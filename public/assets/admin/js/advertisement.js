$(document).ready(function () {

  


    $('#languageForm').validate({

        errorPlacement: function(error, element) {
            $(error).addClass('text-danger');

            if( $(element).is('.select2')  || $(element).is("input:file")  )    {
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




});
