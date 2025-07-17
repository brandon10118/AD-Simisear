document.addEventListener("DOMContentLoaded", function () {
    // Marquee price animation
    const prices = {
        "Amethyst": 45.99,
        "Quartz": 22.50,
        "Emerald": 89.99,
        "Ruby": 120.00,
        "Sapphire": 75.25,
        "Topaz": 35.75,
        "Diamond": 299.99,
        "Opal": 85.50
    };

    let content = Object.entries(prices)
        .map(([name, price]) => `${name}: $${price.toFixed(2)}`)
        .join(' • ') + ' • ';

    content = content.repeat(3);

    const marquee = document.querySelector('.marquee-content');
    if (marquee) {
        marquee.textContent = content;
        const duration = Math.max(20, marquee.textContent.length / 10);
        marquee.style.animationDuration = `${duration}s`;
    }

    // Filtering and searching
    const filterButtons = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.mineral-card');
    const searchInput = document.getElementById('searchInput');

    // Initial filter: show all
    cards.forEach(card => {
        card.style.display = 'flex';
    });


});