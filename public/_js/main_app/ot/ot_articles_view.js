$(document).ready(function () {

    var formulario = $('#article_form');
    formulario.validacion();

    $('input[name="unit_price"]').inputmask('decimal');
    $('input[name="attrition"]').inputmask('decimal');
    $('input[name="benefit"]').inputmask('decimal');

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
