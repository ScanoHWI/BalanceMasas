<?php
include "../ConexionBD/ConexionBalance.php";
include "../validacion_login.php";
if (!isset($_SESSION['rol_id'])) {
    header("Location: ../index.php");
    exit();
}
if ($_SESSION['rol_id'] == 2) {
    header("Location: ../proveedor.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../CSS/estiloMenu.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>
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
        <a href="../admin.php" class="menu-link"><i class="fa-solid fa-arrow-left-long"></i></a>
   </div>



    <!-- MODAL PARA EDITAR CONTRASEÑAS: -->
    <div class="modal fade" id="EditarContrasena" tabindex="-1" aria-labelledby="miVentanaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="miVentanaModalLabel">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="formEditarUsuario" autocomplete="off">
                    <div class="modal-body">
                        <p>Cambiar contraseña del usuario:</p>

                        <input type="text" readonly class="form-control border-0" id="id2" name="id2">
                        <input type="email" class="form-control border-0" id="correo2" name="correo2" required readonly>
                        <input type="text" class="form-control border-0" id="nombre2" name="nombre2" required readonly>

                        <label for="contrasena" class="label-form mt-4">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>

                        <label for="confirmarContrasena" class="label-form mt-4">Confirma la contraseña</label>
                        <input type="password" class="form-control" id="confirmarContrasena" disabled name="confirmarContrasena" required>

                        <div id="mensajeContrasenas" class="mt-2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnRegistrarCambioContrasena" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- FIN MODAL PARA EDITAR CLIENTES -->

    <!-- Contenido principal -->
    <div class="content" id="contenido">
        <h1>Gestionar Accesos</h1>

        <div id="CajaUsuario" class="mt-5 m-5 p-3">
            <?php
            $ConsultaUsuarios = mysqli_query($conexion, "SELECT * FROM balancemasas_usuarios");
            ?>
            <table id="TablaTodosUsuarios">
                <thead>
                    <tr>
                        <!-- <th>Id</th> -->
                        <th>Correo</th>
                        <th>Nombre</th>
                        <th>Nit o Cc</th>
                        <th style="width: 0 auto;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($mostrar = mysqli_fetch_array($ConsultaUsuarios)) {
                    ?>
                        <tr>

                            <td><?php echo $mostrar['correo'] ?></td>
                            <td><?php echo $mostrar['nombre'] ?></td>
                            <td><?php echo $mostrar['nit'] ?></td>
                            <td><button class="btn btn-primary editar-acceso" data-usuario-id="<?php echo $mostrar['id']; ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
        <script src="../JavaScript/idiomaTablas.js"></script>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="../JavaScript/contrasenas.js"></script>
</body>

</html>