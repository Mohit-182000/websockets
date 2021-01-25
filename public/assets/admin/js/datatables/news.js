$(document).ready(function () {


   tab_case_list();

                $("#search").click(function(){
                $('#newsTable').DataTable().destroy();
                // table.destroy();
                tab_case_list();
            });

            var categorySelect2 = $('.categorySelect');
                categorySelect2.select2({
                        allowClear :true,
                        ajax: {
                            url: categorySelect2.data('cat-url'),
                            data: function (params) {
                                return {
                                    search: params.term,
                                    id : $(categorySelect2.data('target')).val()
                                };
                            },
                            dataType: 'json',
                            processResults: function (data) {
                                return {
                                    results: data.map(function (item) {
                                        return {
                                            id: item.id,
                                            text: item.category_name,
                                            otherfield: item,
                                        };
                                    }),
                                }
                            },
                            cache: true,
                        },
                        placeholder: 'Select Category',
                        // minimumInputLength: 2,
                    });

                var userCitySelect2 = $('.citySelect');
                userCitySelect2.select2({
                        allowClear :true,
                        ajax: {
                            url: userCitySelect2.data('city-url'),
                            data: function (params) {
                                return {
                                    search: params.term,
                                    id : $(userCitySelect2.data('target')).val()
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
                            cache: true,
                        },
                        placeholder: 'Select City',
                        //minimumInputLength: 2,
                    });
         
         

            $("#btn_clear").click(function(){

                //$('#date_from').val('');
                $('#date_from').val('');
                $('#category').val('').trigger('change');
                $('#city').val('').trigger('change'),
                $('#newsTable').DataTable().destroy();
                tab_case_list();
               
            });

            $(".dateFrom").datepicker({
                format: 'dd-mm-yyyy',
               // todayHighlight: true,
                autoclose: true,
            });




                function tab_case_list() {

                var table2 = $('#newsTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "stateSave": true,
                    "lengthMenu": [10, 25, 50],
                    "responsive": true,
                    // "iDisplayLength": 2,
                    "ajax": {
                        "url": $('#newsTable').attr('data-url'),
                        "dataType": "json",
                        "type": "POST",
                        "data":  {
                          
                            
                            date_to:$('#date_from').val(),
                            category_id:$('#category').val(),
                            city_id:$('#city').val(),

                      
                         }
                    },
                    "order": [
                        [0, "desc"]
                    ],
                    "columns": [
                        {
                            "data": "id"
                        },
                        {
                            "data": "title"
                        },
                        {
                            "data": "category_id"
                        },
                        {
                            "data": "city_id"
                        },
                        // {
                        //     "data": "status",
                        // },
                        {
                            "data": "type",
                        },
                        {
                            "data": "date",
                        },
                        {
                            "data": "action"
                        }
                    ]
                });
                }














});
