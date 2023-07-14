const menuToggle = document.querySelector('.navbar-toggler');
const divGrid = document.getElementById('grid');

menuToggle.addEventListener('click', (e) => {
    divGrid.classList.toggle('menu-toggle');
});