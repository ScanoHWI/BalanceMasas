// Configuración de DataTables
$('#TablaTodosMateriales').DataTable({
    language: espanol,
    paging: false,
    searching: true
});



$(document).ready(function () {
    // Envío del formulario usando AJAX
    /* REGISTRO DE NUEVOS MATERIALES */
    $("#btnRegistrar").on("click", function () {
        var MaterialID = $("#MaterialID").val();
        var Denominacion = $("#Denominacion").val();
        var proveedor = $("#proveedor").val();

        $.ajax({
            type: "POST",
            url: "../Acciones/agregarMaterial.php",
            data: {
                MaterialID: MaterialID,
                Denominacion: Denominacion,
                proveedor: proveedor
            },
            success: function (response) {
                //REGISTRO EXITOSO... SE CARGA LA ALERTA Y LA PAGINA SE ACTUALIZA
                Swal.fire({
                    icon: 'success',
                    title: 'Material registrado exitosamente',
                    text: 'Cargando...',
                    showConfirmButton: false,
                    timer: 2200
                }).then(() => {
                    location.reload();
                    $('#TablaTodosMateriales').DataTable();
                });
                // Cerramos la ventana modal
                $("#AgregarMateriales").modal("hide");

            },
            error: function () {
                alert("Ha ocurrido un error al registrar el Material.");
            }
        });
    });

    /* SCRIPT PARA LA ACTUALIZACIÓN DEL MATERIAL:: */

    $("#btnRegistrarCambiosMaterial").on("click", function () {
        var MaterialActual = $("#MaterialActual").val();
        var MaterialID2 = $("#MaterialID2").val();
        var Denominacion2 = $("#Denominacion2").val();
        var proveedor2 = $("#proveedor2").val();

        $.ajax({
            type: "POST",
            url: "../Acciones/guardarCambiosMateriales.php", // Ruta correcta al archivo PHP
            data: {
                MaterialActual: MaterialActual,
                MaterialID2: MaterialID2,
                Denominacion2: Denominacion2,
                proveedor2: proveedor2,
            },
            success: function (response) {
                // Cerrar la ventana modal
                $("#EditarMaterial").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: 'Material editado exitosamente',
                    text: 'Cargando...',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    location.reload();
                });
            },
            error: function () {
                alert("Ha ocurrido un error al editar el Material.");
            }
        });
    });

    // Escuchar el clic en el botón del ojo
    $('.ver-Componentes').on('click', function () {
        var materialId = $(this).data('usuario-id');

        // Realizar una solicitud AJAX para obtener los componentes del material
        $.ajax({
            type: "POST",
            url: "../Acciones/obtenerComponente.php", // Ruta a tu archivo PHP
            data: {
                materialId: materialId
            },
            dataType: "json",
            success: function (response) {
                // Limpia la tabla de componentes
                $('#tablaComponentes').empty();

                // Llena la tabla con los componentes
                for (var i = 0; i < response.length; i++) {
                    var estadoComponente = response[i].estadoComponente === 1 ? "Activo" : "Inactivo";
                    $('#tablaComponentes').append('<tr>' +
                        '<td>' + response[i].numeroComponente + '</td>' +
                        '<td>' + response[i].descripcionComponente + '</td>' +
                        '<td>' + response[i].unidad + '</td>' +
                        '<td>' + response[i].PesoResinaRealGR + '</td>' +
                        '<td>' + response[i].RamalPorcentaje + '</td>' +
                        '<td>' + response[i].ScrapRealPorcentaje + '</td>' +
                        '<td>' + response[i].PesoRecinaKilogramos + '</td>' +
                        '<td>' + response[i].PesoScrapKilogramos + '</td>' +
                        '<td>' + estadoComponente + '</td>' +
                        '</tr>');
                }

                // Muestra la modal
                $('#modalComponentes').modal('show');
            },
            error: function () {
                alert("Error al obtener los componentes.");
            }
        });
    });

    $('.editar-Material').on('click', function () {
        var Datos = $(this).data("usuario-id2");
        var partes = Datos.split("-");
        var MaterialID = partes[0];
        var idUsuario = partes[1];

        console.log(MaterialID)
        console.log(idUsuario)

        // Realizar una solicitud AJAX para obtener los detalles del Material
        $.ajax({
            type: "GET",
            url: "../Acciones/obtenerMaterial.php?materialid=" + MaterialID + "&idUsuario=" + idUsuario,
            dataType: "json",
            success: function (material) {
                console.log(material)
                $("#MaterialActual").val(material.id_material);
                $("#MaterialID2").val(material.materialid);
                $("#Denominacion2").val(material.denominacion);
                $("#proveedor2").val(material.UsuarioID);

                // Mostrar la modal
                $("#EditarMaterial").modal("show");
            },
            error: function () {
                alert("Error al obtener la información del Material.");
            }
        });
    });

});

//DESACTIVAR MATERIAL:::

$('.Desactivar-Material').on('click', function () {
    var materialId = $(this).data('usuario-id3');

    // Mostrar una alerta de confirmación
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Quieres desactivar este material y sus componentes?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, desactivar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // El usuario ha confirmado, procede con la desactivación del material
            $.ajax({
                type: "POST",
                url: "../Acciones/desactivarMaterial.php",
                data: {
                    materialId: materialId
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Material desactivado exitosamente',
                        text: 'Cargando...',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function () {
                    alert("Ha ocurrido un error al desactivar el Material.");
                }
            });
        }
    });
});
$('.Activar-Material').on('click', function () {
    var materialId = $(this).data('usuario-id4');

    // Mostrar una alerta de confirmación
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Quieres activar este material y sus componentes?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, activar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // El usuario ha confirmado, procede con la activación del material
            $.ajax({
                type: "POST",
                url: "../Acciones/activarMaterial.php",
                data: {
                    materialId: materialId
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Material Activado exitosamente',
                        text: 'Cargando...',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function () {
                    alert("Ha ocurrido un error al activar el Material.");
                }
            });
        }
    });
});

window.addEventListener('load', function () {
    var loader = document.getElementById('loader');
    loader.style.display = 'none';
});

