var form_login = $("#loginForm");
form_login.validacion();

$("#send_form").click(function (e) {

    e.preventDefault();
    if (!form_login.valida()) {
        return false;
    } else {
        $("#loginForm").submit();
    }
});

$("input[type=password]").keydown(function (e) {
    if (e.keyCode == 13) {
        $("#send_form").click();
    }
});

$("#error-login-alert").fadeTo(2000, 500).slideUp(500, function () {
    $("#error-login-alert").slideUp(500);
});