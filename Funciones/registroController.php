<?php

    require_once('Database/conexion.php');

    $conexion = new conexion();
    $cnx = $conexion->conectar();

    $nombre = trim(mb_strtroupper($_POST['nombre']));
    $apellido = trim(mb_strtroupper($_POST['apellido']));
    $nombreUsuario = trim($_POST['nombreUsuario']);
    $correo = trim($_POST['correo']);
    $contrasenia = trim($_POST['contrasenia']);

    $contraseniaHash = password_hash($contrasenia, PASSWORD_ARGON2I);

    try {
        #Inicia la transacción
        $conexion->beginTransaction();

        #Prepara la consulta sql
        $sql = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, nombreUsuario,
        correo, contrasenia) VALUES (:nombre, :apellido, :nombreUsuario, :correo, :contrasenia) ");

        #Blinda los datos de inserción
        $sql->bindParam(':nombre', $nombre);
        $sql->bindParam(':apellido', $apellido);
        $sql->bindParam(':nombreUsuario', $nombreUsuario);
        $sql->bindParam(':correo', $correo);
        $sql->bindParam(':contrasenia', $contrasenia);

        #Ejecuta la consulta
        $sql->execute();

        #Guarda los datos
        $conexion->commit();
        $response['estado'] = "ok";
        $response['mensaje'] = "Los datos fueron insertados exitosamente.";
        echo json_encode($response);
        exit();
    }catch(PDOException $e) {
        #Devuelve los datos
        $conexion->rollBack();
        $response['estado'] = "error";
        $response['mensaje'] = "Se presentó el siguiente error: $e";
        echo json_encode($response);
        exit();
    }