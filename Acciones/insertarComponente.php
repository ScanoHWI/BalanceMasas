<?php
include "../ConexionBD/ConexionBalance.php";

// Verifica si se reciben los datos del formulario
if (isset($_POST['formDataArray'])) {
    // Decodifica los datos JSON en un array
    $formDataArray = json_decode($_POST['formDataArray'], true);

    // Inicializa una variable para rastrear errores
    $errores = array();

    // Comienza la transacción
    mysqli_begin_transaction($conexion);

    // Prepara las consultas una sola vez
    $queryTabla1 = "INSERT INTO balancemasas_componentes (id_componente, numeroComponente, descripcionComponente, unidad, PesoResinaRealGR, RamalPorcentaje, ScrapRealPorcentaje, PesoRecinaKilogramos, PesoScrapKilogramos, FechaEdicion, estadoComponente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $queryTabla2 = "INSERT INTO balancemasas_materialescomponentes (MaterialID, ComponenteID) VALUES (?, ?)";

    $stmtTabla1 = mysqli_prepare($conexion, $queryTabla1); 
    $stmtTabla2 = mysqli_prepare($conexion, $queryTabla2);

    if ($stmtTabla1 && $stmtTabla2) {
        foreach ($formDataArray as $data) {
            // Escapa y valida los datos
            $id = "";
            $Material = mysqli_real_escape_string($conexion, $data['Material']);
            $MaterialCodigo = mysqli_real_escape_string($conexion, $data['MaterialCodigo']);
            $NumeroComponente = mysqli_real_escape_string($conexion, $data['NumeroComponente']);
            $Descripcion = mysqli_real_escape_string($conexion, $data['Descripcion']);
            $Unidad = mysqli_real_escape_string($conexion, $data['Unidad']);
            $PesoResinaGR = (float)$data['PesoResinaGR'];
            $RamalPorcentaje = (float)$data['RamalPorcentaje'];
            $ScrapPorcentaje = (float)$data['ScrapPorcentaje'];
            $PesoRecinaKilogramos = (float)$data['PesoRecinaKilogramos'];
            $PesoScrapKilogramos = (float)$data['PesoScrapKilogramos'];
            $fechaRegitro = date('Y-m-d');
            $estado = 1;
            // Ejecutar la inserción en Tabla1
            $exitoTabla1 = mysqli_stmt_bind_param($stmtTabla1, 'isssdddddsi', $id, $NumeroComponente, $Descripcion, $Unidad, $PesoResinaGR, $RamalPorcentaje, $ScrapPorcentaje, $PesoRecinaKilogramos, $PesoScrapKilogramos, $fechaRegitro, $estado) &&
              mysqli_stmt_execute($stmtTabla1);
    
            // Obtener el ID del componente recién insertado
            $ComponenteInsertID = mysqli_insert_id($conexion);
    
            // Ejecutar la inserción en Tabla2
            $exitoTabla2 = mysqli_stmt_bind_param($stmtTabla2, 'ii', $MaterialCodigo, $ComponenteInsertID) &&
                          mysqli_stmt_execute($stmtTabla2);
    
            if (!($exitoTabla1 && $exitoTabla2)) {
                $errores[] = "Error en la inserción de un componente.";
                break; // Si hay un error, detén la inserción y sal de la iteración
            }
        }

        // Comprobar si la inserción fue exitosa
        if (empty($errores)) {
            mysqli_commit($conexion);
            echo "Datos insertados correctamente.";
        } else {
            mysqli_rollback($conexion);
            echo "Error al insertar los datos en la base de datos.";
            foreach ($errores as $error) {
                echo $error . "<br>";
            }
        }
    } else {
        mysqli_rollback($conexion);
        echo "Error al preparar las consultas.";
    }

    mysqli_stmt_close($stmtTabla1);
    mysqli_stmt_close($stmtTabla2);
} else {
    echo "No se recibieron datos del formulario.";
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
