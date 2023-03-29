
/*
$("#add_document").click(function () {
    $(".group_documents:first").clone().removeAttr('id').appendTo("#main_row").find("input").val("");
});
*/
var formulario = $('#person_document_form');
formulario.validacion();

$('#save_document').click(function (e) {

    e.preventDefault();
    if (formulario.valida()) {
        formulario.submit();

    }

});
/*
function delete_row(e) {
    e.closest('.group_documents').remove();
}*/



// delete document ajax
$(document).on('click', '.delete_document', function (e) {


    let document_id = $(this).attr('data-attr');

    $.confirm({
        title: 'Eliminar Documento',
        content: '¿Estas seguro que quieres eliminar la provincia?',
        buttons: {
            cancelar: {
                text: 'Cancelar',
                btnClass: 'btn-red',
            },
            confirmar: {
                text: 'Eliminar',
                btnClass: 'btn-dark',
                action: function () {
                    e.preventDefault();

                    let params = {
                        document_id,
                        '_token': csrf_token

                    };
                    $.ajax({
                        data: params,
                        url: delete_document,
                        type: 'PUT',

                        success: function (response) {
                            //$('#modal_content_email').html(response);

                            $('#row_document_' + document_id).hide();

                        }

                    });
                }
            }
        }
    });



});

$(document).on('change', '#document_file', function () {
    $('label[for="document_file"]').html($(this).val());
});

$("#success-container").fadeTo(3000, 500).slideUp(500, function () {
    $("#success-container").slideUp(500);
});