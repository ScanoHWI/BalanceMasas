<?php
session_start();
include "ConexionBD/ConexionBalance.php";

if (!empty($_POST["btningresar"])) {

    if (!empty($_POST["CorreoElectronico"]) and !empty($_POST["password"])) {

        $correo = $_POST['CorreoElectronico'];
        $contrasena = $_POST['password'];

        $ConsultaCorreo = mysqli_query($conexion, "SELECT * FROM balancemasas_usuarios WHERE correo='$correo'");
        if (mysqli_num_rows($ConsultaCorreo) == 0) {
            echo "<div class='alert alert-danger small'>Correo incorrecto</div>";
        } else {
            $sql = mysqli_query($conexion, "SELECT * FROM balancemasas_usuarios WHERE correo='$correo' AND rol_id<=3");
            $array2 = mysqli_fetch_array($ConsultaCorreo);
            $passwordBD = ($array2['contrasena']);
            $rol = ($array2['rol_id']);
            /* VERIFICACION DE CONTRASEÑAS::: */
            if (password_verify($contrasena, $passwordBD)) {

                if ($datos = $sql->fetch_object()) {

                    $_SESSION["id"] = $datos->id;
                    $_SESSION["correo"] = $datos->correo;
                    $_SESSION["nombre"] = $datos->nombre;
                    $_SESSION["nit"] = $datos->nit;
                    $_SESSION["rol_id"] = $datos->rol_id;

                    if ($rol == 1 || $rol == 3) {
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: '¡Ingreso exitoso!',
                                text: 'Ingresando...',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "admin.php";
                            });
                        </script>
                    <?php
                        /* header("Location:admin.php"); */
                    } elseif ($rol == 2) {
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: '¡Ingreso exitoso!',
                                text: 'Ingresando...',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "proveedor.php";
                            });
                        </script>
                    <?php
                        /* header("Location:proveedor.php"); */
                    }
                } else {
                    echo "<div class='alert alert-danger small'>Error de conexión, intente nuevamente</div>";
                }
            } else {
                echo "<div class='alert alert-danger small'>Contraseña incorrecta</div>";
            }
        }
    }
}
