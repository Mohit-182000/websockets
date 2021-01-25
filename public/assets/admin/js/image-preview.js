// Favicon
$.validator.addMethod('filesize', function (value, element, param) {
    console.log(value, element, param);
    if (element.files.length) {
     
        return this.optional(element) || (element.files[0].size <= param)
    }
    return true;
}, 'File size must be less than 5mb.');

$(document).ready(function ()   {

    $(document).on('click','.file-upload-browse', function() {
        // var file = $(this).parents().find('.file-upload-default');
        var el = $(this);
        var target = el.data('target');
        // console.log($(this).parents());
        $(target).trigger('click');
    });

    $(document).on('click','.file-upload-clear', function() {
        var el = $(this);
        var target = el.data('target');
        // var clear = target.val('');
        $(target).val(null);
        // $('.file-upload-default').val('');
        $('.file-upload-default').trigger('change');
        console.log(target);
    });

    $(document).on('change', '.file-upload-default', function() {
        var el = $(this) ;

        var preview = $($(el).data('target')) ;      
        console.log(preview);
        if(el.val() && el.valid()) {
            readURL(this);
            el.parent().find('.form-control').val(el.val().replace(/C:\\fakepath\\/i, '') );
            return true ;
        }
        
        preview.attr('src', preview.data('default'));
        el.val('');
        el.parent().find('.form-control').val(el.val().replace(/C:\\fakepath\\/i, '') );
    });

    var readURL = function (input) {
        
        if (input.files && input.files[0]) {

            var reader = new FileReader();
            var preview = $($(input).data('target')) ;      

            reader.onload = function (e) {
                preview.attr('src', e.target.result)
            }

            reader.readAsDataURL(input.files[0]);

        }
    }

    $(document).on('change','#changeIcon', function(e) {
        var el = $(this);
        var target = el.data('target');
        if(e.icon != 'empty') {
            $(target).val(e.icon)
        }        
    });

});