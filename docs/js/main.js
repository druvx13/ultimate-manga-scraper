// Main JavaScript for Documentation Site

document.addEventListener('DOMContentLoaded', function() {
    // Initialize syntax highlighting
    if (typeof hljs !== 'undefined') {
        hljs.highlightAll();
    }
    
    // Sidebar toggle for mobile
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 1024) {
                if (!sidebar.contains(event.target) && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            }
        });
    }
    
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const navLinks = document.querySelectorAll('.nav-section ul li a');
            
            navLinks.forEach(link => {
                const text = link.textContent.toLowerCase();
                const listItem = link.parentElement;
                
                if (text.includes(searchTerm)) {
                    listItem.style.display = '';
                } else {
                    listItem.style.display = 'none';
                }
            });
            
            // Show/hide section headers based on visible items
            const sections = document.querySelectorAll('.nav-section');
            sections.forEach(section => {
                const visibleItems = section.querySelectorAll('ul li:not([style*="display: none"])');
                if (visibleItems.length === 0) {
                    section.style.display = 'none';
                } else {
                    section.style.display = '';
                }
            });
        });
    }
    
    // Set active nav link based on current page
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    const navLinks = document.querySelectorAll('.nav-section ul li a');
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
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
    
    // Add copy button to code blocks
    const codeBlocks = document.querySelectorAll('pre code');
    codeBlocks.forEach(block => {
        const pre = block.parentElement;
        const button = document.createElement('button');
        button.className = 'copy-button';
        button.textContent = 'Copy';
        button.style.cssText = `
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            padding: 0.25rem 0.75rem;
            background: #374151;
            color: #fff;
            border: 1px solid #4b5563;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.2s;
        `;
        
        pre.style.position = 'relative';
        pre.appendChild(button);
        
        pre.addEventListener('mouseenter', () => {
            button.style.opacity = '1';
        });
        
        pre.addEventListener('mouseleave', () => {
            button.style.opacity = '0';
        });
        
        button.addEventListener('click', async () => {
            const code = block.textContent;
            try {
                await navigator.clipboard.writeText(code);
                button.textContent = 'Copied!';
                setTimeout(() => {
                    button.textContent = 'Copy';
                }, 2000);
            } catch (err) {
                console.error('Failed to copy code:', err);
            }
        });
    });
    
    // Add table of contents for long pages
    const content = document.querySelector('.content');
    if (content) {
        const headings = content.querySelectorAll('h2, h3');
        if (headings.length > 3) {
            const toc = document.createElement('nav');
            toc.className = 'table-of-contents';
            toc.style.cssText = `
                background: var(--surface);
                padding: 1.5rem;
                border-radius: 0.5rem;
                margin-bottom: 2rem;
                border: 1px solid var(--border-color);
            `;
            
            const tocTitle = document.createElement('h3');
            tocTitle.textContent = 'Table of Contents';
            tocTitle.style.marginTop = '0';
            toc.appendChild(tocTitle);
            
            const tocList = document.createElement('ul');
            tocList.style.cssText = `
                list-style: none;
                margin: 1rem 0 0 0;
            `;
            
            headings.forEach((heading, index) => {
                const id = heading.id || `heading-${index}`;
                heading.id = id;
                
                const listItem = document.createElement('li');
                listItem.style.cssText = `
                    margin-bottom: 0.5rem;
                    ${heading.tagName === 'H3' ? 'margin-left: 1rem;' : ''}
                `;
                
                const link = document.createElement('a');
                link.href = `#${id}`;
                link.textContent = heading.textContent;
                link.style.cssText = `
                    color: var(--primary-color);
                    text-decoration: none;
                    font-size: ${heading.tagName === 'H3' ? '0.875rem' : '1rem'};
                `;
                
                link.addEventListener('mouseenter', () => {
                    link.style.textDecoration = 'underline';
                });
                
                link.addEventListener('mouseleave', () => {
                    link.style.textDecoration = 'none';
                });
                
                listItem.appendChild(link);
                tocList.appendChild(listItem);
            });
            
            toc.appendChild(tocList);
            content.insertBefore(toc, content.firstChild.nextSibling);
        }
    }
    
    // Add "back to top" button
    const backToTop = document.createElement('button');
    backToTop.textContent = '↑';
    backToTop.className = 'back-to-top';
    backToTop.style.cssText = `
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 3rem;
        height: 3rem;
        background: var(--primary-color);
        color: #fff;
        border: none;
        border-radius: 50%;
        font-size: 1.5rem;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s, visibility 0.3s;
        box-shadow: var(--shadow-lg);
        z-index: 999;
    `;
    
    document.body.appendChild(backToTop);
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTop.style.opacity = '1';
            backToTop.style.visibility = 'visible';
        } else {
            backToTop.style.opacity = '0';
            backToTop.style.visibility = 'hidden';
        }
    });
    
    backToTop.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Add external link indicators
    const links = document.querySelectorAll('a[href^="http"]');
    links.forEach(link => {
        if (!link.hostname.includes(window.location.hostname)) {
            link.setAttribute('target', '_blank');
            link.setAttribute('rel', 'noopener noreferrer');
            link.innerHTML += ' <span style="font-size: 0.75em;">↗</span>';
        }
    });
    
    // Console Easter egg
    console.log('%c📚 Ultimate Web Novel & Manga Scraper', 'font-size: 20px; font-weight: bold; color: #2563eb;');
    console.log('%cDocumentation Site v2.0', 'font-size: 14px; color: #6b7280;');
    console.log('%cCheck out the source: https://github.com/druvx13/ultimate-manga-scraper', 'font-size: 12px; color: #10b981;');
});
