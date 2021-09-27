$(document).ready(function() {
    $("#btnUpdate").hide();
    const csrfHash = $("input[name=access_token]").val();
    
    const table = $('#resTable').DataTable({
        "order": [[ 0, "desc" ]],
        "pageLength": 5,
        "lengthMenu": [ 5, 10, 15, 20],
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
          'url':'GetResponsibility',
          "data": {"access_token": csrfHash},
          },
          'columns': [
             { data : 'id'}, 
             { data: 'responsibility_name' },
             { data: 'responsibility_ff' },
             { 
                "mRender": function(data, type, full) {
                    return '<div class="action-center">'+
                            '<a class="btn btn-info btn-sm btn-circle mini-right-pad edit"><i class="far fa-edit"></i></a></div>';
                            // '<a class="btn btn-danger btn-sm btn-circle delete"><i class="fas fa-trash"></i></a></div>';
                }
            },
          ],
    });

    $("#btnAddModal").click(function(){
       $("#txtResID").val('');
       $("#txtResName").val('');
       $("#chkUsersID").prop( "checked", false );
       $("input[name=chkFormFunction]").prop( "checked", false );
    });
    $( "#btnAdd" ).click(function() {
        const res = $("#txtResName").val();
        const resid = $("#txtResID").val();
        var form ="";
        $("input[name=chkFormFunction]").each(function() {
            // alert(index + ": " + $( this ).attr('id'));
            var id = $( this ).attr('id');
            if($('#'+id).is(':checked'))
            {
              form+=$( this ).val()+",";
            }
           
         });
         
        
        $.ajax({
            url: "CreateUpdateResponsibility",
            type: "POST",
            data: {
                access_token: csrfHash,
                id:resid,
                responsibility_name:res,
                responsibility_ff:form
            },
            cache: false,
            success: function(dataResult){
                swal(dataResult.res+ " "+dataResult.message, {
                    icon: "success",
                });
                table.ajax.reload();
            },
            error: function (data) {
                swal({
                    title: "Action Failed",
                    text: data.responseText,
                    icon: "warning",
                    buttons: "Ok",
                    dangerMode: true,
                  })
            }
        });

    });

    $('#resTable tbody').on( 'click', '.edit', function () {
        $("input[name=chkFormFunction]").prop( "checked", false );
        $("#addModal").modal("show");
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        $("#txtResID").val(data[0]);
        $("#txtResName").val(data[1]);
        var mods = data[2];
        var modsArr = new Array();
        modsArr = mods.split(',');
        
        for (a in modsArr ) {
            if(modsArr[a]!=''){
                $("#"+modsArr[a] ).prop( "checked", true );
            }
        }

        chkUser();
        
    } );

    $('#resTable tbody').on( 'click', '.delete', function () {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        const id = data[0];
        
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this responsibility.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                url: "DeleteResponsibility/"+id,
                type: "DELETE",
                data: {
                    access_token: csrfHash
                },
                cache: false,
                success: function(dataResult){
                    // var dataResult = JSON.parse(dataResult);
                    swal("Poof! "+dataResult.message, {
                        icon: "success",
                    });
                    table.ajax.reload();
                },
            });
            } else {
              swal("Your responsibility details is safe!");
            }
          });

        
    } );

  });

$('#chkUsersID').click(function(){

    if ($('#chkUsersID').prop('checked') == false) {
        $('.chkUsers').prop('checked', false);
    }else {
        $('.chkUsers').prop('checked', true);
    }

});

$('.chkUsers').change(function(){
    chkUser();
});

function chkUser(){
    var checkUser = true;
    $('.chkUsers').each(function(i) {
        if (i != 0) {
            if ($(this).prop('checked') == false) {
                checkUser = false;
            }
        }
    });

    if (checkUser) {
        $('#chkUsersID').prop('checked', true);
    }
    else {
        $('#chkUsersID').prop('checked', false);
    }
}