<?php
include "ConexionBD/ConexionBalance.php";
include "validacion_login.php";
if (!isset($_SESSION['rol_id'])) {
    header("Location: index.php");
    exit();
}
if ($_SESSION['rol_id'] == 1) {
    header("Location: admin.php");
    exit();
}


?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="CSS/estilosInicio.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>
    <link rel="shortcut icon" href="img/LogoBlanco.png" type="image/x-icon">
    <title>Balance de masas</title>
</head>

<body>
    <div id="loader">
        <img src="img/LogoBlanco.png" alt="Indicador de carga">
    </div>


    <div class="sidebar">
        <a class="menu-link btncerrar"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</a>
        <a href="View/verRegistros.php" class="menu-link"><i class="fa-solid fa-list"></i> Ver historico registros</a>
        </button>
    </div>

    <div class="content" id="contenido">
    <h4 class="mt-3"><mark><strong>ㅤ¡Hola <?php echo $_SESSION['nombre']; ?>!ㅤ</strong></mark></h4>
    <!-- <h4 class="mt-3"><mark><strong>ㅤSeleccione un materialㅤ</strong></mark></h4> -->

        <div id="CajaMateriales" class="mt-5">
            <?php
            $idUsuario = $_SESSION['id'];
            $ConsultaMateriales = mysqli_query($conexion, "SELECT * from balancemasas_usuariosmateriales 
                                                            JOIN balancemasas_materiales ON balancemasas_usuariosmateriales.MaterialID = balancemasas_materiales.id_material 
                                                            WHERE balancemasas_usuariosmateriales.UsuarioID = $idUsuario AND balancemasas_materiales.estado = 1;");
            ?>
            <div class="table-responsive">
                <table id="TablaTodosMateriales">
                    <thead>
                        <tr>
                            <th>Material</th>
                            <th>Denominación</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($mostrar = mysqli_fetch_array($ConsultaMateriales)) {
                        ?>
                            <tr>
                                <td><?php echo $mostrar['materialid'] ?></td>
                                <td><?php echo $mostrar['denominacion'] ?></td>

                                <td><a href="Acciones/inyectarMaterial.php?idMaterial=<?php echo $mostrar['MaterialID']; ?>" class="btn btn-primary inyectarMaterial"><i class="fa-solid fa-magnifying-glass-plus"></i></a></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="JavaScript/idiomaTablas.js"></script>
    </div>

    <div class="footer">
        <div class="container">
            <p style="color:white;">&copy; 2023 Haceb Whirlpool S.A.S . Todos los derechos reservados.</p>
        </div>
    </div>

    <script src="JavaScript/proveedor.js"></script>

</body>

</html>