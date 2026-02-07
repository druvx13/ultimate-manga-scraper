# Frequently Asked Questions (FAQ)

## General Questions

### What is the Ultimate Web Novel & Manga Scraper?

The Ultimate Web Novel & Manga Scraper is a WordPress plugin designed to automate the process of importing manga and web novel content from various sources into your WordPress site. It's specifically built to work with the Madara theme.

### Is this plugin legal to use?

The plugin itself is legal software. However, **you** are responsible for ensuring that your use of the plugin complies with:
- Copyright laws in your jurisdiction
- Terms of service of the sites you're scraping
- Fair use policies

Always obtain proper permissions before scraping and republishing content.

### What makes this different from other scrapers?

- **Madara Integration**: Purpose-built for the Madara manga theme
- **Multi-Source Support**: Works with MangaFox, WuxiaWorld, and any Madara-based site
- **Headless Browser Support**: Can scrape JavaScript-heavy sites
- **Translation Pipeline**: Built-in translation capabilities
- **Auto-Update**: Automatically checks for new chapters

## Installation & Setup

### What are the minimum requirements?

- WordPress 5.0+
- PHP 7.2+ (7.4+ recommended)
- Madara Theme (active)
- Madara Core Plugin
- PHP extensions: cURL, DOM, mbstring, json

### Do I need a special hosting plan?

For basic usage, shared hosting can work. However, for production use we recommend:
- VPS or dedicated server
- 2GB+ RAM
- 20GB+ storage
- Unmetered bandwidth

### Can I use this without the Madara theme?

No. The plugin is tightly integrated with Madara's data structures and storage engine. It checks for the Madara theme and won't activate without it.

### Do I need PhantomJS or Puppeteer?

Not for all sites. Many static sites work fine with basic cURL scraping. Headless browsers are only needed for:
- JavaScript-rendered content
- Sites with Cloudflare protection
- Complex dynamic content

## Configuration

### How do I get translation API keys?

**Google Translate API:**
1. Go to Google Cloud Console
2. Create a new project
3. Enable Cloud Translation API
4. Create credentials (API key)
5. Copy key to plugin settings

**DeepL:**
1. Sign up at deepl.com/pro
2. Get API key from account settings
3. Enter in plugin settings

**Microsoft Translator:**
1. Sign up for Azure account
2. Create Translator resource
3. Get API key
4. Enter in plugin settings

### What's the difference between "Google Translate" and "Google Translate API"?

- **Google Translate (Free)**: Scrapes the Google Translate website. Free but unreliable and may get blocked
- **Google Translate API**: Official paid API. Reliable but costs money per character

### How do I configure proxy settings?

1. Purchase proxies from a provider (residential proxies work best)
2. In Main Settings → Proxy Settings:
   - **Single proxy**: `123.45.67.89:8080`
   - **Multiple proxies** (rotation): `proxy1:8080,proxy2:8080,proxy3:8080`
   - **With authentication**: Enter `username:password` in Proxy Auth field

## Usage

### How often should I set the schedule?

It depends on your needs:
- **Popular ongoing manga**: 12-24 hours
- **Weekly releases**: 168 hours (7 days)
- **Completed manga**: Don't schedule, run manually once
- **Test rules**: 1-2 hours (for testing only)

**Recommendation**: Start with 24 hours and adjust based on update frequency.

### Can I import old chapters from a manga that's already started?

Yes! Two methods:

**Method 1: Reverse Chapters**
1. Enable "Reverse Chapters" in rule settings
2. Set "Max Chapters" to 10-20
3. Run rule multiple times to backfill

**Method 2: Chapter Range**
1. Specify start and end chapter numbers
2. Run rule

### How do I update existing manga with new chapters?

The plugin automatically handles this:
1. It checks if manga exists by URL or title
2. Compares chapter lists
3. Only imports new chapters
4. Existing chapters are skipped

No special configuration needed!

### Can I scrape multiple manga simultaneously?

Yes. Create multiple rules and they'll run according to their schedules. However:
- Rules run sequentially (not parallel) to avoid server overload
- Use file locking prevents multiple instances
- Stagger schedules to spread load

## Troubleshooting

### Why is my rule not running automatically?

Common causes:

1. **WP-Cron not triggered**: Your site needs traffic to trigger WP-Cron
   - **Solution**: Set up system cron (see DEPLOYMENT.md)

2. **Schedule not met**: Check `last_run` time
   - **Solution**: Wait for schedule interval to pass

3. **Plugin disabled**: Main switch is OFF
   - **Solution**: Enable in Main Settings

4. **Rule inactive**: Individual rule is disabled
   - **Solution**: Check "Active" checkbox in rule settings

### Why are images broken or not loading?

