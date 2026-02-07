#!/usr/bin/env python3
"""
Convert Markdown documentation files to HTML pages for the docs/ website.
"""

import re
import os
from pathlib import Path

# HTML template for documentation pages
HTML_TEMPLATE = '''<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{description}">
    <title>{title} - Ultimate Manga Scraper Documentation</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/atom-one-dark.min.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <i class="fas fa-book-reader"></i>
                <span>Ultimate Manga Scraper</span>
            </div>
            <button class="nav-toggle" id="navToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="index.html">Home</a></li>
                <li><a href="getting-started.html">Getting Started</a></li>
                <li><a href="documentation.html">Documentation</a></li>
                <li><a href="api-reference.html">API Reference</a></li>
                <li><a href="faq.html">FAQ</a></li>
                <li><a href="https://github.com/druvx13/ultimate-manga-scraper" target="_blank">
                    <i class="fab fa-github"></i> GitHub
                </a></li>
            </ul>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>{title}</h1>
            <p>{description}</p>
        </div>
    </section>

    <!-- Content -->
    <section class="content-page">
        <div class="container">
            <div class="content">
                {content}
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Ultimate Manga Scraper</h3>
                    <p>Institutional-grade WordPress plugin for manga and web novel content aggregation.</p>
                    <p class="license">Licensed under LUCA Free License v1.0</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="getting-started.html">Getting Started</a></li>
                        <li><a href="documentation.html">Documentation</a></li>
                        <li><a href="api-reference.html">API Reference</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Resources</h3>
                    <ul>
                        <li><a href="https://github.com/druvx13/ultimate-manga-scraper" target="_blank">GitHub Repository</a></li>
                        <li><a href="https://github.com/druvx13/ultimate-manga-scraper/issues" target="_blank">Issue Tracker</a></li>
                        <li><a href="security.html">Security</a></li>
                        <li><a href="troubleshooting.html">Troubleshooting</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Legal</h3>
                    <ul>
                        <li><a href="license.html">License</a></li>
                        <li><a href="security.html#disclosure">Security Disclosure</a></li>
                        <li><a href="notice.html">Third-Party Notices</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 NIKOL. Licensed under LUCA Free License v1.0.</p>
                <p>Built with <i class="fas fa-heart"></i> for the manga community</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <script src="js/main.js"></script>
</body>
</html>
'''

