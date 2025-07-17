function filterType(type) {
    const items = document.querySelectorAll('.product');
    items.forEach(item => {
        item.style.display = (type === 'all' || item.dataset.type === type) ? 'block' : 'none';
    });
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
  document.querySelectorAll('.product').forEach(p => {
    const name = p.querySelector('h3').textContent.toLowerCase();
    const matchesType = p.style.display !== 'none'; // respects current type filter
    if (name.includes(q) && matchesType) {
      p.style.display = '';
    } else {
      p.style.display = 'none';
    }
  });
}
