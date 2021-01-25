$(document).ready(function () {

    $('.select2').select2({
        theme : 'bootstrap4',
        allowClear: true
    });


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



    //Initialize tooltips
    $('.nav-pills > a[title]').tooltip();

    //Wizard
    $('a[data-toggle="pill"]').on('show.bs.tab', function (e) {
        var $target = $(e.target);
        if ($target.hasClass('disabled')) {
            return false;
        }
    });

    $('.category-check').on('keyup paste',function (e) {
        $('#languageForm').valid();
    });

    $(".next-step").click(function (e) {

        var $active = $('.nav-pills .nav-link.active');

        if(!$('#languageForm').valid()){
            return false;
        }
        $active.addClass('disabled');

        nextTab($active);

    });

    $(".prev-step").click(function (e) {
        var $active = $('.nav-pills .nav-link.active');
        if(!$('#languageForm').valid()){
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


});
