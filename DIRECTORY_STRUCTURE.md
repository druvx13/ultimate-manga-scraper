# Directory Structure

This document provides a detailed overview of the file and directory structure of the **Ultimate Web Novel & Manga Scraper** repository.

## Root Directory

| File | Purpose |
| :--- | :--- |
| `ultimate-manga-scraper.php` | **Core Plugin File**. Handles initialization, hooks, cron scheduling, scraping logic, settings pages, and database interactions. |
| `index.php` | Prevents directory listing (silence is golden). |
| `LICENSE` | Legal terms (Unlicense + Disclaimer). |
| `README.md` | General documentation and quick-start guide. |
| `CHANGELOG.md` | Version history. |
| `ARCHITECTURE.md` | System architecture documentation. |
| `API_REFERENCE.md` | Internal API / hook reference. |
| `CONFIGURATION.md` | Configuration reference. |
| `DATA_FLOW.md` | Data flow documentation. |
| `DEPLOYMENT.md` | Deployment and installation guide. |
| `DIRECTORY_STRUCTURE.md` | This file — repository layout overview. |
| `DOCUMENTATION_INDEX.md` | Index of all documentation. |
| `FAQ.md` | Frequently asked questions. |
| `GETTING_STARTED.md` | First-run setup guide. |
| `NOTICE.md` | Third-party software attributions. |
| `SECURITY.md` | Security analysis documentation. |
| `SECURITY_DISCLOSURE.md` | Security disclosure / vulnerability policy. |
| `TROUBLESHOOTING.md` | Troubleshooting guide. |
| `LICENSE_CONFLICT_RESOLUTION.md` | Notes on license conflicts between bundled libraries. |
| `LICENSE_MIGRATION_REPORT.md` | Library migration notes. |
| `sitemap.txt` | URL list used by the WuxiaWorld site scraper rule. |
| `sitemap_box.txt` | URL list used by the NovelBox site scraper rule. |
| `sitemap_vip.txt` | URL list used by the VIP Novel site scraper rule. |
| `convert_docs_to_html.py` | Utility script that generates `docs/*.html` from Markdown sources. |

## `includes/`
*PHP classes for specific integrations, kept separate from the monolithic plugin file.*

| File | Purpose |
| :--- | :--- |
| `class-madara-fetcher.php` | Fetches manga lists and details from Madara-based sites via their AJAX endpoints. |
| `class-madara-handler.php` | Manages the "Madara Enhancements" admin page and its AJAX actions (add, search, load-more). |

## `res/`
*Resources, bundled libraries, and sub-modules.*

### Third-party Libraries

| File/Directory | Version | Purpose |
| :--- | :--- | :--- |
| `simple_html_dom.php` | 1.9.1 (forked) | PHP Simple HTML DOM Parser. Fork preserves `ums_` prefix and WordPress `WP_Filesystem` integration. |
| `ImageResize/ImageResize.php` | gumlet 2.1.3 | Image resizing class (`namespace Gumlet`). Successor to abandoned `eventviva/php-image-resize`. |
| `ImageResize/ImageResizeException.php` | gumlet 2.1.3 | Exception class for `ImageResize`. |
| `UMSJavaScriptUnpacker.php` | — | Decodes packed JavaScript (eval/packer obfuscation) found on some manga sites. |
| `mangafox-master/` | (Composer) | Specialized scraper library for FanFox / MangaFox. Contains its own `composer.json`, `src/`, `tests/`, and pre-built `vendor/`. |

### Scripts / Binaries

| File/Directory | Purpose |
| :--- | :--- |
| `phantomjs/phantom.js` | Node script used with the PhantomJS executable for headless scraping. |
| `puppeteer/puppeteer.js` | Node script used with Puppeteer for headless Chrome scraping. |

### Plugin PHP Files

