<?php

    require_once('Database/conexion.php');

    $conexion = new conexion();
    $cnx = $conexion->conectar();

    $sql = $cnx->prepare("SELECT * FROM categorias");
    $sql->execute();
    $categorias = $sql->fetchAll();

?>

<!DOCTYPE html>

<html lang="es">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Seleccionar noticia</title>

    <link rel="stylesheet" href="Librerias/bootstrap-4.4.1/css/bootstrap.css">

    <link rel="stylesheet" href="Librerias/fontawesome-5.13.0/css/all.css">

    <link rel="stylesheet" href="Librerias/sweetalert2/sweetalert/sweetalert2.min.css">

</head>

<body>
    
    <div class="container" style="padding-top: 2em;">
    
        <form action="noticias.php" method="get">

            <label for="categoria">Seleccione una categoría</label>

            <select name="categoria" id="categoria">
            
                <option value="@">---</option>

                <?php

                    foreach($categorias as $key) {

                ?>

                <option value="<?= $key['idCategoria'] ?>"><?= $key['categoria'] ?></option>

                <?php

                    }

                ?>
            
            </select>

            <button type="submit" class="btn btn-primary">Ir</button>

        </form>
        
    </div>

    <script src="Librerias/jquery-3.4.1/jquery-3.4.1.js"></script>

    <script src="Librerias/bootstrap-4.4.1/js/bootstrap.js"></script>

    <script src="Librerias/sweetalert2/sweetalert/sweetalert2.all.min.js"></script>

</body>

</html>
