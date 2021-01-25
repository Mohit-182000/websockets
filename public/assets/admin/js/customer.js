$(document).ready(function () {

    $('#customerForm').validate({
        errorPlacement: function(error, element) {
            $(error).addClass('text-danger');
            if($(element).is('.select2')) {
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

    $('#same_as').on('change',function(e){

        var el = $(this);

        $('.showhide').removeClass('d-none');
        $('.showhide .select2').val(null).trigger('change');
        $('.showhide :input').val(null);

        if(el.prop("checked")){
            $('.showhide').addClass('d-none');
        }

    });

});
