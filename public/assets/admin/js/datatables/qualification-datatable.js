"use strict";
var DatatablesDataSourceHtml = function () {

    var initQualificationTable = function () {
        var table = $('#qualificationTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            "language": {
                searchPlaceholder: " Id or Qualification"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#qualificationTable').attr('data-url'),
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
            initQualificationTable();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});