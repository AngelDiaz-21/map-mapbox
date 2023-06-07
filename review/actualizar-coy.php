<?php
    include_once('php/config.php');
    include_once('php/google.php');
    $google = new Google;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Contact form using Bootstrap 3.3.4</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap/animate.css">
</head>
<div class="col-sm-10 col-sm-offset-1">
    <div class="well" style="margin-top: 10%;">
        <h2>Actualiza los datos necesarios</h2>
        <form role="form" id="contactForm" data-toggle="validator" class="shake">
        <div id="select2lista">

                <div class="row">

                    <div class="form-group col-sm-6">
                        <label for="lista" class="h4">Nombre del hospital</label>
                        <!-- <input type="text" class="form-control" id="name" placeholder="Enter name" required data-error="NEW ERROR MESSAGE"> -->
                        <!-- <select name="lista" class="form-control" id="lista"> -->
                        <select name="lista" class="form-control" id="lista" onchange="select_consulta(this.value)">
                        <option value="0">Selecciona un hospital</option>
                                <?=$google->get_hospitales();?>
                        </select>
                        <!-- <input type="text" class="form-control" id="name" placeholder="Enter name" required data-error="NEW ERROR MESSAGE"> -->
                        <!-- <div class="help-block with-errors"></div> -->
                    </div>


                    <div class="form-group col-sm-6">
                        <label for="total_camas" class="h4">Número total de camas</label>
                        <input type="text" class="form-control" id="total_camas"  name="total_camas" placeholder="Número de camas" required>
                        <!-- <div class="help-block with-errors"></div> -->
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="camas_ocupadas" class="h4">Camas ocupadas</label>
                        <input type="text" class="form-control" name="camas_ocupadas" id="camas_ocupadas" placeholder="Camas ocupadas" required>
                        <!-- <div class="help-block with-errors"></div> -->
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="camas_disponibles" class="h4">Camas disponibles</label>
                        <input type="text" class="form-control"name="camas_disponibles" id="camas_disponibles"  required>
                        <!-- <div class="help-block with-errors"></div> -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="direccion" class="h4 ">Dirección</label>
                    <textarea id="direccion" name="direccion" class="form-control" rows="5" placeholder="..." required></textarea>
                    <!-- <textarea id="message" class="form-control" rows="5" placeholder="Enter your message" required></textarea> -->
                    <!-- <div class="help-block with-errors"></div> -->
                </div>
                <div class="form-group">
                    <label for="informacion" class="h4 ">Información</label>
                    <textarea id="informacion" name="informacion" class="form-control" rows="5" placeholder="..." required></textarea>
                    <!-- <textarea id="message" class="form-control" rows="5" placeholder="Enter your message" required></textarea> -->
                    <!-- <div class="help-block with-errors"></div> -->
                </div>
        </div>
            <button type="submit" id="form-submit" class="btn btn-success btn-lg pull-right ">Submit</button>
            <div id="msgSubmit" class="h3 text-center hidden"></div>
            <div class="clearfix"></div>
        </form>
    </div>
</div>
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/validator.min.js"></script>
<script type="text/javascript" src="js/form-scripts.js"></script>
<script type="text/javascript" src="js/main.js?version=1.0.1"></script>

</html>