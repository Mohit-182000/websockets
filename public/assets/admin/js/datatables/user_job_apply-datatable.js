"use strict";
var DatatablesDataSourceHtml = function () {

    var initUserJobApplyTable = function () {
        var table = $('#UserJobApplyTable').DataTable({
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
                "url": $('#UserJobApplyTable').attr('data-url'),
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
                "data": "action"
            }
            ]
        });
    };

    return {
        init: function () {
            initUserJobApplyTable();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});