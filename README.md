# Ultimate Web Novel & Manga Scraper

**Institutional-Grade Documentation Edition**

This repository contains the **Ultimate Web Novel & Manga Scraper**, a comprehensive WordPress plugin designed to automate the ingestion of manga and web novel content. It is engineered to integrate seamlessly with the **Madara** theme, transforming a standard WordPress installation into a fully automated content aggregation platform.

---

## 📖 Table of Contents

1.  [Project Overview](#project-overview)
2.  [Feature Inventory](#feature-inventory)
3.  [System Requirements](#system-requirements)
4.  [Technology Stack](#technology-stack)
5.  [Directory Overview](#directory-overview)
6.  [Installation](#installation)
7.  [Environment Setup](#environment-setup)
8.  [Configuration](#configuration)
9.  [Database Setup](#database-setup)
10. [Admin & System Usage](#admin--system-usage)
11. [Development Workflow](#development-workflow)
12. [Production Deployment](#production-deployment)
13. [Security Considerations](#security-considerations)
14. [Limitations & Assumptions](#limitations--assumptions)
15. [Maintenance](#maintenance)
16. [Licensing](#licensing)

---

## 1. Project Overview

The plugin operates as a "God Object" within the WordPress ecosystem, specifically targeting the **Madara** manga theme. It acts as a bridge between external content sources (MangaFox, WuxiaWorld, Madara-based sites, etc.) and the local WordPress database.

It handles the entire lifecycle of content acquisition:
*   **Scheduling**: Cron-based execution.
*   **Fetching**: Multi-mode scraping (cURL, PhantomJS, Puppeteer).
*   **Processing**: HTML parsing, cleaning, and text spinning.
*   **Translation**: Automated translation via Google/DeepL/Microsoft.
*   **Storage**: Saving to local FS, DB, or Cloud Storage (S3).

## 2. Feature Inventory

*   **Multi-Source Scraping**: Built-in rules for major manga/novel sites.
*   **Headless Browser Support**: Renders JavaScript-heavy sites using PhantomJS or Puppeteer.
*   **Translation Pipeline**: Converts content language on-the-fly.
*   **Proxy Support**: Rotates proxies to bypass IP bans.
*   **Cloudflare Bypass**: Mechanisms to handle anti-bot protection.
*   **Madara Enhancements**: specialized module for cloning other Madara sites via AJAX.
*   **Auto-Update**: Updates existing manga with new chapters automatically.

## 3. System Requirements

*   **CMS**: WordPress 5.0+
*   **Theme**: Madara (Active)
*   **Plugin Dependency**: Madara Core (`WP_MANGA_STORAGE`)
*   **PHP**: 8.2+
*   **Extensions**: `curl`, `dom`, `mbstring`, `json`, `libxml`
*   **Optional**:
    *   `Node.js` (for Puppeteer)
    *   `PhantomJS` binary
    *   `shell_exec` enabled

## 4. Technology Stack

*   **Language**: PHP 8
*   **Frontend**: jQuery (Admin UI)
*   **Parsers**: PHP Simple HTML DOM Parser, DOMDocument
*   **Headless**: PhantomJS (JS), Puppeteer (Node.js)
*   **Database**: MySQL/MariaDB (WordPress Schema + Madara Custom Tables)

## 5. Directory Overview

See [DIRECTORY_STRUCTURE.md](DIRECTORY_STRUCTURE.md) for a complete manifest.

*   `root`: Core logic (`ultimate-manga-scraper.php`).
*   `includes/`: Madara integration classes.
*   `res/`: Libraries, drivers, and admin UI templates.
*   `images/`, `scripts/`, `styles/`: Assets.

## 6. Installation

See [DEPLOYMENT.md](DEPLOYMENT.md) for detailed steps.

1.  Upload plugin to `/wp-content/plugins/`.
2.  Activate via WordPress Admin.
3.  Ensure Madara theme is active.

## 7. Environment Setup

*   **Permissions**: Ensure the web server can write to `wp-content/uploads` and `wp-content/plugins/ultimate-manga-scraper`.
*   **Cron**: Disable WP-Cron and setup a system cron for reliability.

## 8. Configuration

See [CONFIGURATION.md](CONFIGURATION.md).

Configuration is handled via **Ultimate Web Novel & Manga Scraper -> Main Settings**. Key areas:
*   **Headless Settings**: Paths to binaries.
*   **Translation Keys**: API credentials.
*   **Storage Backend**: Local vs Cloud.

## 9. Database Setup

The plugin utilizes the standard WordPress `wp_options` table for storing rules and settings. Content is stored in `wp_posts` (Manga) and `wp_postmeta`. Chapter data is managed by Madara's storage engine.

## 10. Admin & System Usage

1.  **Define Rules**: Go to the specific scraper tab (e.g., Manga Scraper).
2.  **Add URL**: Paste the TOC URL of the target manga.
3.  **Set Schedule**: Define how often to check for updates.
4.  **Run**: Click "Run This Rule Now" or wait for Cron.
5.  **Monitor**: Watch the "Activity & Logging" tab.

## 11. Development Workflow

*   **Architecture**: See [ARCHITECTURE.md](ARCHITECTURE.md).
*   **Data Flow**: See [DATA_FLOW.md](DATA_FLOW.md).
*   **Modifying**: Edits should primarily be made in `ultimate-manga-scraper.php` for core logic, or `includes/` for Madara-specific logic.

## 12. Production Deployment

*   **Security**: See [SECURITY.md](SECURITY.md).
*   **Optimization**: Use Redis/Memcached object caching. Use a real Cron job.

## 13. Security Considerations

*   **SSRF**: The plugin makes outbound requests to user-defined URLs.
*   **RCE**: `shell_exec` is used for headless browsers. Secure your server accordingly.
*   **Access Control**: Restrict Admin access.

## 14. Limitations & Assumptions

*   **Theme Dependency**: Assumes Madara theme structure is present.
*   **Site Changes**: Scrapers rely on DOM structure. Target site changes will break scraping until updated.
*   **Legal**: User is responsible for copyright compliance of scraped content.

## 15. Maintenance

*   **Logs**: Rotate logs (`auto_clear_logs`).
*   **Updates**: Check [CHANGELOG.md](CHANGELOG.md).

## 16. Licensing

Licensed under the **LUCA Free License v1.0**. See [LICENSE](LICENSE) for details.

---

**Documentation Index**: [DOCUMENTATION_INDEX.md](DOCUMENTATION_INDEX.md)
