<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Angel Alberto Díaz Cortés">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema De Información COVID-19 - Dibuja tu ruta</title>
        <!-- FIXME: Cuando se puebre desde el celular quitar lo de php-->
        <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap5/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/css/container-images-menu.css?version=1.0.3">
        <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/css/menu.css?version=1.0.1">
        <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/css/maps.css?version=1.0.0">
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
        <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/css/style.css?version=1.0.3">
        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js"></script>
        <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css" type="text/css">
    </head>
    <body>
        <?php
            include('views/templates/header.php');
        ?>
        <main role="main">
            <div class="container mt-2">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between align-items-center flex-wrap">
                        <div class="content-ubication col-md-8">
                            <button type="button" class="btn-ubication" id="btn-ubication">Obtener mi ubicación</button>
                            <input id="my_lat" type="text" class="input-value" placeholder="Latitud" readonly>
                            <input id="my_lng" type="text" class="input-value" placeholder="Longitud" readonly>
                        </div>
                        <div class="content-drawRoute col-md-4 col-sm-6 mt-3 mt-md-0">
                            <select class="form-select" aria-label="Default select example" id="containerSelect">
                                <option selected>Dibujar ruta con</option>
                            </select>
                        </div>
                    </div>
                </div> 
                <div class="row mt-5 mb-5">
                    <div class="col-md-12">
                        <div id="map" class="map"></div>
                        <div id="directions-container"></div>
                    </div>
                </div>
            </div>
        </main>
        <?php
            include('views/templates/footer.php');
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo constant('URL');?>public/js/jquery-3.5.1.min.js"></script>
        <script src="<?php echo constant('URL');?>public/js/menu.js?version=1.0.1"></script>
        <script src="<?php echo constant('URL');?>public/js/container-images.js?version=1.0.3"></script>
        <script src="<?php echo constant('URL');?>public/js/getDataHospitals.js?version=1.0.3"></script>
        <script type="module" src="<?php echo constant('URL');?>public/js/mapbox.js?version=1.0.3"></script>
    </body>
</html>