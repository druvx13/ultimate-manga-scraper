# System Architecture

## Overview

The **Ultimate Web Novel & Manga Scraper** is a monolithic WordPress plugin designed to automate the content ingestion pipeline for Manga and Web Novel sites. It is tightly coupled with the **Madara** WordPress theme and its associated core plugin (`WP_MANGA_STORAGE`).

The system operates on a "Rule" based model, where administrators define scraping targets (URLs), schedules, and processing parameters. These rules are executed via WordPress Cron or manually triggered.

## Core Components

### 1. The God Object (`ultimate-manga-scraper.php`)
Almost all business logic resides in the main plugin file. This includes:
*   **Initialization**: Hook registration, text domain loading.
*   **Cron Scheduler**: `ums_cron` function orchestrates rule execution.
*   **Scraping Engine**: Logic for fetching HTML (`ums_get_web_page`), parsing DOM (`simple_html_dom`), and extracting content.
*   **Headless Integration**: Wrappers for `shell_exec` to call PhantomJS and Puppeteer.
*   **Translation**: Integration with Google, DeepL, and Microsoft Translator APIs.
*   **Database Interaction**: Direct calls to `wp_insert_post`, `update_post_meta`, and Madara specific storage functions.

### 2. Scraping Strategies

The plugin employs a tiered approach to fetching content:

1.  **Direct cURL/FileGetContents**: Fast, low resource usage. Used for static sites.
2.  **PhantomJS**: Legacy headless browser. Used when JavaScript rendering is required.
    *   *Mechanism*: `shell_exec('phantomjs res/phantomjs/phantom.js ...')`
3.  **Puppeteer (Node.js)**: Modern headless browser. Used for complex JS sites or Cloudflare bypass.
    *   *Mechanism*: `shell_exec('node res/puppeteer/puppeteer.js ...')`
4.  **External APIs**: Integration with "HeadlessBrowserAPI" (commercial service) as a fallback.
5.  **Tor**: Support for routing traffic through Tor (via external API).

### 3. Madara Integration

The plugin is not a generic scraper; it is purpose-built for the **Madara** theme ecosystem.

*   **Dependency**: Checks for `WP_MANGA_STORAGE` class.
*   **Data Model**: Maps scraped data to `wp-manga` post type.
*   **Taxonomies**: Automatically creates and assigns:
    *   `wp-manga-genre`
    *   `wp-manga-author`
    *   `wp-manga-artist`
    *   `wp-manga-release` (Year)
*   **Chapter Storage**: Handles the complex directory structure required by Madara for storing chapter images (e.g., `wp-content/uploads/manga/{uniqid}/{chapter_slug}/`).

### 4. Scheduler & Execution

1.  **Trigger**: WP-Cron event `umsaction`.
2.  **Iterator**: Loads all rules from `wp_options` (`ums_rules_list`, `ums_novel_list`, etc.).
3.  **Constraint Check**: Checks `schedule` (time interval) vs `last_run`.
4.  **Locking**: Uses file locking (`flock`) and database flags (`ums_running_list`) to prevent overlapping executions.
5.  **Execution**: Calls `ums_run_rule($id, $type)`.

### 5. Content Processing Pipeline

```
[Fetch HTML] -> [Detect Cloudflare] -> [Parse DOM] -> [Extract Metadata]
      |
      v
[Download Images/Text] -> [Spin/Translate Content] -> [Create WP Post]
      |
      v
[Create Madara Volume] -> [Create Madara Chapter] -> [Move Images to Storage]
```

## Subsystems

### Madara Enhancements (`includes/`)
A separate module allowing users to search and add manga from "Madara-based" source sites (like `manhuaus.com`) using their internal AJAX APIs (`admin-ajax.php?action=madara_load_more`). This bypasses standard DOM scraping by consuming structured JSON/HTML responses.

### Translation Engine
Supports both API-based (paid) and scraping-based (free/unstable) translation.
*   **Google**: Supports "Free" mode (scraping Google Translate web) and API mode.
*   **DeepL**: API integration.
*   **Microsoft**: API integration.
*   **Text Spinner**: Basic synonym replacement using `res/synonyms.dat`.

### Image Handling
*   **Downloader**: Fetches images via cURL.
*   **Processor**: Can resize images using `ImageResize` library.
*   **Storage**: Saves to WordPress Media Library (`wp_insert_attachment`) or directly to the file system for Madara's custom storage driver.

## ASCII Diagram

```
+---------------------------------------------------------+
|                WordPress / Madara Theme                 |
+---------------------------------------------------------+
          ^                       ^
          |                       |
+---------+---------+   +---------+---------+
|   Cron Scheduler  |   |    Admin UI       |
| (ums_cron)        |   | (Settings/Rules)  |
+---------+---------+   +---------+---------+
          |                       |
          v                       v
+---------------------------------------------------------+
|               Main Logic (God Object)                   |
|             ultimate-manga-scraper.php                  |
+---------------------------------------------------------+
    |           |            |             |
    v           v            v             v
[Scrapers]  [Parser]    [Translator]   [Storage]
    |           |            |             |
    +-> cURL    +-> DOM      +-> Google    +-> WP DB
    +-> Phantom +-> Regex    +-> DeepL     +-> Filesystem
    +-> Node    +-> JSON     +-> Bing      +-> S3 (via Madara)
```
