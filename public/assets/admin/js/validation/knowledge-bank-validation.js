"use strict";
var DatatablesDataSourceHtml = function () {

    var initExperienceValidation = function () {
        $('#knowledge_bankForm').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                title: {
                    required: true,
                    remote: {
                        url: $('#knowledge_bankForm').attr('data-url'),
                        type: "post",
                        data: {
                            table: function () {
                                return "knowledge_banks";
                            },
                            column: function () {
                                return "title";
                            },
                            value: function () {
                                return $("#title").val();
                            },
                            id: function () {
                                return $("#id").val();
                            }
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
                if (element.attr("name") == "media_type" || element.attr("name") == "section_id[]") {
                    var div = $(element).closest('.form-group').find('.error-div');
                    error.appendTo(div).addClass('text-danger');
                } else {
                    error.appendTo(element.parent()).addClass('text-danger');

                }   
            },
            submitHandler: function (e) {
                return true;

            }
        });

    };

    return {
        init: function () {
            initExperienceValidation();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});