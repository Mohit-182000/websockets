$(document).ready(function () {
    var table2 = $('#inquiryTable').DataTable({
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        "lengthMenu": [10, 25, 50],
        "responsive": true,
        // "iDisplayLength": 2,
        "ajax": {
            "url": $('#inquiryTable').attr('data-url'),
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
            // {
            //     "data": "subject"
            // },
             {
                "data": "child_name"
            },
             {
                "data": "email"
            },
             {
                "data": "phone"
            },
            {
                "data": "created_at"
            },
            {
                "data": "action"
            },
           
        ]
    });

       
});