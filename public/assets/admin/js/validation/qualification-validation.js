"use strict";
var DatatablesDataSourceHtml = function () {

    var initQualificationValidation = function () {
        $('#qualificationForm').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: $('#qualificationForm').attr('data-url'),
                        type: "post",
                        data: {
                            table: function () {
                                return "qualifications";
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
            initQualificationValidation();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});