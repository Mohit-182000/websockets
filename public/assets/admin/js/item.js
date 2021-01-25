$(document).ready(function () {
    const select2 = $('#category,#unit,#hsncode');


    select2.select2({
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
        allowClear: true
    });

    $('#unit').on('select2:select select2:clear' ,function(e) {
        $('.packaging-repeater :input').each(function (index , item) {
                $(item).val(null).trigger('change');
        });
    });

    $('.packaging-repeater').repeater({
        initEmpty: false,
        show: function () {
            $(this).slideDown();
            getPackage();

            calculate($(this).html());
        },
        hide: function (deleteElement) {
            if(confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        },
        ready: function (setIndexes) {
            getPackage();
            calculate();

        },
        isFirstItemUndeletable: false
    });


    $(document).on('select2:clear select2:select','#unit',function(e){

        const el = $(this);
        $('.package-select2').each(function(i , el){
            $(el).val(null).trigger('chagne');
        });

    });

    //sample rate showhide
    $("#sanple_products").click(function () {
        if ($(this).is(":checked")) {
            $(".show-hide-rate").removeClass('d-none');
        } else {
            $(".show-hide-rate").addClass('d-none');
            $('#sample_rate').val(null);
        }
    });


    // validataion
    $('#itemForm').validate({
        errorPlacement: function(error, element) {
            $(error).addClass('text-danger');

            if( $(element).is('.select2') ||$(element).is('.error-div') )    {
                var div = $(element).closest('.form-group').find('.error-div');
                error.appendTo(div);
            }else{
                error.insertAfter(element);
            }
        },
        submitHandler: function (form , e) {
            showLoader();
            $('.btn-save-update').attr("disabled", true);
            return true;
        }
    });





    //Wizard
    $('a[data-toggle="pill"]').on('show.bs.tab', function (e) {
        var $target = $(e.target);
        if ($target.hasClass('disabled')) {
            return false;
        }
    });
    $(".next-step").click(function (e) {
        var $active = $('.nav-pills .nav-link.active');
        console.log($('#itemForm').validate());
        if(!$('#itemForm').valid()){
            return false;
        }
        $active.addClass('disabled');
        nextTab($active);
    });
    $(".prev-step").click(function (e) {
        var $active = $('.nav-pills .nav-link.active');
        if(!$('#itemForm').valid()){
            return false;
        }
        $active.addClass('disabled');
        prevTab($active);
    });
    function nextTab(elem) {
        $(elem).next().removeClass('disabled').click();
    }
    function prevTab(elem) {
        $(elem).prev().removeClass('disabled').click();
    }

    // repiter select 2
    function getPackage(){
        const package = $('.package-select2');
        package.select2({
            theme: 'bootstrap4',
            ajax: {
                url: function(){
                    return $(this).data('url');
                },
                data: function (params) {

                    var unit = $('#unit').val();

                    return {
                        search: params.term,
                        unit : unit
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
        });
    }


    function calculate(rows){

        $(document).on('keyup','.package_rate ,#discount' , function(){

            let el = $(this);
            let row = $(this).closest('.row.mt-2')

            if(el.is('#discount')){

                $('.row.packaging-repeater .row.mt-2').each(function(el , index){
                    percentage(index)
                });

            } else {

                percentage(row);

            }


        });

    }

    function percentage(row) {

        var rate = $(row).find('.package_rate').val();
        var traget = $(row).find('.package_discount');
        var rate = parseInt(rate);
        var discount = parseInt($('#discount').val());
        var perc="";

        if(isNaN(discount) || isNaN(rate)){
            per="";
        }else{
           per = ((rate*discount) / 100).toFixed(2);
           per = rate - per ;
        }

        $(traget).val(per);

    }

});
