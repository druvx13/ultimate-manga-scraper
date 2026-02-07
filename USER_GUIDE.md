# User Guide

## Getting Started

Welcome to the **Ultimate Web Novel & Manga Scraper** user guide. This document will walk you through setting up and using the plugin to automate your manga and web novel content aggregation.

## Prerequisites

Before you begin, ensure you have:

1. **WordPress Installation** (Version 5.0 or higher)
2. **Madara Theme** (Active and properly configured)
3. **Madara Core Plugin** (Required dependency)
4. **PHP 7.4+** with required extensions (cURL, DOM, mbstring)

## Initial Setup

### Step 1: Installation

1. Download the plugin ZIP file or clone the repository
2. Upload to `/wp-content/plugins/ultimate-manga-scraper/`
3. Navigate to **WordPress Admin → Plugins**
4. Click **Activate** next to "Ultimate Web Novel & Manga Scraper"

You should see a new menu item: **Ultimate Web Novel & Manga Scraper**

### Step 2: Basic Configuration

1. Go to **Ultimate Web Novel & Manga Scraper → Main Settings**
2. Enable the **Main Switch** (turn it ON)
3. Configure basic settings:
   - **Enable Logging**: ON (for troubleshooting)
   - **Auto Clear Logs**: Weekly (recommended)
   - **Manga Storage**: Local (default)
4. Click **Save Settings**

### Step 3: Test Installation

1. Navigate to **Manga Scraper - FanFox** (or any scraper tab)
2. Add a test rule (see "Creating Your First Rule" below)
3. Click **Run This Rule Now**
4. Check **Activity & Logging** tab for results

## Creating Your First Rule

### MangaFox Example

Let's create a rule to scrape a manga from MangaFox:

1. Go to **Manga Scraper - FanFox**
2. Click **Add New** or find the blank rule form
3. Fill in the details:

   **Basic Information:**
   - **Manga URL**: `https://fanfox.net/manga/one_piece/`
   - **Schedule**: `24` (hours between runs)
   - **Active**: ✓ (checked)
   - **Max Chapters**: `5` (for testing)

   **Content Settings:**
   - **Status**: `publish`
   - **Author**: Select your admin user
   - **Create Tags**: ✓ (checked)
   - **Auto Categories**: ✓ (checked)

   **Advanced Settings:**
   - **Use PhantomJS**: ☐ (unchecked for now)
   - **Translation**: `Disabled` (for testing)

4. Click **Save Settings**

### Running Your First Rule

1. Find your newly created rule in the list
2. Click **▶ Run This Rule Now** button
3. Wait for execution (may take 1-5 minutes)
4. Check the **Activity & Logging** tab for status

**Expected Results:**
- A new manga post created in **Manga → All Manga**
- Cover image downloaded and set as featured image
- First 5 chapters imported with images
- Genres/tags automatically created and assigned

## Understanding Scrapers

The plugin supports multiple scraper types:

### 1. Manga Scraper - FanFox

**Purpose:** Scrape manga from MangaFox.net

**Supported Sites:**
- fanfox.net
- mangafox.la (legacy)

**Features:**
- Automatic chapter detection
- Image extraction
- Genre/author parsing
- Status tracking

### 2. Novel Scraper - NovLove

**Purpose:** Scrape web novels from NovLove.com

**Output:** Text-based chapters (not images)

### 3. Text Scraper - WuxiaWorld

**Purpose:** Scrape novels from WuxiaWorld sites

**Features:**
- Text content extraction
- Chapter ordering
- Author metadata

### 4. Madara Generic Scraper

**Purpose:** Scrape from ANY Madara-based site

**How it works:**
- Uses the Madara theme's AJAX API
- Can clone content from other Madara sites
- Most powerful and flexible option

### 5. Madara Enhancements

**Purpose:** Visual manga browser and import tool

**Features:**
- Search manga on source Madara sites
- Preview manga before importing
- Bulk import multiple manga

## Advanced Features

### Translation

Automatically translate manga/novel content to another language.

**Setup:**

1. Go to **Main Settings**
2. Scroll to **Translation API Keys**
3. Enter your API key:
   - **Google Trans Auth**: For Google Translate API
   - **Bing Auth**: For Microsoft Translator
   - **DeepL Auth**: For DeepL API

4. In your rule settings:
   - **Translation**: Select target language (e.g., "English (Google Translate)")
   - **Translation Source**: Choose API (`google_api`, `deepl`, `bing`)

