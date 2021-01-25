"use strict";
var DatatablesDataSourceHtml = function () {

    var initKnown_LanguagesTable = function () {
        var table = $('#known_languagesTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            "language": {
                searchPlaceholder: " Id or Known Languages"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#known_languagesTable').attr('data-url'),
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
            initKnown_LanguagesTable();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});