const getHospitalsForSelect = () => {
    try {
        $.ajax({
            type: 'POST',
            url: '../maps/getHospitalsForSelect',
            success: function(r){
                const response = JSON.parse(r);
                const select = document.getElementById('containerSelect');

                response.forEach(hospital => {
                    const option = document.createElement('option');
                    option.value = hospital.id;
                    option.textContent = hospital.hospital_nombre;
                    select.appendChild(option);
                });
            }
        });
    } catch (error) {
        console.log('Error en la consulta: ', error);
        throw error;
    }
}

const showBedTable = () => {
    try {
        $.ajax({
            type: 'POST',
            url: 'maps/getBedsData',
            success: function(r){
                $('#table').html(r);
            }
        });
    } catch (error) {
        console.log('Error en la consulta: ', error);
        throw error;
    }
}

const ruta = window.location.pathname;
// /map-mapbox/maps/showDrawRoute
// /map-mapbox/

if(ruta === '/map-mapbox/'){
    window.addEventListener('load', showBedTable);
}else{
    window.addEventListener('load', getHospitalsForSelect);
}