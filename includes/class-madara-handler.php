<?php
/*
 * Copyright (C) 2026 NIKOL
 * Licensed under LUCA Free License v1.0
 * DO WHAT THE FUCK YOU WANT TO.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/*
 * Class UMS_Madara_Handler
 * Handles the admin interface and AJAX actions for the Ultimate Manga Scraper: Madara Enhancements plugin.
 */
class UMS_Madara_Handler {
    // Initialize hooks and actions
    public static function init() {
        add_action('wp_ajax_load_more_manga', [__CLASS__, 'load_more_manga']); // Handle AJAX request for loading more manga
        add_action('wp_ajax_add_manga', [__CLASS__, 'add_manga']); // Handle AJAX request for adding manga
        add_action('wp_ajax_search_manga', [__CLASS__, 'search_manga']); // Handle AJAX request for searching manga
        add_action('wp_ajax_save_manga_fetch_url', [__CLASS__, 'save_manga_fetch_url']); // Handle AJAX request for saving manga fetch URL
    }


    // Display the admin page
    public static function ums_enhancements() {
		 // Clear the madara_manga_list option on first load
        update_option('madara_manga_list', []); // This empties the madara_manga_list
        $manga_list = get_option('madara_manga_list', []); // Get the list of manga
        $existing_manga_urls = array_map('trim', array_column(get_option('ums_manga_generic_list', []), 0)); // Get the list of existing manga URLs

        // Filter out existing manga from the list
        $filtered_manga_list = array_filter($manga_list, function($manga) use ($existing_manga_urls) {
            return !in_array(trim($manga['url']), $existing_manga_urls);
        });

        $manga_fetch_url = get_option('manga_fetch_url', 'https://manhuaus.com/wp-admin/admin-ajax.php'); // Get the current manga fetch URL

        ?>
        <div class="wrap">
            <h1>Ultimate Manga Scraper: Madara Enhancements</h1>
            <p>Credits to ThuGie</p>
            <!-- URL Settings Form -->
            <form id="url-settings-form">
                <h2>Set Manga Fetch URL</h2>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="manga-fetch-url">Manga Fetch URL</label></th>
                        <td><input name="manga-fetch-url" type="text" id="manga-fetch-url" value="<?php echo esc_attr($manga_fetch_url); ?>" class="regular-text" /></td>
                    </tr>
                </table>
                <button type="button" class="button button-primary" id="save-url-settings">Save URL</button>
            </form>

            <!-- Search Form -->
            <hr />
            <form id="search-form">
                <h2>Search Manga</h2>
                <label for="search-query">Search Query</label>
                <input type="text" id="search-query" name="search-query" class="regular-text" />
                <label for="search-type">Search Type</label>
                <select id="search-type" name="search-type">
                    <option value="new">New</option>
                    <option value="latest">Latest</option>
                    <option value="trending">Trending</option>
                    <option value="most_viewed">Most Viewed</option>
                    <option value="rating">Rating</option>
                    <option value="a_z">A-Z</option>
                    <option value="relevance">Relevance</option>
                </select>
                <button type="button" class="button button-secondary" id="search-button">Search</button>
            </form>

            <!-- Manga List -->
            <hr />
            <div>
                <label for="auto-load-more">
                    <input type="checkbox" id="auto-load-more" /> Enable Auto Load More
                </label>
                <p id="manga-count">Manga Loaded: 0</p>
            </div>
            <table class="widefat" id="manga-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Cover Image</th>
                        <th>Description</th>
                        <th>Genres</th>
                        <th>Status</th>
                        <th>Last Updated</th>
                        <th>Latest Chapter</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($filtered_manga_list as $index => $manga): ?>
                        <tr>
                            <td><?php echo esc_html($index + 1); ?></td>
                            <td><?php echo esc_html($manga['title']); ?></td>
                            <td><img src="<?php echo esc_url($manga['cover_image']); ?>" alt="<?php echo esc_attr($manga['title']); ?>" width="100"></td>
                            <td><?php echo esc_html($manga['description']); ?></td>
                            <td><?php echo esc_html($manga['genres']); ?></td>
                            <td><?php echo esc_html($manga['status']); ?></td>
                            <td><?php echo esc_html($manga['last_updated']); ?></td>
                            <td><?php echo esc_html($manga['latest_chapter']); ?></td>
                            <td>
                                <form method="post" class="add-manga-form">
                                    <input type="hidden" name="add_manga_url" value="<?php echo esc_attr($manga['url']); ?>">
                                    <button type="submit" class="button button-primary">Add Manga</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button id="load-more" class="button button-secondary">Load More</button> <!-- Load More Button -->
        </div>
        <?php
    }

    // Handle AJAX request to load more manga
    public static function load_more_manga() {
        check_ajax_referer('madara_enhancements_nonce', '_ajax_nonce'); // Verify nonce for security

        $page = isset($_POST['page']) ? intval($_POST['page']) : 0; // Get the current page
        $query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : ''; // Get the search query
        $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : ''; // Get the search type

        $manga_list = UMS_Madara_Fetcher::get_manga_data($page, $query, $type); // Fetch manga data

        $existing_manga_urls = array_map('trim', array_column(get_option('ums_manga_generic_list', []), 0)); // Get the list of existing manga URLs

        // Filter out existing manga from the list
        $filtered_manga_list = array_filter($manga_list, function($manga) use ($existing_manga_urls) {
            return !in_array(trim($manga['url']), $existing_manga_urls);
        });

        if (isset($manga_list['error'])) {
            wp_send_json_error($manga_list['error']); // Send error response if there's an error
        } else {
            // Append new manga to the existing list
            $current_manga_list = get_option('madara_manga_list', []);
            $updated_manga_list = array_merge($current_manga_list, $filtered_manga_list);
            update_option('madara_manga_list', $updated_manga_list); // Update the option with the latest manga list
            wp_send_json_success($filtered_manga_list); // Send success response with the filtered manga list
        }
    }

