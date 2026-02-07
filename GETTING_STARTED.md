# Getting Started Guide

Welcome to **Ultimate Web Novel & Manga Scraper**! This guide will help you set up and start scraping manga and web novels in minutes.

## Quick Start (5 Minutes)

### Prerequisites

Before you begin, ensure you have:

✅ WordPress 5.0 or higher  
✅ Madara theme installed and activated  
✅ Madara Core plugin installed and activated  
✅ PHP 7.2 or higher with cURL, DOM, and mbstring extensions  

### Step 1: Install the Plugin

1. Download the plugin ZIP file
2. Go to **WordPress Admin → Plugins → Add New → Upload Plugin**
3. Choose the ZIP file and click **Install Now**
4. Click **Activate Plugin**

### Step 2: Enable the Plugin

1. Navigate to **Ultimate Web Novel & Manga Scraper → Main Settings**
2. Check the **Main Switch** to enable the plugin
3. Click **Save Settings**

### Step 3: Create Your First Scraping Rule

Let's scrape a manga from a Madara-based site:

1. Go to **Ultimate Web Novel & Manga Scraper → Manga Scraper (Madara Theme Sites)**
2. Click **Add New Rule**
3. Fill in the form:
   - **Manga URL:** `https://example-madara-site.com/manga/manga-title/`
   - **Schedule:** `24` (check every 24 hours)
   - **Max # Chapters:** `10`
   - **Status:** `Publish`
   - **Active:** ✅ Checked
4. Click **Save Rule**

### Step 4: Test the Rule

1. Find your newly created rule in the list
2. Click **Run This Rule Now**
3. Wait for execution (may take 30-60 seconds)
4. Go to **Activity & Logging** to see progress

### Step 5: Verify Success

1. Navigate to **Manga → All Manga** in WordPress admin
2. You should see the newly scraped manga
3. Click on the manga to view chapters
4. View the manga on your site's frontend to see images

🎉 **Congratulations!** You've successfully scraped your first manga.

---

## Detailed Setup

### Understanding the Interface

The plugin's admin interface is organized into several tabs:

```
Ultimate Web Novel & Manga Scraper
├── Main Settings         (Global configuration)
├── Manga Scraper (Madara)       (Generic Madara sites)
├── Web Novel Scraper (Madara)   (Generic Madara novel sites)
├── Manga Scraper (FanFox)       (FanFox-specific)
├── Web Novel Scraper (NovLove)  (NovLove-specific)
├── Web Novel Scraper (WuxiaWorld) (WuxiaWorld-specific)
├── Madara Enhancements          (Search & clone from external sites)
└── Activity & Logging           (Logs, system info, cleanup)
```

### Main Settings Explained

#### General Options

| Setting | Description | Recommended |
|---------|-------------|-------------|
| **Main Switch** | Master enable/disable | On |
| **Logging** | Enable basic logging | On (for debugging) |
| **Detailed Logging** | Verbose debug logs | Off (enable only for troubleshooting) |
| **Auto Clear Logs** | Automatic log rotation | Weekly |

#### Scraper Settings

| Setting | Description | Recommended |
|---------|-------------|-------------|
| **CloudFlare Caching** | Handle Cloudflare timeouts | On (if your server uses Cloudflare) |
| **Disable Rerun** | Prevent immediate retry of failed rules | Off |
| **Manga Storage** | Where to store images | Local (or S3 if configured) |
| **Request Timeout** | Delay between requests (seconds) | 2-5 |
| **Rule Timeout** | Max execution time per rule (seconds) | 300 |

#### Headless Browser Settings

**Only needed if scraping JavaScript-heavy sites**

| Setting | Description | Example |
|---------|-------------|---------|
| **PhantomJS Path** | Absolute path to PhantomJS binary | `/usr/bin/phantomjs` |
| **PhantomJS Timeout** | Max wait time for rendering | 30 |
| **HeadlessBrowserAPI Key** | Third-party service API key | (optional) |

#### Proxy Settings

**Only needed if your IP is blocked or rate-limited**

| Setting | Description | Example |
|---------|-------------|---------|
| **Proxy URL** | Proxy server address | `123.45.67.89:8080` |
| **Proxy Auth** | Username and password | `user:password` |

#### Translation API Keys

**Only needed if you want automatic translation**

