<?php
// Verificar si se ha proporcionado un ID de usuario válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $usuarioId = $_GET['id'];

    // Conectarse a la base de datos (debes tener tu propia configuración de conexión)
    include "../ConexionBD/ConexionBalance.php"; // Asegúrate de que "conexion.php" contenga la conexión a tu base de datos

    // Consulta SQL para obtener la información del usuario
    $consulta = "SELECT * FROM balancemasas_usuarios WHERE id = $usuarioId";

    // Ejecutar la consulta
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        // Obtener los datos del usuario
        $usuario = mysqli_fetch_assoc($resultado);

        // Devolver los datos del usuario en formato JSON
        echo json_encode($usuario);
    } else {
        // Si hay un error en la consulta
        echo json_encode(["error" => "No se pudo obtener la información del usuario"]);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    // Si no se proporciona un ID de usuario válido
    echo json_encode(["error" => "ID de usuario no válido"]);
}
?>