**Diagnosis Steps:**

1. Check if images downloaded:
   - Navigate to `wp-content/uploads/manga/{manga-id}/`
   - Look for chapter folders with images

2. If no images:
   - **Cause**: Download failed
   - **Solutions**: Enable proxy, increase timeout, use headless browser

3. If images exist but don't display:
   - **Cause**: Permission issues or wrong path
   - **Solutions**: Set permissions to 644 for files, 755 for directories

4. If images are 0 bytes:
   - **Cause**: Hotlink protection
   - **Solution**: Use proxy or headless browser

### What does "Cloudflare protection detected" mean?

Cloudflare is an anti-bot service. When detected, normal cURL requests fail.

**Solutions:**
1. Enable PhantomJS or Puppeteer (best option)
2. Use HeadlessBrowserAPI (commercial service)
3. Try different proxies
4. Use "My Server Is Using CloudFlare Caching" option if your server is behind Cloudflare

### The scraper used to work but now it doesn't. Why?

**Most Common Cause**: Target site changed their HTML structure

**Solutions:**
1. Check site manually - did layout change?
2. Enable detailed logging
3. Look for parsing errors in logs
4. Try switching to headless browser
5. If Madara site, use Madara Generic Scraper instead

**Note**: Site structure changes require plugin code updates. This is a limitation of all web scrapers.

### Why is scraping so slow?

Several factors affect speed:

1. **Network latency**: Distance to source server
2. **Request timeout**: Intentional delays to avoid bans (configurable)
3. **Headless browsers**: PhantomJS/Puppeteer add overhead
4. **Image downloads**: Large images take time
5. **Translation**: API calls add latency

**Optimization Tips:**
- Reduce request timeout (but risk getting banned)
- Reduce max chapters per run
- Use faster storage (SSD vs HDD)
- Increase PHP memory limit
- Skip translation for testing

### "Maximum execution time exceeded" error - how to fix?

This means PHP script timed out.

**Solutions:**

1. **Increase PHP timeout**:
   - Edit `php.ini`: `max_execution_time = 300`
   - Or in `wp-config.php`: `set_time_limit(300);`

2. **Reduce chapters per run**:
   - Lower "Max Chapters" to 1-5

3. **Increase plugin timeout**:
   - Main Settings → Rule Timeout: 300 seconds

4. **Use system cron**:
   - System cron doesn't have same limits as web requests

## Performance & Optimization

### How much storage do I need?

Depends on number of manga and chapters:

**Rough estimates:**
- Average manga chapter: 20-50 images
- Average image size: 200KB - 1MB
- Per chapter: 4MB - 50MB
- Full manga (100 chapters): 400MB - 5GB

**Recommendations:**
- Starting out: 20GB+
- Medium site (100 manga): 100GB+
- Large site (1000+ manga): 500GB - 1TB+

### How much bandwidth do I need?

**Initial scraping** (one-time):
- Downloading a full manga: 400MB - 5GB
- 100 manga: 40GB - 500GB

**Monthly bandwidth** (serving to users):
- 1000 chapter views/month × 30MB = 30GB
- Scale accordingly

**Tip**: Use CDN (CloudFlare, Amazon CloudFront) to reduce origin bandwidth.

### Can I use a CDN for images?

Yes! Options:

1. **Amazon S3 + CloudFront**:
   - Configure Madara S3 integration
   - Select "amazon_s3" in plugin settings

2. **CloudFlare**:
   - Enable CloudFlare for your domain
   - Images automatically cached

3. **Custom CDN**:
   - Use filters to modify image URLs
   - See API_REFERENCE.md for hooks

### How do I reduce server load?

1. **Stagger schedules**: Don't run all rules at same time
2. **Limit concurrency**: Rules run sequentially by design
3. **Use object caching**: Redis or Memcached for WordPress
4. **Optimize database**: Regular optimization and indexing
5. **Increase hardware**: More RAM, faster CPU
6. **Offload tasks**: Use external services (HeadlessBrowserAPI, S3)

## Advanced Topics

### Can I scrape sites not listed in the plugin?

Yes, using the **Generic Madara Scraper**:
- Works with any Madara-themed site
- Or **Madara Enhancements** for visual browsing

For non-Madara sites, code modifications are required.

### Can I modify the scraping logic?

Yes! The plugin is open source. Main scraping logic is in `ultimate-manga-scraper.php`.

**Before modifying:**
1. Create a backup
2. Test in development environment
3. Understand PHP and WordPress
4. See ARCHITECTURE.md for code structure

**Better approach**: Use WordPress filters (see API_REFERENCE.md)

### Can I scrape manga to a different post type?

By default, manga is saved as `wp-manga` post type (Madara requirement).

