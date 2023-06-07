<?php
    include_once('php/config.php');
    include_once('php/google.php');
    $google = new Google;
?>

<script type="text/javascript">

    function initMap() {
        let map;
        var acapulco_lat = 16.85286;
        var acapulco_lng = -99.82455;
        const bounds = new google.maps.LatLngBounds();
        // var latitude = position.coords.latitude;
        // var longitude = position.coords.longitude;
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: acapulco_lat, lng: acapulco_lng },
            zoom: 12,
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
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

        map.setTilt(50);
        // Crear múltiples marcadores(Hospitales) desde la base de datos
        var marcadores = [
            <?=$google->dibujar_marcadores();?>
        ];
        // Creamos la ventana de información para cada Marcador
        var ventanaInfo = new google.maps.InfoWindow( [
            <?=$google->info_marcadores();?>
        ]);
        // Creamos la ventana de información con los marcadores 
        var mostrarMarcadores = new google.maps.InfoWindow(), marcadores, i;
        // Colocamos los marcadores en el Mapa de Google 
        for (i = 0; i < marcadores.length; i++) {
            var position = new google.maps.LatLng(marcadores[i][1], marcadores[i][2]);
                bounds.extend(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: marcadores[i][0]
                });
            // Colocamos la ventana de información a cada Marcador del Mapa de Google 
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    mostrarMarcadores.setContent(ventanaInfo[i][0]);
                    mostrarMarcadores.open(map, marker);
                }
            })(marker, i));  
            // Centramos el Mapa de Google para que todos los marcadores se puedan ver 
                map.fitBounds(bounds);
        }
        // Aplicamos el evento 'bounds_changed' que detecta cambios en la ventana del Mapa de Google, también le configramos un zoom de 14 
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(12);
            google.maps.event.removeListener(boundsListener);
        });

/////////////////////////////////////ESTO ES NUEVO 
    //     const geocoder = new google.maps.Geocoder();
    //     const service = new google.maps.DistanceMatrixService();
    //     service.getDistanceMatrix({
    //         origins: [pos],
    //         destinations: [mostrarMarcadores],
    //         travelMode: google.maps.TravelMode.DRIVING,
    //         unitSystem: google.maps.UnitSystem.METRIC,
    //         avoidHighways: false,
    //         avoidTolls: false,
    //     },
    //         (response, status) => {
    //             if ( status !== "OK") {
    //                 alert("Error was: " + status);
    //             } else {
    //                 const originList = response.originAddresses;
    //                 const destinationList = response.destinationAddresses;
    //                 const outputDiv = document.getElementById("output");
    //                 outputDiv.innerHTML = "";
    //                 deleteMarkers(markersArray);

    //                 for (let i = 0; i < originList.length; i++) {
    //                     const results = response.rows[i].elements;
    //                     geocoder.geocode({ address: originList[i] },
    //                         showGeocodedAddressOnMap(false)
    //                     );

    //                     for (let j = 0; j < results.length; j++) {
    //                         geocoder.geocode({ address: destinationList[j] },
    //                             showGeocodedAddressOnMap(true)
    //                         );
    //                         outputDiv.innerHTML +=
    //                             " <img src='img/auto.jpg' alt=''>" +
    //                             results[j].duration.text +
    //                             "<br><br>";
    //                     }
    //                 }
    //             }
    //         }
    //     );

    // function error() {
    //     output.innerHTML = "Unable to retrieve your location";
    // };


    }
</script>