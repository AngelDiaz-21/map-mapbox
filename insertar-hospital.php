<?php
    include_once('php/config.php');
    include_once('php/google.php');
    $google = new Google;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Registrar hospital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css?version=1.0.2">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css?version=1.0.2">
    <link rel="stylesheet" href="css/css/style.css?version=1.0.2">
    <link rel="stylesheet" href="style.css?version=1.0.2">
    <link rel="stylesheet" href="css/bootstrap/animate.css">
</head>


<body>
    <?php
        include('templates/menu-admi.php');
    ?>

    <div class="contenido col-sm-10 col-sm-offset-1">
        <div class="well" style="margin-top: 1%;">
            <h2>Registra un nuevo hospital</h2>
            <form class="formulario" role="form" id="frminsertar" method="POST" data-toggle="validator" class="shake">
            <div class="lista2" id="select2lista">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="nombre_hospital" class="h4">Nombre del hospital</label>
                            <input type="text" class="form-control" id="nombre_hospital"  name="nombre_hospital" placeholder="Escriba el nombre" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="telefono" class="h4">Telefono</label>
                            <input type="text" class="form-control"name="telefono" id="telefono"  required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="latitud" class="h4">Ingrese la latitud del hospital</label>
                            <input type="text" class="form-control"name="latitud" id="latitud"  required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="longitud" class="h4">Ingrese la longitud del hospital</label>
                            <input type="text" class="form-control"name="longitud" id="longitud"  required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="total_camas" class="h4">Número total de camas</label>
                            <input type="text" class="form-control" id="total_camas"  name="total_camas" placeholder="Número de camas" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="camas_ocupadas" class="h4">Camas ocupadas</label>
                            <input type="text" class="form-control" name="camas_ocupadas" id="camas_ocupadas" placeholder="Camas ocupadas" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="camas_disponibles" class="h4">Camas disponibles</label>
                            <input type="text" class="form-control"name="camas_disponibles" id="camas_disponibles" readonly required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="direccion" class="h4 ">Escriba la dirección</label>
                        <textarea id="direccion" name="direccion" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="informacion" class="h4 ">Ingrese información del hospital</label>
                        <textarea id="informacion" name="informacion" class="form-control" rows="5" required></textarea>
                    </div>
            </div>
                <button type="submit" id="btninsertar" class="btn btn-success btn-lg pull-right ">Registrar</button>
                <br>
                <hr>
                <div id="msgSubmit" class="h3 text-center hidden"></div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/validator.min.js"></script>
    <script type="text/javascript" src="js/form-scripts.js"></script>
    <script type="text/javascript" src="js/main.js?version=1.0.2"></script>
</body>

</html>