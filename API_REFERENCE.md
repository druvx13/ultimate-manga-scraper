# API Reference

## WordPress Hooks & Filters

The Ultimate Web Novel & Manga Scraper provides several hooks and filters for developers to extend or modify functionality.

### Actions

#### `ums_before_scrape`
Fires before a scraping rule is executed.

```php
do_action('ums_before_scrape', $rule_id, $rule_type);
```

**Parameters:**
- `$rule_id` (int): The ID of the rule being executed
- `$rule_type` (string): Type of rule ('manga', 'novel', 'generic')

**Example:**
```php
add_action('ums_before_scrape', 'my_custom_function', 10, 2);
function my_custom_function($rule_id, $rule_type) {
    // Your code here
    error_log("Starting scrape for rule ID: $rule_id");
}
```

#### `ums_after_scrape`
Fires after a scraping rule completes execution.

```php
do_action('ums_after_scrape', $rule_id, $rule_type, $result);
```

**Parameters:**
- `$rule_id` (int): The ID of the rule that was executed
- `$rule_type` (string): Type of rule
- `$result` (array): Result data from the scraping operation

#### `ums_chapter_created`
Fires when a new chapter is created.

```php
do_action('ums_chapter_created', $post_id, $chapter_data);
```

**Parameters:**
- `$post_id` (int): WordPress post ID of the parent manga/novel
- `$chapter_data` (array): Chapter metadata (title, slug, images, etc.)

### Filters

#### `ums_scraper_user_agent`
Filters the User-Agent string used for HTTP requests.

```php
apply_filters('ums_scraper_user_agent', $user_agent);
```

**Parameters:**
- `$user_agent` (string): Default User-Agent string

**Returns:**
- (string): Modified User-Agent

**Example:**
```php
add_filter('ums_scraper_user_agent', 'my_custom_user_agent');
function my_custom_user_agent($user_agent) {
    return 'MyCustomBot/1.0';
}
```

#### `ums_translation_text`
Filters text before translation.

```php
apply_filters('ums_translation_text', $text, $source_lang, $target_lang);
```

**Parameters:**
- `$text` (string): Original text
- `$source_lang` (string): Source language code
- `$target_lang` (string): Target language code

**Returns:**
- (string): Modified text

#### `ums_chapter_images`
Filters the array of chapter images before storage.

```php
apply_filters('ums_chapter_images', $images, $chapter_slug);
```

**Parameters:**
- `$images` (array): Array of image URLs
- `$chapter_slug` (string): Chapter slug

**Returns:**
- (array): Modified array of images

#### `ums_request_headers`
Filters HTTP request headers.

```php
apply_filters('ums_request_headers', $headers, $url);
```

**Parameters:**
- `$headers` (array): Default request headers
- `$url` (string): Target URL

**Returns:**
- (array): Modified headers

## PHP Functions

### Core Functions

#### `ums_get_web_page($url, $options = [])`
Fetches content from a URL using the appropriate method (cURL, PhantomJS, or Puppeteer).

**Parameters:**
- `$url` (string): Target URL
- `$options` (array): Optional settings
  - `use_headless` (bool): Force headless browser
  - `timeout` (int): Request timeout in seconds
  - `headers` (array): Custom HTTP headers

**Returns:**
- (string|false): HTML content or false on failure

**Example:**
```php
$html = ums_get_web_page('https://example.com/manga/title', [
    'use_headless' => true,
    'timeout' => 30
]);
```

#### `ums_translate($text, $target_lang, $source_lang = 'auto')`
Translates text using configured translation service.

**Parameters:**
- `$text` (string): Text to translate
- `$target_lang` (string): Target language code (e.g., 'en', 'es', 'zh-CN')
- `$source_lang` (string): Source language code (default: 'auto')

**Returns:**
- (string): Translated text

**Example:**
```php
$translated = ums_translate('Hello World', 'es');
// Returns: "Hola Mundo"
```

