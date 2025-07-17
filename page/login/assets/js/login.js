const cotainer = document.querySelector('.container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    cotainer.classList.add('active');
});

loginBtn.addEventListener('click', () => {
    cotainer.classList.remove('active');
});