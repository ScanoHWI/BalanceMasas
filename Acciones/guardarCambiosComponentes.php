<?php
// Verificar si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ComponenteActual'], $_POST['Material'], $_POST['NumeroComponente'], $_POST['Descripcion'], $_POST['Unidad'], $_POST['PesoResinaGR'], $_POST['RamalPorcentaje'], $_POST['ScrapPorcentaje'], $_POST['PesoRecinaKilogramos'], $_POST['PesoScrapKilogramos'])) {
    // Obtener los datos del formulario
    $ComponenteActual = $_POST['ComponenteActual'];
    $MaterialActual = $_POST['MaterialActual'];
    $Material = $_POST['Material'];
    $MaterialCodigo = $_POST['MaterialCodigo'];
    $NumeroComponente = $_POST['NumeroComponente'];
    $Descripcion = $_POST['Descripcion'];
    $Unidad = $_POST['Unidad'];
    $PesoResinaGR = $_POST['PesoResinaGR'];
    $RamalPorcentaje = $_POST['RamalPorcentaje'];
    $ScrapPorcentaje = $_POST['ScrapPorcentaje'];
    $PesoRecinaKilogramos = $_POST['PesoRecinaKilogramos'];
    $PesoScrapKilogramos = $_POST['PesoScrapKilogramos'];
    $fechaRegitro = date('Y-m-d');
    // Incluye la conexión a la base de datos
    include "../ConexionBD/ConexionBalance.php";

    // Actualización de componentes
    $sql = "UPDATE balancemasas_componentes SET numeroComponente=?, descripcionComponente=?, unidad=?, PesoResinaRealGR=?, RamalPorcentaje=?, ScrapRealPorcentaje=?, PesoRecinaKilogramos=?, PesoScrapKilogramos=? , FechaEdicion=? WHERE id_componente=?";
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssdddddsi", $NumeroComponente, $Descripcion, $Unidad, $PesoResinaGR, $RamalPorcentaje, $ScrapPorcentaje, $PesoRecinaKilogramos, $PesoScrapKilogramos, $fechaRegitro, $ComponenteActual);

        if (mysqli_stmt_execute($stmt)) {
            // Actualización exitosa en la tabla de componentes
            echo "Componente actualizado exitosamente.";
        } else {
            echo "Error al actualizar el Componente: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
    }
    // Actualiza el componente en la tabla intermedia materialescomponentes
    $sql2 = "UPDATE balancemasas_materialescomponentes SET MaterialID=? WHERE ComponenteID=? AND MaterialID=?";
    if ($stmt2 = mysqli_prepare($conexion, $sql2)) {
        if (empty($MaterialCodigo)) {
            mysqli_stmt_bind_param($stmt2, "iii", $MaterialActual, $ComponenteActual, $MaterialActual);
        } else {
            mysqli_stmt_bind_param($stmt2, "iii", $MaterialCodigo, $ComponenteActual, $MaterialActual);
        }

        if (mysqli_stmt_execute($stmt2)) {
            // Actualización exitosa en la tabla intermedia
            echo "Componente actualizado exitosamente en la tabla intermedia.";
        } else {
            echo "Error al actualizar el Componente en la tabla intermedia: " . mysqli_error($conexion);
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
