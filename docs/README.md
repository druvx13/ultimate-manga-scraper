# Documentation Website

This directory contains the HTML documentation website for the Ultimate Web Novel & Manga Scraper plugin.

## Structure

```
docs/
├── index.html                 # Homepage
├── getting-started.html       # Getting Started guide
├── documentation.html         # Main documentation (README)
├── api-reference.html         # API Reference
├── faq.html                   # FAQ
├── configuration.html         # Configuration guide
├── architecture.html          # System architecture
├── troubleshooting.html       # Troubleshooting guide
├── security.html              # Security documentation
├── deployment.html            # Deployment guide
├── data-flow.html             # Data flow documentation
├── directory-structure.html   # Directory structure
├── css/
│   └── style.css             # Main stylesheet
├── js/
│   └── main.js               # Main JavaScript
└── assets/
    └── images/               # Images and assets
```

## Viewing Locally

Simply open `index.html` in a web browser to view the documentation website locally.

## Hosting

This is a static website and can be hosted on:
- GitHub Pages
- Netlify
- Vercel
- Any static web hosting service

## Building

The HTML pages are generated from the Markdown documentation files in the root directory using `convert_docs_to_html.py`.

To regenerate the HTML pages:

```bash
python3 ../convert_docs_to_html.py
```

## Features

- Responsive design (mobile-friendly)
- Syntax highlighting for code blocks
- Search functionality
- Table of contents generation
- Dark mode code blocks
- Font Awesome icons

## Dependencies

External CDN dependencies:
- Font Awesome 6.0.0 (icons)
- Highlight.js 11.7.0 (syntax highlighting)

## License

Same as the main plugin: LUCA Free License v1.0
