<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/*
 * Class UMS_Madara_Fetcher
 * Fetches manga data from the specified URL.
 */
class UMS_Madara_Fetcher {
    /**
     * Fetch manga data from the specified URL.
     *
     * @param int $page The page number to fetch.
     * @param string $query The search query.
     * @param string $type The type of search (new, latest, trending, etc.).
     * @return array The list of manga data or an error message.
     */
    public static function get_manga_data($page = 0, $query = '', $type = '') {
        // Get the manga fetch URL from options
        $url = get_option('manga_fetch_url', 'https://manhuaus.com/wp-admin/admin-ajax.php');

        // Prepare the query variables
        $vars = [
            's' => $query,
            'orderby' => 'meta_value_num',
            'paged' => $page,
            'template' => 'search',
            'meta_query' => [
                [
                    'relation' => 'AND'
                ]
            ],
            'post_type' => 'wp-manga',
            'post_status' => 'publish',
            'meta_key' => '_latest_update',
            'order' => 'desc',
            'manga_archives_item_layout' => 'big_thumbnail'
        ];

        // Adjust search parameters based on the specified type
        switch ($type) {
            case 'new':
                $vars['orderby'] = 'date';
                break;
            case 'latest':
                $vars['orderby'] = 'meta_value_num';
                $vars['meta_key'] = '_latest_update';
                $vars['order'] = 'desc';
                break;
            case 'trending':
                $vars['orderby'] = 'meta_value_num';
                $vars['meta_key'] = '_wp_manga_week_views_value';
                $vars['order'] = 'desc';
                break;
            case 'most_viewed':
                $vars['orderby'] = 'meta_value_num';
                $vars['meta_key'] = '_wp_manga_views';
                $vars['order'] = 'desc';
                break;
            case 'rating':
                $vars['orderby'] = [
                    ['query_avarage_reviews' => 'DESC'],
                    ['query_total_reviews' => 'DESC']
                ];
                $vars['meta_query'][] = [
                    'query_avarage_reviews' => [
                        'key' => '_manga_avarage_reviews'
                    ],
                    'query_total_reviews' => [
                        'key' => '_manga_total_votes'
                    ]
                ];
                break;
            case 'a_z':
                $vars['orderby'] = 'post_title';
                $vars['order'] = 'ASC';
                break;
            case 'relevance':
                // No additional parameters needed for relevance
                break;
        }

        // Prepare the arguments for the HTTP request
        $args = [
            'sslverify' => false,
            'body' => [
                'action' => 'madara_load_more',
                'page' => $page,
                'template' => 'madara-core/content/content-search',
                'vars' => $vars
            ]
        ];

        // Perform the HTTP request to fetch manga data
        $response = wp_remote_post($url, $args);

        // Check for errors in the response
        if (is_wp_error($response)) {
            return ['error' => $response->get_error_message()];
        }

        // Retrieve and process the response body
        $html = wp_remote_retrieve_body($response);
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        if(empty($html))
        {
            return ['error' => 'Empty response from the server'];
        }
        // Load the HTML into a DOMDocument for parsing
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        // Use XPath to query the DOM for manga items
        $xpath = new DOMXPath($dom);
        $manga_items = $xpath->query('//div[contains(@class, "c-tabs-item__content")]');
        $manga_list = [];

        // Iterate through the manga items and extract data
        foreach ($manga_items as $item) {
            $title = $xpath->query('.//div[@class="post-title"]/h3[@class="h4"]/a', $item)->item(0)->nodeValue;
            $cover_image = $xpath->query('.//div[@class="tab-thumb c-image-hover"]/a/img', $item)->item(0)->getAttribute('data-src');
            $description = '';
            $genres = [];
            $status = '';
            
            $index = 0;
            $summary_headings = $xpath->query('.//div[@class="summary-heading"]/h5', $item);

            // Extract specific details based on the summary headings
            foreach ($summary_headings as $heading) {
                $heading_text = trim($heading->nodeValue);
                if ($heading_text === 'Alternative') {
                    $description = $xpath->query('.//div[@class="summary-content"]', $item)->item($index)->nodeValue;
                    $index++;
                } elseif ($heading_text === 'Authors' || $heading_text === 'Artists') {
                    $index++;
                } elseif ($heading_text === 'Genres') {
                    $genres = [];
                    $genre_elements = $xpath->query('.//div[@class="summary-content"]', $item)->item($index)->getElementsByTagName('a');
                    foreach ($genre_elements as $genre) {
                        $genres[] = $genre->nodeValue;
                    }
                    $index++;
                } elseif ($heading_text === 'Status') {
                    $status = $xpath->query('.//div[@class="summary-content"]', $item)->item($index)->nodeValue;
                    $index++;
                }
            }

            // Extract additional details like last updated date and latest chapter
            if($last_updated = $xpath->query('.//div[@class="meta-item post-on"]/span[@class="font-meta"]', $item)->item(0))
            {
                $last_updated = $xpath->query('.//div[@class="meta-item post-on"]/span[@class="font-meta"]', $item)->item(0)->nodeValue;
            }
            else
            {
                $last_updated = '';
            }
            if($xpath->query('.//div[@class="meta-item latest-chap"]/span[@class="font-meta chapter"]/a', $item)->item(0))
            {
                $latest_chapter = $xpath->query('.//div[@class="meta-item latest-chap"]/span[@class="font-meta chapter"]/a', $item)->item(0)->nodeValue;
            }
            else
            {
                $latest_chapter = '';
            }
            if($xpath->query('.//div[@class="post-title"]/h3[@class="h4"]/a', $item)->item(0))
            {
                $url = $xpath->query('.//div[@class="post-title"]/h3[@class="h4"]/a', $item)->item(0)->getAttribute('href');
            }
            else
            {
                $url = '';
            }

            // Add the extracted manga data to the list
            $manga_list[] = [
                'title' => $title,
                'url' => $url,
                'cover_image' => $cover_image,
                'description' => trim($description),
                'genres' => implode(', ', $genres),
                'status' => trim($status),
                'last_updated' => trim($last_updated),
                'latest_chapter' => $latest_chapter,
            ];
        }

        // Return an error message if no manga are found
        if (empty($manga_list)) {
            return ['error' => 'No manga found on the provided URL.'];
        }

        // Return the list of manga data
        return $manga_list;
    }

