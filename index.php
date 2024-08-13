<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HWI - Balance de masas</title>
    <link rel="shortcut icon" href="./img/LogoBlanco.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <div class="container w-75 mt-5 bg-white rounded shadow">
        <div class="row align-items-stretch">
            <div class="col d-none d-md-block bg">

            </div>
            <div class="col p-5 rounded-end">
                <h2 class="fw-bold text-center py-4">Iniciar sesión</h2>

                <form method="POST" action="">
                    <?php
                    ?>
                    <?php
                    include "ConexionBD/ConexionBalance.php";
                    include "validacion_login.php";
                    ?>
                    <div class="mb-4">
                        <label for="CorreoElectronico" class="form-label">Correo Electrónico</label>
                        <input type="Email" class="form-control" id="CorreoElectronico" name="CorreoElectronico" placeholder="Ingrese el correo electrónico" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese la contraseña" required>
                    </div>

                    <div class="d-grid mb-5">
                        <button type="submit" value="Ingresar" name="btningresar" class="btn btn-success" id="btningresar">Ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>