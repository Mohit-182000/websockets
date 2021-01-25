"use strict";
var DatatablesDataSourceHtml = function () {

    var initRolePermissionValidation = function () {
        $('#rolepermissionForm').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                role: {
                    required: true,
                    remote: {
                        url: $('#rolepermissionForm').attr('data-url'),
                        type: "post",
                        data: {
                            table: function () {
                                return "role_permissions";
                            },
                            column: function () {
                                return "role";
                            },
                            value: function () {
                                return $("#role").val();
                            },
                            id: function () {
                                return $("#id").val();
                            },
                        }
                    }
                },
            },
            messages: {
                role: {
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
            initRolePermissionValidation();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});