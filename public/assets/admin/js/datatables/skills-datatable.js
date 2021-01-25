"use strict";
var DatatablesDataSourceHtml = function () {

    var initSkillsTable = function () {
        var table = $('#skillsTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            "language": {
                searchPlaceholder: " Id or Skill"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#skillsTable').attr('data-url'),
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
                { "data": "category" },
                { "data": "name" },
                { "data": "is_active" },
                { "data": "action" }
            ]
        });
    };

    return {
        init: function () {
            initSkillsTable();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});