    /**
     * Fetch detailed manga data from a specific URL.
     *
     * @param string $url The URL of the manga.
     * @return array The detailed manga data or an error message.
     */
    public static function get_manga_details($url) {
        // Perform the HTTP request to fetch manga details
        $response = wp_remote_get($url, ['sslverify' => false]);

        // Check for errors in the response
        if (is_wp_error($response)) {
            return ['error' => $response->get_error_message()];
        }

        // Retrieve and process the response body
        $html = wp_remote_retrieve_body($response);
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        // Load the HTML into a DOMDocument for parsing
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        // Use XPath to query the DOM for detailed manga data
        $xpath = new DOMXPath($dom);

        // Extract the manga details
        $title = $xpath->query('//h1[@class="title"]')->item(0)->nodeValue;
        $cover_image = $xpath->query('//div[@class="thumb"]/img')->item(0)->getAttribute('src');
        $description = $xpath->query('//div[@class="description-summary"]/div[@class="summary__content show-more"]')->item(0)->nodeValue;
        $genres = [];
        $genre_elements = $xpath->query('//div[@class="genres-content"]/a');
        foreach ($genre_elements as $genre) {
            $genres[] = $genre->nodeValue;
        }
        $status = $xpath->query('//div[@class="post-status"]/div[@class="summary-content"]/a')->item(0)->nodeValue;

        // Return the detailed manga data
        return [
            'title' => trim($title),
            'cover_image' => $cover_image,
            'description' => trim($description),
            'genres' => implode(', ', $genres),
            'status' => trim($status)
        ];
    }
}