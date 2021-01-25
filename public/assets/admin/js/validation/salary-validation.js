"use strict";
var DatatablesDataSourceHtml = function () {

    var initSkillsValidation = function () {
        $('#salaryForm').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                salary: {
                    required: true,
                    remote: {
                        url: $('#salaryForm').attr('data-url'),
                        type: "post",
                        data: {
                            table: function () {
                                return "salaries";
                            },
                            column: function () {
                                return "salary";
                            },
                            value: function () {
                                return $("#salary").val();
                            },
                            id: function () {
                                return $("#id").val();
                            },
                        }
                    }
                },
            },
            messages: {
                salary: {
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

    }


    // end select
    return {
        init: function () {
            initSkillsValidation();
            Selectbox();
        },

    };
}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});