    // Handle AJAX request to add manga
    public static function add_manga() {
        check_ajax_referer('madara_enhancements_nonce', '_ajax_nonce'); // Verify nonce for security

        $url = isset($_POST['add_manga_url']) ? sanitize_text_field($_POST['add_manga_url']) : null; // Get the manga URL

        $manga_list = get_option('madara_manga_list', []); // Get the current manga list

        if ($url !== null) {
            $manga_to_add = array_filter($manga_list, function ($manga) use ($url) {
                return $manga['url'] === $url;
            });

            if (!empty($manga_to_add)) {
                $manga_to_add = array_values($manga_to_add)[0];

                // Check if the manga already exists in the saved rules
                $rules = get_option('ums_manga_generic_list', []);
                foreach ($rules as $rule) {
                    if (trim($rule[0]) === trim($manga_to_add['url'])) {
                        wp_send_json_error('Manga already exists.');
                        return;
                    }
                }

                self::save_manga_rules($manga_to_add); // Save manga rules

                // Remove the manga from the list after adding
                $manga_list = array_filter($manga_list, function ($manga) use ($url) {
                    return $manga['url'] !== $url;
                });
                update_option('madara_manga_list', $manga_list); // Update the manga list

                wp_send_json_success(); // Send success response
            } else {
                wp_send_json_error('Manga not found.'); // Send error response if manga not found
            }
        } else {
            wp_send_json_error('Invalid request.'); // Send error response if the request is invalid
        }
    }

    // Save manga rules
    public static function save_manga_rules($manga) {
        // Clear the cache for the option
        $GLOBALS['wp_object_cache']->delete('ums_manga_generic_list', 'options');

        // Get current rules
        $rules = get_option('ums_manga_generic_list', []);

        // Validate the schedule format
        $schedule = '24';
        if (!is_numeric($schedule) || $schedule <= 0) {
            $schedule = '24';
        }

        $new_rule = [
            trim($manga['url']),
            $schedule,
            '1',
            (new DateTime())->modify('-24 hours -5 minutes')->format('Y-m-d H:i:s'),
            '1000',
            'publish',
            'admin',
            '',
            '',
            'genre',
            'genre',
            '',
            '1',
            '0',
            '1',
            '0',
            '0',
            '0',
            '0',
        ];

        $rules[] = $new_rule;
        update_option('ums_manga_generic_list', $rules); // Update the rules option
    }

    // Enqueue scripts for the admin page
    public static function enqueue_scripts() {
        wp_enqueue_script('madara-enhancements', plugin_dir_url(__FILE__) . '../assets/js/madara-enhancements.js', ['jquery'], null, true);
        wp_localize_script('madara-enhancements', 'madaraEnhancements', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('madara_enhancements_nonce'),
        ]);
    }

    // Handle AJAX request to search manga
// Handle AJAX request to search manga
public static function search_manga() {
    check_ajax_referer('madara_enhancements_nonce', '_ajax_nonce'); // Verify nonce for security

    $query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : ''; // Get the search query
    $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : ''; // Get the search type
    $page = isset($_POST['page']) ? intval($_POST['page']) : 0; // Get the page number

    // Fetch manga data from the URL
    $manga_list = UMS_Madara_Fetcher::get_manga_data($page, $query, $type);

    // Check if there was an error fetching the manga data
    if (isset($manga_list['error'])) {
        wp_send_json_error($manga_list['error']); // Send error response if there's an error
        return;
    }

    $existing_manga_urls = array_map('trim', array_column(get_option('ums_manga_generic_list', []), 0)); // Get the list of existing manga URLs

    // Filter out existing manga from the list
    $filtered_manga_list = array_filter($manga_list, function($manga) use ($existing_manga_urls) {
        return !in_array(trim($manga['url']), $existing_manga_urls);
    });

    // Get the current madara_manga_list
    $current_manga_list = get_option('madara_manga_list', []);
    // Merge the current list with the new filtered list
    $updated_manga_list = array_merge($current_manga_list, $filtered_manga_list);
    // Update the madara_manga_list with the combined list
    update_option('madara_manga_list', $updated_manga_list);

    wp_send_json_success(array_values($filtered_manga_list)); // Send success response with the filtered manga list
}

    // Handle AJAX request to save the manga fetch URL
    public static function save_manga_fetch_url() {
        check_ajax_referer('madara_enhancements_nonce', '_ajax_nonce'); // Verify nonce for security
        
        $manga_fetch_url = isset($_POST['manga_fetch_url']) ? esc_url_raw($_POST['manga_fetch_url']) : ''; // Get the manga fetch URL
        
        if ($manga_fetch_url) {
            update_option('manga_fetch_url', $manga_fetch_url); // Update the manga fetch URL option
            wp_send_json_success(); // Send success response
        } else {
            wp_send_json_error('Invalid URL.'); // Send error response if the URL is invalid
        }
    }
}