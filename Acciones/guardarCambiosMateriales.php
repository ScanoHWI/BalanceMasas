<?php
// Verificar si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['MaterialID2'], $_POST['Denominacion2'], $_POST['proveedor2'])) {
    // Obtener los datos del formulario
    $MaterialActual = $_POST['MaterialActual'];
    $MaterialID2 = $_POST['MaterialID2'];
    $Denominacion2 = $_POST['Denominacion2'];
    $proveedor2 = $_POST['proveedor2'];
    $fechaRegitro = date('Y-m-d');

    // Incluye la conexión a la base de datos
    include "../ConexionBD/ConexionBalance.php";

    // Actualiza el proveedor en la tabla de materiales
    $sql = "UPDATE balancemasas_materiales SET materialid=?, denominacion=?, FechaEdicion=? WHERE id_material=?";
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $MaterialID2, $Denominacion2, $fechaRegitro, $MaterialActual);

        if (mysqli_stmt_execute($stmt)) {
            // Actualización exitosa en la tabla de materiales
            echo "Material actualizado exitosamente.";
        } else {
            echo "Error al actualizar el material: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
    }

    // Actualiza el proveedor en la tabla intermedia materialesUsuarios
    $sql2 = "UPDATE balancemasas_usuariosmateriales SET UsuarioID=? WHERE MaterialID=?";
    if ($stmt2 = mysqli_prepare($conexion, $sql2)) {
        mysqli_stmt_bind_param($stmt2, "ss", $proveedor2, $MaterialActual);

        if (mysqli_stmt_execute($stmt2)) {
            // Actualización exitosa en la tabla intermedia
            // Puedes mostrar un mensaje de éxito si lo deseas
            echo "Proveedor actualizado exitosamente en la tabla intermedia.";
        } else {
            echo "Error al actualizar el proveedor en la tabla intermedia: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt2);
    } else {
        echo "Error en la preparación de la consulta (tabla intermedia): " . mysqli_error($conexion);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Error: Datos del formulario no recibidos o incompletos.";
}
?>
