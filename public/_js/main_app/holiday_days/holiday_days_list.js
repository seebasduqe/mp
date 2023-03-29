
$(function () {
    initializeDates();

});

function initializeDates() {
    let params = {
        '_token': csrf_token

    };
    $.ajax({
        data: params,
        url: get_dates_url,
        type: 'GET',

        success: function (response) {


            mountCalendar(response);


        }

    });

}

function mountCalendar(dates) {
    var today = new Date();
    var y = today.getFullYear();
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };

    $.datepicker.setDefaults($.datepicker.regional['es']);

    $('#full-year').multiDatesPicker({

        dateFormat: "dd/mm/yy",
        addDates: dates,
        numberOfMonths: [3, 4],
        defaultDate: '1/1/' + y,
        onSelect: function (date, datepicker) {
            if (date != "") {

                toogleDates(date);
            }
        }
    });
}

function toogleDates(date) {
    let params = {
        '_token': csrf_token,
        date

    };
    $.ajax({
        data: params,
        url: toogle_dates,
        type: 'POST',

        success: function (response) {

        }

    });
}
