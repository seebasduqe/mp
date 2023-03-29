$(document).ready(function () {

    if (error_from_modal) {
        $('#modalHours').modal('show');
    }

    var formulario2 = $('#bulk_load_hours_form');


    $('input[name="hours_modal"]').inputmask('decimal');

    $('input[name="price_modal"]').inputmask('decimal');

    $('#saveBulkLoadHours').click(function (e) {
        formulario2.validacion();
        e.preventDefault();
        if (formulario2.valida()) {
            formulario2.submit();
        }
    });

    $('#selectPersonModal').on('change', function () {

        let person_id = $('#selectPersonModal').val();
        let hour_type_id = $('#selectTypeHourModal').val();

        if (person_id != '' && hour_type_id != '') {
            getPersonHourPriceModal(person_id, hour_type_id);
        }


    });

    $('#selectTypeHourModal').on('change', function () {

        let person_id = $('#selectPersonModal').val();
        let hour_type_id = $('#selectTypeHourModal').val();

        if (person_id != '' && hour_type_id != '') {
            getPersonHourPriceModal(person_id, hour_type_id);
        }


    });
});

function getPersonHourPriceModal(person_id, hour_type_id) {

    let params = {
        person_id,
        hour_type_id,
        '_token': csrf_token

    };
    $.ajax({
        data: params,
        url: get_person_hour_price,
        type: 'GET',

        success: function (response) {

            if (response == 0) {

                $('input[name="price_modal"]').val('');
            }
            else {

                $('input[name="price_modal"]').val(response);
            }
        }

    });
}