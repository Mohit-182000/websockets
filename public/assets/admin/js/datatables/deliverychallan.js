$(document).ready(function () {

    const table2 = $('#transferorderTable').DataTable({
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        "lengthMenu": [10, 25, 50],
        "responsive": true,
        // "iDisplayLength": 2,
        "ajax": {
            "url": $('#transferorderTable').attr('data-url'),
            "dataType": "json",
            "type": "POST",
            "data": function (d) {
                return $.extend({
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val(),
                    type: $('#type').val(),
                }, d, {});
            }
        },
        "order": [
            [0, "desc"]
        ],
        "columns": [{
                "data": "date"
            },
            {
                "data": "transaction_no"
            },
            {
                "data": "ref"
            },
            {
                "data": "qty"
            },
            {
                "data": "to"
            },
            {
                "data": "action"
            }
        ]
    });

    $('#type').select2({
        theme: 'bootstrap4',
        allowClear: true,
    });

    $('.btn-search,#type').on('click select2:unselect', function () {

        $('#transferorderTable').DataTable().ajax.reload(null, false);

    });

    function createDatePicker(from = '.start-date', to = '.end-date') {

        $('.date-picker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,

        });

        $(from).datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,

        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            $(to).datepicker('setStartDate', startDate);
        });

        $(to).datepicker({
            useCurrent: false,
            autoclose: true,
            format: 'dd-mm-yyyy'
        }).on('changeDate', function (selected) {
            var endDate = new Date(selected.date.valueOf());
            $(from).datepicker('setEndDate', endDate);
        });

    }
    createDatePicker();
});