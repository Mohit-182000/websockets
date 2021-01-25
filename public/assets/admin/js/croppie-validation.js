"use strict";
var ValidationControls = function () {
    // Private functions
    
    var validationForm = function () {
                         var $uploadCrop;


                            function readFile(input) {
                                if (input.files && input.files[0]) {

                                    var reader = new FileReader();
                                    var file = input.files[0]; // Get your file here
                                    var fileExt = file.type.split('/')[1];
                                    //alert(fileExt);
                                    if(fileExt=='jpeg' || fileExt=='jpg' || fileExt=='png' ){
                                                    reader.onload = function (e) {
                                                    $('.upload-demo').addClass('ready');
                                                    $uploadCrop.croppie('bind', {
                                                        url: e.target.result,
                                                    }).then(function(){
                                                        // $('#profile_modal').modal('show');
                                                    });

                                                }
                                                reader.readAsDataURL(input.files[0]);
                                    }else{
                                        $('#profile_modal').modal('hide');
                                        message.fire({
                                                type: 'error',
                                                title: 'Error' ,
                                                text:'Supported file formats: jpg, jpeg, or png'
                                            });

                                    }
                                    
                                }
                                else {

                                    swal("Sorry - you're browser doesn't support the FileReader API");
                                }
                            }

                            $uploadCrop = $('#upload-demo').croppie({
                                viewport: {
                                    width: 200,
                                    height: 200,
                                    type: 'circle'
                                },  boundary: {
                                    width: 300,
                                    height: 300
                                } ,
                                enableExif: true,
                            });

                            $('#uplode_btn').on('change', function () {
                                $('#profile_modal').modal('show');
                            });

                            $('#profile_modal').on('shown.bs.modal', function(){
                                var input = $('#uplode_btn').get(0) ;
                                readFile(input);
                            });

                            $('.upload-result').on('click', function (ev) {
         
                                $uploadCrop.croppie('result', {
                                    type: 'canvas',
                                    size: 'viewport',
                                    format: 'base64'
                                }).then(function (resp) {

                                    $.ajax({
                                        type: "post",
                                        url: $('#profile_url').val(),
                                        data: {image: resp}
                                    }).done(function (res) {
                                        
                                        // alert(res.image_url);

                                        $('.showcropimg').attr('src',res.image_url);
                                        $('#imgname').attr('src', res.image_url);
                                        $('#sidebarimage').attr('src', res.image_url);
                                
                                          message.fire({
                                                type: 'success',
                                                title: 'Success' ,
                                                text: res.message
                                            });
                                    }).always(function (res) {

                                        $('#profile_modal').modal('hide');
                                    }).fail(function (res) {

                                        swal("Sorry - you're browser doesn't support the FileReader API");
                                    }) ;
                                    // console.log(resp);
                                });
                            });

            
               
    };


    

    return {
        // public functions
        init: function() {
            validationForm(); 

          
        }
    };
}();

jQuery(document).ready(function() {    
    ValidationControls.init();
});