
// Configuración de DataTables
$('#TablaTodosUsuarios').DataTable({
    language: espanol
});

$(document).ready(function () {

    $("#contrasena").on("input", function () {
        var contrasena = $("#contrasena").val();
        var confirmarContrasena = $("#confirmarContrasena").val();
        var mensajeContrasenas = $("#mensajeContrasenas");

        // Expresión regular para verificar la longitud mínima, la presencia de al menos un número y un carácter especial
        var regexValidacion = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;

        // Validar la contraseña
        if (!regexValidacion.test(contrasena)) {
            // La contraseña no cumple con los requisitos, muestra mensaje y aplica estilo en rojo
            $("#contrasena").css({
                "border-color": "red",
                "border-width": "3px"
            });
            mensajeContrasenas.text("La contraseña debe tener al menos 8 caracteres, un número y un carácter especial.").css("color", "red");
            $("#confirmarContrasena").val("").prop("disabled", true);
            $("#confirmarContrasena").css({
                "border-color": "",
                "border-width": ""
            });


        } else {

            // La contraseña cumple con los requisitos, activar campo confirmación y aplica estilo en verde
            $("#confirmarContrasena").prop("disabled", false);
            $("#contrasena").css({
                "border-color": "green",
                "border-width": "3px"
            });
            mensajeContrasenas.text("").css("color", ""); // Limpiar el mensaje si es válido

            if (contrasena !== confirmarContrasena) {
                // Contraseñas no coinciden, muestra mensaje y aplica estilo en rojo
                $("#confirmarContrasena").css({
                    "border-color": "red",
                    "border-width": "3px"
                });
                mensajeContrasenas.text("Las contraseñas no coinciden").css("color", "red");
                /* $("#contrasena").prop("readonly", false); */
            } else {
                // Contraseñas coinciden, aplica estilo en verde
                $("#contrasena, #confirmarContrasena").css({
                    "border-color": "green",
                    "border-width": "3px"
                });
                mensajeContrasenas.text("Las contraseñas coinciden").css("color", "green");
                /* $("#contrasena").prop("readonly", true); */
    
            }
        }

    });

    $("#confirmarContrasena").on("input", function () {
        var contrasena = $("#contrasena").val();
        var confirmarContrasena = $("#confirmarContrasena").val();
        var mensajeContrasenas = $("#mensajeContrasenas");

        if (contrasena !== confirmarContrasena) {
            // Contraseñas no coinciden, muestra mensaje y aplica estilo en rojo
            $("#confirmarContrasena").css({
                "border-color": "red",
                "border-width": "3px"
            });
            mensajeContrasenas.text("Las contraseñas no coinciden").css("color", "red");
            /* $("#contrasena").prop("readonly", false); */
        } else {
            // Contraseñas coinciden, aplica estilo en verde
            $("#contrasena, #confirmarContrasena").css({
                "border-color": "green",
                "border-width": "3px"
            });
            mensajeContrasenas.text("Las contraseñas coinciden").css("color", "green");
            /* $("#contrasena").prop("readonly", true); */

        }

    })

    // Envío del formulario usando AJAX
    $("#btnRegistrar").on("click", function () {
        var correo = $("#correo").val();
        var nombre = $("#nombre").val();
        var nit = $("#nit").val();
        var contrasena = $("#contrasena").val();
        var rol = $("#rol").val();

        $.ajax({
            type: "POST",
            url: "../Acciones/agregarUsuario.php",
            data: {
                correo: correo,
                nombre: nombre,
                nit: nit,
                contrasena: contrasena,
                rol: rol
            },
            dataType: "text",
            success: function (response) {

                if (response === "CorreoExistente") {
                    // El correo ya está registrado
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al registrar usuario',
                        text: 'El correo ya está registrado.',
                        showConfirmButton: false,
                        timer: 2500,
                    })
                } else if (response === "Correcto") {
                    // Registro exitoso, mostrar una alerta y recargar la página
                    Swal.fire({
                        icon: 'success',
                        title: 'Usuario registrado exitosamente',
                        text: 'Cargando...',
                        showConfirmButton: false,
                        timer: 2200
                    }).then(() => {
                        location.reload();
                    });

                    // Cerrar la ventana modal
                    $("#AgregarUsuario").modal("hide");

                    // Limpiar los campos del formulario
                    $("#correo").val("");
                    $("#nombre").val("");
                    $("#nit").val("");
                    $("#contrasena").val("");
                    $("#rol").val("");
                } else {
                    // Otro tipo de error, mostrar una alerta genérica
                    alert("Ha ocurrido un error al registrar el usuario.");
                }
            },
            error: function () {
                alert("Ha ocurrido un error al registrar el usuario.");
            }
        });
    });

    /* SCRIPT PARA LA ACTUALIZACIÓN DEL USUARIO:: */

    $("#btnRegistrarCambiosUsuario").on("click", function () {
        var id2 = $("#id2").val();
        var correo2 = $("#correo2").val();
        var nombre2 = $("#nombre2").val();
        var nit2 = $("#nit2").val();
        var rol2 = $("#rol2").val();

        $.ajax({
            type: "POST",
            url: "../Acciones/guardarCambiosUsuario.php", // Ruta correcta al archivo PHP
            data: {
                id2: id2,
                correo2: correo2,
                nombre2: nombre2,
                nit2: nit2,
                rol2: rol2
            },
            success: function (response) {
                // Cerrar la ventana modal
                $("#EditarUsuario").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: 'Usuario editado exitosamente',
                    text: 'Cargando...',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    location.reload();
                });
            },
            error: function () {
                alert("Ha ocurrido un error al editar el usuario.");
            }
        });
    });

});



$(document).on("click", ".editar-usuario", function () {
    var usuarioId = $(this).data("usuario-id");

    // Realizar una solicitud AJAX para obtener los detalles del usuario
    $.ajax({
        type: "GET",
        url: "../Acciones/obtenerUsuario.php?id=" + usuarioId,
        dataType: "json",
        success: function (usuario) {
            // Llenar los campos de la modal con los datos del usuario
            $("#id2").val(usuario.id);
            $("#correo2").val(usuario.correo);
            $("#nombre2").val(usuario.nombre);
            $("#nit2").val(usuario.nit);
            $("#rol2").val(usuario.rol_id);

            // Mostrar la modal
            $("#EditarUsuario").modal("show");
        },
        error: function () {
            alert("Error al obtener la información del usuario.");
        }
    });
});

window.addEventListener('load', function () {
    var loader = document.getElementById('loader');
    loader.style.display = 'none';
});
