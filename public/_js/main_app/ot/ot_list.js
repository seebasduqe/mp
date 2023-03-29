var oTable_ot;
var fmt = new DateFormatter();
var domLayout = "<'row pb-2'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'p>>" +
    "<'row pb-2'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
$(document).ready(function () {

    $.fn.dataTable.ext.errMode = 'none';


    oTable_ot = $('#otTbl').DataTable({
        "dom": domLayout,
        "orderCellsTop": true,
        "stateSave": true,
        "scrollX": true,
        "scrollY": 600,
        "scroller": {
            "loadingIndicator": true
        },
        "language": { "url": http_web_root + '_js/datatables/es.datatables.json' },
        "lengthMenu": [5, 10, 15, 20, 50, 100, 500],
        "pageLength": 15,
        "order": [[0, 'desc']],
        "autoWidth": false,
        "processing": true,
        "errMode": 'none',
        "bServerSide": true,
        "columnDefs": [
            { "targets": 0, "visible": true, "searchable": true, "bSortable": true, "sClass": "text-center", "width": "40px" },
            { "targets": 1, "visible": true, "searchable": true, "bSortable": true, "sClass": "text-center", "width": "80px" },
            { "targets": 2, "visible": true, "searchable": true, "bSortable": true, "sClass": "text-center", "width": "80px" },
            { "targets": 3, "visible": true, "searchable": true, "bSortable": true, "sClass": "text-center", "width": "138px" },
            { "targets": 4, "visible": true, "searchable": false, "bSortable": true, "sClass": "text-center", "width": "138px" },
            { "targets": 5, "visible": true, "searchable": false, "bSortable": true, "sClass": "text-center", "width": "138px" },
            { "targets": 6, "visible": true, "searchable": false, "bSortable": true, "sClass": "text-center", "width": "138px" },
            { "targets": 7, "visible": true, "searchable": false, "bSortable": false, "sClass": "text-center", "width": "70px" },
            { "targets": 8, "visible": true, "searchable": false, "bSortable": false, "sClass": "text-center", "width": "70px" },
            { "targets": 9, "visible": true, "searchable": false, "bSortable": false, "sClass": "text-center", "width": "70px" },
            { "targets": 10, "visible": true, "searchable": true, "bSortable": false, "sClass": "text-center", "width": "70px" },
            { "targets": 11, "visible": true, "searchable": false, "bSortable": false, "sClass": "text-center", "width": "70px" },
            { "targets": 12, "visible": true, "mDataProp": null, "searchable": false, "bSortable": false, "sClass": "text-center", "width": "70px" }

        ],
        "ajax": {
            "url": get_ot_list_url,
            "type": "POST",
            "datatype": "json",
            "data": function (obj) {
                obj.action = "list";

                obj.filterSearch = $('#filterSearch').val();
                obj.filterDaterange = $('#filterDaterange').val();
                obj.filterClient = $('#filterClient').val();
                obj.filterPerson = $('#filterPerson').val();
                obj.filterDestinyType = $('#filterDestinyType').val();
                obj.filterStatus = $('#filterStatus').val();
                obj.filterYear = $('#filterYear').val();
                obj.filterQuarter = $('#filterQuarter').val();
                obj._token = csrf_token;
            },

            "complete": function (data) {

                if (data['responseJSON'].hasOwnProperty('status')) {
                    if (data['responseJSON'].status == false) {
                        if (data['responseJSON'].hasOwnProperty('redirect')) {
                            location.href = data['responseJSON'].redirect;
                        }
                    }
                }

                printOtResume(data.responseJSON.arrayResume);


            }
        },
        "aoColumns": [
            { mData: "ot_id" },
            { mData: "ot_number_info" },
            { mData: "ot_number" },
            { mData: "description" },
            { mData: "type" },
            { mData: "client_name" },
            { mData: "ot_status_id" },
            { mData: "person_name" },
            { mData: "destiny_name" },
            { mData: "related_ot_number" },
            { mData: "delivery_note_information" },
            { mData: "creation_date" },
            { mData: "ot_related_id" },


        ],
        "fnCreatedRow": function (nRow, aData, iDataIndex) {



            $(nRow).attr('data-id', aData.ot_id);

            $(nRow).attr('id', 'row_ot_' + aData.ot_id);

            $('td:eq(4)', nRow).html(
                '<span class="" data-action="toggleStatus" data-toggle="tooltip" data-html="true"  data-placement="top" >' + getTypeName(aData.type) + '</span>'
            );



            var obj_select = '<select  data-id="' + aData.ot_id + '" class="form-control selectChangeStatus">';
            obj_select += '<option  value="">Cualquier estado</option>';
            $.each(array_ot_status, function (key, value) {

                if (value.ot_status_id == aData.ot_status_id) {
                    obj_select += '<option value="' + value.ot_status_id + '" selected>' + value.name + '</option>';
                } else {
                    obj_select += '<option value="' + value.ot_status_id + '" >' + value.name + '</option>';
                }
            });
            obj_select += '</select>';

            $('td:eq(6)', nRow).html(obj_select);

            if (aData.ot_related_id != null) {
                //ot_related_id
                ot_edit_related_ot = ot_edit_url.replace('ot_id', aData.ot_related_id);
                $('td:eq(9)', nRow).html(
                    `
                <a class="" href="${ot_edit_related_ot}" title="Editar ot">${aData.related_ot_number}</a>

                `
                );
            }

            ot_edit_url_new = ot_edit_url.replace('ot_id', aData.ot_id);
            $('td:eq(12)', nRow).html(
                `
                <a class="btn btn-primary" href="${ot_edit_url_new}" title="Editar ot"> <i class="fas fa-edit"></i></a>
                <button type="button" class="btn btn-danger delete_ot" data-attr="${aData.ot_id}" id="delete_ot_${aData.ot_id}" title="Eliminar ot"><i class="fas fa-trash-alt"></i></button>
                `
            );
        },
        "drawCallback": function (settings) {
            $('#clientTbl [data-toggle="tooltip"]').tooltip();
        }
    });
    // ----------------------  iniciador de datatable ------------------------------
    oTable_ot.on('draw.dt', function () {

        var d1 = '';
        var tooltip_tag = '';
        oTable_ot.column(11).nodes().each(function (cell, i) {
            if (cell.innerHTML != '') {
                tooltip_tag = '<span data-toggle="tooltip" data-placement="bottom" title="$2">$1</span>';
                d1 = fmt.formatDate(cell.innerHTML, 'Y-m-d H:i:s , d/m/Y , l j  F  Y ');
                d1 = d1.split(',');
                tooltip_tag = tooltip_tag.replace('$2', d1[2]);
                tooltip_tag = tooltip_tag.replace('$1', d1[1]);
                //cell.innerHTML = tooltip_tag;
                $(cell).html(tooltip_tag);
            }

        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip(); //relanzar para dom datatable
        });
    });
    // ----------------------- Event de click on chnage status --------------------------------
    $('#otTbl' + ' tbody').on('change', 'select', function () {

        var ot_id = $(this).attr('data-id');
        var status_ot_id = $(this).val();

        let params = {
            ot_id,
            status_ot_id,
            '_token': csrf_token

        };
        $.ajax({
            data: params,
            url: change_ot_status,
            type: 'PUT',

            success: function (response) {

            }

        });
    });
    function getTypeName(type_id) {
        return type_id == 1 ? 'Administración'
            : type_id == 2 ? 'General'
                : type_id == 3 ? 'Servicio'
                    : '';
    }


});

