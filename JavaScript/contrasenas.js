
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

            } else {
                // Contraseñas coinciden, aplica estilo en verde
                $("#contrasena, #confirmarContrasena").css({
                    "border-color": "green",
                    "border-width": "3px"
                });
                mensajeContrasenas.text("Las contraseñas coinciden").css("color", "green");

    
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
            
        } else {
            $("#contrasena, #confirmarContrasena").css({
                "border-color": "green",
                "border-width": "3px"
            });
            mensajeContrasenas.text("Las contraseñas coinciden").css("color", "green");


        }

    })

    /* SCRIPT PARA LA ACTUALIZACIÓN DE CONTRASENA:: */

    $("#btnRegistrarCambioContrasena").on("click", function () {
        var id2 = $("#id2").val();
        var contrasena = $("#contrasena").val();
    
        $.ajax({
            type: "POST",
            url: "../Acciones/cambiarContrasena.php", // Ruta correcta al archivo PHP
            data: {
                id2: id2,
                contrasena: contrasena
            },
            success: function (response) {
                // Cerrar la ventana modal
                $("#EditarUsuario").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: 'Contraseña guardada exitosamente',
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



$(document).on("click", ".editar-acceso", function () {
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
            /* $("#contrasenaActual").val(usuario.contrasena); */

            // Mostrar la modal
            $("#EditarContrasena").modal("show");
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
