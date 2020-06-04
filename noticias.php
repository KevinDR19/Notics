<?php

    require_once('Database/conexion.php');

    $conexion = new conexion();
    $cnx = $conexion->conectar();

    $categoria = $_GET['categoria'];

    $sql = $conexion->prepare("SELECT * FROM noticias WHERE categoria = :categoria");
    $sql->bindParam(':categoria', $categoria);
    $sql->execute();
    $noticias = $sql->fetchAll();

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Noticias</title>

    <link rel="stylesheet" href="Librerias/bootstrap-4.4.1/css/bootstrap.css">

    <link rel="stylesheet" href="Librerias/fontawesome-5.13.0/css/all.css">

    <link rel="stylesheet" href="Librerias/sweetalert2/sweetalert/sweetalert2.min.css">

</head>

<body>
    
    <div class="container">
    
        <div class="table-responsive">
        
            <?php

                foreach($noticias as $key) {

            ?>

                <div style="margin-top: 2em;">
                
                    <label style="font-weight: bold"><?= $key['tituloNoticia'] ?></label>
                    <br>

                    <p><?= $key['descripcionNoticia'] ?></p>
                    <br>

                    <textarea name="comentario" id="comentario" cols="30" rows="5"></textarea>

                    <button class="btn btn-primary">Publicar</button>
                    <br>

                    <h4>Comentarios</h4>

                    <?php

                        $noticia = $key['idNoticia'];

                        $sql = $conexion->prepare("SELECT * FROM comentarios WHERE idNoticia = :idNoticia");
                        $sql->bindParam(':idNoticia', $noticia);
                        $sql->execute();
                        $comentarios = $sql->fetchAll();

                        foreach($comentarios as $key) {

                    ?>

                        <label><?= $key['comentario'] ?></label>
                        <br>

                    <?php
                    
                        }        

                    ?>

                </div>
            
                <hr>

            <?php

                }

            ?>

        </div>
    
    </div>

    <script src="Librerias/jquery-3.4.1/jquery-3.4.1.js"></script>

    <script src="Librerias/bootstrap-4.4.1/js/bootstrap.js"></script>

    <script src="Librerias/sweetalert2/sweetalert/sweetalert2.all.min.js"></script>

</body>

</html>
