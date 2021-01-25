"use strict";
var DatatablesDataSourceHtml = function () {

    var initSkillsValidation = function () {
        $('#localityForm').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                name: {
                    required: true,
                    remote: {
                        url: $('#localityForm').attr('data-url'),
                        type: "post",
                        data: {
                            table: function () {
                                return "localities";
                            },
                            column: function () {
                                return "name";
                            },
                            value: function () {
                                return $("#name").val();
                            },
                            id: function () {
                                return $("#id").val();
                            },
                        }
                    }
                },
            },
            messages: {
                name: {
                    remote: "Please enter unique name",
                }
            },
            errorPlacement: function (error, element) {
                error.appendTo(element.parent()).addClass('text-danger');
            },
            submitHandler: function (e) {
                return true;

            }
        });

    }

    var Selectbox = function () {

        var categorySelect2 = $('.category-select2');
        var citySelect2 = $('.city-select2');

        // start select
        categorySelect2.select2({
            theme: 'bootstrap4',

            allowClear: true,
            ajax: {
                url: function () {
                    return $(this).data('url');
                },
                data: function (params) {
                    return {
                        search: params.term,
                        //  id: $(categorySelect2.data('target')).val()
                    };
                },
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            return {
                                id: item.id,
                                text: item.name,
                                otherfield: item,
                            };
                        }),
                    }
                },
                //cache: true,
                delay: 250
            },
            placeholder: 'Search State',
            // minimumInputLength: 2,
        });

        citySelect2.select2({
            theme: 'bootstrap4',

            allowClear: true,
            // ajax: {
            //     url: function () {
            //         return $(this).data('url'+'/1');
            //     },
            //     data: function (params) {
            //         return {
            //             search: params.term,
            //             //  id: $(categorySelect2.data('target')).val()
            //         };
            //     },
            //     dataType: 'json',
            //     processResults: function (data) {
            //         return {
            //             results: data.map(function (item) {
            //                 return {
            //                     id: item.id,
            //                     text: item.name,
            //                     otherfield: item,
            //                 };
            //             }),
            //         }
            //     },
            //     //cache: true,
            //     delay: 250
            // },
            placeholder: 'Search City',
            // minimumInputLength: 2,
        });

        $('.category-select2').on('change',function (e) {
            var el = $(this);

            var clearInput = el.data('clear').toString();
            if (clearInput.length) {
                $(clearInput).val(null).trigger('change');
            }

            $.ajax({
               type:"GET",
               url:"/city-state?state_id="+el.val(),

               success:function(res){
                if(res){
                    $(".city-select2").empty();
                    $(".city-select2").append('<option value="">Select City</option>');
                    $.each(res,function(key,value){
                        $(".city-select2").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });

                }else{
                   $(".city-select2").empty();
                }
               }
            });

        });
    }


    var PragReplace = function () {
        $('#name').on('keydown',function(){
            
            var name_value = this.value;

            var name = preg_replace('/\s+/', ' ',name_value); 

            $('#name').val(name);
        })
    }
    // end select
    return {
        init: function () {
            initSkillsValidation();
            Selectbox();
            PragReplace();
        },

    };
}();

jQuery(document).ready(function () {
    DatatablesDataSourceHtml.init();
});
