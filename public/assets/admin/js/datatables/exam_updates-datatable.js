"use strict";
var DatatablesDataSourceHtml = function () {

    var initExamUpdatesTable = function () {
        var table = $('#exam_updatesTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            "language": {
                searchPlaceholder: " Id or Exam"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#exam_updatesTable').attr('data-url'),
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
                "data": "no_of_post"
            },
            {
                "data": "last_date_of_exam"
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
            initExamUpdatesTable();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});