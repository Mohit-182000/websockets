$(document).ready(function () {

    var countrySelect2 = $('.country-select2 ,.emergency_country-select2');
    var stateSelect2 = $('.state-select2,.emergency_state-select2');
    var citySelect2 = $('.city-select2 ,.emergency_city-select2');


    countrySelect2.select2({
        theme: 'bootstrap4',
        ajax: {
            url: function(){
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
        placeholder: 'Search Country',
        allowClear: true
        // templateResult: getfName,
        // templateSelection: formatRepoSelection
        //multiple: true
    });

    stateSelect2.select2({
        theme: 'bootstrap4',

        allowClear: true,
        ajax: {
            url: function(){
                return $(this).data('url');
            },
            data: function (params) {
                return {
                    search: params.term,
                    id: $(stateSelect2.data('target')).val()
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
            url: function(){
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


    
    $('.country-select2 , .state-select2 ,.city-select2 ').on('select2:select' ,function(e){
        var el = $(this);
        var clearInput = el.data('clear').toString();
        if (clearInput.length) {
            $(clearInput).val(null).trigger('change');        
        }
    });

});