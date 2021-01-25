"use strict";
var DatatablesDataSourceHtml = function () {

    var initCityValidation = function () {
        $('#cityForm').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: $('#cityForm').attr('data-url'),
                        type: "post",
                        data: {
                            table: function () {
                                return "cities";
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

        var stateSelect2 = $('.state-select2');

        // start select
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
                        //  id: $(stateSelect2.data('target')).val()
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

        $('.state-select2').on('select2:select', function (e) {
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
            initCityValidation();
            Selectbox();
        },

    };
}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});