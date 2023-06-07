<?php
    include_once('php/config.php');
    include_once('php/google.php');
    $google = new Google;
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- <link rel="stylesheet" href="estilos.css?version=1.0.0"> -->
    <link rel="stylesheet" href="css/css/estilos.css?version=1.0.3">
    <script src="js/main.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
</head>

<body>

    <form id="frmajax" method="POST">
        <h2>Iniciar </h2>
        <input type="text" placeholder="&#128273; Usuario" name="usuario" required>
        <input type="password" placeholder="&#128274; Contraseña" name="password" required>
        <button id="btniniciar">Iniciar</button>
        <br>
        <a href="index.php" style="float:right">Regresar</a>
    </form>
    <hr>
            
</body>

</html>