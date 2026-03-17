const menuIcon = document.querySelector('.menu-icon');
const navLinks = document.querySelector('.nav-links');
const body = document.body;
const navbar = document.querySelector('.navbar');
const overlay = document.querySelector(".overlay");


let scrollPos = 0;

menuIcon.addEventListener('click', () => {

    const isOpen = navbar.classList.toggle('menu-active');
    navLinks.classList.toggle('mobile-menu');
    overlay.classList.toggle("active");


    if (isOpen) {
        scrollPos = window.scrollY;
        body.style.position = 'fixed';
        body.style.top = `-${scrollPos}px`;
        body.style.width = '100%';
        menuIcon.classList.toggle('bx-x', isOpen);
        menuIcon.classList.toggle('bx-menu', !isOpen);
    } else {
        body.style.position = '';
        body.style.top = '';
        body.style.width = '';
        window.scrollTo(0, scrollPos);
        menuIcon.classList.toggle('bx-x', isOpen);
        menuIcon.classList.toggle('bx-menu', !isOpen);
    }

    body.classList.toggle('no-scroll');
});

function closeMobileMenu() {

    navbar.classList.remove('menu-active');
    navLinks.classList.remove('mobile-menu');
    overlay.classList.remove('active');
    body.classList.remove('no-scroll');

    body.style.position = '';
    body.style.top = '';
    body.style.width = '';

    menuIcon.classList.replace('bx-x', 'bx-menu');

    window.scrollTo(0, scrollPos);
}

window.addEventListener("resize", () => {
    if (window.innerWidth > 1250) {
        closeMobileMenu();
    }
});

// Function to check scroll position
function checkScroll() {
    // Use pageYOffset as a fallback for older mobile browsers
    const scroll = window.scrollY || window.pageYOffset;

    if (scroll > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
}

// Run on scroll
window.addEventListener('scroll', checkScroll);

// Run on load in case user refreshes halfway down the page
window.addEventListener('load', checkScroll);

// Search Wrapper

document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar');
    const searchWrapper = document.querySelector('.search-wrapper');
    const searchInput = document.querySelector('.search-input');
    const searchIcon = document.querySelector('.search-icon');

    // Expand search on click
    searchIcon.addEventListener('click', () => {
        searchWrapper.classList.toggle('active');
        if (searchWrapper.classList.contains('active')) {
            searchInput.focus();
        }
    });

    // Optional: click outside closes search
    document.addEventListener('click', (e) => {
        if (!searchWrapper.contains(e.target)) {
            searchWrapper.classList.remove('active');
        }
    });
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        const headerOffset = 20; // adjust to your header height
        const elementPosition = target.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

        window.scrollTo({
            top: offsetPosition,
            behavior: "smooth"
        });
    });
});

// Theme Toggle

const toggleBtn = document.querySelector('.theme-toggle');
const icon = toggleBtn.querySelector('i');

// Load saved mode
if (localStorage.getItem("theme") === "dark") {
    body.classList.add("dark-mode");
    icon.classList.replace("bx-moon", "bx-sun");
}

toggleBtn.addEventListener("click", () => {
    body.classList.toggle("dark-mode");

    if (body.classList.contains("dark-mode")) {
        localStorage.setItem("theme", "dark");
        icon.classList.replace("bx-moon", "bx-sun");
    } else {
        localStorage.setItem("theme", "light");
        icon.classList.replace("bx-sun", "bx-moon");
    }
});

/* Hero content animation */

window.addEventListener('load', () => {
    const hero = document.querySelector('.header-content');
    hero.classList.add('show');
});