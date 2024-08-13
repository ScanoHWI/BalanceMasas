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

// Verificar si se ha proporcionado un ID válido en la URL
if (isset($_GET['idComponente'])) {
    $componenteIdActual = $_GET['idComponente'];
    $componente_id = $_GET['idComponente'];
    // Realiza una consulta SQL para obtener la información del componente con el ID proporcionado
    $sql = "SELECT * FROM balancemasas_componentes 
                    JOIN balancemasas_materialescomponentes ON balancemasas_componentes.id_componente = balancemasas_materialescomponentes.ComponenteID 
                    JOIN balancemasas_materiales ON balancemasas_materialescomponentes.MaterialID =  balancemasas_materiales.id_material
                    WHERE balancemasas_componentes.id_componente = '$componente_id';";
    $result = mysqli_query($conexion, $sql);

    if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {
            $numeroComponente = $row['numeroComponente'];
            $Material =  $row['materialid'];
            $MaterialID = $row['MaterialID'];
            $descripcion = $row['descripcionComponente'];
            $unidad = $row['unidad'];
            $PesoResinaRealGR = $row['PesoResinaRealGR'];
            $RamalPorcentaje = $row['RamalPorcentaje'];
            $ScrapRealPorcentaje = $row['ScrapRealPorcentaje'];
            $PesoRecinaKilogramos = $row['PesoRecinaKilogramos'];
            $PesoScrapKilogramos = $row['PesoScrapKilogramos'];
            $fechaRegitro = date('Y-m-d');
?>
            <?php
            include "../ConexionBD/ConexionBalance.php";

            ?>


            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Balance masas</title>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
                <link rel="shortcut icon" href="../img/LogoBlanco.png" type="image/x-icon">
                <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
                <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="../CSS/estiloAgregarComponente.css">
                <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
            </head>

            <body>
                <!-- PANTALLA DE CARGA:: -->
                <div id="loader">
                    <img src="../img/LogoBlanco.png" alt="Indicador de carga">
                </div>

                <!-- Menú lateral -->
                <div class="sidebar">
                    <a href="../admin.php" class="menu-link"><i class="fa-solid fa-house"></i></i></a>
                    <a href="componentes.php" class="menu-link"><i class="fa-solid fa-arrow-left-long"></i></a>

                </div>

                <div class="content m-5 mt-2" id="contenido">
                    <h2>Modificar componente <strong>#<?php echo $numeroComponente . " - " . $descripcion; ?></strong></h2>
                    <!-- Contenedor para los formularios duplicados -->
                    <div id="formularios">
                        <div class="formulario">
                            <hr>
                            <div id="cajaFormularioAgregar" class="m-1 p-3">
                                <form id="" autocomplete="off">
                                    <div class="row">
                                        <p class="text-danger ms-1"><strong>Recuerda:</strong> los valores decimales deben escribirse con punto (.)</p>
                                        <!-- Columna 1 -->
                                        <div class="col-md-4 p-3">
                                            <input type="text" value="<?php echo $componenteIdActual ?>" class="form-control" name="ComponenteActual" id="ComponenteActual" hidden readonly>

                                            <input type="text" value="<?php echo $MaterialID ?>" class="form-control" name="MaterialActual" id="MaterialActual" hidden readonly>

                                            <label for="Material" class="label-form">Material</label>
                                            <input type="text" value="<?php echo $Material ?>" class="form-control" name="Material" id="Material" placeholder="Busca aquí..." required>
                                            <input type="text" class="form-control" name="MaterialCodigo" id="MaterialCodigo" hidden readonly>

                                            <label for="NumeroComponente" class="label-form mt-4">Número componente</label>
                                            <input type="text" value="<?php echo $numeroComponente ?>" class="form-control" name="NumeroComponente" id="NumeroComponente" required>

                                            <label for="Descripcion" class="label-form mt-4">Descripción componente</label>
                                            <input type="text" value="<?php echo $descripcion ?>" class="form-control" name="Descripcion" id="Descripcion" required>

                                        </div>

                                        <!-- Columna 2 -->
                                        <div class="col-md-4 p-3">
                                            <label for="Unidad" class="label-form">Unidad</label>
                                            <input type="text" value="<?php echo $unidad ?>" class="form-control" name="Unidad" id="Unidad" required>

                                            <label for="PesoResinaGR" class="label-form mt-4">Peso resina real GR</label>
                                            <input type="text" value="<?php echo $PesoResinaRealGR ?>" class="form-control" name="PesoResinaGR" id="PesoResinaGR" onkeydown="validarNumero(event)" required>

                                            <label for="RamalPorcentaje" class="label-form mt-4">Ramal Porcentaje</label>
                                            <input type="text" value="<?php echo $RamalPorcentaje ?>" class="form-control" name="RamalPorcentaje" id="RamalPorcentaje" onkeydown="validarNumero(event)" required>
                                        </div>

                                        <!-- Columna 3 -->
                                        <div class="col-md-4 p-3">
                                            <label for="ScrapPorcentaje" class="label-form">Scrap real porcentaje</label>
                                            <input type="text" value="<?php echo $ScrapRealPorcentaje ?>" class="form-control" name="ScrapPorcentaje" id="ScrapPorcentaje" onkeydown="validarNumero(event)" required>

                                            <label for="PesoRecinaKilogramos" class="label-form mt-4">Peso recina kilogramos</label>
                                            <input type="text" value="<?php echo $PesoRecinaKilogramos ?>" class="form-control" name="PesoRecinaKilogramos" id="PesoRecinaKilogramos" onkeydown="validarNumero(event)" required>

                                            <label for="PesoScrapKilogramos" class="label-form mt-4">Peso scrap kilogramos</label>
                                            <input type="text" value="<?php echo $PesoScrapKilogramos ?>" class="form-control" name="PesoScrapKilogramos" id="PesoScrapKilogramos" onkeydown="validarNumero(event)" required>

                                        </div>
                                    </div>
                                    <button type="button" id="btnRegistrarCambiosComponente" class="btn btn-success ms-1">Guardar cambios </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>
                <script src="../JavaScript/editarComponente.js"></script>
            </body>

            </html>


<?php
        } else {
            echo "No se encontró el componente.";
        }
    } else {
        echo "Error al realizar la consulta.";
    }
} else {
    echo "ID de componente no válido.";
}
?>