<?php
if (isset($_GET['materialid']) && isset($_GET['idUsuario'])) {
    $MaterialID = $_GET['materialid'];
    $idUsuario = $_GET['idUsuario'];

    include "../ConexionBD/ConexionBalance.php";

    // Consulta SQL para obtener la información del material
    $consulta = "SELECT * FROM balancemasas_materiales 
                JOIN balancemasas_usuariosmateriales ON balancemasas_materiales.id_material = balancemasas_usuariosmateriales.MaterialID 
                WHERE balancemasas_materiales.id_material = '$MaterialID' AND balancemasas_usuariosmateriales.UsuarioID = '$idUsuario'";

    // Ejecutar la consulta
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        // Obtener los datos del material
        $material = mysqli_fetch_assoc($resultado);

        // Devolver los datos del material en formato JSON
        echo json_encode($material);
    } else {
        // Si hay un error en la consulta, registra el error
        error_log("Error en la consulta SQL: " . mysqli_error($conexion));
        echo json_encode(["error" => "No se pudo obtener la información del material"]);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    // Si no se proporciona un ID de material válido
    echo json_encode(["error" => "ID de Material o Usuario no válido"]);
}
