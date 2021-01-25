$(document).ready(function () {
    $("#m_tree_3").jstree({
        plugins: ["wholerow", "checkbox", "types"],
        core: {
            themes: {
                responsive: !1
            },
            data: jsTree
        },
        types: {
            default: {
                icon: "fa fa-folder m--font-warning"
            },
            file: {
                icon: "fa fa-file  m--font-warning"
            }
        }
    });

    $(document).on('getpermission', function () {
        var el = $(this);
        var btndata = el.data();

        var server_tree = $('#m_tree_3').jstree("get_selected", true);
        
        var newArray  = server_tree.map(function (value ,index ) {    
            return $.merge(value.parents ,[value.id]) ;
        });

        var arrayData = $.unique([].concat.apply([], newArray))  ;
        data = arrayData.filter(function (x, i, a) {
            return a.indexOf(x) == i && x != '#' ;
        }).join(',');

        $('#permissiondata').val(data);
    
        // return true ;
    });

    $('#roleForm').validate({
        submitHandler: function (form , e) {
            $(document).trigger('getpermission');
            showLoader();
            $('.btn-save-update').attr("disabled", true);
            return true;
            
        }
    });

});