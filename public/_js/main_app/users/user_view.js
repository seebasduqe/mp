var formulario = $('#user_form');
formulario.validacion();

$('#btnUserSubmit').click(function (e) {
    e.preventDefault();
    if (formulario.valida()) {
        if ($('#password').val() !== $('#password2').val()) {
            $('#password2').addClass('is-invalid').parent().append(
                '<div class="invalid-feedback">Las claves no coinciden.</div>'
            );
        } else {
            formulario.submit();
        }
    }
    $('#password2').removeClass('is-invalid is-valid').parent().children('.invalid-feedback').remove();
    if ($('#password').val() !== $('#password2').val()) {
        $('#password2').addClass('is-invalid').parent().append(
            '<div class="invalid-feedback">Las claves no coinciden.</div>'
        );
    } else {
        $('#password2').addClass('is-valid');
    }
});

$('#password2').on('blur click change', function () {
    $('#password2').removeClass('is-invalid is-valid').parent().children('.invalid-feedback').remove();
    if ($('#password').val() !== $('#password2').val()) {
        $('#password2').addClass('is-invalid').parent().append(
            '<div class="invalid-feedback">Las claves no coinciden.</div>'
        );
    } else {
        $('#password2').addClass('is-valid');
    }
});