**Free Translation:**
- Set **Translation** to a language
- Set **Translation Source** to `google` (not `google_api`)
- Note: Free translation is slower and less reliable

### Headless Browser Scraping

Some sites use JavaScript to load content. For these, use headless browsers.

#### PhantomJS Setup

1. Download PhantomJS binary for your OS
2. Upload to server (e.g., `/usr/local/bin/phantomjs`)
3. Make it executable: `chmod +x /usr/local/bin/phantomjs`
4. In **Main Settings → Headless Browser Settings**:
   - **PhantomJS Path**: `/usr/local/bin/phantomjs`
5. In rule settings:
   - **Use PhantomJS**: ✓ (checked)

#### Puppeteer Setup

1. Install Node.js on your server
2. Navigate to plugin directory:
   ```bash
   cd wp-content/plugins/ultimate-manga-scraper/res/puppeteer/
   npm install
   ```
3. In **Main Settings**:
   - **Puppeteer Enabled**: ✓ (checked)
4. In rule settings:
   - **Use Puppeteer**: ✓ (checked)

### Proxy Configuration

Use proxies to avoid IP bans or access geo-restricted content.

**Setup:**

1. Go to **Main Settings → Proxy Settings**
2. **Proxy URL**: Enter proxy address
   - Format: `ip:port`
   - Example: `123.45.67.89:8080`
   - Multiple proxies: `proxy1.com:8080,proxy2.com:8080`
3. **Proxy Auth** (if required): `username:password`

**Testing:**
- Check **Activity & Logging** for "Using proxy: ..." messages

### Cloudflare Bypass

If target sites use Cloudflare protection:

1. In **Main Settings**:
   - **My Server Is Using CloudFlare Caching**: ✓ (if applicable)
2. In rule settings:
   - **Use PhantomJS** or **Use Puppeteer**: ✓
3. Consider using **HeadlessBrowserAPI** (commercial service):
   - Get API key from provider
   - Enter in **Main Settings → HeadlessBrowserAPI Key**

### Image Storage Options

Control where manga images are stored:

**Local Storage** (default):
- Path: `wp-content/uploads/manga/`
- No additional setup required

**Amazon S3**:
1. Configure Madara Core with S3 credentials
2. In **Main Settings → Manga Storage**: Select `amazon_s3`

**Imgur**:
1. Get Imgur API key
2. Configure in Madara settings
3. Select `imgur` in plugin settings

**Flickr**:
1. Get Flickr API key
2. Configure in Madara settings
3. Select `flickr` in plugin settings

## Scheduling and Automation

### Using WP-Cron

By default, rules run using WordPress Cron:

- Cron checks rules every hour (or based on WP traffic)
- Rules execute if `schedule` hours have passed since `last_run`

**Limitation:** WP-Cron only runs when someone visits your site

### Using System Cron (Recommended)

For reliable, high-volume scraping:

1. Edit `wp-config.php`:
   ```php
   define('DISABLE_WP_CRON', true);
   ```

2. Add system cron job (run every minute):
   ```bash
   * * * * * wget -q -O - https://yoursite.com/wp-cron.php?doing_wp_cron >/dev/null 2>&1
   ```

   Or using WP-CLI:
   ```bash
   * * * * * cd /path/to/wordpress && wp cron event run --due-now >/dev/null 2>&1
   ```

## Common Tasks

### Updating Existing Manga

The plugin automatically detects existing manga:

1. If manga URL already exists, it **updates** instead of creating new
2. Only new chapters are imported
3. Existing chapters are skipped

**Forced Update:**
- Delete the manga from WordPress
- Run the rule again to re-import everything

### Importing Specific Chapters

Use the **Chapter Range** feature:

1. In rule settings:
   - **Start Chapter**: `10`
   - **End Chapter**: `20`
2. Only chapters 10-20 will be imported

### Bulk Import from Madara Sites

Use **Madara Enhancements**:

1. Go to **Madara Enhancements** tab
2. Enter source site URL (e.g., `https://manhuaus.com`)
3. Click **Search**
4. Browse manga, select desired titles
5. Click **Import Selected**

## Monitoring and Troubleshooting

### Activity & Logging Tab

Real-time view of scraper activity:

- **Green ✓**: Success
- **Red ✗**: Failed
- **Yellow ⚠**: Warning