#### `ums_run_rule($rule_id, $rule_type)`
Manually executes a scraping rule.

**Parameters:**
- `$rule_id` (int): Rule identifier
- `$rule_type` (string): Type ('manga', 'novel', 'generic')

**Returns:**
- (bool): Success status

**Example:**
```php
// Run manga rule #5
ums_run_rule(5, 'manga');
```

#### `ums_log($message, $level = 'info')`
Logs a message to the plugin log file.

**Parameters:**
- `$message` (string): Message to log
- `$level` (string): Log level ('info', 'warning', 'error')

**Example:**
```php
ums_log('Custom scraping started', 'info');
ums_log('Failed to download image', 'error');
```

### Utility Functions

#### `ums_repairHTML($html)`
Cleans and repairs malformed HTML.

**Parameters:**
- `$html` (string): HTML content

**Returns:**
- (string): Cleaned HTML

#### `ums_strip_links($html, $keep_text = true)`
Removes or processes links from HTML content.

**Parameters:**
- `$html` (string): HTML content
- `$keep_text` (bool): Keep link text (default: true)

**Returns:**
- (string): Processed HTML

#### `ums_detect_cloudflare($html)`
Checks if response contains Cloudflare protection.

**Parameters:**
- `$html` (string): HTML response

**Returns:**
- (bool): True if Cloudflare detected

## REST API Endpoints

The plugin exposes several REST API endpoints for programmatic access.

### Base URL
```
/wp-json/ums/v1/
```

### Endpoints

#### GET `/rules`
Retrieve all scraping rules.

**Authentication:** Required (Administrator)

**Response:**
```json
{
    "success": true,
    "rules": [
        {
            "id": 1,
            "type": "manga",
            "url": "https://example.com/manga/title",
            "schedule": 24,
            "active": true,
            "last_run": "2026-02-07 08:00:00"
        }
    ]
}
```

#### POST `/rules`
Create a new scraping rule.

**Authentication:** Required (Administrator)

**Request Body:**
```json
{
    "type": "manga",
    "url": "https://example.com/manga/title",
    "schedule": 24,
    "max_chapters": 10,
    "active": true
}
```

**Response:**
```json
{
    "success": true,
    "rule_id": 5,
    "message": "Rule created successfully"
}
```

#### POST `/rules/{id}/run`
Trigger immediate execution of a rule.

**Authentication:** Required (Administrator)

**Response:**
```json
{
    "success": true,
    "message": "Rule execution started"
}
```

#### DELETE `/rules/{id}`
Delete a scraping rule.

**Authentication:** Required (Administrator)

**Response:**
```json
{
    "success": true,
    "message": "Rule deleted successfully"
}
```

## Database Schema

### Options Table (`wp_options`)

#### `ums_Main_Settings`
Serialized array of global settings.

**Structure:**
```php
array(
    'ums_enabled' => 'on',
    'enable_logging' => 'on',
    'phantomjs_path' => '/usr/bin/phantomjs',
    'proxy_url' => '',
    'manga_storage' => 'local',
    // ... more settings
)
```

#### `ums_rules_list`
FanFox manga scraping rules.

**Structure:**
```php
array(
    1 => array(
        'url' => 'https://fanfox.net/manga/title',
        'schedule' => 24,
        'active' => true,
        'last_run' => 1638360000,
        'max_chapters' => 10,
        // ... more fields
    ),
    // ... more rules
)
```

#### `ums_manga_generic_list`
Madara-based manga scraping rules (same structure as `ums_rules_list`).

#### `ums_novel_list`
Novel scraping rules (same structure).

#### `ums_running_list`
Currently executing rules (lock mechanism).

**Structure:**
```php
array(
    'manga_1' => true,
    'novel_5' => true
)
```

### Post Meta (`wp_postmeta`)

#### `_manga_import_slug`
Original slug from source site (used for duplicate detection).

**Type:** string

