"use strict";
var DatatablesDataSourceHtml = function () {

    var initIndustriesTable = function () {
        var table = $('#industriesTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            "language": {
                searchPlaceholder: " Id or Industries"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#industriesTable').attr('data-url'),
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
            initIndustriesTable();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});