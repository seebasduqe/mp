var oTable_provinces;
$(document).ready(function () {




    oTable_provinces = $('#provinceTbl').DataTable({
        "orderCellsTop": true,
        "stateSave": true,
        "scrollX": true,
        "scrollY": 600,
        "scroller": {
            "loadingIndicator": true
        },
        "language": { "url": http_web_root + '_js/datatables/es.datatables.json' },
        "lengthMenu": [5, 10, 15, 20],
        "pageLength": 15,
        "order": [[0, 'desc']],
        "autoWidth": false,
        "processing": true,
        "bServerSide": false,
        "columnDefs": [
            { "targets": 0, "visible": true, "searchable": true, "bSortable": true, "sClass": "", "width": "5%" },//province_id
            { "targets": 1, "visible": true, "searchable": true, "bSortable": true, "sClass": "", "width": "45%" },//province_name
            { "targets": 2, "visible": true, "searchable": true, "bSortable": true, "sClass": "", "width": "20%" },//phone_prefix
            { "targets": 3, "visible": true, "searchable": true, "bSortable": true, "sClass": "", "width": "20%" },//code_prefix            
            { "targets": 4, "visible": true, "searchable": false, "bSortable": false, "sClass": "", "width": "10%" }
        ],
        initComplete: function () {
            var api = this.api();
            //hacemos un primer bucle para los th que no tienen filtros que se quite el texto ya que arriba hacemos un clone
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    var cell_clear = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    $(cell_clear).text('');
                });
            // For each column
            api
                .columns([])
                .eq(0)
                .each(function (colIdx) {

                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();

                    if ($(api.column(colIdx).header()).index() >= 0) {
                        $(cell).html('<input class="form-control" type="text" placeholder="' + title + '"/>');
                    }


                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();

                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();

                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });


                });



            let filter_columns = [];

            $(".filters th").each(function (i) {
                if (filter_columns.includes(i)) {
                    var select = $('<select  class="form-control"><option value=""></option></select>')
                        .appendTo($(this).empty())
                        .on('change', function () {
                            oTable_provinces.column(i)
                                .search($(this).val())
                                .draw();
                        });

                    oTable_provinces.column(i).data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                }
            });
        },

        "drawCallback": function (settings) {
            $('#provinceTbl [data-toggle="tooltip"]').tooltip();
        }
    });








    // delete client ajax
    $(document).on('click', '.delete_province', function (e) {


        let province_id = $(this).attr('data-attr');
        let url_parsed = check_priovince_has_clients_url.replace('province_id', province_id);
        let params = {
            province_id,
            '_token': csrf_token
        };
        $.ajax({
            data: params,
            url: url_parsed,
            type: 'GET',

            success: function (response) {
                let message = '';
                if (response == true) {
                    message = `<br> La provincia que quieres eliminar esta assignada a diversos registros. <br><br>
                    La eliminación de la provincia es irreversible. <br><br>
                    ¿Estás seguro de continuar con la eliminación de la provincia? `;

                } else {
                    message = '<br> ¿Estás seguro que quieres eliminar la provincia?';
                }

                showMessageCard(province_id, message, e);

            }

        });




    });


    function showMessageCard(province_id, message, e) {
        $.confirm({
            title: 'Eliminar Provincia',
            content: message,
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
                            province_id,
                            '_token': csrf_token

                        };
                        $.ajax({
                            data: params,
                            url: delete_province_url,
                            type: 'PUT',

                            success: function (response) {
                                //$('#modal_content_email').html(response);

                                $('#row_province_' + province_id).hide();

                            }

                        });
                    }
                }
            }
        });
    }
});
