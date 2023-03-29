$(document).ready(function () {

    var formulario = $('#hour_price_client_form');
    formulario.validacion();

    $('input[name="pvp"]').inputmask('decimal');
    $('input[name="cost"]').inputmask('decimal');

    $('#btnHourPriceSubmit').click(function (e) {
        e.preventDefault();
        if (formulario.valida()) {
            formulario.submit();

        }

    });

});
