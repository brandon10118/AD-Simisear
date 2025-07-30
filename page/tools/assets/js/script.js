function filterType(type) {
    const categorySection = document.querySelectorAll('.category-section');
    const items = document.querySelectorAll('.product');
    
    if (type === 'all') {
        // Show all categories and products
        categorySection.forEach(section => {
            section.style.display = 'block';
        });
        items.forEach(item => {
            item.style.display = 'flex';
        });
    } else {
        // Hide all categories first
        categorySection.forEach(section => {
            section.style.display = 'none';
        });
        
        // Show only the selected category
        const targetSection = document.querySelector(`[data-category="${type}"]`);
        if (targetSection) {
            targetSection.style.display = 'block';
            // Show all products in the selected category
            const categoryProducts = targetSection.querySelectorAll('.product');
            categoryProducts.forEach(item => {
                item.style.display = 'flex';
            });
        }
    }
}



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

function searchProducts() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    const categorySection = document.querySelectorAll('.category-section');
    
    if (q.trim() === '') {
        // If search is empty, show all categories and products
        categorySection.forEach(section => {
            section.style.display = 'block';
            const products = section.querySelectorAll('.product');
            products.forEach(p => {
                p.style.display = 'flex';
            });
        });
        return;
    }
    
    categorySection.forEach(section => {
        const products = section.querySelectorAll('.product');
        let categoryHasMatch = false;
        
        products.forEach(p => {
            const name = p.querySelector('h3').textContent.toLowerCase();
            if (name.includes(q)) {
                p.style.display = 'flex';
                categoryHasMatch = true;
            } else {
                p.style.display = 'none';
            }
        });
        
        // Show/hide category section based on whether it has matching products
        section.style.display = categoryHasMatch ? 'block' : 'none';
    });
}
