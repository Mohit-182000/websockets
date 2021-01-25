"use strict";
var DatatablesDataSourceHtml = function () {

    var initJobPostTable = function () {
        var table = $('#jobPostTable').DataTable({
            // "scrollX": true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            // "lengthMenu":  [10, 25, 50],
            "responsive": true,
            "scrollX" : true,
            "dom": 'lBfrtip',
            "buttons" : [
                            {
                                extend : 'excel',
                                text : '<span><i class="fas fa-file-export"></i> Excel Export</span>',
                                className : 'btn btn-success',
                                title: 'Job-post',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
                                }
                            }
                    ],
            "language": {
                searchPlaceholder: " Id or Job"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#jobPostTable').attr('data-url'),
                "dataType": "json",
                "type": "POST",
                "data": {
                    // return $.extend({}, d, {});
                    job_type : $('#jobType').val(), 
                    category : $('#category').val(), 
                    city : $('#city').val(), 
                    experience : $('#experience').val(), 
                    qualification : $('#qualification').val(),
                    job_status_select2 : $('#jobStatus').val()
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columns": [{
                "data": "id"
            },
            {
                "data": "company_name"
            },
            {
                "data": "job_title"
            },
            {
                "data": "job_description"
            },
            {
                "data": "category"
            },
            {
                "data": "city"
            },
            {
                "data": "experience"
            },
            {
                "data": "qualification"
            },
            {
                "data": "approve_status"
            },
            {
                "data": "is_active"
            },
            {
                "data": "action"
            }
            ]
        });
        table.buttons().container().appendTo($('#buttons'));
    };

    return {
        init: function () {
            initJobPostTable();
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

    var companyType = $('.select2-company-type');

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

    var jobStatus = $('.jobStatusSelect2');

    jobStatus.html('').select2({
        theme: 'bootstrap4',
        data : [
            {
                id: '', 
                text: ''
            },
            {
                id: 'Approved', 
                text: 'Approved'
            },
            {
                id: 'Pending', 
                text: 'Pending'
            },
            {
                id: 'Expired', 
                text: 'Job Closed'
            }
        ],
        allowClear: true,
        
    });

    $("#search").click(function(){
        $('#jobPostTable').DataTable().destroy();
        DatatablesDataSourceHtml.init();
    });

    $("#btn_clear").click(function(){
        $('.select2').val('').trigger('change');
        $('.jobStatusSelect2').val('').trigger('change');
        $('#jobPostTable').DataTable().destroy();
        DatatablesDataSourceHtml.init();
    });
});