"use strict";
var ValidationControls = function () {
    // Private functions
    
    var validationForm = function () {
               

                        $('#loginForm').validate({
                            rules: {
                              email: {
                                required: true,
                                email: true,
                                remote:{
                                         url: $('#loginForm').attr('data-email-url'),
                                         type: 'post',
                                     
                                        }
                              },
                              password: {
                                required: true,
                               
                              },
                              
                            },
                            messages: {
                              email: {
                                required: "Please enter  email address",
                                email: "Please enter a vaild email address",
                                remote:"These credentials do not match our records"
                              },
                              password: {
                                required: "Please enter password",

                              },
                            },
                            errorElement: 'span',
                            errorPlacement: function (error, element) {
                              error.addClass('invalid-feedback');
                              element.closest('.input-group').append(error);
                              $('.form-control.is-invalid').css('background-image','none');
                            },
                            highlight: function (element, errorClass, validClass) {
                              $(element).addClass('is-invalid');
                            },
                            unhighlight: function (element, errorClass, validClass) {
                              $(element).removeClass('is-invalid');
                            },
                            submitHandler: function () {
                                return true;
                            }
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