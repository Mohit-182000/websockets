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

        let $select2 = $('.challan');
        let $item = $('.select2-items');

        $select2.select2({
            theme: 'bootstrap4',
            ajax: {
                url: function(){
                    return  $(this).data('url');
                },
                data: function (params) {
                    let dc = $('#challan').val();
                    return {
                        search: params.term,
                        challan : dc
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
        });

        $item.select2({
            theme: 'bootstrap4',
            ajax: {
                url: function(){
                    return  $(this).data('url');
                },
                data: function (params) {
                    let dc = $('#challan').val();
                    return {
                        search: params.term,
                        challan : dc
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
                delay: 250
            },
            allowClear: true ,
            templateResult: getAttr,
        }).on('select2:select' ,function(e){

            var el = $(this);
            var data = e.params.data.otherfield ;
            var tr  = el.closest("tr") ;

            var count = tr.nextAll("tr").length;

            if(count == 0 && el.is('.select2-items') ){
                $('.add-new-row').trigger('click');
            }

            fillrow(tr.get(0) , data);

        });



    } loadSelect2();


    $(document).on('click' ,'.insert-data', function () {

        const $el = $(this);
        const data = $el.data('item');
        const $modal = $el.closest('.modal.show');
        let row = $('#'+$modal.attr('data-fill')).closest('tr');
        fillrow(row , data);

    });

    $(document).on('select2:clear','.select2-items',function(e){
        var el = $(this);
        var tr = el.closest('tr').get(0);
        clearRow(tr , {});
    });

    $(document).on('select2:clear','.challan',function(e){
        var el = $(this);
        var tr = $('table tbody tr');
        $.each(tr , function (index, item) {
            clearRow(item , {});
        });
    });


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

    function fillrow(row , data) {
        console.log(row , data);
        $(row).find('.receive_qty').val(parseInt(data.qty));
        $(row).find('.ref_item_id').val(parseInt(data.ref_item_id));
        $(row).find('.stock_item_attribute_id').val(data.stock_item_attribute_id);
        $(row).find('.item_package_id').val(data.item_package_id);
        $(row).find('.qty').attr('max' , data.qty);
        $('.inventory-table').trigger('change');

    }

    function clearRow(row , data) {

        $(row).find('.select2-items').val(null).trigger('change');
        $(row).find('.ref_item_id').val(null);
        $(row).find('.receive_qty').val(null);
        $(row).find('.item_package_id').val(null);
        $(row).find('.qty').val(null);
        $(row).find('.reason').val(null);
        $(row).find('.stock_item_attribute_id').val(null);
        $(row).find('.qty').removeAttr('max');

    }

    function getAttr(data) {

        if (!data.id) {
            return data.text;
        }

        var attribute = '<p class=" mb-1 h5">'+data.text+'</p>\n';

        var html = data.otherfield.attribute.map(function (item , index) {
            return  '<p class="mb-0"><b>'+item.group_name+'</b> : ' + item.attribute_name + '</p>';
        }).join('\n');

        attribute = attribute + html ;

        var $a = $(attribute);

        return $a;

    }

});
