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
        <title> SISCOE </title>
        <link rel="stylesheet" href="css/css/style.css?version=1.0.1">
        <link rel="stylesheet" href="css/bootstrap/bootstrap.css?version=1.0.2">
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    </head>

    <body>
        <?php
            include('templates/menu.php');
        ?>
        
        <div class="container">
            <table class="table-elements">
                <tr>
                    <td>
                        <input type="button" value="Obtener mi ubicacion - A" onclick="get_my_location();" class="btn">
                    </td>
                    <td>
                        <input type="text" placeholder="Latitud" id="my_lat" class="txt" readonly>
                    </td>
                    <td>
                        <input type="text" placeholder="Longitud" id="my_lng" class="txt" readonly>
                    </td>
                    <td>
                        <select class="txt" onchange="draw_rute(this.value)">
                            <option value="0">Dibujar ruta con &#8595;</option>
                            <?=$google->get_stores();?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <!-- <main class="main">
        </main> -->
        <div id="map"></div>
        <div id="indicators"></div>
        <div class="caja"></div>
        <!-- <footer>
        </footer> -->
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/menu.js?version=1.0.2"></script>
        <script src="js/main.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzk0G2tLaQyBB70--EdCglWM-D_j9jmds&callback=initMap&libraries=&v=weekly" async></script>
    </body>
</html>