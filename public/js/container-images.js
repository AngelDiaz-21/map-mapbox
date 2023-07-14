const btnDepartamentos = document.getElementById('btn-departamentos');
const grid = document.getElementById('grid');
const message = document.querySelector('.message');
const icono = btnDepartamentos.childNodes[3];
const btnBack = document.querySelector('.btn-regresar');
let isMenuActive = false;

const activateMenu = () => {
  grid.classList.add('activo');
  icono.style.display = 'none';
  isMenuActive = true;
};

const deactivateMenu = () => {
  grid.classList.remove('activo');
  icono.style.display = 'block';
  isMenuActive = false;
};

const toggleActiveClass = (targetElement) => {
  document.querySelectorAll('#grid .imagenes').forEach((hospital) => {
    hospital.classList.toggle('activo', hospital.dataset.hospital === targetElement.dataset.hospital);
  });
};

const handleMouseEnter = (e) => {
  toggleActiveClass(e.target);
  message.style.display = 'none';
};

const handleMouseLeave = (e) => {
  if (!grid.contains(e.relatedTarget)) deactivateMenu();
  
  toggleActiveClass(e.target);
  message.style.display = 'block';
};

if ($(window).width() > 800) {
  btnDepartamentos.addEventListener('mouseenter', activateMenu); 

  document.querySelectorAll('#grid .hospitales .hospitales-nombre').forEach((elemento) => {
    elemento.addEventListener('mouseenter', handleMouseEnter);
  });

  grid.addEventListener('mouseleave', handleMouseLeave);
};

btnDepartamentos.addEventListener('click', () => {
  isMenuActive ? deactivateMenu() : activateMenu();
});

btnBack.addEventListener('click', deactivateMenu);