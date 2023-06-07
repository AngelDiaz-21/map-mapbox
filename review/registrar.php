<?php
    include_once('php/config.php');
    include_once('php/google.php');
    $google = new Google;
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <link rel="stylesheet" href="css/css/estilos.css?version=1.0.0">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/main.js"></script>
</head>

<body>
    <form id="frmsesion" method="POST">
        <h2>Crear nueva cuenta</h2>
        <input type="text" placeholder="&#128273; Usuario" name="usser" required>
        <input type="password" placeholder="&#128274; Contraseña" name="pass" required>
        <button id="btnguardar">Guardar datos</button>
        <br>
        <a href="index.php" style="float:right">Regresar</a>

    </form>
</body>

</html>