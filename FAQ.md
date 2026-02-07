# Frequently Asked Questions (FAQ)

## General Questions

### What is Ultimate Web Novel & Manga Scraper?

Ultimate Web Novel & Manga Scraper is a WordPress plugin designed to automate the ingestion of manga and web novel content from various sources. It integrates seamlessly with the Madara WordPress theme to create a fully automated content aggregation platform.

### Is this plugin free?

Yes, the plugin is licensed under the LUCA Free License v1.0. See [LICENSE](LICENSE) for details.

### What WordPress themes does this plugin work with?

This plugin is specifically designed for the **Madara** theme by MangaBooth. It requires the Madara theme and Madara Core plugin to be active.

### Can I use this plugin with other themes?

No. The plugin is tightly integrated with Madara's custom post types, taxonomies, and storage mechanisms. It will not function properly with other themes.

## Installation & Setup

### What are the minimum requirements?

- WordPress 5.0+
- PHP 7.2+ (7.4+ recommended)
- Madara theme (active)
- Madara Core plugin (for WP_MANGA_STORAGE)
- PHP extensions: cURL, DOM, mbstring, json, libxml

### Do I need Node.js or PhantomJS?

Not required for basic functionality. However, if you're scraping JavaScript-heavy sites or sites with Cloudflare protection, you'll need:
- **PhantomJS** (legacy headless browser)
- **Node.js + Puppeteer** (modern headless browser)

### How do I install PhantomJS?

1. Download PhantomJS binary for your OS: http://phantomjs.org/download.html
2. Extract and move to `/usr/local/bin/` (or another PATH directory)
3. Make it executable: `chmod +x /usr/local/bin/phantomjs`
4. Set the path in plugin settings: **Main Settings → PhantomJS Path**

### How do I install Puppeteer?

```bash
cd /path/to/wordpress/wp-content/plugins/ultimate-manga-scraper/res/puppeteer/
npm install
```

Then ensure Node.js is in your system PATH.

### Why am I getting "Plugin requires Madara Theme" error?

This means:
1. Madara theme is not installed or not active
2. You're using a child theme without proper parent theme reference
3. Madara Core plugin is not active

**Solution:** Install and activate Madara theme, then activate Madara Core plugin.

## Scraping

### What sites can I scrape?

The plugin has built-in support for:
- **FanFox** / MangaFox
- **WuxiaWorld**
- **NovLove**
- Any **Madara-based** manga/novel site
- **Generic** sites via Madara Enhancements

### How do I add a new manga to scrape?

1. Go to **Ultimate Web Novel & Manga Scraper → Manga Scraper (Madara)**
2. Click "Add New Rule"
3. Enter the manga's Table of Contents (TOC) URL
4. Set schedule (e.g., check every 24 hours)
5. Configure options (max chapters, translation, etc.)
6. Save

### Why isn't my scraper working?

Common causes:
- **Site structure changed:** Scrapers rely on HTML structure. If the target site changes layout, parsing breaks.
- **Cloudflare protection:** Enable "Use PhantomJS/Puppeteer" for the rule or enable Cloudflare handling in Main Settings.
- **IP blocked:** Use a proxy or VPN.
- **Wrong URL:** Ensure you're using the manga's TOC page, not a chapter page.

### How often should I schedule scraping?

Depends on:
- **Update frequency of source:** Daily updates → 24-hour schedule
- **Server resources:** More frequent = more CPU/memory usage
- **Target site tolerance:** Too frequent = risk of IP ban

**Recommended:** 12-24 hours for most manga, 6-12 hours for active web novels.

### Can I scrape multiple manga simultaneously?

Yes. The plugin uses a locking mechanism to prevent conflicts. However, be mindful of:
- Server resources (CPU, memory)
- Target site rate limits
- Risk of IP bans

### How do I test a rule before scheduling?

1. Create the rule with "Active" checkbox checked
2. Click "Run This Rule Now"
3. Go to **Activity & Logging** to monitor execution
4. Check **Manga → All Manga** to see if it worked

## Translation

### What translation services are supported?

- **Google Translate** (Free via scraping or Paid API)
- **Microsoft Translator** (API)
- **DeepL** (API)
- **Text Spinner** (synonym replacement, no translation)

### Do I need API keys?

- **Google Translate (Free):** No key needed, but rate-limited and unstable
- **Google Translate (API):** Yes, requires API key
- **Microsoft Translator:** Yes, requires API key
- **DeepL:** Yes, requires API key

