function initMap() {

    const bounds = new google.maps.LatLngBounds();

    function success(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        const markersArray = [];
        const origin1 = { lat: latitude, lng: longitude };



        const destinationA = { lat: 16.930918, lng: -99.820314 };
        const destinationB = { lat: 16.899684192361807, lng: -99.82756347129909 };
        const destinationC = { lat: 16.84254921468893, lng: -99.84881986830379 };
        const destinationD = { lat: 16.87437593185094, lng: -99.88424600278537 };
        const destinationE = { lat: 16.873091127691143, lng: -99.88952486018484 };
        const destinationF = { lat: 16.87308422042258, lng: -99.88746717493126 };
        const destinationIcon =
            "https://chart.googleapis.com/chart?" +
            "chst=d_map_pin_letter&chld=D|FF0000|000000";
        const originIcon =
            "https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000";



        const map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 16.860711, lng: -99.880856 },
            zoom: 12,
        });
        const geocoder = new google.maps.Geocoder();
        const service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix({
                origins: [origin1],
                destinations: [destinationA, destinationB, destinationC, destinationD, destinationE, destinationF],
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
                avoidHighways: false,
                avoidTolls: false,
            },
            (response, status) => {
                if (status !== "OK") {
                    alert("Error was: " + status);
                } else {
                    const originList = response.originAddresses;
                    const destinationList = response.destinationAddresses;
                    const outputDiv = document.getElementById("output");
                    outputDiv.innerHTML = "";
                    deleteMarkers(markersArray);

                    // Con esta función mostramos los marcadores o ubicaciones en el mapa
                    const showGeocodedAddressOnMap = function(asDestination) {


                        const icon = asDestination ? destinationIcon : originIcon;

                        var marker1 = new google.maps.Marker({
                            position: { lat: 16.930918, lng: -99.820314 },
                            map: map,
                            title: 'Hospital General de Acapulco'
                        });

                        var marker2 = new google.maps.Marker({
                            position: { lat: 16.899684192361807, lng: -99.82756347129909 },
                            map: map,
                            title: 'Hospital General Dr. Donato G. Alarcón'
                        });


                        var marker3 = new google.maps.Marker({
                            position: { lat: 16.84254921468893, lng: -99.84881986830379 },
                            map: map,
                            title: 'Hospital Naval Acapulco'
                        });

                        var marker4 = new google.maps.Marker({
                            position: { lat: 16.87437593185094, lng: -99.88424600278537 },
                            map: map,
                            title: 'Hospital Militar Regional'
                        });

                        var marker5 = new google.maps.Marker({
                            position: { lat: 16.873091127691143, lng: -99.88952486018484 },
                            map: map,
                            title: 'IMSS Hospital General Regional Vicente Guerrero (HGR No. 1)',


                        });

                        var marker6 = new google.maps.Marker({
                            position: { lat: 16.87308422042258, lng: -99.88746717493126 },
                            map: map,
                            title: 'Hospital General ISSSTE',


                        });
                        var marker6 = new google.maps.Marker({
                            position: { lat: latitude, lng: longitude },
                            map: map,
                            title: 'mi ubicacion',
                            icon: svgMarker = {
                                path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
                                fillColor: "blue",
                                fillOpacity: 0.6,
                                strokeWeight: 0,
                                rotation: 0,
                                scale: 2,
                                anchor: new google.maps.Point(15, 30),
                            },
                        });

                    };

                    for (let i = 0; i < originList.length; i++) {
                        const results = response.rows[i].elements;
                        geocoder.geocode({ address: originList[i] },
                            showGeocodedAddressOnMap(false)
                        );

                        for (let j = 0; j < results.length; j++) {
                            geocoder.geocode({ address: destinationList[j] },
                                showGeocodedAddressOnMap(true)
                            );
                            outputDiv.innerHTML +=
                                results[j].duration.text +
                                "<br><br>";
                            // outputDiv.innerHTML +=
                            //     " <img src='img/auto.jpg' alt=''>" +
                            //     results[j].duration.text +
                            //     "<br><br>";
                        }
                    }
                }
            }
        );

    };

    function deleteMarkers(markersArray) {
        for (let i = 0; i < markersArray.length; i++) {
            markersArray[i].setMap(null);
        }
        markersArray = [];
    }

    function error() {
        output.innerHTML = "Unable to retrieve your location";
    };

    navigator.geolocation.getCurrentPosition(success, error);


};