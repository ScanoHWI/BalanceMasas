function validarNumero(event) {
    var key = event.key;

    if (event.target.type === 'text') {
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
    var formularioOriginal = $(".formulario").first().clone(); // Clona el primer formulario

    $("#agregarFormulario").click(function() {
        var nuevoFormulario = formularioOriginal.clone();
        $("#formularios").append(nuevoFormulario);
        nuevoFormulario.find(".eliminarFormulario").click(function() {
            eliminarFormulario(nuevoFormulario);
        });

        // Adjunta la función de autocompletado al campo Material en el nuevo formulario
        nuevoFormulario.find(".material-autocomplete").autocomplete({
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
                                label: producto.id + ' - ' + producto.den,
                                value: producto.id,
                                id2: producto.id2
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
                var parentForm = $(this).closest("form");
                parentForm.find(".material-id").val(ui.item.id2);
            }
        });
    });

    // Función para eliminar un formulario con confirmación
    function eliminarFormulario(formulario) {
        if ($(".formulario").length > 1) {
            if (confirm("¿Seguro que deseas eliminar este componente?")) {
                formulario.remove();
            }
        } else {
            alert("No puedes eliminar el último formulario.");
        }
    }

    // Registrar todos los formularios
    $("#registrarTodos").click(function() {
        var formularios = $(".formulario");
        var formDataArray = [];

        formularios.each(function(index, formulario) {
            var data = {
                Material: $(formulario).find("#Material").val(),
                MaterialCodigo: $(formulario).find("#MaterialCodigo").val(),
                NumeroComponente: $(formulario).find("#NumeroComponente").val(),
                Descripcion: $(formulario).find("#Descripcion").val(),
                Unidad: $(formulario).find("#Unidad").val(),
                PesoResinaGR: $(formulario).find("#PesoResinaGR").val(),
                RamalPorcentaje: $(formulario).find("#RamalPorcentaje").val(),
                ScrapPorcentaje: $(formulario).find("#ScrapPorcentaje").val(),
                PesoRecinaKilogramos: $(formulario).find("#PesoRecinaKilogramos").val(),
                PesoScrapKilogramos: $(formulario).find("#PesoScrapKilogramos").val()
            };

            console.log(data)
            ///NO ESTA REGISTRANDO LA DESCRIPCION, UNIDAD, NI EL PESORESINAGR

            formDataArray.push(data);
        });

        // Validar los datos en el cliente antes de enviarlos al servidor
        var isValid = true;
        formDataArray.forEach(function(data) {
            if (!data.Material || !data.NumeroComponente || !data.Descripcion || !data.Unidad || !data.PesoResinaGR || !data.RamalPorcentaje || !data.ScrapPorcentaje || !data.PesoRecinaKilogramos || !data.PesoScrapKilogramos) {
                isValid = false;
            }
        });

        if (!isValid) {
            alert("Por favor, complete todos los campos en todos los formularios.");
        } else {
            $.ajax({
                url: "../Acciones/insertarComponente.php",
                method: "POST",
                data: {
                    formDataArray: JSON.stringify(formDataArray)
                },
                success: function(response) {
                    alert("Datos registrados con éxito.");
                    location.reload();
                },
                error: function() {
                    alert("Error al registrar los datos.");
                }
            });
        }
    });


    $(".material-autocomplete").autocomplete({
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
                            label: producto.id + ' - ' + producto.den,
                            value: producto.id,
                            id2: producto.id2
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
            var parentForm = $(this).closest("form");
            parentForm.find(".material-id").val(ui.item.id2);
        }
    });
});

window.addEventListener('load', function() {
    var loader = document.getElementById('loader');
    loader.style.display = 'none';
});
