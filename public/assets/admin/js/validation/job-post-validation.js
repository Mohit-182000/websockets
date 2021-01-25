"use strict";
var DatatablesDataSourceHtml = function () {

    var initStateValidation = function () {
        $('#stateForm').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: $('#stateForm').attr('data-url'),
                        type: "post",
                        data: {
                            table: function () {
                                return "states";
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
            initStateValidation();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});