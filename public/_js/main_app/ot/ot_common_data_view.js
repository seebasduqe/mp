var formulario = $('#ot_form');
formulario.validacion();
$(document).ready(function () {
    $('#btnSubmit').click(function (e) {
        e.preventDefault();
        if (formulario.valida()) {
            formulario.submit();

        }

    });

    $("#success-container").fadeTo(3000, 500).slideUp(500, function () {
        $("#success-container").slideUp(500);
    });
});