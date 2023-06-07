function select_consulta(value) {
    if (value > 0) {
        $.ajax({
            // especifica si será una petición POST o GET
            type: 'POST',
            // la URL para la petición
            url: 'php/google.php',

            // la información a enviar en este caso el valor de lo que seleccionaste en el select
            data: 'valor=' + value,
            // data: 'value=' + value,


            // el tipo de información que se espera de respuesta
            dataType: 'json',
            contentType: "application/json; charset=utf-8",

            // código a ejecutar si la petición es satisfactoria;
            success: function(json) {
                //aqui recibimos el "echo" del php(ajax.php)
                //y ahora solo colocas el valor en los campos
                // $("#NombreCliente").value = json.nombre;
                document.getElementby('#NombreCliente').value = json.nombre;
                document.getElementby('#CodigoCliente').value = json.codigo;
                // $("#CodigoCliente").value = json.codigo;
            },

            // código a ejecutar si la petición falla;
            error: function(xhr, status) {
                alert('Codigo');
            }
        });
    }
}