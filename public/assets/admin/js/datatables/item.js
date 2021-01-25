$(document).ready(function () {
    
    const select2 = $('#category,#unit,#hsncode');

    const table2 = $('#itemTable').DataTable({
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        "lengthMenu": [10, 25, 50],
        "responsive": true,
        // "iDisplayLength": 2,
        "ajax": {
            "url": $('#itemTable').attr('data-url'),
            "dataType": "json",
            "type": "POST",
            "data": function (d) {
                return $.extend({
                    unit : $('#unit').val(),
                    category : $('#category').val(),
                }, d, {});
            }
        },
        "order": [
            [0, "desc"]
        ],
        "columns": [
            {
                "data": "name"
            },
            {
                "data": "unit"
            },
            {
                "data": "rate"
            },
            {
                "data": "stock"
            },
            {
                "data": "tax"
            },
            {
                "data": "status",
            },
            {
                "data": "action"
            }
        ]
    });

    select2.select2({
        theme: 'bootstrap4',
        ajax: {
            url: function(){
                return $(this).data('url');
            },
            data: function (params) {
                return {
                    search: params.term,
                };
            },
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.name,
                            otherfield: item,
                        };
                    }),
                }
            },
            //cache: true,
            delay: 250
        },
    });

    $('.btn-search').on('click' ,function(){
        
        $('#itemTable').DataTable().ajax.reload();

    });

}); 