<?php

if (isset($_POST['correo'], $_POST['nombre'], $_POST['nit'], $_POST['contrasena'], $_POST['rol'])) {
    // Obtener los datos del formulario
    $correo = $_POST['correo'];
    $nombre = $_POST['nombre'];
    $nit = $_POST['nit'];
    $contrasena = $_POST['contrasena'];
    $contrasenaIncriptada = password_hash($contrasena, PASSWORD_ARGON2ID);
    $rol = $_POST['rol'];

    include "../ConexionBD/ConexionBalance.php";

    // Validar si el correo ya está registrado
    $consultaCorreoExistente = "SELECT * FROM balancemasas_usuarios WHERE correo = ?";
    if ($stmtCorreo = mysqli_prepare($conexion, $consultaCorreoExistente)) {
        mysqli_stmt_bind_param($stmtCorreo, "s", $correo);
        mysqli_stmt_execute($stmtCorreo);
        mysqli_stmt_store_result($stmtCorreo);

        if (mysqli_stmt_num_rows($stmtCorreo) > 0) {
            echo "CorreoExistente";
            mysqli_stmt_close($stmtCorreo);
            mysqli_close($conexion);
            exit();
        }

        mysqli_stmt_close($stmtCorreo);
    } else {
        echo "Error en la preparación de la consulta de validación de correo: " . mysqli_error($conexion);
        mysqli_close($conexion);
        exit();
    }

    // Si el correo no está registrado, proceder con la inserción
    $sql = "INSERT INTO balancemasas_usuarios (correo, nombre, nit, contrasena, rol_id) VALUES (?, ?, ?, ?, ?)";
    
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssi", $correo, $nombre, $nit, $contrasenaIncriptada, $rol);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Correcto";
        } else {
            echo "Error al registrar el usuario: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta de inserción: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
} else {
    echo "Error: Datos del formulario no recibidos.";
}

