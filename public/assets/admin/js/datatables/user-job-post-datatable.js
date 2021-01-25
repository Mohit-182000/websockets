"use strict";
var DatatablesDataSourceHtml = function () {

    var inituserJobsTable = function () {
        var table = $('#userJobsTable').DataTable({
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
                "url": $('#userJobsTable').attr('data-url'),
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
                "data": "company_name"
            },
            {
                "data": "location"
            },
            {
                "data": "applied_on"
            }
            ]
        });
    };

    return {
        init: function () {
            inituserJobsTable();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});