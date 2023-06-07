<?php
    include_once('php/config.php');
    include_once('php/google.php');
    $google = new Google;
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Mi pagina personal tec">
        <meta name="Keyword" content="Angel, programación, programacion web, trabajos">
        <meta name="author" content="Angel Alberto Díaz Cortés">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> SISCOE con mysqli </title>
        <link rel="stylesheet" href="css/css/style.css?version=1.0.2">
        <!-- Con este css hacemos que las tablas esten juntas como si fueran una -->
        <link rel="stylesheet" href="style.css?version=1.0.2">
        <!-- <link rel="stylesheet" href="css/css/style_popu.css?version=1.0.1"> -->
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css?version=1.0.3">
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    </head>

    <body>
        <?php
            include('templates/menu.php');
        ?>

        <main role="main">
            <div class="container text-center mt-5">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h2 class="h2s">Información de hospitales COVID-19</h2>
                        <?php
                            // DE ESTA FORMA TAMBÍEN SE PUEDE
                            $edu = new Google;
                            $coll = $edu->tbl_datos_hospitales();
                            // print_r($coll);
                            // $coll = json_encode($coll, true);
                            // echo '<div id="data">'.$coll. '</div>'
                        ?>  
                    
                    </div>
                </div> 
            </div>
        </main>
        <?php
            // include('templates/prueba-mapa.php');
        ?>
        <div id="map"></div>
        <!-- <div class="caja"></div> -->
        <!-- <footer>
        </footer> -->
        <!-- <script src="js/function.js?version=1.0.2"></script> -->
        <!-- <script src="js/prueba-mapa.js?version=1.0.5"></script> -->
        <!-- <script src="main.js"></script> -->
        <!-- <script src="js/popup.js?version=1.0.2"></script> -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzk0G2tLaQyBB70--EdCglWM-D_j9jmds&callback=initMap&libraries=&v=weekly" async></script>
        <script src="js/menu.js?version=1.0.2"></script>
        <script src="js/mapa_estaticos.js?version=1.0.3"></script>
        <script src="js/jquery-3.5.1.min.js"></script>
    </body>
</html>