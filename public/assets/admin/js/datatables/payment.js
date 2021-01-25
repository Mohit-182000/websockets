"use strict";
var DatatablesDataSourceHtml = function () {

    var initPaymentTable = function () {
        var table = $('#paymentTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            "language": {
                searchPlaceholder: " Id"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#paymentTable').attr('data-url'),
                "dataType": "json",
                "type": "POST",
                "data": {
                    // return $.extend({}, d, {});
                    user_type:$('#UserType').val(),
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
                "data": "job"
            },
            {
                "data": "package"
            },
            {
                "data": "subscription_date"
            },
            {
                "data": "expiry_date"
            },
            {
                "data": "status"
            },
            {
                "data": "action"
            }
            ]
        });
    };

    return {
        init: function () {
            initPaymentTable();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();


    var UserType = $('#UserType');

    UserType.select2({
        theme: 'bootstrap4',
        delay: 250,
        allowClear: true
    });

    $("#search").click(function(){
        $('#paymentTable').DataTable().destroy();
        DatatablesDataSourceHtml.init();
    });

    $("#btn_clear").click(function(){
        $('#UserType').val('').trigger('change');
        $('#paymentTable').DataTable().destroy();
        DatatablesDataSourceHtml.init();
    });
});