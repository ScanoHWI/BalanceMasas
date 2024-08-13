<?php
if (isset($_POST['MaterialID'], $_POST['fechaHora'], $_POST['PesoRecinaKilogramos'])) {
    include "../ConexionBD/ConexionBalance.php";
    include "../validacion_login.php";

    $MaterialID = $_POST['MaterialID'];
    $fechaHora = $_POST['fechaHora'];
    $fechaHoraOficial = date("Y-m-d H:i:s", strtotime($fechaHora));
    $PesoRecinaKilogramos = $_POST['PesoRecinaKilogramos'];
    $idProveedor = $_SESSION["id"];
    $id = "";

    $sql = "INSERT INTO balancemasas_inyecciones (idInyeccion, idMaterial, IdProveedor, FechaInyeccion, PesoResinaKG) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql); 

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iiisd", $id, $MaterialID, $idProveedor, $fechaHora, $PesoRecinaKilogramos);
        
        if (mysqli_stmt_execute($stmt)) {
            // La inserción fue exitosa
            echo "Inserción exitosa.";
        } else {
            // Error en la ejecución de la consulta
            echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Error en la preparación de la consulta
        echo "Error al preparar la consulta: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
} else {
    echo "Error: Datos del formulario no recibidos.";
}
?>
