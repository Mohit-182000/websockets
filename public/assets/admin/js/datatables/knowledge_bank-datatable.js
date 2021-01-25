"use strict";
var DatatablesDataSourceHtml = function () {

    var initKnowledgeBankTable = function () {
        var table = $('#knowledge_bankTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            "language": {
                searchPlaceholder: " Id or Knowledge Bank"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#knowledge_bankTable').attr('data-url'),
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
                "data": "title"
            },
            {
                "data": "description"
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
            initKnowledgeBankTable();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});