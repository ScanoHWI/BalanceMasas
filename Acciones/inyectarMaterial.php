<?php
include "../ConexionBD/ConexionBalance.php";

if (isset($_GET['idMaterial'])) {

    $idMaterial = $_GET['idMaterial'];
    $sql = "SELECT * FROM `balancemasas_materiales` WHERE id_material = $idMaterial;";
    $result = mysqli_query($conexion, $sql);

    if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {
            $id_material = $row['id_material'];
            $materialid = $row['materialid'];
            $denominacion = $row['denominacion'];


?>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
            <!-- Incluye el archivo JavaScript de Bootstrap -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>
            <link rel="shortcut icon" href="../img/LogoBlanco.png" type="image/x-icon">
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Balance masas</title>
                <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
                <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="../CSS/estiloMenu.css">
                <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
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

                <div class="content" id="contenido">
                    <h3>Ingrese la información para el material: <strong style="text-transform: uppercase;"><?php echo $materialid . " - " . $denominacion; ?></strong></h3>

                    <div ms-3>
                        <hr>
                        <p class="text-danger ms-3"><strong>Recuerda:</strong> los valores decimales deben escribirse con punto (.)</p>

                        <div id="cajaFormularioInyectar" style="align-items: center; align-content: center; text-align: center; margin-top: 20px;">
                            <form id="" autocomplete="off" style="max-width: 500px; margin: 0 auto;">

                                <div class="p-3">
                                    <div style="text-align: left;">
                                        <label for="fechaHora" class="label-form">Fecha y hora del registro</label>
                                    </div>
                                    <input type="text" class="form-control" name="MaterialID" id="MaterialID" value="<?php echo $idMaterial; ?>" required readonly hidden>
                                    <input type="text" class="form-control" name="fechaHora" id="fechaHora" required readonly>
                                    <div style="text-align: left;">
                                        <label for="PesoRecinaKilogramos" class="label-form mt-4">Peso resina KG</label>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Ingresa el valor aquí..." name="PesoRecinaKilogramos" id="PesoRecinaKilogramos" onkeydown="validarNumero(event)" required>
                                </div>
                                <br>
                                <button type="button" id="btnRegistrarInyeccion" class="btn btn-success">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>


                <script>
                    function actualizarFechaHora() {
                        var inputFechaHora = document.getElementById("fechaHora");
                        var fechaHoraActual = new Date();

                        // Ajustar a la zona horaria de Colombia (UTC-5)
                        fechaHoraActual.setUTCHours(fechaHoraActual.getUTCHours() - 5);

                        // Formato YYYY-MM-DD HH:mm:ss
                        var fechaYHora = fechaHoraActual.toISOString().slice(0, 19).replace("T", " ");
                        inputFechaHora.value = fechaYHora;
                    }

                    setInterval(actualizarFechaHora, 1000);


                    window.addEventListener('load', function() {
                        var loader = document.getElementById('loader');
                        loader.style.display = 'none';
                    });

                    $("#btnRegistrarInyeccion").on("click", function() {
                        var MaterialID = $("#MaterialID").val();
                        var fechaHora = $("#fechaHora").val();
                        var PesoRecinaKilogramos = $("#PesoRecinaKilogramos").val();

                        if (PesoRecinaKilogramos == "") {
                            alert("Llena todos los campos");
                            $("#PesoRecinaKilogramos").focus();
                        } else {

                            $.ajax({
                                type: "POST",
                                url: "inyeccion.php",
                                data: {
                                    MaterialID: MaterialID,
                                    fechaHora: fechaHora,
                                    PesoRecinaKilogramos: PesoRecinaKilogramos
                                },
                                success: function(response) {

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Registro guardado exitosamente',
                                        text: 'Cargando...',
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(() => {
                                        window.location.href = '../proveedor.php';
                                    });

                                },
                                error: function() {
                                    alert("Ha ocurrido un error al editar el Componente.");
                                }
                            });
                        }
                    });


                    function validarNumero(event) {
                        var key = event.key;

                        if (event.target.type === 'text') {

                            if (key === 'Tab' || key === 'Backspace') {
                                return;
                            }

                            var fieldValue = event.target.value;

                            // Verificar si ya hay un punto decimal en el campo
                            var hasDecimal = fieldValue.includes('.');

                            // Si se está intentando ingresar un punto y ya hay uno, o si no es un dígito o punto, prevenir la acción
                            if ((key === '.' && hasDecimal) || (!/^\d$/.test(key) && key !== '.')) {
                                event.preventDefault();
                            }

                            // Si ya hay un punto decimal y la longitud de los dígitos después del punto es 4, prevenir la acción
                            if (hasDecimal && fieldValue.split('.')[1].length >= 4) {
                                event.preventDefault();
                            }
                        }
                    }
                </script>

            </body>

            </html>

<?php
        } else {
            echo "No se encontró el material.";
        }
    } else {
        echo "No se encontró el material.";
    }
} else {
    echo "Material no valido";
}
?>