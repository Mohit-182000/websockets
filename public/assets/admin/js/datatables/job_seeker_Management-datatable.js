"use strict";
var DatatablesDataSourceHtml = function () {

    var initJobJobSeekerTable = function () {
        var table = $('#jobJobSeekerTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            'scrollX': true,
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            "responsive": true,
            "dom": 'lBfrtip',
            "buttons" : [
                            {
                                extend : 'excel',
                                text : '<span><i class="fas fa-file-export"></i> Excel Export</span>',
                                title: 'Job-seeker',
                                className : 'btn btn-success',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                                }
                            }
                    ],
            "language": {
                searchPlaceholder: " Id or Job Seeker"
            },
            "ajax": {
                "url": $('#jobJobSeekerTable').attr('data-url'),
                "dataType": "json",
                "type": "POST",
                "data": {
                    // return $.extend({}, d, {});
                    category : $('#category').val(),
                    city : $('#city').val(),
                    qualification : $('#qualification').val()
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columns": [
                {
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "category"
                },
                {
                    "data": "city"
                },
                {
                    "data": "qualification"
                },
                {
                    "data": "experience"
                },
                {
                    "data": "mobile"
                },
                {
                    "data": "applied_count"
                },
                {
                    "data": "is_active"
                },
                {
                    "data": "action"
                },
                {
                    "data": "chat"
                }
            ],
        });
        table.buttons().container().appendTo($('#buttons'));
    };

    return {
        init: function () {
            initJobJobSeekerTable();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();

    var select2 = $('.select2');

    select2.select2({
        theme: 'bootstrap4',

        allowClear: true,
        ajax: {
            url: function () {
                return $(this).data('url');
            },
            data: function (params) {
                return {
                    search: params.term,
                };
            },
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.name,
                            otherfield: item,
                        };
                    }),
                }
            },
            //cache: true,
            delay: 250
        },
        // minimumInputLength: 2,
    });

    $("#search").click(function(){
        $('#jobJobSeekerTable').DataTable().destroy();
        DatatablesDataSourceHtml.init();
    });

    $("#btn_clear").click(function(){
        $('.select2').val('').trigger('change');
        $('#jobJobSeekerTable').DataTable().destroy();
        DatatablesDataSourceHtml.init();
    });
});