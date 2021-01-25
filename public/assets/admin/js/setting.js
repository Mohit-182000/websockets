$(document).ready(function () {
    
    $('#timezone,#currency_symbol1,#currency_format,#currency_symbol1').select2({
        theme: 'bootstrap4'
    });

    
    $('#general_form').validate({   
        debug: false,
        ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
        rules: {},
        messages: {},
        errorPlacement: function (error, element) {
            console.log(error, element);
            $(error).addClass('text-danger');
            error.appendTo(element.parent()).addClass('text-danger-custom');
            if(element.parent('.input-group').length)
            {
                error.insertAfter(element.parent());
            }
        },
        submitHandler : function (e) {
            // $("button[name='save']").attr("disabled", "disabled").button('refresh');
            // $('#general_form').find('span#sid').addClass("spinner-border spinner-border-sm");
            showLoader();
            $('.btn-save-update').attr("disabled", true);
            return true;
        }
    })
});