$(document).ready(function () {
    var table2 = $('#newsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        "lengthMenu": [10, 25, 50],
        "responsive": true,
        // "iDisplayLength": 2,
        "ajax": {
            "url": $('#newsTable').attr('data-url'),
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
            {
                "data":"id"
            },
            {
                "data": "title"
            },
            {
                "data": "category_id"
            },
            {
                "data": "city_id"
            },
            {
                "data": "status",
            },
            {
                "data": "date",
            },
            {
                "data": "action"
            }
        ]
    });
});
