//== Class Definition
var ProfilePage= function() {

    

    var handleProfileUpdateFormSubmit = function() {
       

            $('#profileForm').validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {

                    name: {
                        required: "Please enter name.",
                    },
                    email: {
                        required: "Please enter email.",
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                  error.addClass('invalid-feedback');
                  element.closest('.message_error').append(error);
                 $('.form-control.is-invalid').css('background-image','none');

                },
                highlight: function (element, errorClass, validClass) {
                  $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                  $(element).removeClass('is-invalid');
                },
                submitHandler: function () {
                     $("button[name='save']").attr("disabled", "disabled").button('refresh');
                     $('#profileForm').find('span#sid').addClass("spinner-border spinner-border-sm");
                     return true;
                }
            });

            
        
    }

    var handleFormChangePwd = function() {
        $.validator.addMethod("pwcheck", function(value) {
            return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/.test(value) // consists of only these
        });
       
           

            $('#passwordForm').validate({
                rules: {
                    old_password: {
                        required: true,
                        //pwcheck: true,
                        minlength: 8
                    },
                    password: {
                        required: true,
                        pwcheck: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 8,
			            equalTo: "#password"
                    }
                },
                messages: {
                    old_password: {
                        required: "Please enter current password.",
                       // pwcheck: 'Password must be minimum 8 characters.password must contain at least 1 lowercase, 1 Uppercase, 1 numeric and 1 special character.',
                        minlength: "Your password must at least 8 digits."
                    },
                    password: {
                        required: "Please enter password.",
                        pwcheck: 'Password must be minimum 8 characters.password must contain at least 1 lowercase, 1 Uppercase, 1 numeric and 1 special character.',
                        minlength: "Please enter atleast 8 digit."
                    },
                    password_confirmation: {
                        required: "Please enter confirm password.",
                        minlength: "password must be at least 8 characters long.",
                        equalTo: "Confirm password does not match to password."

                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                  error.addClass('invalid-feedback');
                  element.closest('.form-group').append(error);
                 $('.form-control.is-invalid').css('background-image','none');
                  
                },
                highlight: function (element, errorClass, validClass) {
                  $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                  $(element).removeClass('is-invalid');
                },
                submitHandler: function () {
                    $("button[name='save']").attr("disabled", "disabled").button('refresh');
                    $('#passwordForm').find('span#sid').addClass("spinner-border spinner-border-sm");
                    return true;
                }
            });

         
        
    }

    
    //== Public Functions
    return {
        // public functions
        init: function() {
            handleFormChangePwd();
            handleProfileUpdateFormSubmit();
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    ProfilePage.init();
});