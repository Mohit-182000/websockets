"use strict";
var DatatablesDataSourceHtml = function () {

    var initShiftsValidation = function () {
        $('#shiftsForm').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: $('#shiftsForm').attr('data-url'),
                        type: "post",
                        data: {
                            table: function () {
                                return "shifts";
                            },
                            column: function () {
                                return "name";
                            },
                            value: function () {
                                return $("#name").val();
                            },
                            id: function () {
                                return $("#id").val();
                            },
                        }
                    }
                },
            },
            messages: {
                name: {
                    remote: "Please enter unique name",
                }
            },
            errorPlacement: function (error, element) {
                error.appendTo(element.parent()).addClass('text-danger');
            },
            submitHandler: function (e) {
                return true;

            }
        });

    };

    return {
        init: function () {
            initShiftsValidation();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});