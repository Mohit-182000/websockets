//== Class Definition
var ValidationControls = function() {
 
    var formValidation = function() {
       
        $('#employerPackageForm').validate({   
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {},
            messages: {},
            errorPlacement: function (error, element) {            
                // $(element).addClass('is-invalid')
                error.appendTo(element.parent()).addClass('text-danger');
            },

            submitHandler: function (e) {
                showLoader();
                $("button[name='save']").attr("disabled", "disabled").button('refresh');
                return true;
            }
        })

        $('#jobseekerPackageForm').validate({   
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {},
            messages: {},
            errorPlacement: function (error, element) {            
                // $(element).addClass('is-invalid')
                error.appendTo(element.parent()).addClass('text-danger');
            },
            
            submitHandler: function (e) {
                showLoader();
                $("button[name='save']").attr("disabled", "disabled").button('refresh');
                return true;
            }
        })
                       
        
    }


    
    //== Public Functions
    return {
        // public functions
        init: function() {
           formValidation();
         
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    ValidationControls.init();
});