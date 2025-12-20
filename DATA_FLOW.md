# Data Flow

This document details the lifecycle of data within the **Ultimate Web Novel & Manga Scraper**, from configuration to persistent storage.

## 1. Rule Creation (Input)

**Actor**: Administrator
**Interface**: WordPress Admin (`ums_rules_list.php`, `ums_novel_list.php`)

1.  User inputs target URL (e.g., FanFox manga URL).
2.  User configures parameters:
    *   Schedule (e.g., "Every hour").
    *   Chapter limits.
    *   Translation settings.
    *   Status mapping.
3.  **Storage**: Rule is saved as a serialized array in `wp_options`.
    *   Key: `ums_rules_list` (Manga), `ums_novel_list` (Novels).
    *   Format: `array( id => array( url, schedule, active, last_run, ... ) )`.

## 2. Cron Execution (Trigger)

**Trigger**: WP-Cron (`umsaction` hook).

1.  **Loader**: `ums_cron()` fetches rule arrays from `wp_options`.
2.  **Evaluator**: Iterates through each rule.
    *   Calculates `next_run = last_run + schedule`.
    *   If `now >= next_run`, proceeds.
3.  **Dispatcher**: Calls `ums_run_rule($id, $type)`.

## 3. Scraping Process (Ingestion)

**Function**: `ums_run_rule()`

1.  **Locking**: Checks `ums_running_list` to ensure the rule isn't already running.
2.  **Fetching (Phase 1: Listing)**:
    *   Fetches the main Manga/Novel TOC page.
    *   Strategy: `ums_get_web_page()` -> attempts cURL -> falls back to PhantomJS/Puppeteer if configured or if Cloudflare is detected.
3.  **Parsing**:
    *   DOM Parser extracts: Title, Cover Image, Author, Genre, Status, Chapter List.
    *   Checks if Manga already exists in DB (by Title or `_manga_import_slug`).
4.  **Creation (Parent Post)**:
    *   If new, calls `wp_insert_post()` (`post_type = 'wp-manga'`).
    *   Downloads Cover Image -> `wp_insert_attachment()` -> Sets as Featured Image.
    *   Sets Taxonomies (`wp-manga-genre`, etc.).
5.  **Fetching (Phase 2: Chapters)**:
    *   Iterates through detected chapters.
    *   Checks against existing chapters in DB (`wp_manga_chapter->get_chapter_by_slug`).
    *   If new:
        *   Fetches Chapter Page.
        *   **Manga**: Extracts image URLs (`ums_extractMangaImages`).
        *   **Novel**: Extracts text content (`ums_repairHTML`, `ums_strip_links`).

## 4. Processing & Transformation

1.  **Translation (Optional)**:
    *   If enabled, content (Novel text or Manga Title) is sent to `ums_translate()`.
    *   Calls external API (Google/DeepL/Bing).
2.  **Text Spinning (Optional)**:
    *   If enabled, replaces words with synonyms from `synonyms.dat`.

## 5. Storage (Persistence)

**Manga Images**:
1.  Downloads image binary.
2.  **Path**: `wp-content/uploads/manga/{manga_id}/{chapter_slug}/`.
3.  **File System**: Uses `WP_Filesystem` to write files.

**Database**:
1.  **Madara Tables**:
    *   Typically stores chapter metadata in custom tables (depending on Madara version) or custom post types.
    *   The plugin uses `WP_MANGA_STORAGE` global class to abstract this.
    *   Calls `$wp_manga_storage->wp_manga_upload_single_chapter()`.

## 6. Cleanup

1.  **Logging**: Execution result logged to `ums_info.log` (if enabled).
2.  **State Update**: Updates `last_run` timestamp in the rule array in `wp_options`.
3.  **Unlock**: Removes ID from `ums_running_list`.
