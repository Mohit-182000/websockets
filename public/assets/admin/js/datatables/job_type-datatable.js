"use strict";
var DatatablesDataSourceHtml = function () {

    var initJobTypeTable = function () {
        var table = $('#job_typeTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            "language": {
                searchPlaceholder: " Id or Job Type"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#job_typeTable').attr('data-url'),
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
                "data": "is_active"
            },
            {
                "data": "action"
            }
            ]
        });
    };

    return {
        init: function () {
            initJobTypeTable();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});