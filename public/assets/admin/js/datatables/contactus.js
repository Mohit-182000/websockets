$(document).ready(function () {
    var table2 = $('#contactTable').DataTable({
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        "lengthMenu": [10, 25, 50],
        "responsive": true,
        // "iDisplayLength": 2,
        "ajax": {
            "url": $('#contactTable').attr('data-url'),
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
                "data": "subject"
            },
             {
                "data": "name"
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

             $('table').on('click', function(e){
        if($('.popoverButton').length>1)
        $('.popoverButton').popover('hide');
        $(e.target).popover('toggle');

        });
});