<?php

    require_once('Database/conexion.php');

    $conexion = new conexion();
    $cnx = $conexion->conectar();

    $nombre = trim(mb_strtroupper($_POST['nombre']));
    $apellido = trim(mb_strtroupper($_POST['apellido']));
    $nombreUsuario = trim($_POST['nombreUsuario']);
    $correo = trim($_POST['correo']);
    $contrasenia = trim($_POST['contrasenia']);

    $sql = $cnx->prepare("SELECT * FROM Usuarios WHERE nombreUsuario = :nombreUsuario");
    $sql->bindParam(':nombreUsuario', $nombreUsuario);
    $sql->execute();
    $existeUsuario = $sql->rowCount();

    if($existeUsuario >= 1) {
        echo "El nombre de usuario $nombreUsuario ya existe!";
        exit();
    }

    $contraseniaHash = password_hash($contrasenia, PASSWORD_ARGON2I);

    $response = array();

    try {
        #Inicia la transacción
        $cnx->beginTransaction();

        #Prepara la consulta sql
        $sql = $cnx->prepare("INSERT INTO Usuarios (nombre, apellido, nombreUsuario,
        correo, contrasenia) VALUES (:nombre, :apellido, :nombreUsuario, :correo, :contrasenia) ");

        #Blinda los datos de inserción
        $sql->bindParam(':nombre', $nombre);
        $sql->bindParam(':apellido', $apellido);
        $sql->bindParam(':nombreUsuario', $nombreUsuario);
        $sql->bindParam(':correo', $correo);
        $sql->bindParam(':contrasenia', $contraseniaHash);

        #Ejecuta la consulta
        $sql->execute();

        #Guarda los datos
        $cnx->commit();
        $response['estado'] = "ok";
        $response['mensaje'] = "Los datos fueron insertados exitosamente.";
        echo json_encode($response);
        exit();
    }catch(PDOException $e) {
        #Devuelve los datos
        $cnx->rollBack();
        $response['estado'] = "error";
        $response['mensaje'] = "Se presentó el siguiente error: $e";
        echo json_encode($response);
        exit();
    }