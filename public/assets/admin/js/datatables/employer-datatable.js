"use strict";
var DatatablesDataSourceHtml = function () {

    var initEmployerPostTable = function () {
        var table = $('#employerPostTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            "responsive": true,
            "dom": 'lBfrtip',
            "buttons" : [
                            {
                                extend : 'excel',
                                text : '<span><i class="fas fa-file-export"></i> Excel Export</span>',
                                title: 'Employer',
                                className : 'btn btn-success',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5]
                                }
                            }
                    ],
            "language": {
                searchPlaceholder: " Id or Employer"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#employerPostTable').attr('data-url'),
                "dataType": "json",
                "type": "POST",
                "data":  {
                    // return $.extend({}, d, {});
                    company_type : $('#companyType').val(),
                    industries : $('#industries').val(),
                    category : $('#category').val(),
                    city : $('#city').val()
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columns": [{
                "data": "id"
            },
            {
                "data": "name"
            },
            {
                "data": "email"
            },
            {
                "data": "mobile"
            },
            {
                "data": "no_of_job_post"
            },
            {
                "data": "applied_no_of_job_post"
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
            ]
        });
        table.buttons().container().appendTo($('#buttons'));
    };

    return {
        init: function () {
            initEmployerPostTable();
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

    var companyType = $('.select2companytype');

    companyType.select2({
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
                            text: item.company_type,
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
        $('#employerPostTable').DataTable().destroy();
        DatatablesDataSourceHtml.init();
    });

    $("#btn_clear").click(function(){
        $('.select2companytype').val('').trigger('change');
        $('.select2').val('').trigger('change');
        $('#employerPostTable').DataTable().destroy();
        DatatablesDataSourceHtml.init();
    });
});