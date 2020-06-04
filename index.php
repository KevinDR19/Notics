<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro de usuario</title>

    <link rel="stylesheet" href="Librerias/bootstrap-4.4.1/css/bootstrap.css">

    <link rel="stylesheet" href="Librerias/fontawesome-5.13.0/css/all.css">
    
    <link rel="stylesheet" href="Librerias/sweetalert2/sweetalert/sweetalert2.min.css">

    <link rel="stylesheet" href="Librerias/indexStyle.css">

</head>

<body>

    <div class="contenedor">

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="form-control">
        </div>

        <div class="form-group">
            <label for="nombreUsuario">Nombre de usuario:</label>
            <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Correo:</label>
            <input type="email" name="correo" id="correo" class="form-control">
        </div>

        <div class="form-group">
            <label for="contrasenia">Contraseña:</label>
            <input type="password" name="contrasenia" id="contrasenia" class="form-control">
        </div>
        
        <div class="form-group">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" id="btnEnviar">Enviar</button>
            </div>
        </div>

    </div>

    <script src="Librerias/jquery/jquery-3.5.0.js"></script>

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
                success: function(response) {
                    if(response['estado'] == "ok") {
                        Swal.fire({
                            type: 'success',
                            title: 'Ok!',
                            text: response['mensaje'],
                        });
                        /*location.reload();*/
                    }
                    if(response['estado'] == "error") {
                        Swal.fire({
                            type: 'error',
                            title: 'Opps!',
                            text: response['mensaje'],
                        });
                    }
                },
            });
        });

    </script>

</html>
