"use strict";
var ValidationControls = function () {
    // Private functions
    
    var validationForm = function () {
               

         $.validator.addMethod("pwcheck", function(value) {
            return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/.test(value) // consists of only these
        });

                        $('#resetForm').validate({
                          rules: {
                            email: {
                              required: true,
                              email: true,
                              remote:{
                                       url: $('#resetForm').attr('data-email-url'),
                                       type: 'post',
                                       
                                      }
                            },
                            password: {
                              required: true,
                              pwcheck: true,
                              minlength: 8
                             
                            },
                            password_confirmation:{
                              required: true,
                              minlength: 8,
                              equalTo: "#password"

                            },
                            
                          },
                          messages: {
                            email: {
                              required: "Please enter  email address",
                              email: "Please enter a vaild email address",
                              remote:"These credentials do not match our records"
                            },
                            password: {
                              required: "Please enter new password.",
                              pwcheck: 'Password must be minimum 8 characters.password must contain at least 1 lowercase, 1 Uppercase, 1 numeric and 1 special character.',
                              minlength: "Please enter atleast 8 digit."

                            },
                            password_confirmation:{
                              required: "Please enter confirm password.",
                              minlength: "password must be at least 8 characters long.",
                              equalTo: "Confirm password does not match to password."

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