**Log Information:**
- Timestamp
- Rule ID
- Status message
- Error details (if any)

### Log File

For detailed debugging:

1. Enable **Detailed Logging** in Main Settings
2. Access log file: `wp-content/ums_info.log`
3. Download via FTP/SSH

**Log Analysis:**
```
[2024-02-07 10:30:45] Starting rule #5
[2024-02-07 10:30:46] Fetching: https://fanfox.net/manga/one_piece/
[2024-02-07 10:30:48] Found 1200 chapters
[2024-02-07 10:30:50] Importing chapter 1: "Romance Dawn"
[2024-02-07 10:31:00] Chapter 1 imported successfully
```

### Common Issues

#### "No chapters found"

**Causes:**
- Site structure changed
- Cloudflare blocking
- Network issues

**Solutions:**
1. Enable PhantomJS/Puppeteer
2. Use a proxy
3. Check **Activity & Logging** for specific errors

#### "Images not loading"

**Causes:**
- Hotlink protection
- Download timeout
- Permission issues

**Solutions:**
1. Check `wp-content/uploads/manga/` directory exists
2. Verify folder permissions (755)
3. Try using a proxy
4. Increase timeout in settings

#### "Maximum execution time"

**Causes:**
- Too many chapters per run
- Slow network
- Large images

**Solutions:**
1. Reduce **Max Chapters** to 1-5
2. Increase PHP `max_execution_time`
3. Increase **Rule Timeout** in settings

For more issues, see [TROUBLESHOOTING.md](TROUBLESHOOTING.md)

## Best Practices

### Performance Optimization

1. **Start Small**: Test with 1-5 chapters first
2. **Stagger Rules**: Don't run all rules simultaneously
3. **Use Caching**: Enable object caching (Redis/Memcached)
4. **Optimize Images**: Enable image compression in Madara settings

### Legal Compliance

**Important:** You are responsible for copyright compliance.

- Only scrape content you have rights to use
- Respect robots.txt files
- Consider using API integrations when available
- Add proper attribution to original sources

### Server Resources

Monitor your server:

- **CPU**: Headless browsers are CPU-intensive
- **RAM**: Each PhantomJS instance uses ~200MB
- **Disk**: Images can consume significant storage
- **Bandwidth**: Large manga series require substantial bandwidth

**Recommendations:**
- VPS with at least 2GB RAM
- 20GB+ storage for images
- Unmetered or high bandwidth plan

### Rate Limiting

Avoid IP bans:

1. Set **Request Timeout** to 2-5 seconds
2. Limit **Max Chapters** per run to 10-20
3. Spread rule schedules across different times
4. Use proxy rotation for high-volume scraping

## Tips and Tricks

### Finding Manga URLs

**MangaFox:**
- URL format: `https://fanfox.net/manga/manga_name/`
- Find by browsing the site

**Madara Sites:**
- URL format: `https://site.com/manga/manga-name/`
- Use the Madara Enhancements browser

### Testing New Sites

Before committing to scraping a new site:

1. View page source to understand structure
2. Check if Cloudflare is used (look for `cf-ray` header)
3. Test with 1 chapter manually
4. Enable detailed logging
5. Review log for issues

### Organizing Content

Use WordPress categories and tags:

1. Enable **Auto Categories** in rule settings
2. Map genres to WordPress categories
3. Use custom taxonomies for additional organization

### Backup Strategy

Regular backups are essential:

1. **Database**: Backup WordPress database regularly
2. **Images**: Backup `wp-content/uploads/manga/`
3. **Configuration**: Export plugin settings

Consider using WordPress backup plugins or server-level snapshots.

## Getting Help

### Resources

- **Documentation**: See [DOCUMENTATION_INDEX.md](DOCUMENTATION_INDEX.md)
- **Architecture**: See [ARCHITECTURE.md](ARCHITECTURE.md) for technical details
- **Troubleshooting**: See [TROUBLESHOOTING.md](TROUBLESHOOTING.md)
- **Security**: See [SECURITY.md](SECURITY.md)

### Support

- Check logs first (`ums_info.log`)
- Enable detailed logging for better diagnostics
- Provide log excerpts when seeking help
- Include WordPress version, PHP version, and plugin version

## Next Steps

Now that you're familiar with the basics:

1. Create rules for your favorite manga series
2. Experiment with translation features
3. Optimize your cron schedule
4. Monitor server resources
5. Set up automated backups

Happy scraping! 📚
