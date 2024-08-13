<?php
// Verificar si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id2'], $_POST['contrasena'])) {
    // Obtener los datos del formulario
    $id = $_POST['id2'];
    $contrasenaNueva = $_POST['contrasena'];
    $contrasenaIncriptadaNueva = password_hash($contrasenaNueva, PASSWORD_ARGON2ID);

    // Incluye la conexión a la base de datos
    include "../ConexionBD/ConexionBalance.php";

    // Prepara la consulta SQL utilizando sentencias preparadas
    $sql = "UPDATE balancemasas_usuarios SET contrasena=? WHERE id=?";
    if ($stmt = mysqli_prepare($conexion, $sql)) { 
        // Vincula los parámetros
        mysqli_stmt_bind_param($stmt, "si", $contrasenaIncriptadaNueva, $id);

        // Ejecuta la consulta
        if (mysqli_stmt_execute($stmt)) {
            echo "Actualizado"; // Puedes devolver un mensaje de éxito
        } else {
            echo "Error al actualizar el Usuario: " . mysqli_error($conexion);
        }

        // Cierra la declaración
        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
} else {
    echo "Error: Datos del formulario no recibidos o incompletos.";
}
?>
