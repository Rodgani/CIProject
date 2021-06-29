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
                            '<a class="btn btn-info btn-sm btn-circle mini-right-pad edit"><i class="far fa-edit"></i></a>'+
                            '<a class="btn btn-danger btn-sm btn-circle delete"><i class="fas fa-trash"></i></a></div>';
                }
            },
          ],
    });

    var chkUser = true;
    $('.chkUsers').each(function(i, obj) {
        if (i != 0) {
            if ($(this).prop('checked') == false) {
                chkUser= false;
            }
        }
    });

    if (chkUser) {
        $('#chkUsersID').prop('checked', true);
    }
    else {
        $('#chkUsersID').prop('checked', false);
    }

    $( "#btnAdd" ).click(function() {
        const res = $("#txtResName").val();
        var form ="";
        $('.chkUsers').each(function(index) {
            // alert(index + ": " + $( this ).attr('id'));
            var id = $( this ).attr('id');
            if($('#'+id).is(':checked'))
            {
              form+=$( this ).val()+",";
            }
           
         });
         
        
        $.ajax({
            url: "Responsibility",
            type: "POST",
            data: {
                access_token: csrfHash,
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
  });

$('#chkUsersID').click(function(){

    if ($('#chkUsersID').prop('checked') == false) {
        $('.chkUsers').prop('checked', false);
    }else {
        $('.chkUsers').prop('checked', true);
    }

});

$('.chkUsers').change(function(){
    var checkUser = true;

    $('.chkUsers').each(function(i, obj) {
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

});