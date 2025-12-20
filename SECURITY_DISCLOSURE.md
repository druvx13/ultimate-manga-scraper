# Security Disclosure Policy

## Reporting Vulnerabilities

If you discover a security vulnerability in **Ultimate Web Novel & Manga Scraper**, we appreciate your help in disclosing it to us in a responsible manner.

Please report security issues by opening an issue on the repository (if private reporting is not available) or contacting the maintainers directly.

## Supported Versions

Only the current version of the plugin is supported.

## Vulnerability Handling

1.  **Triage**: We will acknowledge your report and verify the issue.
2.  **Fix**: We will work on a patch to resolve the vulnerability.
3.  **Disclosure**: Once fixed, we will release the update and disclose the vulnerability details.

## Known Risks (Architectural)

*   **SSRF (Server-Side Request Forgery)**: As this plugin is designed to fetch content from arbitrary URLs (scrapers), it has inherent SSRF capabilities. Administrators should ensure the server is isolated and cannot access internal network resources.
*   **Remote Code Execution (RCE)**: The plugin utilizes `shell_exec` to run PhantomJS and Puppeteer. Ensure the PHP environment is secured and these binaries are restricted if possible.
*   **Input Sanitization**: While output is generally escaped, the plugin deals with untrusted HTML content from third-party sites.
