var formulario = $('#provinces_form');
formulario.validacion();

$('#btnProvinceSubmit').click(function (e) {
    e.preventDefault();
    if (formulario.valida()) {
        formulario.submit();

    }

});

