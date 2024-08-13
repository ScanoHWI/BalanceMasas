<?php
include "../ConexionBD/ConexionBalance.php";

function obtenerComponentesPorMaterial($materialId) {
    global $conexion;

    $query = "SELECT * FROM balancemasas_componentes c
              JOIN balancemasas_materialescomponentes mc ON c.id_componente = mc.ComponenteID
              WHERE mc.MaterialID = ?";
    
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, 'i', $materialId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $componentes = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $componentes[] = $row;
    }

    mysqli_stmt_close($stmt);

    return $componentes;
}

// Verifica si se recibió materialId
if (isset($_POST['materialId'])) {
    $materialId = $_POST['materialId'];

    // Llama a la función para obtener componentes por MaterialID
    $componentes = obtenerComponentesPorMaterial($materialId);

    // Devuelve los resultados como JSON
    header('Content-Type: application/json');
    echo json_encode($componentes);
} else {
    echo "MaterialID no proporcionado.";
}
