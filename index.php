<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="Librerias/bootstrap-4.4.1/css/bootstrap.css">

    <link rel="stylesheet" href="Librerias/fontawesome-5.13.0/css/all.css">
    
    <link rel="stylesheet" href="Librerias/sweetalert2/sweetalert/sweetalert2.min.css">

    <link rel="stylesheet" href="Librerias/indexStyle.css">

</head>

<body>

    <div class="container">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre"  class="form-control">

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" class="form-control">

        <label for="nombreUsuario">Nombre de usuario:</label>
        <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control">

        <label for="email">Correo:</label>
        <input type="email" name="correo" id="correo" class="form-control">

        <label for="contrasenia">Contraseña:</label>
        <input type="password" name="contrasenia" id="contrasenia" class="form-control">

        <button type="submit" class="btn btn-primary" id="btnEnviar">Enviar</button>

    </div>

    <script src="Librerias/jquery-3.4.1/jquery-3.4.1.js"></script>

    <script src="Librerias/bootstrap-4.4.1/js/bootstrap.js"></script>

    <script src="Librerias/sweetalert2/sweetalert/sweetalert2.all.min.js"></script>

</body>

    <script>
    
        $('#btnEnviar').click(function(){ 
            var nombre = $('#nombre').val();
            var apellido = $('#apellido').val();
            var nombreUsuario = $('#nombreUsuario').val();
            var correo = $('#correo').val();
            var contrasenia = $('#contrasenia').val();

            if(nombre == "") {
                $('#nombre').focus();
                Swal.fire({
                    type: 'warning',
                    title: 'Opps!',
                    text: 'Este campo es obligatorio.',
                });
                return;
            }

            if(apellido == "") {
                $('#apellido').focus();
                Swal.fire({
                    type: 'warning',
                    title: 'Opps!',
                    text: 'Este campo es obligatorio.',
                });
                return;
            }

            if(nombreUsuario == "") {
                $('#nombreUsuario').focus();
                Swal.fire({
                    type: 'warning',
                    title: 'Opps!',
                    text: 'Este campo es obligatorio.',
                });
                return;
            }

            if(correo == "") {
                $('#correo').focus();
                Swal.fire({
                    type: 'warning',
                    title: 'Opps!',
                    text: 'Este campo es obligatorio.',
                });
                return;
            }

            if(contrasenia == "") {
                $('#contrasenia').focus();
                Swal.fire({
                    type: 'warning',
                    title: 'Opps!',
                    text: 'Este campo es obligatorio.',
                });
                return;
            }
            
            $.ajax({
                data: {
                    nombre: nombre,
                    apellido: apellido,
                    nombreUsuario: nombreUsuario,
                    correo: correo,
                    contrasenia: contrasenia,
                },
                dataType: 'json',
                type: 'POST',
                url: 'Funciones/registroController.php',
                beforeSend: function() {
                    Swal.fire({
                        title: "Enviando datos...",
                        text: "Esto tomará unos segundos!",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        imageWidth: 150,
                        imageUrl: "https://utservisalud.isware.com.co/img/loading3.gif",
                    }),
                    Swal.disableButtons();
                },
                
            });
        });

    </script>

</html>
