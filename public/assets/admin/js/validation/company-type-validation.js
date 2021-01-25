"use strict";
var DatatablesDataSourceHtml = function () {

    var initCompanyTypeValidation = function () {
        $('#companyTypeForm').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: $('#companyTypeForm').attr('data-url'),
                        type: "post",
                        data: {
                            table: function () {
                                return "company_types";
                            },
                            column: function () {
                                return "company_type";
                            },
                            value: function () {
                                return $("#company_types").val();
                            },
                            id: function () {
                                return $("#id").val();
                            },
                        }
                    }
                },
            },
            messages: {
                company_types: {
                    remote: "Please enter unique company type",
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
            initCompanyTypeValidation();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});