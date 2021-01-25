"use strict";
var DatatablesDataSourceHtml = function () {

    var initEmployerJobUserApplyTable = function () {
        var table = $('#employerJobUserApplyTable').DataTable({
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
                "url": $('#employerJobUserApplyTable').attr('data-url'),
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
                "data": "email"
            },
            {
                "data": "mobile"
            },
            {
                "data": "no_of_job_post"
            },
            {
                "data": "action"
            }
            ]
        });
    };

    return {
        init: function () {
            initEmployerJobUserApplyTable();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});