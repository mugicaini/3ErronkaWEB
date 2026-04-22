// Reveal animations on scroll
const observerOptions = {
    threshold: 0.2
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
        }
    });
}, observerOptions);

document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

// Navigation glass effect on scroll
window.addEventListener('scroll', () => {
    const nav = document.querySelector('nav');
    if (window.scrollY > 50) {
        nav.style.padding = '0.8rem 0';
        nav.style.background = 'rgba(26, 26, 26, 0.98)'; // Dark background for dark theme
        nav.style.boxShadow = '0 5px 20px rgba(0,0,0,0.5)';
        nav.style.borderBottom = '1px solid rgba(197, 164, 109, 0.2)';
    } else {
        nav.style.padding = '1.5rem 0';
        nav.style.background = 'var(--color-glass)';
        nav.style.boxShadow = 'none';
        nav.style.borderBottom = 'none';
    }
});

// Simple reveal for elements on load
window.addEventListener('load', () => {
    const heroContent = document.querySelector('.hero-content');
    if (heroContent) heroContent.classList.add('active');
    
    // Auto-scroll if hash exists on load
    if (window.location.hash) {
        const target = document.querySelector(window.location.hash);
        if (target) {
            setTimeout(() => {
                target.scrollIntoView({ behavior: 'smooth' });
            }, 500);
        }
    }
});

// Smooth scroll for nav links - ONLY on same page
document.querySelectorAll('nav a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        
        // If it's a relative anchor on the SAME page
        if (href.startsWith('#')) {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        } 
        // If it's index.php#anchor AND we are already on index.php
        else if (href.includes('#') && window.location.pathname.endsWith('index.php')) {
            const hash = href.substring(href.indexOf('#'));
            const target = document.querySelector(hash);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
});

