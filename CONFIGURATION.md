# Configuration Reference

This document details the configuration options available in the **Ultimate Web Novel & Manga Scraper**. Configuration is managed via the WordPress Admin Dashboard.

## Main Settings
*Menu: Ultimate Web Novel & Manga Scraper -> Main Settings*

### General Options
*   **Main Switch (`ums_enabled`)**: Master toggle. Must be `on` for any scraping to occur.
*   **Logging (`enable_logging`)**: Enables basic logging to `wp-content/ums_info.log`.
*   **Detailed Logging (`enable_detailed_logging`)**: Verbose logging for debugging.
*   **Auto Clear Logs (`auto_clear_logs`)**: Frequency to wipe the log file (e.g., Daily, Weekly).

### Scraper Settings
*   **CloudFlare Caching**: Enable if the host server is behind Cloudflare to mitigate execution time limits.
*   **Disable Rerun (`disable_rerun`)**: Prevents the scraper from retrying failed rules immediately.
*   **Manga Storage (`manga_storage`)**:
    *   `local`: Store images on the web server.
    *   `amazon_s3`: Store images on S3 (requires Madara S3 setup).
    *   `imgur`: Upload to Imgur.
    *   `flickr`: Upload to Flickr.
*   **Timeouts**:
    *   `request_timeout`: Delay (seconds) between HTTP requests.
    *   `rule_timeout`: Max execution time (seconds) for a single rule.

### Headless Browser Settings
*   **PhantomJS Path**: Absolute path to the `phantomjs` executable.
*   **PhantomJS Timeout**: Max wait time for page rendering.
*   **HeadlessBrowserAPI Key**: API key for the third-party scraping service (optional).

### Proxy Settings
*   **Proxy URL**: Format `ip:port` or comma-separated list.
*   **Proxy Auth**: Format `user:pass`.

### Translation API Keys
*   **Google Trans Auth**: Key for Google Translate API.
*   **Bing Auth**: Key for Microsoft Translator.
*   **DeepL Auth**: Key for DeepL API.

## Rule Configuration
*Menu: Scraper Rules (e.g., Manga Scraper - FanFox)*

Each rule consists of the following parameters:

| Parameter | Description |
| :--- | :--- |
| **Manga URL** | The direct link to the manga's Table of Contents (TOC) page. |
| **Schedule** | How often to run (Hours). |
| **Active** | Enable/Disable this specific rule. |
| **Max Chapters** | Maximum number of chapters to scrape per run. |
| **Status** | Post status for created manga (Publish, Draft, Pending). |
| **Author** | WordPress user to assign as author. |
| **Create Tags** | Whether to import original tags. |
| **Default Category** | Fallback category if none found. |
| **Auto Categories** | Create categories from source genres. |
| **Use PhantomJS** | Force headless browser for this rule. |
| **Reverse Chapters** | Scrape oldest chapters first (useful for backfilling). |
| **Translation** | Target language for translation (or Disabled). |
| **Translation Source** | API to use (Google, Bing, DeepL). |

## Database Options
*Configuration stored in `wp_options` table.*

| Option Name | Description |
| :--- | :--- |
| `ums_Main_Settings` | Serialized array of global settings. |
| `ums_rules_list` | Serialized array of FanFox scraping rules. |
| `ums_novel_list` | Serialized array of NovLove scraping rules. |
| `ums_text_list` | Serialized array of WuxiaWorld scraping rules. |
| `ums_manga_generic_list` | Serialized array of Madara-based scraping rules. |
| `ums_running_list` | Array of currently executing rule IDs (Lock file). |
