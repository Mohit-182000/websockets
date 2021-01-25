"use strict";
var DatatablesDataSourceHtml = function () {

    var initsalaryDatable = function () {
        var table = $('#salaryDatable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            "language": {
                searchPlaceholder: " Id or Salary"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#salaryDatable').attr('data-url'),
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    return $.extend({}, d, {});
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columns": [
                { "data": "id" },
                { "data": "salary" },
                { "data": "is_active" },
                { "data": "action" }
            ]
        });
    };

    return {
        init: function () {
            initsalaryDatable();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});
