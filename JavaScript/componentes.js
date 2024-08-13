$('#TablaTodosMateriales').DataTable({
    language: espanol,
    paging: false,
    searching: true
});
$(document).ready(function() {

});


$('.Desactivar-Componente').on('click', function() {
    var componenteid = $(this).data('usuario-id');

    Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Quieres desactivar este componente?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, desactivar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                type: "POST",
                url: "../Acciones/desactivarComponente.php",
                data: {
                    componenteid: componenteid
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Componente desactivado exitosamente',
                        text: 'Cargando...',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function() {
                    alert("Ha ocurrido un error al desactivar el Componente.");
                }
            });
        }
    });
});
$('.Activar-Componente').on('click', function() {
    var componenteid = $(this).data('usuario-id2');

    Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Quieres activar este componente?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, activar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // El usuario ha confirmado, procede con la activación del material
            $.ajax({
                type: "POST",
                url: "../Acciones/activarComponente.php",
                data: {
                    componenteid: componenteid
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Componente Activado exitosamente',
                        text: 'Cargando...',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function() {
                    alert("Ha ocurrido un error al activar el Componente.");
                }
            });
        }
    });
});

window.addEventListener('load', function() {
    var loader = document.getElementById('loader');
    loader.style.display = 'none';
});
