"use strict";
var DatatablesDataSourceHtml = function () {

    var initUserValidation = function () {
        $('#userForm').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                email: {
                    required: true,
                    remote: {
                        url: $('#userForm').attr('data-url'),
                        type: "post",
                        data: {
                            table: function () {
                                return "users";
                            },
                            column: function () {
                                return "email";
                            },
                            value: function () {
                                return $("#email").val();
                            },
                            id: function () {
                                return $("#id").val();
                            },
                        }
                    }
                },
            },
            messages: {
                email: {
                    remote: "Please enter unique email",
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
            initUserValidation();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});
