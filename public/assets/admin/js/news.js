$(document).ready(function () {

    $('.select2').select2({
        theme : 'bootstrap4',
        allowClear: true
    });


    $('#newsForm').validate({
         // debug: false,
         //        rules: {
         //            title: {
         //                required: true,
         //                remote: {
         //                url: $('#newsForm').attr('data-exit-url'),
         //                type: "post",
         //                //_token:"{{ csrf_token() }}",
         //                //async:true,
         //                data: {
         //                  table: function() {
         //                    return "news";
         //                  },
         //                  column: function() {
         //                    return "title";
         //                  },
         //                  value: function() {
         //                    return $( "#title" ).val();
         //                  },
         //                  id: function() {
         //                    return $( "#id" ).val();
         //                  }
         //                }
         //            }
         //            }
         //        },
         //        messages:{
         //            title:{
         //                remote:"Title already exist",
         //            }
         //        },

        errorPlacement: function(error, element) {
            $(error).addClass('text-danger');

            if( $(element).is('.parentSelect') || $(element).is('.newsCityId')  || $(element).is("input:file")  )    {
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




    $('.category-check').on('keyup paste',function (e) {
        $('#newsForm').valid();
    });

  



});
