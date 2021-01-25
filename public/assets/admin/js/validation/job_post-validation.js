"use strict";
var DatatablesDataSourceHtml = function () {

    var initSkillsValidation = function () {
        $('#jobPostForm').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: $('#jobPostForm').attr('data-url'),
                        type: "post",
                        data: {
                            table: function () {
                                return "job_post";
                            },
                            column: function () {
                                return "job_title";
                            },
                            value: function () {
                                return $("#job_title").val();
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
                if (element.attr("name") == "gender" || element.attr("name") == "job_type[]") {
                    var div = $(element).closest('.form-group').find('.error-div');
                    error.appendTo(div).addClass('text-danger');
                }else{
                    error.appendTo(element.parent()).addClass('text-danger');
                }
            },
            submitHandler: function (e) {
                return true;

            }
        });

    }

    var Selectbox = function () {

        var jobCategory = $('.category-select2');
        // var stateSelect2 = $('.state-select2');
        var citySelect2 = $('.city-select2');
        // var maritalStatusSelect2 = $('.marital-status-select2');
        // var experienceSelect2 = $('.experience-select2');
        // var skillSelect2 = $('.skill-select2');

        // start select
        jobCategory.select2({
            theme: 'bootstrap4',

            allowClear: true,
            ajax: {
                url: function () {
                    return $(this).data('url');
                },
                data: function (params) {
                    return {
                        search: params.term,
                    };
                },
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            return {
                                id: item.id,
                                text: item.name,
                                otherfield: item,
                            };
                        }),
                    }
                },
                //cache: true,
                delay: 250
            },
            placeholder: 'Search Category',
            // minimumInputLength: 2,
        });

        citySelect2.select2({
            theme: 'bootstrap4',

            allowClear: true,
            ajax: {
                url: function () {
                    return $(this).data('url');
                },
                data: function (params) {
                    return {
                        search: params.term,
                        id: $(citySelect2.data('target')).val()
                    };
                },
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            return {
                                id: item.id,
                                text: item.name,
                                otherfield: item,
                            };
                        }),
                    }
                },
                //cache: true,
                delay: 250
            },
            placeholder: 'Search City',
            // minimumInputLength: 2,
        });


        $('.state-select2').on('select2:select' ,function(e){
            var el = $(this);
            var clearInput = el.data('clear').toString();
            if (clearInput.length) {
                $(clearInput).val(null).trigger('change');
            }
        });


        $('.category-select2').on('select2:select' ,function(e){
            var el = $(this);
            var clearInput = el.data('clear').toString();
            if (clearInput.length) {
                $(clearInput).val(null).trigger('change');
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