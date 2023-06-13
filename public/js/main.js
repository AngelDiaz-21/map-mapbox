// Variables "globales"
let map;
var acapulco_lat = 16.85286;
var acapulco_lng = -99.82455;

// Función para que aparezca el mapa
function initMap() {
    // const directionsRenderer = new google.maps.DirectionsRenderer({ polylineOptions: { strokeColor: '#2E9AFE' } });
    const indicatorsEle = document.getElementById('indicators');
    // Para obtener la ruta optima
    directionsService = new google.maps.DirectionsService();
    // Para renderizar esa ruta optima
    directionsRenderer = new google.maps.DirectionsRenderer();
    directionsDisplay = new google.maps.DirectionsRenderer();

    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: acapulco_lat, lng: acapulco_lng },
        zoom: 12,
    });
    directionsRenderer.setMap(map);
    directionsDisplay.setMap(map);
    // Con esto renderizamos las indicaciones
    directionsDisplay.setPanel(indicatorsEle);
    // calculateAndDisplayRoute(directionsService, directionsRenderer);
    draw_rute_map(directionsService, directionsRenderer);

}

// Funcion para que aparezca la posición en el mapa
function get_my_location() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {

            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            //CON ESTO HACEMOS QUE LA LONGITUD Y LONGITUD APAREZCAN EN EL INPUT
            document.getElementById("my_lat").value = pos['lat'];
            document.getElementById("my_lng").value = pos['lng'];

            // SOLO ES PARA CAMBIAR DE ICONO (MARCADOR) DE MI POSICION
            const svgMarker = {
                path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
                fillColor: "blue",
                fillOpacity: 0.6,
                strokeWeight: 0,
                rotation: 0,
                scale: 2,
                anchor: new google.maps.Point(15, 30),
            };

            // AQUI DIBUJAMOS EL ICONO (MARCADOR) PARA QUE APAREZCA EN EL MAPA
            var marker = new google.maps.Marker({
                map: map,
                // PARA QUE NO PODAMOS MOVER EL MARCADOR
                draggable: false,
                title: 'Mi ubicación',
                // label: 'Mi ubicación',
                animation: google.maps.Animation.DROP,
                position: pos,
                icon: svgMarker,
            });
        });
    }
}

//Funcion para recibir el segundo punto al que queremos llegar así como para enviar una petición JSON
function draw_rute(value) {
    if (value > 0) {
        $.ajax({
            type: 'POST',
            url: 'php/google.php',
            data: 'value=' + value,
            dataType: 'JSON',
            success: function(response) {
                draw_rute_map(response.lat, response.lng);
            }
        });
    }
}

function select_consulta(value) {
    // console.log(value);
    if (value > 0) {
        $.ajax({
            // la URL para la petición
            url: 'php/google.php',
            // la información a enviar en este caso el valor de lo que seleccionaste en el select
            data: { valor: value },
            // especifica si será una petición POST o GET
            type: 'POST',
            // el tipo de información que se espera de respuesta
            dataType: 'json',
            // código a ejecutar si la petición es satisfactoria;
            success: function(json) {

                var prueba = JSON.parse(json);

                // console.log(prueba.nombre);
                //aqui recibimos el "echo" del php(ajax.php)
                //y ahora solo colocas el valor en los campos
                $("#total_camas").val(prueba.total_camas);
                $("#camas_ocupadas").val(prueba.camas_ocupadas);
                $("#camas_disponibles").val(prueba.camas_disponibles);
                $("#telefono").val(prueba.telefono);
                $("#direccion").val(prueba.direccion);
                $("#informacion").val(prueba.informacion);
                $("#ID_hospital").val(prueba.hospital_id);
                // $("#CodigoCliente").val(json.codigo);
                // $("#CodigoCliente").val(prueba.telefono);
                // $("#NombreCliente").value=json.nombre;
                // $("#CodigoCliente").value=json.codigo;
            },
            // código a ejecutar si la petición falla;
            error: function(xhr, status) {
                console.log(xhr);
                // alert('Disculpe, existió un problema');
                alert('Erororororor123');
            }
        });
    }
}



// Con esta funcion recibimos los valores así como trazamos el inicio y final de la ruta
function draw_rute_map(lat, lng) {
    var my_lat = $('#my_lat').val();
    var my_lng = $('#my_lng').val();

    var start = new google.maps.LatLng(my_lat, my_lng);
    var end = new google.maps.LatLng(lat, lng);

    // const geocoder = new google.maps.Geocoder();
    // const service = new google.maps.DistanceMatrixService();
    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode["DRIVING"],
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false,
    };
    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsRenderer.setDirections(response);
            directionsRenderer.setMap(map);
            directionsRenderer.setOptions({ suppressMarkers: false });
            // Para las direcciones
            directionsDisplay.setDirections(response);

        }
    });
}

$(document).ready(function() {
    $('#btniniciar').click(function() {
        var datos = $('#frmajax').serialize();
        $.ajax({
            type: "POST",
            url: "php/google.php",
            data: datos,
            success: function(d) {
                if (d == 1) {
                    alert("Agregado correctamente");
                } else {
                    alert("Fallo al iniciar sesion");
                }
            }
        });
        return false;
    });
});

$(document).ready(function() {
    $('#btnguardar').click(function() {
        var dates = $('#frmsesion').serialize();
        $.ajax({
            type: "POST",
            url: "php/google.php",
            data: dates,
            success: function(r) {
                if (r == 1) {
                    alert("Agregado correctamente");
                } else {

                    alert("Fallo el server");
                }
            }
        });
        return false;
    });
});

$(document).ready(function() {
    $('#btnactualizar').click(function() {
        var dates = $('#frmactualizar').serialize();
        console.log(dates);
        $.ajax({
            type: "POST",
            url: "php/google.php",
            data: dates,
            success: function() {
                console.log("Actualizado");
                alert("Agregado correctamente");
                // Para refrescar la pagina despues de haber actualizado los datos
                location.reload();
            },
            // success: function(r) {
            //     if (r == 1) {
            //         console.log("Actualizado");
            //         alert("Agregado correctamente");
            //     } else {

            //         alert("Fallo el server");
            //     }
            // }
        });
        return false;
    });
});

$(document).ready(function() {
    $('#btninsertar').click(function() {
        var dates = $('#frminsertar').serialize();
        console.log(dates);
        $.ajax({
            type: "POST",
            url: "php/google.php",
            data: dates,
            success: function() {
                console.log(dates);
                alert("Agregado correctamente");
                // Para refrescar la pagina despues de haber actualizado los datos
                // location.reload();
            },
        });
        return false;
    });
});


let precio1 = document.getElementById("total_camas");
let precio2 = document.getElementById("camas_ocupadas");
let precio3 = document.getElementById("camas_disponibles");


precio2.addEventListener("change", () => {
    precio3.value = parseInt(precio1.value) - parseInt(precio2.value)
});

precio1.addEventListener("change", () => {
    precio3.value = parseInt(precio1.value) - parseInt(precio2.value)
});

// function operacion(value) {
//     var total = 0;
//     value = parseInt(value); //Convertir el value a un entero (número)

//     total = document.getElementById('total_camas').innerHTML;

//     //Aqui se valida si hay un value previo, si no hay datos, se pone 0
//     total = (total == null || total == undefined || total == "") ? 0 : total;

//     // Aqui se realiza la suma(operacion)
//     total = (parseInt(value) - parseInt(total));



//     //Colocar el resultado de la suma en el input
//     document.getElementById('camas_disponibles').innerHTML = total;

//     console.log(total);
// }