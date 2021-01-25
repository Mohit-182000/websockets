"use strict";
var DatatablesDataSourceHtml = function () {

    var initKnown_LanguagesValidation = function () {
        $('#known_languagesForm').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: $('#known_languagesForm').attr('data-url'),
                        type: "post",
                        data: {
                            table: function () {
                                return "known_languages";
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
            initKnown_LanguagesValidation();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});