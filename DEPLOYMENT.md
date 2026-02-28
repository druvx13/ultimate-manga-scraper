# Deployment Guide

## System Requirements

*   **WordPress**: Version 5.0 or higher.
*   **PHP**: Version 8.2 or higher.
*   **Theme**: **Madara** (By MangaBooth). This plugin is strictly an add-on for Madara.
*   **Plugins**:
    *   **Madara Core** (`WP_MANGA_STORAGE` class must be available).
*   **Extensions**:
    *   `cURL`
    *   `DOM` / `libxml`
    *   `mbstring`
    *   `json`

## Server Requirements (Optional but Recommended)

For advanced scraping features (Headless Browser):

*   **Node.js**: Required for Puppeteer support.
*   **PhantomJS**: Binary installed and executable by the PHP user (Legacy).
*   **Exec Functions**: PHP `shell_exec` must be enabled in `php.ini` (remove from `disable_functions`) if using headless browsers.

## Installation Steps

1.  **Upload**:
    *   Upload the `ultimate-manga-scraper` folder to `/wp-content/plugins/`.
    *   OR upload the `.zip` file via **Plugins -> Add New -> Upload**.
2.  **Activate**:
    *   Activate via the WordPress Plugins menu.
    *   Ensure the **Madara** theme is active first.
3.  **Verify Permissions**:
    *   Ensure the web server (e.g., `www-data`) has write permissions to:
        *   `/wp-content/uploads/` (For storing images).
        *   `/wp-content/` (For logs).
        *   `/wp-content/plugins/ultimate-manga-scraper/` (For temp files/lock files).

## Configuration

1.  Go to **Ultimate Web Novel & Manga Scraper -> Main Settings**.
2.  **Enable Plugin**: Set "Main Switch" to **On**.
3.  **Storage**: Select "Local" (default).
4.  **Save Settings**.

## Cron Setup

The plugin uses WP-Cron. For high-volume scraping, it is highly recommended to disable the default WP-Cron (which runs on page load) and set up a real system cron.

1.  Edit `wp-config.php`:
    ```php
    define('DISABLE_WP_CRON', true);
    ```
2.  Add crontab entry (run every minute):
    ```bash
    * * * * * wget -q -O - http://your-site.com/wp-cron.php?doing_wp_cron >/dev/null 2>&1
    ```

## Post-Deployment Verification

1.  Create a test rule (e.g., scrape one chapter of a manga).
2.  Click "Run This Rule Now".
3.  Check **Activity & Logging** tab for success messages.
4.  Verify the Manga appears in **Manga -> All Manga**.
5.  Verify images are loaded in the chapter viewer.
