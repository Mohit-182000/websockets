$(document).ready(function () {

    let role = $('.role-select2');
    let branch = $('.branch-select2');


    role.select2({
        theme: 'bootstrap4',
        ajax: {
            url: role.data('url'),
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

    branch.select2({
        theme: 'bootstrap4',
        ajax: {
            url: branch.data('url'),
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


    $('#userForm').validate({
        debug : false ,
        errorPlacement: function(error, element) {
            $(error).addClass('text-danger');
            if($(element).is('select')) {
                var div = $(element).closest('.form-group').find('.error-div');
                error.appendTo(div);
            }else{
                error.insertAfter(element);
            }
        },
        submitHandler: function () {
            return true;
        }
    });

});
