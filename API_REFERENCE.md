# API Reference

## Overview

This document provides a technical reference for developers working with or extending the **Ultimate Web Novel & Manga Scraper** plugin. It details key functions, hooks, filters, and classes.

## Core Functions

### Scraping Engine

#### `ums_get_web_page($url, $use_proxy = false, $custom_cookies = array(), $timeout = 0, $phantom = false)`

Fetches a web page using various methods (cURL, PhantomJS, Puppeteer).

**Parameters:**
- `$url` (string): The URL to fetch
- `$use_proxy` (bool): Whether to use configured proxy
- `$custom_cookies` (array): Custom cookies to send with request
- `$timeout` (int): Request timeout in seconds
- `$phantom` (bool): Force use of headless browser

**Returns:** (string) HTML content or false on failure

**Example:**
```php
$html = ums_get_web_page('https://example.com/manga/chapter-1');
if ($html) {
    // Process HTML
}
```

#### `ums_run_rule($id, $type)`

Executes a specific scraping rule.

**Parameters:**
- `$id` (int): Rule ID from the rules array
- `$type` (string): Type of rule ('manga', 'novel', 'madara', etc.)

**Returns:** void

### Content Processing

#### `ums_sanitize_html_content($html)`

Sanitizes scraped HTML content by removing dangerous tags and scripts.

**Parameters:**
- `$html` (string): Raw HTML content

**Returns:** (string) Sanitized HTML

**Removed Tags:**
- `<script>`, `<iframe>`, `<object>`, `<embed>`, `<form>`, `<input>`, `<style>`, `<link>`, `<meta>`

#### `ums_repairHTML($str)`

Repairs and tidies HTML content.

**Parameters:**
- `$str` (string): HTML string

**Returns:** (string) Cleaned HTML

#### `ums_strip_links($content)`

Removes all hyperlinks from content while preserving text.

**Parameters:**
- `$content` (string): HTML content

**Returns:** (string) Content without links

### Translation Functions

#### `ums_translate($text, $from_lang, $to_lang, $source = 'google')`

Translates text using configured translation service.

**Parameters:**
- `$text` (string): Text to translate
- `$from_lang` (string): Source language code (e.g., 'en', 'ja')
- `$to_lang` (string): Target language code
- `$source` (string): Translation service ('google', 'deepl', 'bing')

**Returns:** (string) Translated text or original on failure

**Supported Services:**
- **Google Translate**: Free (web scraping) or API
- **DeepL**: API only
- **Microsoft Translator**: API only

#### `ums_google_translate($text, $to)`

Google Translate implementation (free version).

**Parameters:**
- `$text` (string): Text to translate
- `$to` (string): Target language code

**Returns:** (string) Translated text

### Image Handling

#### `ums_extractMangaImages($html, $rule_id)`

Extracts manga image URLs from chapter HTML.

**Parameters:**
- `$html` (string): Chapter HTML content
- `$rule_id` (int): Rule ID for site-specific extraction logic

**Returns:** (array) Array of image URLs

#### `ums_download_image($url, $save_path, $use_proxy = false)`

Downloads an image from URL to local path.

**Parameters:**
- `$url` (string): Image URL
- `$save_path` (string): Local file path to save
- `$use_proxy` (bool): Use proxy for download

**Returns:** (bool) Success status

## WordPress Hooks

### Actions

#### `umsaction`

Main cron hook that triggers scraping execution.

**Usage:**
```php
add_action('umsaction', 'ums_cron');
```

#### `ums_after_chapter_import`

Fired after a chapter is successfully imported.

**Parameters:**
- `$chapter_id` (int): WordPress post ID of the chapter
- `$manga_id` (int): Parent manga post ID
- `$rule_id` (int): Rule that imported this chapter

**Usage:**
```php
add_action('ums_after_chapter_import', function($chapter_id, $manga_id, $rule_id) {
    // Custom logic after chapter import
}, 10, 3);
```

### Filters

#### `ums_chapter_content`

Filters chapter content before saving to database.

**Parameters:**
- `$content` (string): Chapter HTML content
- `$chapter_data` (array): Chapter metadata

**Usage:**
```php
add_filter('ums_chapter_content', function($content, $chapter_data) {
    // Modify content
    return $content;
}, 10, 2);
```

#### `ums_manga_metadata`

Filters manga metadata before creating/updating post.

**Parameters:**
- `$metadata` (array): Manga data (title, author, genres, etc.)

**Usage:**
```php
add_filter('ums_manga_metadata', function($metadata) {
    // Modify metadata
    return $metadata;
});
```

## AJAX Actions

### Admin AJAX Endpoints

All admin AJAX actions require `manage_options` capability.

#### `wp_ajax_ums_my_action_callback`

