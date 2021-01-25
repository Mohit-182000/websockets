$(document).ready(function () {

    $('#languageForm').validate({
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
             showLoader();
             $('.btn-save-update').attr("disabled", true);
             return true;
        }
    });

});
