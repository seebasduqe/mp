var formulario = $('#persons_form');
formulario.validacion();
$(document).ready(function () {
    $('#btnClientSubmit').click(function (e) {
        e.preventDefault();
        if (formulario.valida()) {
            formulario.submit();

        }

    });

    $("#success-container").fadeTo(3000, 500).slideUp(500, function () {
        $("#success-container").slideUp(500);
    });
});