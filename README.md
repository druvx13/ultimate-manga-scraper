
# Ultimate Web Novel & Manga Scraper

This WordPress plugin automatically scrapes web novels and manga from various sources and publishes them on your Madara-powered website.

## Description

The Ultimate Web Novel & Manga Scraper is a powerful tool designed to automate the process of fetching and publishing web novels and manga. It integrates seamlessly with the Madara theme, allowing you to create a comprehensive manga and web novel site with minimal effort.

### Key Features:

- **Automated Scraping:** Schedule automatic scraping of manga and web novels from popular sources.
- **Madara Theme Integration:** Works perfectly with the Madara theme, ensuring compatibility and a smooth user experience.
- **Multiple Scrapers:** Includes scrapers for FanFox.net, novlove.com, WuxiaWorld.site, and other Madara-based sites.
- **Advanced Scraping Options:** Configure advanced search parameters, including genres, authors, artists, and release years.
- **Content Translation:** Automatically translate scraped content using Google Translate, DeepL, or Microsoft Translator.
- **Proxy Support:** Use web proxies to avoid getting blocked while scraping.
- **Headless Browser Support:** Utilize PhantomJS, Puppeteer, or HeadlessBrowserAPI to scrape content from sites that rely on JavaScript.

## Requirements

- **WordPress:** Version 4.0 or higher.
- **Madara Theme:** This plugin requires the [Madara - WordPress Theme for Manga](https://mangabooth.com/product/wp-manga-theme-madara/) to be installed and active.
- **Madara Core Plugin:** The Madara Core plugin, which comes with the theme, must also be active.

## Installation

1.  **Upload Plugin:** Upload the plugin files to the `/wp-content/plugins/ultimate-manga-scraper` directory, or install the plugin through the WordPress plugins screen directly.
2.  **Activate Plugin:** Activate the plugin through the 'Plugins' screen in WordPress.
3.  **Configure Settings:** Use the **Ultimate Web Novel & Manga Scraper** -> **Main Settings** screen to configure the plugin.

## Configuration

The plugin's settings are divided into several sections, which can be accessed from the WordPress admin menu.

### Main Settings

- **Main Switch:** Enable or disable the entire plugin.
- **Scraping Enhancements:**
    - **HeadlessBrowserAPI Key:** Enter your API key to use the HeadlessBrowserAPI for scraping JavaScript-rendered content.
- **Plugin Options:**
    - **CloudFlare Caching:** Enable if your server uses CloudFlare to avoid issues with execution time limits.
    - **Manga Storage Device:** Select the storage location for scraped manga (local, Amazon S3, etc.).
    - **Logging:** Enable or disable logging for scraping rules.
    - **Automatic Rerunning of Rules:** Disable to prevent the plugin from automatically restarting a failed scraping process.
    - **Proxy Settings:** Configure your web proxy address and authentication details.
    - **Timeouts and Delays:** Set timeouts for rule execution and delays between scraping requests.
- **Translation Options:**
    - **Translator API Keys:** Enter your API keys for Google Translator, Microsoft Translator, or DeepL.
- **PhantomJS Settings:**
    - **PhantomJS Path:** Set the server path for the PhantomJS executable.
    - **Execution Timeout:** Configure the timeout for PhantomJS execution.

### Scraping Rules

You can create and manage scraping rules for different sources:

- **Manga Scraper (FanFox.net)**
- **Web Novel Scraper (novlove.com)**
- **Web Novel Scraper (WuxiaWorld.site)**
- **Manga Scraper (Madara Theme Sites)**
- **Web Novel Scraper (Madara Theme Sites)**

Each rule allows you to specify the manga or web novel to scrape (by URL or keyword), set a scraping schedule, define the number of chapters to fetch, and configure various other options.

## Usage

1.  **Navigate to the Plugin Settings:** In your WordPress dashboard, go to **Ultimate Web Novel & Manga Scraper**.
2.  **Configure Main Settings:** Set up your API keys, proxy settings, and other global options in the **Main Settings** tab.
3.  **Create a Scraping Rule:**
    -   Go to one of the scraper sections (e.g., **Manga Scraper (FanFox.net)**).
    -   Enter the URL or search keyword for the manga you want to scrape.
    -   Set the scraping schedule (in hours or minutes).
    -   Configure other options, such as the number of chapters to scrape, post status, and author.
    -   Save the rule.
4.  **Run the Rule:** You can either wait for the rule to run on its schedule or trigger it manually by clicking the "Run This Rule Now" button.

## Troubleshooting

- **Scraping Failures:** If a scraping rule fails, check the **Activity & Logging** tab for detailed error messages.
- **CloudFlare Issues:** If your site is behind CloudFlare, make sure to enable the "My Server Is Using CloudFlare Caching" option in the Main Settings.
- **JavaScript-Rendered Content:** If you're scraping a site that uses JavaScript to load content, use one of the headless browser options (PhantomJS, Puppeteer, or HeadlessBrowserAPI).

## Support (From Official Plugin Creators)

If you need help with the plugin, please check our [knowledge base](//coderevolution.ro/knowledge-base/) or contact [our support team](//coderevolution.ro/support).

## Changelog

### 2.0.3
- Added Nulled Version.

### 2.0.2
- Bugfixes and performance improvements.

### 1.0
- Initial release.
