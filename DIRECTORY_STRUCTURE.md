# Directory Structure

This document provides a detailed overview of the file and directory structure of the **Ultimate Web Novel & Manga Scraper** repository.

## Root Directory

| File | Purpose |
| :--- | :--- |
| `ultimate-manga-scraper.php` | **Core Plugin File**. Handles initialization, hooks, cron scheduling, scraping logic, settings pages, and database interactions. Effectively the "God Object" of the plugin. |
| `index.php` | Silence is golden. Prevents directory listing. |
| `LICENSE` | Legal terms (Unlicense + Disclaimer). |
| `README.md` | General documentation. |
| `sitemap.txt` | Sitemap template or artifact. |
| `sitemap_box.txt` | Sitemap template or artifact. |
| `sitemap_vip.txt` | Sitemap template or artifact. |
| `NOTICE.md` | Third-party software attributions. |
| `SECURITY_DISCLOSURE.md` | Security policy. |
| `CHANGELOG.md` | Version history. |
| `ARCHITECTURE.md` | System architecture documentation. |
| `DATA_FLOW.md` | Data flow documentation. |
| `SECURITY.md` | Security analysis documentation. |
| `CONFIGURATION.md` | Configuration reference. |
| `DEPLOYMENT.md` | Deployment guide. |
| `TROUBLESHOOTING.md` | Troubleshooting guide. |
| `DOCUMENTATION_INDEX.md` | Index of all documentation. |

## `includes/`
*Contains helper classes for specific integrations.*

| File | Purpose |
| :--- | :--- |
| `class-madara-fetcher.php` | **Madara Theme Integration**. Handles fetching manga lists and details specifically for Madara-based sites using AJAX endpoints. |
| `class-madara-handler.php` | **Admin Handler**. Manages the "Madara Enhancements" admin page, AJAX actions for adding manga, and searching. |

## `res/`
*Contains resources, libraries, and sub-modules.*

| File/Directory | Purpose |
| :--- | :--- |
| `simple_html_dom.php` | **Library**. PHP Simple HTML DOM Parser for parsing scraped HTML. |
| `ImageResize/` | **Library**. PHP class for resizing images. |
| `mangafox-master/` | **Library**. Specialized scraper library for FanFox (MangaFox). Contains its own `composer.json` and structure. |
| `phantomjs/` | **Binary/Script**. Contains `phantom.js` script used by the PhantomJS executable. |
| `puppeteer/` | **Binary/Script**. Contains `puppeteer.js` node script used for headless scraping. |
| `ums-main.php` | **Admin UI**. Settings page layout. |
| `ums-rules-list.php` | **Admin UI**. Logic for displaying and managing scraping rules (Manga). |
| `ums-novel-list.php` | **Admin UI**. Logic for displaying and managing scraping rules (Novels). |
| `ums-logs.php` | **Admin UI**. Activity logging interface. |
| `ums-translator.php` | **Logic**. Google Translate API integration (Free/Scraping method). |
| `ums-translator-microsoft.php` | **Logic**. Microsoft Translator API integration. |
| `UMSJavaScriptUnpacker.php` | **Logic**. Decodes packed JavaScript often found on manga sites (eval/packer). |
| `synonyms.dat` | **Data**. Data file for synonyms (possibly for text spinning). |
| `other/` | **Misc**. Contains `plugin-dash.php` (dashboard widgets) and generic JS scripts. |

## `images/`
*Plugin assets.*

| File | Purpose |
| :--- | :--- |
| `icon.png` | Plugin icon. |
| `image-placeholder.jpg` | Fallback image for missing manga covers. |
| `running.gif`, `ok.gif`, `failed.gif` | Status indicators for the admin UI. |

## `scripts/`
*Frontend and Admin JavaScript.*

| File | Purpose |
| :--- | :--- |
| `main.js` | Core admin JS. |
| `madara-enhancements.js` | JS for the "Madara Enhancements" tab (AJAX loading/adding). |
| `footer.js` | JS loaded in the admin footer. |

## `styles/`
*CSS Stylesheets.*

| File | Purpose |
| :--- | :--- |
| `ums-rules.css` | Styling for the rules list tables. |
| `ums-browser.css` | Styling for the embedded browser or scrapers. |
| `coderevolution-style.css` | Generic plugin styles. |

## `languages/`
*Translation files.*

| File | Purpose |
| :--- | :--- |
| `ultimate-manga-scraper.pot` | POT template for internationalization. |