To change this, you'd need to:
1. Modify post creation code in plugin
2. Handle chapter storage differently
3. Update taxonomies

**Not recommended**: This breaks Madara integration.

### Is there an API to trigger scraping externally?

Yes, via WordPress admin-ajax:

```bash
curl -X POST https://yoursite.com/wp-admin/admin-ajax.php \
  -d "action=ums_my_action_callback&id=5&type=manga&nonce=NONCE"
```

**Requirements:**
- Valid nonce (get from admin page)
- Proper authentication cookies
- `manage_options` capability

**Better**: Use WP-CLI if you have shell access:
```bash
wp cron event run umsaction
```

### Can I import from a different Madara site?

Yes! This is what **Madara Enhancements** is designed for:

1. Go to Madara Enhancements tab
2. Enter source Madara site URL
3. Browse and select manga
4. Click Import

This uses the source site's AJAX API for structured data (more reliable than HTML scraping).

### Can I export my rules?

Rules are stored in `wp_options` table. To export:

**Method 1: Database export**
```sql
SELECT * FROM wp_options WHERE option_name LIKE 'ums_%';
```

**Method 2: WordPress export**
- Use a plugin like "All-in-One WP Migration"
- Or export database manually

**Import**: Import SQL to new site

## Legal & Ethical

### Am I allowed to scrape manga and novels?

**Legal perspective**: Laws vary by jurisdiction. Generally:
- ✗ Copyrighted content without permission is illegal
- ✓ Public domain content is okay
- ✓ Content you own is okay
- ? Fair use may apply in some cases (educational, transformative)

**Recommendation**: Consult a lawyer in your jurisdiction.

### What about robots.txt?

`robots.txt` is a **request**, not a law, but respecting it is ethical.

The plugin doesn't check `robots.txt` by default. You should:
1. Manually check each site's robots.txt
2. Respect their wishes
3. Only scrape sites that allow it

### How can I use this plugin ethically?

**Best practices:**
1. Only scrape sites you have permission to scrape
2. Respect rate limits and robots.txt
3. Provide attribution to original sources
4. Don't republish copyrighted content without license
5. Consider official APIs when available

**Legitimate uses:**
- Personal archival
- Research and analysis
- Aggregating public domain content
- Internal corporate use with licensed content

## Technical Details

### What PHP extensions are required?

**Required:**
- `curl`: For HTTP requests
- `dom`: For HTML parsing
- `mbstring`: For multi-byte string handling
- `json`: For JSON parsing
- `libxml`: For XML/HTML processing

**Optional:**
- `gd` or `imagick`: For image processing
- `zip`: For backup/export features

### Does this work with WordPress Multisite?

Potentially, but not officially supported or tested. Issues:
- Plugin activation per site
- Shared resources might conflict
- Cron jobs might interfere

**Recommendation**: Use separate WordPress installations for each site.

### Can I contribute to the plugin?

Yes! The plugin is open source (Public Domain license).

**Ways to contribute:**
1. Report bugs
2. Submit pull requests
3. Improve documentation
4. Add support for new sites
5. Translate to other languages

### What data does the plugin collect?

The plugin collects:
- ✓ Scraped content from target sites
- ✓ Execution logs (locally)
- ✗ No user analytics
- ✗ No phone-home functionality
- ✗ No data sent to third parties (except translation APIs if configured)

**Privacy**: All data stays on your server.

## Getting More Help

### Where can I find more documentation?

- **README.md**: Overview and quick start
- **USER_GUIDE.md**: Comprehensive user documentation (this file)
- **ARCHITECTURE.md**: Technical architecture and code structure
- **API_REFERENCE.md**: Developer API documentation
- **TROUBLESHOOTING.md**: Common problems and solutions
- **SECURITY.md**: Security analysis and recommendations
- **DEPLOYMENT.md**: Installation and server setup
- **CONFIGURATION.md**: All configuration options

### Something's not working. What should I do?

1. **Check logs**: Enable detailed logging and check `ums_info.log`
2. **Check TROUBLESHOOTING.md**: See if your issue is listed
3. **Test in isolation**: Create a minimal rule with 1 chapter
4. **Check permissions**: Verify file/folder permissions
5. **Check dependencies**: Ensure Madara theme and PHP extensions are present
6. **Update plugin**: Make sure you're using the latest version

### How do I report a bug?

When reporting bugs, include:
- Plugin version
- WordPress version
- PHP version
- Madara theme version
- Exact error message
- Steps to reproduce
- Relevant log excerpts

### Can I request new features?

Yes! Feature requests are welcome. Consider:
- Is it generally useful?
- Does it fit the plugin's scope?
- Is it technically feasible?

---

**Still have questions?** Check the other documentation files or review the source code.
