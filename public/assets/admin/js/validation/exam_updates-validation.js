"use strict";
var DatatablesDataSourceHtml = function () {

    var initExamUpdateseValidation = function () {
        $('#exam_updatesForm').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                title: {
                    required: true,
                    remote: {
                        url: $('#exam_updatesForm').attr('data-url'),
                        type: "post",
                        data: {
                            table: function () {
                                return "exam_updates";
                            },
                            column: function () {
                                return "title";
                            },
                            value: function () {
                                return $("#title").val();
                            },
                            id: function () {
                                return $("#id").val();
                            },
                        }
                    }
                },
            },
            messages: {
                title: {
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
            initExamUpdateseValidation();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});
