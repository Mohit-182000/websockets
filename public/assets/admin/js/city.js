$(document).ready(function () {

  


    $('#languageForm').validate({
        debug: false,
                rules: {
                    name: {
                        required: true,
                        remote: {
                        url: $('#languageForm').attr('data-exit-url'),
                        type: "post",
                        //_token:"{{ csrf_token() }}",
                        //async:true,
                        data: {
                          table: function() {
                            return "new_cities";
                          },
                          column: function() {
                            return "name";
                          },
                          value: function() {
                            return $( "#name" ).val();
                          },
                          id: function() {
                            return $( "#id" ).val();
                          }
                        }
                    }
                    }
                },
                messages:{
                    name:{
                        remote:"City already exist",
                    }
                },

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
