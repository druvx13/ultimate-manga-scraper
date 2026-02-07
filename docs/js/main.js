// Mobile Navigation Toggle
document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');
    
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!navToggle.contains(event.target) && !navMenu.contains(event.target)) {
                navMenu.classList.remove('active');
            }
        });

        // Close menu when clicking a link
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navMenu.classList.remove('active');
            });
        });
    }
});

// Smooth Scrolling for Anchor Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Scroll to Top Button
window.addEventListener('scroll', function() {
    const scrollBtn = document.getElementById('scrollTopBtn');
    if (scrollBtn) {
        if (window.pageYOffset > 300) {
            scrollBtn.style.display = 'block';
        } else {
            scrollBtn.style.display = 'none';
        }
    }
});

// Code Copy Button
function addCopyButtons() {
    const codeBlocks = document.querySelectorAll('pre code');
    codeBlocks.forEach(block => {
        const pre = block.parentElement;
        const button = document.createElement('button');
        button.className = 'copy-btn';
        button.textContent = 'Copy';
        button.addEventListener('click', function() {
            navigator.clipboard.writeText(block.textContent).then(() => {
                button.textContent = 'Copied!';
                setTimeout(() => {
                    button.textContent = 'Copy';
                }, 2000);
            });
        });
        pre.style.position = 'relative';
        pre.appendChild(button);
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', addCopyButtons);

// Simple Search Functionality (if search box exists)
const searchInput = document.getElementById('searchInput');
if (searchInput) {
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const searchableElements = document.querySelectorAll('.searchable');
        
        searchableElements.forEach(element => {
            const text = element.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                element.style.display = '';
            } else {
                element.style.display = 'none';
            }
        });
    });
}

// Table of Contents Generator
function generateTOC() {
    const toc = document.getElementById('toc');
    if (!toc) return;

    const headings = document.querySelectorAll('.content h2, .content h3');
    const tocList = document.createElement('ul');
    tocList.className = 'toc-list';

    headings.forEach((heading, index) => {
        const li = document.createElement('li');
        const a = document.createElement('a');
        const id = heading.id || `heading-${index}`;
        
        heading.id = id;
        a.href = `#${id}`;
        a.textContent = heading.textContent;
        
        if (heading.tagName === 'H3') {
            li.style.paddingLeft = '20px';
        }
        
        li.appendChild(a);
        tocList.appendChild(li);
    });

    toc.appendChild(tocList);
}

document.addEventListener('DOMContentLoaded', generateTOC);