#### `_manga_source_url`
Original source URL.

**Type:** string

#### `_wp_manga_chapter_type`
Chapter storage type ('manga' or 'text').

**Type:** string

## Constants

### Plugin Constants

```php
// Plugin version
UMS_VERSION = '2.0.3';

// Plugin directory path
UMS_PLUGIN_DIR = '/path/to/wp-content/plugins/ultimate-manga-scraper/';

// Plugin URL
UMS_PLUGIN_URL = 'https://yoursite.com/wp-content/plugins/ultimate-manga-scraper/';
```

### Usage in Code

```php
// Access plugin directory
$template_path = UMS_PLUGIN_DIR . 'res/admin-templates/template.php';

// Access plugin URL (for assets)
$script_url = UMS_PLUGIN_URL . 'scripts/admin.js';
```

## Error Codes

### Common Error Messages

| Code | Message | Cause |
|------|---------|-------|
| `UMS_ERR_001` | "Failed to fetch URL" | Network error or invalid URL |
| `UMS_ERR_002` | "Cloudflare protection detected" | Target site has anti-bot protection |
| `UMS_ERR_003` | "PhantomJS execution failed" | Headless browser error |
| `UMS_ERR_004` | "Translation API error" | Invalid API key or quota exceeded |
| `UMS_ERR_005` | "Madara storage not available" | WP_MANGA_STORAGE class not found |
| `UMS_ERR_006` | "Image download failed" | Failed to fetch image from source |
| `UMS_ERR_007` | "Maximum execution time exceeded" | Script timeout |

## Examples

### Custom Scraper Integration

```php
// Add custom scraper logic
add_action('ums_before_scrape', 'my_custom_scraper', 10, 2);
function my_custom_scraper($rule_id, $rule_type) {
    if ($rule_type === 'custom') {
        // Your custom scraping logic
        $html = ums_get_web_page($url);
        // Process HTML...
    }
}
```

### Custom Translation Hook

```php
// Modify text before translation
add_filter('ums_translation_text', 'preprocess_text', 10, 3);
function preprocess_text($text, $source, $target) {
    // Remove special characters
    $text = preg_replace('/[^\w\s]/', '', $text);
    return $text;
}
```

### Programmatic Rule Creation

```php
// Get existing rules
$rules = get_option('ums_manga_generic_list', array());

// Add new rule
$new_rule = array(
    'url' => 'https://example.com/manga/new-title',
    'schedule' => 12,
    'active' => true,
    'last_run' => 0,
    'max_chapters' => 20,
    'status' => 'publish',
    'translation' => 14, // English
    'use_headless' => false
);

$rules[] = $new_rule;
update_option('ums_manga_generic_list', $rules);
```

## Best Practices

1. **Always check for Madara theme** before executing scraping operations
2. **Use headless browsers sparingly** - they consume significantly more resources
3. **Implement rate limiting** to avoid overwhelming target sites
4. **Cache API responses** when possible to reduce API calls
5. **Use proper error handling** and logging for debugging
6. **Test rules on staging** before deploying to production
7. **Monitor execution times** and adjust timeouts accordingly
8. **Rotate proxies** for high-volume scraping to avoid IP bans

## Security Considerations

- **Never expose API keys** in client-side code
- **Validate all user inputs** before processing
- **Use nonces** for admin actions
- **Check capabilities** before allowing operations
- **Sanitize URLs** before making requests to prevent SSRF
- **Disable `shell_exec`** if headless browsers are not needed
- **Implement rate limiting** to prevent abuse
- **Regular security audits** of scraping rules

## Support & Resources

- **GitHub Repository:** https://github.com/druvx13/ultimate-manga-scraper
- **Issue Tracker:** https://github.com/druvx13/ultimate-manga-scraper/issues
- **Documentation:** See [DOCUMENTATION_INDEX.md](DOCUMENTATION_INDEX.md)
- **Security:** See [SECURITY.md](SECURITY.md)
