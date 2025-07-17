document.addEventListener("DOMContentLoaded", function() {
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

    // Filter by category buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const type = button.dataset.type;

            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            cards.forEach(card => {
                if (type === 'all' || card.dataset.type === type) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });

            if (searchInput) searchInput.value = ''; // clear search box when filtering
        });
    });

    // Live search system
    if (searchInput) {
        searchInput.addEventListener('input', () => {
            const filter = searchInput.value.toLowerCase();

            cards.forEach(card => {
                const name = card.querySelector('h2') ? card.querySelector('h2').textContent.toLowerCase() : '';
                const origin = card.querySelector('p:nth-of-type(1)') ? card.querySelector('p:nth-of-type(1)').textContent.toLowerCase() : '';
                const type = card.dataset.type ? card.dataset.type.toLowerCase() : '';
                const description = card.querySelector('p:nth-of-type(3)') ? card.querySelector('p:nth-of-type(3)').textContent.toLowerCase() : '';

                if (
                    name.includes(filter) ||
                    origin.includes(filter) ||
                    type.includes(filter) ||
                    description.includes(filter)
                ) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // Quantity increment/decrement
    const minusButtons = document.querySelectorAll('.minus');
    const plusButtons = document.querySelectorAll('.plus');
    const inputBoxes = document.querySelectorAll('.input-box');

    minusButtons.forEach((minusButton, idx) => {
        const inputBox = inputBoxes[idx];
        if (inputBox) {
            minusButton.addEventListener('click', () => {
                inputBox.stepDown();
            });
        }
    });

    plusButtons.forEach((plusButton, idx) => {
        const inputBox = inputBoxes[idx];
        if (inputBox) {
            plusButton.addEventListener('click', () => {
                inputBox.stepUp();
            });
        }
    });
});