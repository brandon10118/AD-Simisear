const cotainer = document.querySelector('.container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    cotainer.classList.add('active');
});

loginBtn.addEventListener('click', () => {
    cotainer.classList.remove('active');
});

// Error message functionality
function closeError() {
    const errorMessage = document.getElementById('errorMessage');
    if (errorMessage) {
        errorMessage.style.animation = 'slideUp 0.3s ease-out forwards';
        setTimeout(() => {
            errorMessage.remove();
        }, 300);
    }
}

// Auto-hide error message after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const errorMessage = document.getElementById('errorMessage');
    if (errorMessage) {
        setTimeout(() => {
            closeError();
        }, 5000);
    }
});

// Add slide up animation
const style = document.createElement('style');
style.textContent = `
    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
        to {
            opacity: 0;
            transform: translateX(-50%) translateY(-20px);
        }
    }
`;
document.head.appendChild(style);