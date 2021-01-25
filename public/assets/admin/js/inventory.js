$(document).ready(function () {

    $('.select2').select2({
        allowClear: true,
        theme: 'bootstrap4',
    });

    $('#date').datepicker({
        format: 'dd-mm-yyyy',
        autoclose : true
    });

    $('.inventory-repeter').repeater({
        initEmpty: false,
        show: function () {
            var formdate = $(this).find('.from-date');
            var todate = $(this).find('.to-date');
            $(this).slideDown();
            loadSelect2();
            createDatePicker(formdate , todate);
            $('#inventoryForm').valid();
        },
        hide: function (deleteElement) {
            if(confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        },
        ready: function (setIndexes) {
        },
        isFirstItemUndeletable: false
    })

    $('#inventoryForm').validate({
        debug: false,
        errorPlacement: function(error, element) {
        },
        highlight: function(element, errorClass, validClass) {
            if($(element).is('select')) {
                $(element).closest('.form-group').find('.select2-selection.select2-selection--single') .addClass('border-danger');
            }else{
                $(element).addClass('border-danger');
            }
        },
        unhighlight: function(element, errorClass, validClass) {
            if($(element).is('select')) {
                $(element).closest('.form-group').find('.select2-selection.select2-selection--single') .removeClass('border-danger');
            }else{
                $(element).removeClass('border-danger');
            }
        },
        submitHandler: function () {
            showLoader();
            $('.btn-save-update').attr("disabled", true);
            return true;
        }
    });

    function createDatePicker(from = '.from-date', to = '.to-date') {


        $(from).datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true ,
            endDate : new Date()
        });

        $(to).datepicker({
            format: 'dd-mm-yyyy',
            autoclose : true,
            startDate : moment().add(1, 'days').format('DD-MM-YYYY'),

        });



        // $(from).datepicker({
        //     format: 'dd-mm-yyyy'
        // }).on('changeDate', function (selected) {
        //     var startDate = new Date(selected.date.valueOf());
        //     $(to).datepicker('setStartDate', startDate);
        // });

        // $(to).datepicker({
        //     useCurrent: false,
        //     format: 'dd-mm-yyyy'
        // }).on('changeDate', function (selected) {
        //     var endDate = new Date(selected.date.valueOf());
        //     $(from).datepicker('setEndDate', endDate);
        // });

    }

    function loadSelect2() {

        let $select2 = $('.select2-items,.select2-manufacturer');
        let $package = $('.select2-items-package');

        $select2.select2({
            theme: 'bootstrap4',
            ajax: {
                url: function(){
                    return  $(this).data('url');
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
            allowClear: true
        }).on('select2:select' ,function(e){

            var count = $(this).closest("tr").nextAll("tr").length;

            if(count == 0 ){
                $('.add-new-row').trigger('click');
            }

            if($(this).is('.select2-items')) {
                celearrow($(this).closest('tr'));
            }


        });

        $package.select2({
            theme: 'bootstrap4',
            ajax: {
                url: function() {
                    return  $(this).data('url');
                },
                data: function (params) {
                    let id = $(this).closest('tr').find('.select2-items').val();
                    return {
                        search: params.term,
                        id: id,
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
            allowClear: true
        })


    }

    createDatePicker();

    loadSelect2();

    function celearrow(row , data) {
        $(row).find('.select2-items-package').val(null).trigger('change');
    }

});
