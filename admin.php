<?php
include "ConexionBD/ConexionBalance.php";
include "validacion_login.php";
if (!isset($_SESSION['rol_id'])) {
    header("Location: index.php");
    exit(); 
}
if ($_SESSION['rol_id']==2) {
    header("Location: proveedor.php");
    exit(); 
}

?>
<!DOCTYPE html>
<html lang="en">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="CSS/estilosInicio.css">
    <link rel="shortcut icon" href="img/LogoBlanco.png" type="image/x-icon">
    <title>Balance de masas</title>
</head>

<body>
    <div id="loader">
        <img src="img/LogoBlanco.png" alt="Indicador de carga">
    </div>


    <div class="sidebar">
        <a href="View/PiezasComponentes.php" class="menu-link"><i class="fa-solid fa-boxes-stacked"></i> Materiales y componentes</a>
        <a href="View/usuarios.php" class="menu-link"><i class="fa-solid fa-users"></i> Usuarios</a>
        <a href="View/Proveedores.php" class="menu-link"><i class="fa-solid fa-file-zipper"></i> Informe</a>
        <a href="View/inyecciones.php" class="menu-link"><i class="fa-solid fa-inbox"></i> Inyecciones</a>
        <?php
        if ($_SESSION['rol_id']==3){
        ?>
        <a href="View/accesos.php" class="menu-link"><i class="fa-solid fa-key"></i> Contraseñas</a>
        <?php
        }
        ?>
        <hr style="color:White">
        <a class="menu-link btncerrar"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</a>
        </button>
    </div>

    <div class="content" id="contenido">
    <?php
    $frase = $_SESSION['nombre'];
    $palabras = explode(' ', $frase);
    $primera_palabra = $palabras[0]; 
    
    ?>
    <h4 class="mt-3"><mark><strong>ㅤ¡Hola <?php echo $primera_palabra; ?>!ㅤ</strong></mark></h4>

    </div>

    <div class="footer">
        <div class="container mr-5">
            <p style="color:white;">&copy; 2023 Haceb Whirlpool S.A.S . Todos los derechos reservados.</p>
        </div>
    </div>
    <style>
        .footer {
            background-color: #072B31; 
            position: absolute;
            text-align: center;
            padding: 5px;
            bottom: 0;
            width: 100%;
            height: 40px;
            font-size: smaller;
        }
    </style>

    <script>
        window.addEventListener('load', function() {
            var loader = document.getElementById('loader');
            loader.style.display = 'none';
        });

        // Cuando se hace clic en el botón "btncerrar"
        $('.btncerrar').on('click', function() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Quieres cerrar la sesión?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, cerrar sesión',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                   
                    $.ajax({
                        type: "POST",
                        url: "Acciones/cerrarSesion.php",
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Cerrando sesión',
                                text: 'Cargando...',
                                showConfirmButton: false,
                                timer: 1000
                            }).then(() => {
                                window.location.href = "index.php";
                            });
            
                        },
                        error: function() {
                            alert("Ha ocurrido un error al cerrar la sesión.");
                        }
                    });
                }
            });
        });
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

</body>

</html>