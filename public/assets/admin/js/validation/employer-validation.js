"use strict";
var DatatablesDataSourceHtml = function () {

    var initSkillsValidation = function () {
        $('#employerForm').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: $('#employerForm').attr('data-url'),
                        type: "post",
                        data: {
                            table: function () {
                                return "skills";
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

    }

    var Selectbox = function () {

        var companyTypeSelect2 = $('.company-type-select2');
        var stateSelect2 = $('.state-select2');
        var citySelect2 = $('.city-select2');
        var localitySelect2 = $('.locality-select2');

        // start select
        companyTypeSelect2.select2({
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
                                text: item.company_type,
                                otherfield: item,
                            };
                        }),
                    }
                },
                //cache: true,
                delay: 250
            },
            placeholder: 'Search Comapny Type',
            // minimumInputLength: 2,
        });

        stateSelect2.select2({
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
            placeholder: 'Search State',
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

        

        localitySelect2.select2({
            theme: 'bootstrap4',

            allowClear: true,
            ajax: {
                url: function () {
                    return $(this).data('url');
                },
                data: function (params) {
                    return {
                        search: params.term,
                        id: $(localitySelect2.data('target')).val()
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
            placeholder: 'Search Locality',
            // minimumInputLength: 2,
        });

        $('.city-select2').on('select2:select' ,function(e){
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