Manual rule execution trigger.

**Request Parameters:**
- `id` (int): Rule ID
- `type` (string): Rule type

**Response:**
```json
{
    "status": "success",
    "message": "Rule executed successfully"
}
```

#### `wp_ajax_madara_load_more`

Loads manga from Madara-based source sites.

**Request Parameters:**
- `source_url` (string): Source site URL
- `page` (int): Page number
- `search` (string): Search query

**Response:**
```json
{
    "success": true,
    "data": {
        "manga": [...],
        "has_more": true
    }
}
```

## Database Schema

### Options Table

Configuration stored in `wp_options`:

| Option Key | Type | Description |
|------------|------|-------------|
| `ums_Main_Settings` | serialized array | Global plugin settings |
| `ums_rules_list` | serialized array | MangaFox scraping rules |
| `ums_novel_list` | serialized array | Novel scraping rules |
| `ums_text_list` | serialized array | WuxiaWorld scraping rules |
| `ums_manga_generic_list` | serialized array | Generic manga rules |
| `ums_madara_list` | serialized array | Madara site rules |
| `ums_running_list` | serialized array | Currently executing rule IDs |

### Post Meta

Chapter and manga data stored in `wp_postmeta`:

| Meta Key | Description |
|----------|-------------|
| `_manga_import_slug` | Original source slug for deduplication |
| `_wp_manga_chapter_type` | Chapter type (manga/text) |
| `_wp_manga_volume` | Volume number |
| `_wp_manga_chapter_index` | Chapter index/number |

## Classes

### `WP_MANGA_STORAGE` (Madara Core)

External class provided by Madara theme.

**Key Methods:**
- `wp_manga_upload_single_chapter($manga_id, $chapter_data, $images)`: Uploads chapter with images
- `get_chapter_by_slug($manga_id, $slug)`: Retrieves chapter by slug

### Custom Classes (in `includes/`)

#### `Madara_Fetcher`

Handles fetching manga data from Madara-based sites via AJAX.

**Methods:**
- `fetch_manga_list($url, $page)`: Fetches manga listing
- `search_manga($url, $query)`: Searches manga on source site

#### `Madara_Handler`

Processes and imports manga from Madara sources.

**Methods:**
- `import_manga($source_url, $manga_slug)`: Imports a manga from source
- `sync_chapters($manga_id, $source_url)`: Syncs chapters with source

## Constants

### Plugin Constants

```php
// Plugin version
define('UMS_VERSION', '2.0.3');

// Plugin directory path
define('UMS_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Plugin URL
define('UMS_PLUGIN_URL', plugin_dir_url(__FILE__));
```

## Error Codes

| Code | Description |
|------|-------------|
| `UMS_ERROR_NETWORK` | Network/connection error |
| `UMS_ERROR_PARSE` | HTML parsing failed |
| `UMS_ERROR_CLOUDFLARE` | Cloudflare protection detected |
| `UMS_ERROR_TIMEOUT` | Request timeout |
| `UMS_ERROR_AUTH` | Authentication failed (API) |

## Best Practices

### Custom Scrapers

When adding support for a new manga source:

1. Add source detection logic in `ums_run_rule()`
2. Implement site-specific parsing in `ums_extractMangaImages()`
3. Handle site-specific cookies/headers
4. Test with multiple manga from the source
5. Document any special requirements

### Performance

- Use caching for repeated requests
- Batch image downloads when possible
- Implement rate limiting to avoid IP bans
- Use headless browsers only when necessary

### Security

- Always sanitize scraped content
- Validate URLs before fetching
- Use nonces for all AJAX actions
- Check user capabilities before operations

## Extending the Plugin

### Adding a New Translation Service

```php
function ums_custom_translate($text, $to_lang) {
    // Your translation logic
    return $translated_text;
}

add_filter('ums_translate_service', function($text, $to_lang, $service) {
    if ($service === 'custom') {
        return ums_custom_translate($text, $to_lang);
    }
    return $text;
}, 10, 3);
```

### Custom Storage Backend

```php
add_filter('ums_image_storage', function($local_path, $image_url, $manga_id) {
    // Upload to custom CDN
    $cdn_url = upload_to_cdn($local_path);
    return $cdn_url;
}, 10, 3);
```

## Logging

### Log Levels

- **INFO**: General execution flow
- **WARNING**: Non-critical issues
- **ERROR**: Failures that prevent operation

### Log Format

```
[2024-02-07 10:30:45] [INFO] Rule #5: Starting execution
[2024-02-07 10:30:46] [ERROR] Failed to fetch URL: Connection timeout
```

### Accessing Logs

Logs are stored in: `wp-content/ums_info.log`

Enable detailed logging in Main Settings for verbose output.
