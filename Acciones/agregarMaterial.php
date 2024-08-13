<?php
/* AGREGAR MATERIAL */
if (isset($_POST['MaterialID'], $_POST['Denominacion'], $_POST['proveedor'])) {
    // Obtener los datos del formulario
    $MaterialID = $_POST['MaterialID'];
    $Denominacion = $_POST['Denominacion'];
    $proveedor = $_POST['proveedor'];
    $fechaRegitro = date('Y-m-d');
    $id = "";
    $estado = 1;
    include "../ConexionBD/ConexionBalance.php";

    // Utiliza una consulta preparada para insertar los datos de manera segura
    $sql = "INSERT INTO balancemasas_materiales (id_material ,materialid, denominacion, FechaEdicion, estado) VALUES (?, ?, ?, ?, ?)";
    $sql2 = "INSERT INTO balancemasas_usuariosmateriales (UsuarioID, MaterialID) VALUES (?, ?)";

    $stmtTabla1 = mysqli_prepare($conexion, $sql); 
    $stmtTabla2 = mysqli_prepare($conexion, $sql2);
    
    if ($stmtTabla1 && $stmtTabla2) {
        // Vincula los parámetros con los valores

        mysqli_stmt_bind_param($stmtTabla1, "isssi", $id , $MaterialID, $Denominacion, $fechaRegitro, $estado);
        
        
        // Ejecuta la consulta
        if (mysqli_stmt_execute($stmtTabla1)) {
            $materialInsertID = mysqli_insert_id($conexion);

            mysqli_stmt_bind_param($stmtTabla2, "ii", $proveedor, $materialInsertID);
            echo ("Correcto");
            if (!mysqli_stmt_execute($stmtTabla2)) {
                echo "Error al registrar el Material para el usuario: " . mysqli_error($conexion);
            }
        } else {
            echo "Error al registrar el Material: " . mysqli_error($conexion);
        }

        // Cierra la declaración
        mysqli_stmt_close($stmtTabla1);
        mysqli_stmt_close($stmtTabla2);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
} else {
    echo "Error: Datos del formulario no recibidos.";
}
?>
