
window.addEventListener('load', function () {
    var loader = document.getElementById('loader');
    loader.style.display = 'none';
});

$('#TablaTodosMateriales').DataTable({
    language: espanol
});
// Cuando se hace clic en el botón "btncerrar"
$('.btncerrar').on('click', function () {
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Quieres cerrar la sesión?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, cerrar sesión',
        confirmButtonColor: '#28a745;',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                type: "POST",
                url: "Acciones/cerrarSesion.php",
                success: function (response) {
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
                error: function () {
                    alert("Ha ocurrido un error al cerrar la sesión.");
                }
            });
        }
    });
});
