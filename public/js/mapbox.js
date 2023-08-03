import { accessToken } from "../../config/config.js";
mapboxgl.accessToken = accessToken;
const selection = document.getElementById('containerSelect');
const createMarkerBtn = document.getElementById('btn-ubication');
let currentMarker = null; // Variable para almacenar la referencia del marcador

const getHospitalsForMarkers = async () => {
    const ruta = window.location.pathname;
    const urlRoute = ruta === '/map-mapbox/' ? 'maps/getHospitalsForMarkers' : '../maps/getHospitalsForMarkers';

    try {
        const response = await $.ajax({
            type: 'POST',
            url: urlRoute
        });
        return JSON.parse(response);
    } catch (error) {
        console.log('Error en la consulta: ', error);
        throw error;
    }
}

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v12',
    center: [-99.880856, 16.860711],
    zoom: 11
});

map.on('load', async () => {
    try {
        const response = await getHospitalsForMarkers();

        response.forEach((item) => {
            const element = document.createElement('div');
            element.className = 'marker';

            const popup = new mapboxgl.Popup({ closeButton: true })
                .setHTML(`
                    <h1 class="title-map">${item[1]}</h1>
                    <p class="information-text">${item[5]}</p>
                    <p class="information-text">${item[6]}</p>
                `);
            
            const marker = new mapboxgl.Marker(element)
                .setLngLat([item[4], item[3]])
                .setPopup(popup)
                .addTo(map);
        });
    } catch (error) {
        console.log('Error en la petición: ', error);
    }
});

if (createMarkerBtn) createMarkerBtn.addEventListener('click', crearMarcador);

function crearMarcador() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const pos = {
                    lng: position.coords.longitude,
                    lat: position.coords.latitude
                };

                document.getElementById("my_lat").value = pos['lat'];
                document.getElementById("my_lng").value = pos['lng'];

                if (currentMarker) {
                    currentMarker.remove();
                }

                currentMarker = new mapboxgl.Marker({ color: 'black', rotation: 45 })
                    .setLngLat(pos)
                    .addTo(map);
            },
            function(error) {
                if (error.code === error.PERMISSION_DENIED) {
                    alert('Debe habilitar la geolocalización para usar esta función.');
                } else {
                    console.error('Error al obtener la ubicación: ', error);
                }
            }
        );
    } else {
        alert('Su navegador no admite la geolocalización.');
    }
}

if (selection) selection.addEventListener('change', getDestination);

async function getDestination(e){
    const id = e.target.value;
    if(id>0){
        try {
            const response = await fetchDestinationLatLng(id);
            response.forEach(item => {
                drawRouteMap(item.hospital_latitud, item.hospital_longitud)
            })
        } catch (error) {
            console.error('Error al obtener los registros:', error);
        }
    }
}

async function fetchDestinationLatLng(id){
    try {
        const response = await fetch('../maps/getHospitalsLatLng', {
            method: 'POST',
            body: `id_hospital=${id}`,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });

        if(!response.ok){
            throw new Error('Error en la solicitud');
        }

        return await response.json();
    } catch (error) {
        throw error;
    }
}

function drawRouteMap(latEnd, lngEnd){
    const my_lat = $('#my_lat').val();
    const my_lng = $('#my_lng').val();

    if (!my_lat || !my_lng) {
        console.error('Error: Las coordenadas de origen no están definidas.');
        return;
    }

    const directions = new MapboxDirections({
        accessToken: mapboxgl.accessToken,
        interactive: false, 
        language:    'es', 
        unit:        'metric', 
    });

    map.addControl(directions, 'top-left');
    directions.setOrigin([my_lng, my_lat]);
    directions.setDestination([lngEnd, latEnd]);
}