// ------------------------ Event click on filterBtn ---------------------------
$('#filterBtn').click(function () {
    let filter_datarange = $('#filterDaterange').val();
    let filter_year = $('#filterYear').val();
    let filter_quarter = $('#filterQuarter').val();
    if (filter_datarange != '' && filter_quarter != '') {
        $("#warning-container").show();
        $("#warning-container-text").text('No se puede filtrar por fecha y por trimestre a la vez por favor deselecciona alguna opción.');
        closeErrorModal();
    }
    else if (filter_datarange != '' && filter_year != '') {
        $("#warning-container").show();
        $("#warning-container-text").text('No se puede filtrar por fecha y por año a la vez por favor deselecciona alguna opción.');
        closeErrorModal();
    }
    else {
        oTable_ot.draw(true);
    }

});
// ------------------------ Event click on resetBtn ---------------------------
$('#resetBtn').click(function () {
    $('#filterSearch,#filterDaterange,#filterClient,#filterPerson,#filterDestinyType,#filterStatus,#filterYear,#filterQuarter').val('');
    oTable_ot.draw(true);
});


$('.export_excel').click(function () {

    exportExcel();

});

function exportExcel() {
    /* Generar excel a partir de la tabla html */
    var wb = XLSX.utils.table_to_book(document.getElementById('otTbl'), { sheet: "Excel" });

    /* generate excel and download */
    var f = new Date();
    var day = f.getDate();
    var month = f.getMonth() + 1;
    var year = f.getFullYear();
    XLSX.writeFile(wb, 'ot_mp_' + year + '_' + month + '_' + day + '.xlsx');
}

function printOtResume(data) {

    if (Object.keys(data).length > 0) {
        $("#ot_count").text(data.ot_count);
        $("#total_sales_amount").text(data.total_sales_amount);
        $("#total_theoretical_purchase_amount").text(data.total_theoretical_purchase_amount);
        $("#total_amount_real_cost").text(data.total_amount_real_cost);
        $("#theoretical_margin").text(data.theoretical_margin);
        $("#real_margin").text(data.real_margin);
    }
    else {
        $("#ot_count").text('0');
        $("#total_sales_amount").text('0');
        $("#total_theoretical_purchase_amount").text('0');
        $("#total_amount_real_cost").text('0');
        $("#theoretical_margin").text('0');
        $("#real_margin").text('0');
    }

}
function closeErrorModal() {
    $("#warning-container").fadeTo(4000, 500).slideUp(500, function () {
        $("#warning-container").slideUp(500);
    });
}
$("#error-container").fadeTo(3000, 500).slideUp(500, function () {
    $("#error-container").slideUp(500);
});

$(document).on('click', '.delete_ot', function (e) {


    let ot_id = $(this).attr('data-attr');

    $.confirm({
        title: 'Eliminar orden de trabajo',
        content: '¿Estas seguro que quieres eliminar la orden de trabajo?',
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
                        ot_id,
                        '_token': csrf_token

                    };
                    $.ajax({
                        data: params,
                        url: delete_ot_url,
                        type: 'PUT',

                        success: function (response) {

                            $('#row_ot_' + ot_id).hide();

                        }

                    });
                }
            }
        }
    });



});


