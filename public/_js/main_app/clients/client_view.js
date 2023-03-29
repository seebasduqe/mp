var formulario = $('#clients_form');
formulario.validacion();

$('#btnClientSubmit').click(function (e) {
    e.preventDefault();
    if (formulario.valida()) {
        formulario.submit();

    }

});

