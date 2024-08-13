function validarNumero(event) {
    var key = event.key;

    if (event.target.type === 'text') {
        // Permite las teclas Tab y Backspace
        if (key === 'Tab' || key === 'Backspace') {
            return;
        }

        if (!/^\d$/.test(key) && key !== '.') {
            event.preventDefault();
        }

        var fieldValue = event.target.value;
        if (key === '.' && fieldValue.endsWith('.')) {
            event.preventDefault();
        }
    }
}
$(document).ready(function() {
    $("#Material").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "../Acciones/buscarMaterial.php",
                method: "POST",
                data: {
                    consulta: request.term
                },
                dataType: "json",
                success: function(data) {
                    var opciones = data.map(function(producto) {
                        return {
                            label: producto.id + " - " + producto.den,
                            value: producto.id,
                            id: producto.id,
                            id2: producto.id2 // Agregar el ID2 del Material
                        };
                    });
                    response(opciones);
                },
                error: function() {
                    alert("Error al buscar productos.");
                }
            });
        },
        select: function(event, ui) {
            $("#MaterialCodigo").val(ui.item.id2);
        }
    });
});

window.addEventListener('load', function() {
    var loader = document.getElementById('loader');
    loader.style.display = 'none';
});

$("#btnRegistrarCambiosComponente").on("click", function() {
    var MaterialActual = $("#MaterialActual").val();
    var ComponenteActual = $("#ComponenteActual").val();
    var Material = $("#Material").val();
    var MaterialCodigo = $("#MaterialCodigo").val();
    var NumeroComponente = $("#NumeroComponente").val();
    var Descripcion = $("#Descripcion").val();
    var Unidad = $("#Unidad").val();
    var PesoResinaGR = $("#PesoResinaGR").val();
    var RamalPorcentaje = $("#RamalPorcentaje").val();
    var ScrapPorcentaje = $("#ScrapPorcentaje").val();
    var PesoRecinaKilogramos = $("#PesoRecinaKilogramos").val();
    var PesoScrapKilogramos = $("#PesoScrapKilogramos").val();

    $.ajax({
        type: "POST",
        url: "../Acciones/guardarCambiosComponentes.php",
        data: {
            MaterialActual: MaterialActual,
            ComponenteActual: ComponenteActual,
            Material: Material,
            MaterialCodigo: MaterialCodigo,
            NumeroComponente: NumeroComponente,
            Descripcion: Descripcion,
            Unidad: Unidad,
            PesoResinaGR: PesoResinaGR,
            RamalPorcentaje: RamalPorcentaje,
            ScrapPorcentaje: ScrapPorcentaje,
            PesoRecinaKilogramos: PesoRecinaKilogramos,
            PesoScrapKilogramos: PesoScrapKilogramos
        },
        success: function(response) {

            Swal.fire({
                icon: 'success',
                title: 'Componente editado exitosamente',
                text: 'Cargando...',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = 'componentes.php';
            });

        },
        error: function() {
            alert("Ha ocurrido un error al editar el Componente.");
        }
    });
});
