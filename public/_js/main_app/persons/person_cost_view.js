$(document).ready(function () {


    var formulario = $('#form_cost_hour_person');
    formulario.validacion();


    var num = $('input[data-name=type_cost]').length;

    for (let i = 1; i <= num; i++) {
        $('input[name="type_' + i + '_cost"]').inputmask('decimal');
    }


    /*$('input[name="type_1_cost"]').inputmask('9{2}\.9{2}€', {
        placeholder: '00.00€'
    });*/

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
