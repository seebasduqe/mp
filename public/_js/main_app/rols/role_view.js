var formulario = $('#role_form');
formulario.validacion();

$('#btnSubmit').click(function (e) {
    e.preventDefault();
    if (formulario.valida()) {
        formulario.submit();
    }

});

