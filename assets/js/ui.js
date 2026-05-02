// UI Enhancements
document.addEventListener('DOMContentLoaded', function() {
    // Loading animations
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    const animateElements = document.querySelectorAll('.product-card, .section');
    animateElements.forEach(el => {
        observer.observe(el);
    });

    // Add loading class for animations
    setTimeout(() => {
        document.body.classList.add('loaded');
    }, 100);
});

// Add CSS for animations
const style = document.createElement('style');
style.textContent = `
    .product-card, .section {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s, transform 0.6s;
    }

    .animate-in {
        opacity: 1;
        transform: translateY(0);
    }

    body.loaded .navbar {
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-100%);
        }
        to {
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);