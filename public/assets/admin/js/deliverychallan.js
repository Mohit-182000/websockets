$(document).ready(function () {

    $('.select2').select2({
        allowClear: true,
        theme: 'bootstrap4',
    });

    $('#date').datepicker({
        format: 'dd-mm-yyyy',
        autoclose : true ,
    });

    $('.inventory-repeter').repeater({
        initEmpty: false,
        show: function (show) {
            var formdate = $(this).find('.dom-date');
            var todate = $(this).find('.exp-date');
            $(this).find('.current_qty').text(null);
            $(this).find('.attributes-list').text(null);
            $(this).slideDown(show);
            loadSelect2();
            $('#inventoryForm').valid();
        },
        hide: function (deleteElement) {
            if(confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        },
        afterremove : function () {
            $('.inventory-table').trigger('change');
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


    function loadSelect2() {

        let $select2 = $('.source_branch,.destination_dranch ,.select2-items');
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
            allowClear: true ,
        }).on('select2:select' ,function(e){


            var count = $(this).closest("tr").nextAll("tr").length;

            var el = $(this);

            if(count == 0 && el.is('.select2-items') ){
                $('.add-new-row').trigger('click');
            }

            if(el.is('.destination_dranch')) {
               createAddress(e);
            }

            celearrow($(this).closest('tr'));


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
        }).on('select2:select' ,function(e){

            console.log(e);

            var itemSelect2 = $(this).closest("tr").find('.select2-items').select2('data');

            $(document).trigger('showbsmodal' ,{
                item :  itemSelect2[0] ?  itemSelect2[0] : [],
                itme_package_id :   e.params.data.id,
                event : e
            });

            // var count = $(this).closest("tr").nextAll("tr").length;

            // var el = $(this);

            // if(count == 0 && el.is('.select2-items') ){
            //     $('.add-new-row').trigger('click');
            // }

            // if (el.is('.select2-items')) {
            //     $(document).trigger('showbsmodal' ,{
            //         item :  e.params,
            //         event : e
            //     });
            // }

            // if(el.is('.destination_dranch')) {
            //    createAddress(e);
            // }

        })


    } loadSelect2();

    $('.destination_dranch').on('select2:clear' ,function(){

        var el = $(this);

        el.closest('.row').find('address').html('');

    });

    $(document).on('click' ,'.insert-data', function () {

        const $el = $(this);
        const data = $el.data('item');
        const $modal = $el.closest('.modal.show');
        let row = $('#'+$modal.attr('data-fill')).closest('tr');
        fillrow(row , data);

    });



    $(document).on('select2:clear','.select2-items',function(e){
        const el = $(this);
        const row = el.closest('tr');
        celearrow(row);
    });


    $(document).on('showbsmodal',function(e ,data){

        const $modal = $('#showproductlist');
        let url = $modal.data('url');

        $modal.removeAttr('data-fill');
        let row = $(data.event.target).closest('tr');
        $modal.attr('data-fill' ,$(data.event.target).attr('id'));

        showLoader();

        $.ajax({
            url: url ,
            data: {
                id : data.item.id ,
                itme_package_id : data.itme_package_id
                // id : data.item.data.id
            }
        }).always(function (respons) {
            stopLoader();
            $('#showproductlist .modal-body').html('').empty();
        }).done(function (respons) {

            $('#showproductlist .modal-body').html(respons.html);
            $('#showproductlist').modal('toggle');

        }).fail(function (respons) {
            message.fire({
                type: 'error',
                title: 'Error',
                text: data.message ? data.message :
                    'something went wrong please try again !'
            });
        });;



    });


    function fillrow(row , data) {
        var attr  = $.map(data.attribute , function(item){
            return item.attribute_name ;
        }).join(', ');

        $(row).find('.current_qty').text(data.qty);
        $(row).find('.attributes-list').text(attr);
        $(row).find('.stock_item_attribute_id').val(data.id);
        $(row).find('.manufacturer_id').val(data.manufacturer_id);
        $(row).find('.qty').attr('max' , data.qty);
        $(row).find('.qty').attr('max' , data.qty);
        $('.inventory-table').trigger('change');
    }

    function celearrow(row , data) {
        $(row).find('.current_qty').text(null);
        $(row).find('.select2-items-package ').val(null).trigger('change');
        $(row).find('.qty').removeAttr('max').val(null);
        $(row).find('.stock_item_attribute_id,.manufacturer_id').val(null);
        $(row).find('.attributes-list').text(null);

    }

    $(document).on('keyup change','.inventory-table', function () {

        let totalQty = 0;
        let totalItem = 0;

        let qty = $('.inventory-table .qty').each(function(index, item){
            if(! isNaN(parseInt($(item).val()))){
                totalQty += parseInt($(item).val());
            }
        });

        let item = $('.stock_item_attribute_id').each(function(index, item){
            if(! isNaN(parseInt($(item).val()))){
                totalItem += 1;
            }
        });

        $('.total-item').html('<sapn>'+totalItem+'</sapn>');
        $('.total-qty').html('<sapn>'+totalQty+'</sapn>');

    });

    function createAddress(e) {
        var data = e.params.data.otherfield;
        var mainaddress = data.branchaddress;;

        console.log( data.otherfield);

        var address = '<p>'+ mainaddress.address_one;

        if(mainaddress.address_two) {
            address += ','+ '<br>' + mainaddress.address_two ;
        }


        if(mainaddress.city) {
            address += ','+ '<br>' + mainaddress.city+' - '+ mainaddress.pincode ;
        }


        if(mainaddress.state) {
            address += ','+ '<br>'  + mainaddress.state.name+' - '+ mainaddress.state.country.name ;
        }

        if(data.contact_person_mobile) {
            address += ','+ '<br>' + 'Mobile No. : ' + data.contact_person_mobile;
        }

        $('.destination_dranch').closest('.row').find('address').html(address);

    }

});
