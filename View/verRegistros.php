<?php
include "../ConexionBD/ConexionBalance.php";
include "../validacion_login.php";
if (!isset($_SESSION['rol_id'])) {
    header("Location: ../index.php");
    exit();
}
if ($_SESSION['rol_id'] == 1) {
    header("Location: ../admin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../CSS/estiloMenu.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../img/LogoBlanco.png" type="image/x-icon">
    <title>Balance de masas</title>
</head>

<body>

    <!-- PANTALLA DE CARGA:: -->
    <div id="loader">
        <img src="../img/LogoBlanco.png" alt="Indicador de carga">
    </div>

    <!-- Menú lateral -->
    <div class="sidebar">
        <a href="../proveedor.php" class="menu-link"><i class="fa-solid fa-arrow-left-long"></i></a>
    </div>



    <!-- Contenido principal -->
    <div class="content" id="contenido">

        <h3 class="mt-3"><mark><strong>ㅤRegistrosㅤ</strong></mark></h3>
        <style>
            mark {
                background-color: #072B31;
                color: #ffffff;
                border-radius: 40px;
                box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
                padding: 15px;
            }
        </style>
        <div id="CajaMateriales" class="mt-5 m-5 p-2">
            <?php
            /*  $fecha_actual = date('F');
            echo "Fecha Actual: $fecha_actual"; */
            $ConsultaMateriales = mysqli_query($conexion, "SELECT *
            FROM balancemasas_inyecciones 
            JOIN balancemasas_materiales ON balancemasas_inyecciones.idMaterial = balancemasas_materiales.id_material 
            WHERE YEAR(FechaInyeccion) * 12 + MONTH(FechaInyeccion) < YEAR(CURRENT_DATE) * 12 + MONTH(CURRENT_DATE);");
            ?>
            <div class="table-responsive">
                <table id="TablaTodosMateriales">
                    <thead>
                        <tr>
                            <th>Material</th>
                            <th>Denominación</th>
                            <th>Fecha registro</th>
                            <th>Peso Recina KG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($mostrar = mysqli_fetch_array($ConsultaMateriales)) {
                        ?>
                            <tr>
                                <td><?php echo $mostrar['materialid'] ?></td>
                                <td><?php echo $mostrar['denominacion'] ?></td>
                                <td><?php echo $mostrar['FechaInyeccion'] ?></td>
                                <td><?php echo $mostrar['PesoResinaKG'] ?></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="../JavaScript/idiomaTablas.js"></script>
    <script src="../JavaScript/materiales.js"></script>
</body>

</html>