def markdown_to_html(md_content):
    """Convert basic Markdown to HTML."""
    html = md_content
    
    # Headers
    html = re.sub(r'^# (.*?)$', r'<h2>\1</h2>', html, flags=re.MULTILINE)
    html = re.sub(r'^## (.*?)$', r'<h3>\1</h3>', html, flags=re.MULTILINE)
    html = re.sub(r'^### (.*?)$', r'<h4>\1</h4>', html, flags=re.MULTILINE)
    html = re.sub(r'^#### (.*?)$', r'<h5>\1</h5>', html, flags=re.MULTILINE)
    
    # Code blocks
    html = re.sub(r'```(\w+)?\n(.*?)```', r'<pre><code class="language-\1">\2</code></pre>', html, flags=re.DOTALL)
    
    # Inline code
    html = re.sub(r'`([^`]+)`', r'<code>\1</code>', html)
    
    # Bold
    html = re.sub(r'\*\*(.*?)\*\*', r'<strong>\1</strong>', html)
    
    # Italic
    html = re.sub(r'\*(.*?)\*', r'<em>\1</em>', html)
    
    # Links
    html = re.sub(r'\[([^\]]+)\]\(([^)]+)\)', r'<a href="\2">\1</a>', html)
    
    # Tables - detect and convert
    table_pattern = r'\|(.+?)\|\n\|[-:\s|]+\|\n((?:\|.+?\|\n)+)'
    def convert_table(match):
        header = match.group(1)
        rows = match.group(2)
        
        # Process header
        headers = [h.strip() for h in header.split('|')]
        header_html = '<tr>' + ''.join(f'<th>{h}</th>' for h in headers if h) + '</tr>'
        
        # Process rows
        rows_html = ''
        for row in rows.strip().split('\n'):
            cells = [c.strip() for c in row.split('|')]
            if any(cells):
                rows_html += '<tr>' + ''.join(f'<td>{c}</td>' for c in cells if c) + '</tr>'
        
        return f'<table>\n<thead>{header_html}</thead>\n<tbody>{rows_html}</tbody>\n</table>'
    
    html = re.sub(table_pattern, convert_table, html, flags=re.MULTILINE)
    
    # Unordered lists
    html = re.sub(r'^\*   (.*?)$', r'<li>\1</li>', html, flags=re.MULTILINE)
    html = re.sub(r'^- (.*?)$', r'<li>\1</li>', html, flags=re.MULTILINE)
    
    # Wrap consecutive list items in ul
    html = re.sub(r'(<li>.*?</li>\n)+', r'<ul>\n\g<0></ul>\n', html, flags=re.MULTILINE)
    
    # Paragraphs - wrap text that's not in other tags
    lines = html.split('\n')
    result = []
    in_block = False
    
    for line in lines:
        stripped = line.strip()
        if not stripped:
            result.append(line)
            continue
        
        # Check if line is already in a tag
        if re.match(r'<(h[2-5]|pre|code|ul|li|table|thead|tbody|tr|th|td|strong|em|a)', stripped):
            in_block = True
            result.append(line)
        elif in_block and re.match(r'</(h[2-5]|pre|code|ul|li|table|thead|tbody|tr|th|td)>', stripped):
            in_block = False
            result.append(line)
        elif not in_block and stripped and not stripped.startswith('<'):
            result.append(f'<p>{line}</p>')
        else:
            result.append(line)
    
    html = '\n'.join(result)
    
    # Fix markdown links to point to HTML files
    html = re.sub(r'href="([^"]+)\.md"', r'href="\1.html"', html)
    
    return html

def convert_md_file(md_file, output_dir, title, description):
    """Convert a single markdown file to HTML."""
    with open(md_file, 'r', encoding='utf-8') as f:
        md_content = f.read()
    
    html_content = markdown_to_html(md_content)
    
    html = HTML_TEMPLATE.format(
        title=title,
        description=description,
        content=html_content
    )
    
    output_file = output_dir / f"{md_file.stem.lower().replace('_', '-')}.html"
    with open(output_file, 'w', encoding='utf-8') as f:
        f.write(html)
    
    print(f"Created: {output_file.name}")

def main():
    # Define documentation files to convert
    docs_to_convert = [
        ('GETTING_STARTED.md', 'Getting Started', 'Quick setup guide for Ultimate Manga Scraper'),
        ('README.md', 'Overview', 'Complete overview of Ultimate Manga Scraper'),
        ('API_REFERENCE.md', 'API Reference', 'Complete API documentation with hooks, filters, and functions'),
        ('FAQ.md', 'FAQ', 'Frequently asked questions'),
        ('CONFIGURATION.md', 'Configuration', 'Detailed configuration reference'),
        ('ARCHITECTURE.md', 'Architecture', 'System architecture and design'),
        ('TROUBLESHOOTING.md', 'Troubleshooting', 'Common issues and solutions'),
        ('SECURITY.md', 'Security', 'Security considerations and best practices'),
        ('DEPLOYMENT.md', 'Deployment', 'Installation and deployment guide'),
        ('DATA_FLOW.md', 'Data Flow', 'Data flow and processing pipeline'),
        ('DIRECTORY_STRUCTURE.md', 'Directory Structure', 'Complete directory structure reference'),
    ]
    
    root_dir = Path('.')
    output_dir = root_dir / 'docs'
    output_dir.mkdir(exist_ok=True)
    
    for md_file, title, description in docs_to_convert:
        md_path = root_dir / md_file
        if md_path.exists():
            convert_md_file(md_path, output_dir, title, description)
        else:
            print(f"Warning: {md_file} not found, skipping...")
    
    print("\nConversion complete!")

if __name__ == '__main__':
    main()
