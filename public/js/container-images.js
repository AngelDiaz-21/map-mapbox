// OBTENEMOS EL ELEMENTO DEL BOTON Y AGREGAMOS MAS VARIABLES
const btnDepartamentos = document.getElementById('btn-departamentos'),
    //ACCEDEMOS A LA GRID      
    grid = document.getElementById('grid');
// HACEMOS UNA FUNCIONA QUE SE LLAMA "esDispositivoMovil" QUE NOS VA A RETORNAR SI EL USUARIO SE ENCUENTRA EN UN DISPOSITIVO MOVIL, PREGUNTAMOS SI EL ANCHO DE LA VENTANA ES MAYOR O MENOR A 800PX 
// esDispositivoMovil = () => {
//     if (window.innerWidth <= 800) {
//         return true;
//     } else {
//         return false;
//     }
// }

// O PODEMOS USAR ESTA FORMA SIMPLIFICADA
esDispositivoMovil = () => window.innerWidth <= 800;

// ACCEDEMOS A BOTON DEPARTAMENTOS Y QUE TENGA UN EVENTO MAOUSE, QUE CUANDO PASEN EL CURSOR DENTRO DEL BOTON DE "TODAS LAS CATEGORIAS"  ENTONCES QUE EJECUTE LA FUNCION
btnDepartamentos.addEventListener('mouseover', () => {
    if (!esDispositivoMovil()) {
        // QUEREMOS ACCEDER A LA GRID Y QUEREMOS ACCEDER A SU LISTA DE CLASES Y QUEREMOS AGREGAR LA DE "ACTIVO"
        grid.classList.add('activo');
    }
});

// PARA CUANDO QUITEN EL CURSOr EL MENU SE OCULTE
grid.addEventListener('mouseleave', () => {
    if (!esDispositivoMovil()) {
        // CON ESTO LE DECIMOS QUE REMUEVA EL ACTIVO PARA QUE EL MENU SE OCULTE
        grid.classList.remove('activo');
    }
});
// TENEMOS QUE ACCEDER A LAS CATEGORIAS. PRIMERO ACCEDEMOS AL MENU Y DESPUES QUE NOS TRAIGA LAS CLASES DE CATEGORIA Y TODOS LOS ENLACES QUE TENGAMOS DENTRO. CON EL forEach LE DECIMOS QUE POR CADA ELEMENTO NOS EJECUTE EL CODIGO QUE TENEMOS DENTRO
document.querySelectorAll('#menu .categorias a').forEach((elemento) => {
    // Y POR CADA ELEMENTOS QUEREMOS QUE NOS AGREGUE UN eventListener Y QUE CUANDO TENGA UN mouseenter NOS EJECUTE LA FUNCION   
    elemento.addEventListener('mouseenter', (e) => {
        // console.log(e.target.dataset.categoria);
        // ACCEDEMOS AL MENU Y QUEREMOS ACCEDER A TODOS LOS ELEMENTOS DE SUBCATEGORIA
        document.querySelectorAll('#menu .subcategoria').forEach((categoria) => {
            // console.log(categoria.dataset.categoria);
            // POR CADA SUBCATEGORIA ACCEDEMOS Y LE QUITAMOS SU CLASE DE ACTIVO EN CASO DE QUE LA TENGAN
            categoria.classList.remove('activo');
            // SI EL dataset de CATEGORIA ES EXACTAMENTE IGUAL AL dataset DE SUBCATEGORIA SE EJECUTARA EL CODIGO
            if (categoria.dataset.categoria == e.target.dataset.categoria) {
                categoria.classList.add('activo');
            }
        });
    });
});