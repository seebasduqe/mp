var formulario = $('#person_tax_social_data_form');
formulario.validacion();

$(document).ready(function () {
    $('input[name="bank_account"]').inputmask('a{2}9{2} 9{4} 9{4} 9{2} 9{10}', {
        placeholder: 'ESXX XXXX XXXX XX XXXXXXXXXX'
    });


    $.Validacion_formulario.incluye_opcion('bank_account', {
        verifica: function (input) {
            if ($(input).val() == '')
                return true;

            if ($('input[name="bank_account"]').inputmask('isComplete')) {
                return true;
            }
            return false;
        },
        alerta: 'IBAN erroneo'
    });


    $('#btnSubmit').click(function (e) {
        e.preventDefault();
        if (IBANValidation($('input[name="bank_account"]').val())) {
            if (formulario.valida()) {
                formulario.submit();
            }
        } else {

            $('#bank_account').addClass('is-invalid');

            if ($('#error_format').length == 0) {
                $('#bank_account').parent().append('<div id="error_format" class="invalid-feedback" style="display:block;">El número de cuenta introducido es erróneo.</div>');
            }


        }
    });

    $("#success-container").fadeTo(3000, 500).slideUp(500, function () {
        $("#success-container").slideUp(500);
    });

});