| File | Purpose |
| :--- | :--- |
| `ums-main.php` | Admin settings page layout (HTML template). |
| `ums-rules-list.php` | Admin UI — displays and manages manga scraping rules. |
| `ums-novel-list.php` | Admin UI — displays and manages novel scraping rules. |
| `ums-novel-generic-list.php` | Admin UI — generic Madara-based novel rules list. |
| `ums-manga-generic-list.php` | Admin UI — generic Madara-based manga rules list. |
| `ums-text-list.php` | Admin UI — text / post scraping rules list. |
| `ums-vipnovel-list.php` | Admin UI — VIP novel scraping rules list. |
| `ums-logs.php` | Admin UI — activity and error logging interface. |
| `ums-enhancements.php` | Admin UI — Madara Enhancements settings/controls. |
| `ums-text-spinner.php` | Logic — text spinning / rewriting integration. |
| `ums-translator.php` | Logic — Google Translate API (free/scraping method). |
| `ums-translator-microsoft.php` | Logic — Microsoft Azure Translator API. |
| `translator-api.php` | Logic — DeepL or alternate translation API wrapper. |
| `synonyms.dat` | Data — synonym word list used by text spinning. |

### `res/other/`

| File | Purpose |
| :--- | :--- |
| `plugin-dash.php` | WordPress dashboard widget registration. |
| `script.js` | Dashboard widget JS (loaded via `plugin-dash.php`). |
| `scriptnews.js` | News/announcements dashboard widget JS. |

## `images/`
*Static plugin assets.*

| File | Purpose |
| :--- | :--- |
| `icon.png` | Plugin menu icon. |
| `new.png` | "New" badge image. |
| `image-placeholder.jpg` | Fallback image for missing manga covers. |
| `running.gif` | Status indicator — rule is running. |
| `ok.gif` | Status indicator — rule completed successfully. |
| `nochange.gif` | Status indicator — rule ran but found no changes. |
| `failed.gif` | Status indicator — rule failed. |
| `facebook.png`, `twitter.png`, `pinterest.png` | Social-share icons used by the front-end. |

## `scripts/`
*Admin and front-end JavaScript files.*

| File | Purpose |
| :--- | :--- |
| `footer.js` | Admin JS loaded in the footer: rule actions, busy-wait-free CloudFlare retry, form helpers, modal controls. |
| `main.js` | Admin JS for the Main Settings page: license activation/revocation, toggle visibility. |
| `madara-enhancements.js` | Admin JS for the Madara Enhancements page: AJAX search, load-more, add-manga. |
| `display-posts.js` | Front-end block JS for the Display Posts block. |
| `list-posts.js` | Front-end block JS for the List Posts block. |
| `badge-block.js` | Gutenberg block JS for a badge/label block. |

## `styles/`
*CSS stylesheets — all include responsive `@media` queries.*

| File | Loaded on | Purpose |
| :--- | :--- | :--- |
| `coderevolution-style.css` | Admin pages | General admin utilities (helper classes, typography, layout). Includes tablet/mobile breakpoints. |
| `ums-rules.css` | Rules list pages | Styling for scraping-rules tables and the run/delete modal. |
| `ums-browser.css` | Browser/scraper pages | Styling for the embedded scraper and settings sections. |
| `ums-activation.css` | Activation page | License activation form styling. |
| `ums-enhancements.css` | Madara Enhancements page | Responsive layout for the search form, manga table, and action buttons. |
| `coderevolution-front.css` | Front-end (public) | Front-end display styles (share buttons, image grid, video embeds). Includes mobile breakpoints. |

## `languages/`
*Internationalization (i18n) files.*

| File | Purpose |
| :--- | :--- |
| `ultimate-manga-scraper.pot` | POT template for translator tools. |

## `docs/`
*Auto-generated HTML documentation site (built from root Markdown sources via `convert_docs_to_html.py`).*

| File | Purpose |
| :--- | :--- |
| `index.html` | Documentation landing page. |
| `architecture.html` | Architecture docs. |
| `api-reference.html` | API reference. |
| `configuration.html` | Configuration reference. |
| `changelog.html` | Changelog. |
| `deployment.html` | Deployment guide. |
| `faq.html` | FAQ. |
| `getting-started.html` | Getting started guide. |
| `security.html` | Security docs. |
| `troubleshooting.html` | Troubleshooting guide. |
| `css/style.css` | Docs site stylesheet. |
| `js/main.js` | Docs site JavaScript. |