### How do I get a Google Translate API key?

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project
3. Enable "Cloud Translation API"
4. Create credentials (API Key)
5. Copy key to **Main Settings → Google Trans Auth**

### Translation is not working. Why?

- **API key invalid:** Verify your key in the respective service dashboard
- **Quota exceeded:** Check your API usage limits
- **Rate limiting:** Google's free scraping method is heavily rate-limited
- **Language not supported:** Some services don't support all languages

### Can I translate manga titles and descriptions only?

Yes. Translation settings apply to:
- Manga/novel titles
- Descriptions/summaries
- Chapter titles
- Chapter content (text novels)
- **Note:** Images are not translated (requires OCR + image editing)

## Images

### Why are chapter images not loading?

1. **Failed download:** Check logs to see if download failed
2. **Hotlink protection:** Source site blocks external image requests. Use a proxy or download locally.
3. **File permissions:** Ensure web server can read files in `wp-content/uploads/manga/`
4. **Storage backend:** If using S3/Imgur/Flickr, verify credentials

### How do I switch to Amazon S3 storage?

1. Install and configure Madara's S3 integration
2. Go to **Main Settings → Manga Storage → Amazon S3**
3. Save
4. New chapters will be uploaded to S3 (existing local images won't be migrated)

### Can I resize images automatically?

The plugin includes ImageResize library. However, automatic resizing is not exposed in the UI. You can modify the code to enable it:

```php
// In ultimate-manga-scraper.php, find the image download section
$image = new ImageResize($image_path);
$image->resizeToWidth(800);
$image->save($image_path);
```

### Where are images stored?

**Local storage:**
```
wp-content/uploads/manga/{manga_id}/{chapter_slug}/{image_name}.jpg
```

**S3/Cloud:** Depends on Madara's S3 configuration.

## Performance

### The scraper is timing out. How do I fix this?

1. **Increase PHP timeout:**
   - Edit `php.ini`: `max_execution_time = 300`
2. **Increase plugin timeout:**
   - **Main Settings → Rule Timeout** (e.g., 300 seconds)
3. **Reduce chapters per run:**
   - **Rule → Max # Chapters** (e.g., 10 instead of 50)
4. **Use headless browser selectively:**
   - Only enable for rules that require it

### How can I speed up scraping?

- **Disable translation** if not needed
- **Use cURL** instead of headless browsers when possible
- **Reduce image quality** (if resizing)
- **Increase server resources** (CPU, memory)
- **Use faster storage** (SSD vs HDD)

### Can I run multiple cron jobs?

Yes, but ensure the schedule doesn't cause overlapping executions. The plugin has locking mechanisms, but too many concurrent jobs can overwhelm the server.

### Should I use WP-Cron or system cron?

**System cron is highly recommended** for production:
- WP-Cron relies on site traffic (unreliable)
- System cron runs independently of WordPress
- Better for high-volume scraping

See [DEPLOYMENT.md](DEPLOYMENT.md) for setup instructions.

## Errors & Troubleshooting

### "Maximum execution time exceeded"

See [Performance → The scraper is timing out](#the-scraper-is-timing-out-how-do-i-fix-this)

### "Cloudflare protection detected"

1. Enable **Main Settings → My Server Is Using CloudFlare Caching**
2. Enable **Rule → Use PhantomJS/Puppeteer**
3. Use **HeadlessBrowserAPI** as fallback
4. Use a proxy

### "WP_MANGA_STORAGE class not found"

Install and activate **Madara Core** plugin. This is a dependency.

### "shell_exec() has been disabled"

You're using shared hosting with `shell_exec` disabled in `php.ini`. Solutions:
1. Contact hosting support to enable `shell_exec`
2. Use VPS/dedicated server
3. Don't use headless browsers (limited functionality)

### Images are broken (403 Forbidden)

Source site has **hotlink protection**. Solutions:
1. Enable **Download Images Locally** (should be default)
2. Use a proxy
3. Set custom `Referer` header (requires code modification)

### Rule is not running on schedule

1. **Check if plugin is enabled:** Main Settings → Main Switch
2. **Check WP-Cron:** If using WP-Cron, ensure site has traffic
3. **Setup system cron:** See [DEPLOYMENT.md](DEPLOYMENT.md)
4. **Check rule's "Active" status**
5. **Check logs:** Activity & Logging tab

## Legal & Ethical

### Is it legal to scrape manga/novels?

**Depends on jurisdiction and copyright status.** The plugin is a tool; **you** are responsible for how you use it. Scraping copyrighted content without permission may violate:
- Copyright law
- Terms of Service of target sites
- DMCA (USA) / equivalent laws

**Use responsibly and ethically.**

### Can I use scraped content for commercial purposes?

**Not recommended unless:**
1. Content is in the public domain
2. You have explicit permission from copyright holder
3. Your use qualifies as fair use (varies by jurisdiction)

**Consult a lawyer** before commercializing scraped content.

### Will I get sued for using this plugin?

The plugin itself is legal. However:
- **Scraping copyrighted content** without permission can lead to legal action
- **Ignoring DMCA takedowns** can result in hosting suspension
- **Violating Terms of Service** can result in IP bans or legal action

**Use at your own risk.**

### How can I use this plugin ethically?

1. **Scrape only public domain** or Creative Commons content
2. **Respect robots.txt** and site ToS
3. **Don't overwhelm servers** (use reasonable intervals)
4. **Don't claim content as your own**
5. **Provide attribution** to original sources
6. **Remove content upon DMCA request**

## Advanced Usage

### Can I create custom scrapers for other sites?

Yes, but it requires PHP knowledge. You'll need to:
1. Understand the target site's HTML structure
2. Modify `ultimate-manga-scraper.php` to add parsing logic
3. Create a new admin UI tab for your scraper
4. Add to the cron scheduler

**Alternatively:** Use the **Madara Enhancements** module if the target site is Madara-based.

### How do I add a proxy?

1. **Main Settings → Proxy URL:** Enter `ip:port` (e.g., `123.45.67.89:8080`)
2. **Main Settings → Proxy Auth:** Enter `user:pass` if authentication required
3. Save

For multiple proxies, separate with commas: `proxy1:port,proxy2:port`

### Can I use Tor for scraping?

Not directly. However, you can:
1. Set up a Tor SOCKS proxy
2. Configure the plugin to use that proxy
3. Note: Tor is slow and may break some scrapers

### How do I export/import rules?

**Export:**
1. Go to **Activity & Logging → System Info**
2. Copy the "Rules Backup" JSON
3. Save to a file

**Import:**
1. Manually insert into database:
```sql
UPDATE wp_options SET option_value = 'YOUR_SERIALIZED_ARRAY' WHERE option_name = 'ums_rules_list';
```
2. Or use a custom script to `update_option('ums_rules_list', $rules);`

### Can I scrape sites behind a login/paywall?

Technically yes, but:
1. Requires custom code to handle authentication
2. May violate Terms of Service
3. **Not recommended** without permission

## Support

### Where can I get help?

- **Documentation:** [DOCUMENTATION_INDEX.md](DOCUMENTATION_INDEX.md)
- **Troubleshooting:** [TROUBLESHOOTING.md](TROUBLESHOOTING.md)
- **GitHub Issues:** https://github.com/druvx13/ultimate-manga-scraper/issues

### How do I report a bug?

1. Go to [GitHub Issues](https://github.com/druvx13/ultimate-manga-scraper/issues)
2. Search for existing issues
3. If not found, create new issue with:
   - WordPress version
   - PHP version
   - Plugin version
   - Error message
   - Steps to reproduce

### How do I request a feature?

Open a **Feature Request** on GitHub Issues with:
- Description of feature
- Use case
- Why it's needed

### Is there commercial support?

No official commercial support. However:
- Community support via GitHub
- Documentation available
- Code is open source for custom development

## Miscellaneous

### What's the difference between Manga and Web Novel scrapers?

- **Manga:** Scrapes image-based chapters (stored as image galleries)
- **Web Novel:** Scrapes text-based chapters (stored as HTML/text content)

The underlying mechanism is similar, but storage format differs.

### Can I use this for comics/manhwa/webtoons?

Yes, if the source site is Madara-based or follows a similar structure to supported sites.

### Does this plugin work with multisite?

Not tested. Use at your own risk in multisite environments.

### How do I uninstall the plugin?

1. **Backup your database** (manga posts will be deleted if you delete data)
2. Deactivate plugin
3. Delete plugin files
4. Optionally: Clean up `wp_options` entries (`ums_*`)

**Note:** Scraped manga/novels will remain in your database unless explicitly deleted.

### Can I contribute to the plugin?

Yes! The plugin is open source. See the GitHub repository for contribution guidelines.

---

**Still have questions?** Check [DOCUMENTATION_INDEX.md](DOCUMENTATION_INDEX.md) or open an issue on GitHub.
