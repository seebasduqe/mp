var formulario = $('#sub_company_form');
formulario.validacion();

$('#btnUserSubmit').click(function (e) {
    e.preventDefault();
    if (formulario.valida()) {
        formulario.submit();

    }

});

