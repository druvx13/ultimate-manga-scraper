# Documentation Website

This directory contains the complete HTML documentation website for the Ultimate Web Novel & Manga Scraper plugin.

## 📁 Structure

```
docs/
├── index.html              # Homepage/landing page
├── installation.html       # Installation & overview guide
├── user-guide.html        # Complete user guide
├── api-reference.html     # Developer API documentation
├── faq.html               # Frequently asked questions
├── performance.html       # Performance tuning guide
├── architecture.html      # System architecture
├── configuration.html     # Configuration reference
├── deployment.html        # Deployment guide
├── troubleshooting.html   # Troubleshooting guide
├── security.html          # Security analysis
├── data-flow.html         # Data flow documentation
├── directory-structure.html # Directory structure
├── changelog.html         # Version history
├── css/
│   └── style.css         # Main stylesheet
├── js/
│   └── main.js           # Interactive features
└── assets/               # Images and other assets
```

## 🚀 Features

- **Responsive Design**: Works perfectly on desktop, tablet, and mobile devices
- **Search Functionality**: Real-time search through documentation pages
- **Syntax Highlighting**: Code examples with highlight.js
- **Table of Contents**: Auto-generated for long pages
- **Copy Code Buttons**: One-click code copying
- **Back to Top**: Smooth scroll to top button
- **Mobile Navigation**: Collapsible sidebar for mobile devices
- **Interactive Elements**: Hover effects, transitions, and animations

## 🌐 Viewing the Documentation

### Option 1: Local Web Server

```bash
# Navigate to docs directory
cd docs/

# Python 3
python3 -m http.server 8080

# Python 2
python -m SimpleHTTPServer 8080

# PHP
php -S localhost:8080

# Node.js (with http-server)
npx http-server -p 8080
```

Then open: http://localhost:8080

### Option 2: Direct File Access

Simply open `index.html` in your web browser. Note that some features (like external fonts) may not work perfectly with the `file://` protocol.

### Option 3: GitHub Pages

If this repository is published on GitHub, the documentation can be hosted on GitHub Pages:

1. Go to repository Settings
2. Navigate to Pages
3. Set source to the `/docs` folder
4. Save and wait for deployment
5. Access at: `https://username.github.io/repository-name/`

## 🎨 Customization

### Colors

Edit `css/style.css` and modify the CSS variables:

```css
:root {
    --primary-color: #2563eb;      /* Main brand color */
    --primary-dark: #1e40af;       /* Darker variant */
    --secondary-color: #10b981;    /* Secondary/accent color */
    --background: #ffffff;          /* Page background */
    --surface: #f9fafb;            /* Card/surface background */
    --text-primary: #111827;       /* Primary text color */
    --text-secondary: #6b7280;     /* Secondary text color */
}
```

### Layout

- **Sidebar width**: Change `--sidebar-width` in `style.css`
- **Content max-width**: Modify `.content { max-width: ... }` in `style.css`
- **Breakpoints**: Adjust `@media` queries for responsive behavior

## 📝 Adding New Pages

1. Create a new HTML file using the existing structure:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title - Ultimate Web Novel & Manga Scraper</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
</head>
<body>
    <!-- Copy sidebar navigation from index.html -->
    <!-- Add your content -->
    <!-- Copy footer from index.html -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
```

2. Add link to sidebar navigation in all pages
3. Update the active state for the new page

## 🔧 Dependencies

### CDN Resources

- **Highlight.js**: Code syntax highlighting
  - CSS: https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css
  - JS: https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js
  - Integrity hashes included for security (SRI)

### Local Files

- `css/style.css`: Custom styles
- `js/main.js`: Interactive functionality

All dependencies are either included locally or loaded from CDN with Subresource Integrity (SRI) for security.

## 🛠️ Development

### Prerequisites

- Modern web browser (Chrome, Firefox, Safari, Edge)
- Basic knowledge of HTML, CSS, and JavaScript
- Text editor or IDE

### Making Changes

1. Edit HTML files to update content
2. Modify `css/style.css` for styling changes
3. Update `js/main.js` for functionality changes
4. Test in multiple browsers
5. Test responsive behavior on different screen sizes

### Testing Checklist

- [ ] All pages load without errors
- [ ] Navigation works correctly
- [ ] Search functionality works
- [ ] Code blocks have syntax highlighting
- [ ] Copy buttons work on code blocks
- [ ] Links work (internal and external)
- [ ] Responsive design works on mobile
- [ ] Back to top button appears on scroll
- [ ] Table of contents generates correctly

## 🔒 Security

- All external resources use Subresource Integrity (SRI)
- External links open in new tab with `rel="noopener noreferrer"`
- No inline scripts (CSP-friendly)
- No user input processing (static site)

## 📱 Browser Support

- ✅ Chrome/Edge (latest)
- ✅ Firefox (latest)
- ✅ Safari (latest)
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)
- ⚠️ IE11 (partial support, not recommended)

## 📄 License

Released into the Public Domain. See [LICENSE](../LICENSE) for details.

## 🤝 Contributing

To improve the documentation:

1. Edit the markdown source files in the parent directory
2. Regenerate HTML files (or edit HTML directly for minor changes)
3. Test thoroughly
4. Submit a pull request

## 📞 Support

For questions or issues:

- Check the [FAQ](faq.html)
- Review [Troubleshooting](troubleshooting.html)
- Open an issue on GitHub
- Consult the [User Guide](user-guide.html)

---

**Version**: 2.0.3  
**Last Updated**: February 2024  
**Maintained by**: Community