| Setting | Description | Where to Get |
|---------|-------------|--------------|
| **Google Trans Auth** | Google Translate API key | [Google Cloud Console](https://console.cloud.google.com/) |
| **Bing Auth** | Microsoft Translator key | [Azure Portal](https://portal.azure.com/) |
| **DeepL Auth** | DeepL API key | [DeepL API](https://www.deepl.com/pro-api) |

---

## Creating Scraping Rules

### Rule Types

Choose the appropriate scraper based on your target site:

| Scraper | Use For |
|---------|---------|
| **Manga Scraper (Madara)** | Any Madara-based manga site |
| **Web Novel Scraper (Madara)** | Any Madara-based novel site |
| **Manga Scraper (FanFox)** | FanFox.net, MangaFox sites |
| **Web Novel Scraper (NovLove)** | NovLove.com |
| **Web Novel Scraper (WuxiaWorld)** | WuxiaWorld.site |

### Rule Configuration Fields

#### Basic Settings

| Field | Description | Example |
|-------|-------------|---------|
| **Manga URL** | Table of Contents (TOC) page | `https://site.com/manga/title/` |
| **Schedule** | Check interval in hours | `24` |
| **Active** | Enable/disable this rule | ✅ |

#### Content Settings

| Field | Description | Example |
|-------|-------------|---------|
| **Max # Chapters** | Limit chapters per run (0 = all) | `10` |
| **Status** | Post status for created manga | `Publish` |
| **Author** | WordPress user to assign | Select from dropdown |
| **Create Tags** | Import original tags | ✅ |
| **Default Category** | Fallback category | Select from dropdown |
| **Auto Categories** | Create categories from genres | ✅ |

#### Advanced Settings

| Field | Description | When to Use |
|-------|-------------|-------------|
| **Use PhantomJS** | Force headless browser | JavaScript-heavy sites, Cloudflare |
| **Reverse Chapters** | Scrape oldest first | Backfilling old chapters |
| **Translation** | Target language | Disabled (or select language) |
| **Translation Source** | API to use | Google (Free), Google (API), Bing, DeepL |

---

## Common Use Cases

### Use Case 1: Daily Manga Updates

**Goal:** Automatically check for new chapters every day

**Configuration:**
- **Schedule:** `24` hours
- **Max # Chapters:** `5`
- **Status:** `Publish`
- **Active:** ✅

**Workflow:**
1. Plugin checks site every 24 hours
2. Finds new chapters (up to 5)
3. Downloads and publishes them automatically

### Use Case 2: Backfilling Old Chapters

**Goal:** Scrape all historical chapters of a manga

**Configuration:**
- **Schedule:** `1` hour (or manual "Run Now")
- **Max # Chapters:** `0` (all chapters)
- **Reverse Chapters:** ✅
- **Active:** ✅

**Workflow:**
1. Run once to grab all chapters
2. After completion, change schedule to 24 hours for updates
3. Uncheck "Reverse Chapters"

### Use Case 3: Scraping with Translation

**Goal:** Translate Chinese manga to English

**Prerequisites:**
- Google Translate API key configured in Main Settings

**Configuration:**
- **Translation:** `English (Google Translate)`
- **Translation Source:** `Google (API)` or `Google (Free)`
- **All other settings:** Normal

**Workflow:**
1. Plugin scrapes content
2. Translates titles, descriptions, and chapter titles
3. Saves translated content to WordPress

**Note:** Only text is translated (manga images require OCR, not supported)

### Use Case 4: Using Madara Enhancements

**Goal:** Search and add manga from multiple external Madara sites

**Setup:**
1. Go to **Madara Enhancements** tab
2. Set **Manga Fetch URL:** `https://external-site.com/wp-admin/admin-ajax.php`
3. Choose search type: **Latest**, **Trending**, **Search by keyword**
4. Click **Load More** to fetch results
5. Click **Add This Manga** to create a scraping rule
6. The manga is now added to your regular scraping queue

**Benefits:**
- No need to manually find manga URLs
- Search external Madara libraries
- One-click addition to your site

---

## Automation with Cron

### Why Use System Cron?

WordPress Cron (WP-Cron) runs on page load, which is unreliable for automated scraping. System cron ensures:

✅ Consistent execution  
✅ No dependency on site traffic  
✅ Better for high-volume scraping  

### Setup System Cron

#### Step 1: Disable WP-Cron

Edit `wp-config.php` and add:

```php
define('DISABLE_WP_CRON', true);
```

#### Step 2: Add Crontab Entry

SSH into your server and edit crontab:

```bash
crontab -e
```

Add this line (run every minute):

```bash
* * * * * wget -q -O - https://yoursite.com/wp-cron.php?doing_wp_cron >/dev/null 2>&1
```

Or using `curl`:

```bash
* * * * * curl -s https://yoursite.com/wp-cron.php?doing_wp_cron >/dev/null 2>&1
```

#### Step 3: Verify

Wait a few minutes, then check **Activity & Logging** to see if rules are executing.

---

## Monitoring & Debugging

### Viewing Logs

1. Go to **Activity & Logging** tab
2. Click **View Logs**
3. Logs show:
   - Rule execution start/end
   - Chapters found
   - Download progress
   - Errors

### Log Levels

| Level | Description |
|-------|-------------|
| **INFO** | Normal operation (rule started, chapters found) |
| **WARNING** | Non-critical issues (missing metadata) |
| **ERROR** | Critical failures (download failed, timeout) |

### Common Log Messages

| Message | Meaning |
|---------|---------|
| `Rule #5 started` | Scraping rule #5 began execution |
| `Found 10 chapters` | Detected 10 chapters on TOC page |
| `Chapter already exists: ch-1` | Chapter 1 already in database, skipped |
| `Downloaded image: 001.jpg` | Image download succeeded |
| `Failed to fetch URL` | Network error or invalid URL |
| `Cloudflare detected` | Target site has anti-bot protection |

### System Info

Click **System Info** to view:
- Server environment
- PHP version
- User agent
- Plugin version
- Active rules count

---

## Troubleshooting Quick Fixes

### Problem: Rule not running

**Solutions:**
1. Check **Main Switch** is ON
2. Check rule's **Active** checkbox is checked
3. Verify schedule time has passed
4. Check logs for errors
5. Setup system cron (see above)

### Problem: No chapters found

**Solutions:**
1. Verify URL is the Table of Contents page (not a chapter)
2. Check if site structure changed
3. Enable **Use PhantomJS** for the rule
4. Check logs for parsing errors

### Problem: Images not loading

**Solutions:**
1. Check file permissions: `chmod 755 wp-content/uploads/manga/`
2. Enable proxy if source has hotlink protection
3. Check available disk space
4. Verify images exist in `wp-content/uploads/manga/{id}/`

### Problem: Timeout errors

**Solutions:**
1. Increase **Rule Timeout** in Main Settings
2. Reduce **Max # Chapters** per run
3. Increase PHP `max_execution_time` in `php.ini`
4. Split large manga into multiple rules

---

## Best Practices

### DO:
✅ Start with small tests (1-2 chapters)  
✅ Use reasonable schedules (12-24 hours)  
✅ Enable logging for debugging  
✅ Backup your database before large operations  
✅ Monitor server resources (CPU, disk space)  
✅ Respect target sites (don't overload)  

### DON'T:
❌ Set schedule too frequently (<6 hours)  
❌ Scrape all chapters of 100 manga at once  
❌ Run multiple rules simultaneously without testing  
❌ Ignore legal/ethical considerations  
❌ Use on production without testing on staging  
❌ Forget to rotate logs regularly  

---

## Next Steps

Now that you have the basics:

1. **Read the full documentation:**
   - [CONFIGURATION.md](CONFIGURATION.md) - Detailed settings reference
   - [TROUBLESHOOTING.md](TROUBLESHOOTING.md) - Common issues
   - [SECURITY.md](SECURITY.md) - Security considerations

2. **Explore advanced features:**
   - [API_REFERENCE.md](API_REFERENCE.md) - Hooks and filters for developers
   - [ARCHITECTURE.md](ARCHITECTURE.md) - System design
   - [DATA_FLOW.md](DATA_FLOW.md) - How data moves through the system

3. **Join the community:**
   - [GitHub Issues](https://github.com/druvx13/ultimate-manga-scraper/issues)
   - [FAQ](FAQ.md)

---

**Need help?** Check the [FAQ](FAQ.md) or open an issue on GitHub.

**Ready to contribute?** See [CONTRIBUTING.md](CONTRIBUTING.md) (if available) or submit a pull request.

Happy scraping! 🚀
