"use strict";
var DatatablesDataSourceHtml = function () {

    var initEmployerJobPostTable = function () {
        var table = $('#employerJobPostTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            "language": {
                searchPlaceholder: " Id or Job"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#employerJobPostTable').attr('data-url'),
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    return $.extend({}, d, {});
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columns": [{
                "data": "id"
            },
            {
                "data": "job_title"
            },
            {
                "data": "vacancy"
            },
            {
                "data": "salary"
            },
            {
                "data": "action"
            }
            ]
        });
    };

    var initUserApply = function () {
        var table = $('#userApply').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            "language": {
                searchPlaceholder: " Id or Employer"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#userApply').attr('data-url'),
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    return $.extend({}, d, {});
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
                "data": "qualification"
            },
            {
                "data": "excepted_salary"
            },
            {
                "data": "action"
            }
            ]
        });
    };

    return {
        init: function () {
            initEmployerJobPostTable();
            initUserApply();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});