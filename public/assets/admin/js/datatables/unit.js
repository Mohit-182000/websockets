$(document).ready(function () {
    var table2 = $('#unitTable').DataTable({
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        "lengthMenu": [10, 25, 50],
        "responsive": true,
        // "iDisplayLength": 2,
        "ajax": {
            "url": $('#unitTable').attr('data-url'),
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
                "data": "name"
            },
            // {
            //     "data": "description"
            // },
            // {
            //     "data": "default"
            // },
            {
                "data": "status",
            },
            {
                "data": "action"
            }
        ]
    });
});