var formulario = $('#provider_form');
formulario.validacion();

$('#btnProviderSubmit').click(function (e) {
    e.preventDefault();
    if (formulario.valida()) {
        formulario.submit();

    }

});

