"use strict";
var DatatablesDataSourceHtml = function () {

    var initLocalityTable = function () {
        var table = $('#localityTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            "language": {
                searchPlaceholder: " Id or Locality"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#localityTable').attr('data-url'),
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
                { "data": "state" },
                { "data": "city" },
                { "data": "locality"},
                { "data": "is_active" },
                { "data": "action" }
            ]
        });
    };

    return {
        init: function () {
            initLocalityTable();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});