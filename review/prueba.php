<?php
    include_once('php/config.php');
    include_once('php/google.php');
    $google = new Google;
?>
<!DOCTYPE html>
<html lang="es">


    <head>
        <meta charset = "UTF-8">
        <meta name    = "description" content = "Mi pagina personal tec">
        <meta name    = "Keyword"     content = "Angel, programación, programacion web, trabajos">
        <meta name    = "author"      content = "Angel Alberto Díaz Cortés">
        <meta name    = "viewport"    content = "width=device-width, initial-scale=1.0">
        <title> Prueba </title>
        <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
        <!-- <script type="text/javascript" src="js/prueba.js?version=1.0.4"></script> -->
    </head>
    
    
    <body>
        <form name="registrarSd" action="../../controls/Solicitud_Registrar.php" method="post">
            <label>Código: </label>
            <input name="indiceCA" type="text"/>
            
            <label>Fecha: </label>
            <input name="fechaSd" type="text" class="sizeinput" onkeyup="enmascarar(this,'/',patron,true)" maxlength="10" required>
            
            <label>Cliente: </label>
            <select name="cliente" required onchange="mifuncion(this.value)">
            <option value="">Selecciona un hospital</option>
                    <?=$google->get_hospitales();?>
            </select>
            
            <label>Código: </label>
            <input name="CodigoCliente" id="CodigoCliente"  type="text" />
            
            <label>Nombre: </label>
            <input name="NombreCliente" id ="NombreCliente" type="text">
            
            <input name="reset" value=" Limpiar " type="reset"/>
            
            <input name="enviar" value="Registrar" type="submit" />
        
        </form>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script  type="text/javascript" >
 
 
	function mifuncion(valor){
        console.log(valor);
		if(valor>0){

            $.ajax({
			// la URL para la petición
			url : 'php/google.php',
 
			// la información a enviar en este caso el valor de lo que seleccionaste en el select
			data : { valor : valor },
 
			// especifica si será una petición POST o GET
			type : 'POST',
 
			// el tipo de información que se espera de respuesta
			dataType : 'json',
 
			// código a ejecutar si la petición es satisfactoria;
			success : function(json) {

                var prueba = JSON.parse(json);

                 

                console.log(prueba.nombre);
                
				//aqui recibimos el "echo" del php(ajax.php)
				//y ahora solo colocas el valor en los campos
				$("#NombreCliente").val(prueba.nombre);
                // $("#CodigoCliente").val(json.codigo);
				$("#CodigoCliente").val(prueba.telefono);
				// $("#NombreCliente").value=json.nombre;
				// $("#CodigoCliente").value=json.codigo;
                
			},
 
			// código a ejecutar si la petición falla;
			error : function(xhr, status) {
                console.log(xhr);
				// alert('Disculpe, existió un problema');
				alert('Erororororor123');
			}
});
        }
	}
 
</script>
    
    </body>
</html>