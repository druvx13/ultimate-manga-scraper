# Troubleshooting Guide

## Common Issues

### 1. "Plugin requires Madara Theme" Error
*   **Cause**: The plugin checks for the active theme name or parent theme.
*   **Solution**: Ensure you have the **Madara** theme installed and active. If you are using a child theme, ensure the `Template` in `style.css` is `madara`.

### 2. Scraping Fails (No Content)
*   **Cause**: Target site layout changed, Cloudflare protection, or IP ban.
*   **Solution**:
    *   **Check Logs**: Go to **Activity & Logging**.
    *   **Cloudflare**: Enable "My Server Is Using CloudFlare Caching" in Main Settings.
    *   **Headless**: Switch the rule to use "Puppeteer" or "PhantomJS".
    *   **Proxy**: Configure a proxy in Main Settings if your server IP is blocked.

### 3. Images Not Loading (Broken Images)
*   **Cause**: Hotlink protection by source site or failed download.
*   **Solution**:
    *   Check `wp-content/uploads/manga/` to see if files exist.
    *   If 0 bytes or missing, the download failed. Use a Proxy.
    *   If files exist but don't show, check file permissions (`chmod 644`).

### 4. "Maximum Execution Time Exceeded"
*   **Cause**: PHP script timed out while downloading many images.
*   **Solution**:
    *   Increase `max_execution_time` in `php.ini`.
    *   Increase "Rule Timeout" in Main Settings.
    *   Reduce "Max Chapters" per run in the Rule settings.

### 5. Translation Not Working
*   **Cause**: API Key invalid or Quota exceeded.
*   **Solution**:
    *   Verify your Google/DeepL/Bing API keys.
    *   Check if "Google Translate (Free)" is being blocked (Google rate limits this aggressively).

### 6. Cron Jobs Not Running
*   **Cause**: WP-Cron relying on site traffic.
*   **Solution**: Set up a real system cron (see `DEPLOYMENT.md`).

### 7. PhantomJS/Puppeteer Errors
*   **Cause**: Binaries not executable or missing dependencies (libfontconfig, etc.).
*   **Solution**:
    *   SSH into server.
    *   Try running the command manually: `phantomjs --version` or `node --version`.
    *   Ensure `shell_exec` is enabled in PHP.

## Debugging

To enable verbose logs:
1.  Go to **Main Settings**.
2.  Check **Enable Detailed Logging**.
3.  Save.
4.  Run a rule.
5.  Check `wp-content/ums_info.log`.
