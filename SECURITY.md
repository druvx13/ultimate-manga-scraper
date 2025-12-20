# Security Analysis

This document outlines the security mechanisms, assumptions, and potential risks associated with the **Ultimate Web Novel & Manga Scraper**.

## Authentication & Authorization

*   **Role Requirements**: All admin AJAX actions and settings pages require the `manage_options` capability (Administrator).
*   **Nonce Verification**:
    *   AJAX actions (e.g., `ums_activation`, `madara_load_more`) are protected by WordPress Nonces (`activation-secret-nonce`, `madara_enhancements_nonce`).
    *   **Note**: Some older AJAX actions in `ultimate-manga-scraper.php` (like `ums_my_action_callback`) check `current_user_can('edit_posts')` but rely on `manage_options` for the UI.

## Input Validation

*   **Settings**: Most inputs are sanitized via `sanitize_text_field` or cast to integers before saving.
*   **URLs**: Scraper targets are generally trusted as they are entered by the Administrator. However, the plugin performs basic checks (e.g., `parse_url`).
*   **HTML Content**: Scraped content goes through `ums_sanitize_html_content()` which removes dangerous tags:
    *   `script`, `iframe`, `object`, `embed`, `style`, `form`, etc.
    *   **Warning**: This sanitization is regex and DOM-based. While robust for general scraping, it should not be considered a military-grade WAF against targeted XSS payloads embedded in source sites.

## System Interaction Risks

### Remote Code Execution (RCE) via Headless Browsers
The plugin allows the execution of system binaries (`phantomjs`, `node`) via `shell_exec`.
*   **Risk**: If an attacker gains access to the WordPress Admin, they could potentially manipulate the `PhantomJS Path` setting to execute arbitrary commands.
*   **Mitigation**: The `PhantomJS Path` setting is not strictly validated against a whitelist of executables. **Server Administrators should disable `shell_exec`** if headless scraping is not required, or strictly control file permissions.

### Server-Side Request Forgery (SSRF)
By definition, this is a web scraper. It fetches content from URLs provided by the admin.
*   **Risk**: An admin (or compromised admin account) could set a rule to scrape `http://localhost:8080` or other internal network resources.
*   **Mitigation**: The plugin does not implement an allowlist/blocklist for IP ranges. It relies on the trust level of the Administrator.

## File System Access
The plugin writes files to `wp-content/uploads/` and `wp-content/plugins/ultimate-manga-scraper/`.
*   **Logging**: Logs are written to `wp-content/ums_info.log`. This file is publicly accessible if the web server configuration does not block `.log` files.
    *   **Recommendation**: Configure `.htaccess` or Nginx rules to deny access to `*.log` files in `wp-content/`.

## Data Privacy
*   **Cookies**: The scraper may send cookies to target sites (`isAdult=1`).
*   **User Data**: The plugin does not collect end-user data, but it does impersonate users (User-Agent rotation) when scraping.

## Security Recommendations for Administrators

1.  **Block Log Access**: Deny web access to `ums_info.log`.
2.  **Restrict Capabilities**: Ensure only trusted admins have `manage_options`.
3.  **Disable `shell_exec`**: If not using PhantomJS/Puppeteer.
4.  **Firewall**: Restrict outbound connections from the server to known manga domains if possible.
