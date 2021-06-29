$(document).ready(function() {
    $("#btnUpdate").hide();
    const csrfHash = $("input[name=access_token]").val();
    
    const table = $('#userTable').DataTable({
        "order": [[ 0, "desc" ]],
        "pageLength": 5,
        "lengthMenu": [ 5, 10, 15, 20],
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
          'url':'getUser',
          "data": {"access_token": csrfHash},
          },
          'columns': [
             { data : 'id'}, 
             { data: 'email' },
             { data: 'iis_employee_number' },
             { data: 'responsibility' },
             { 
                "mRender": function(data, type, full) {
                    return '<div class="action-center">'+
                            '<a class="btn btn-info btn-sm btn-circle mini-right-pad edit"><i class="far fa-edit"></i></a>'+
                            '<a class="btn btn-danger btn-sm btn-circle delete"><i class="fas fa-trash"></i></a></div>';
                }
            },
          ],
    });

    $("#btnAddModal").click(function(){
        clearInputs();
        $("#txtPassword").prop("disabled",false);
        $("#btnUpdate").hide();
        $("#btnAdd").show();
    });

    $( "#btnAdd" ).click(function() {
        const email = $("#txtEmail").val();
        const password = $("#txtPassword").val();
        const iisemployeeid = $("#txtIISEmployeeID").val();
        const levelaccess = $("#selAccess").val();
       // CSRF hash
       
        $.ajax({
            url: "User",
            type: "POST",
            data: {
                access_token: csrfHash,
                iis_employee_number: iisemployeeid,
                email: email,
                password: password,
                responsibility:levelaccess	
            },
            cache: false,
            success: function(dataResult){
                // var dataResult = JSON.parse(dataResult);
                removeclases();
                $(".alert").addClass("alert-success-cus");
                $( ".alert-message" ).append( dataResult.email + " " + dataResult.message );
                showSuccess();
                table.ajax.reload();
            },
            error: function (data) {
                removeclases();
                $(".alert").addClass("alert-error-cus");
                $( ".alert-message" ).append("error " + data.responseText );
                showError();
            }
        });

    });

    $('#userTable tbody').on( 'click', '.edit', function () {
        clearInputs();
        $("#txtPassword").prop("disabled",true);
        $("#btnAdd").hide();
        $("#btnUpdate").show();
        $("#addModal").modal("show");
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        $("#txtID").val(data[0]);
        $("#txtEmail").val(data[1]);
        $("#txtIISEmployeeID").val(data[2]);
        $("#selAccess").val(data[3]);

    } );

    $("#btnUpdate").click(function(){
        const id = $("#txtID").val();
        const email = $("#txtEmail").val();
        const iisemployeeid = $("#txtIISEmployeeID").val();
        const levelaccess = $("#selAccess").val();
       
        $.ajax({
            url: "updateUser",
            type: "POST",
            data: {
                access_token: csrfHash,
                id:id,
                iis_employee_number: iisemployeeid,
                email: email,
                responsibility:levelaccess	
            },
            cache: false,
            success: function(dataResult){
                // var dataResult = JSON.parse(dataResult);
                removeclases();
                $(".alert").addClass("alert-success-cus");
                $( ".alert-message" ).append( dataResult.Users.email + " " + dataResult.message );
                showSuccess();
                table.ajax.reload();
            },
            error: function (data) {
                removeclases();
                $(".alert").addClass("alert-error-cus");
                $( ".alert-message" ).append("error " + data.responseText );
                showError();
            }
        });

    });

    $('#userTable tbody').on( 'click', '.delete', function () {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        const id = data[0];
        
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this account",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                url: "deleteUser",
                type: "POST",
                data: {
                    access_token: csrfHash,
                    id:id,
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
              swal("Your imaginary file is safe!");
            }
          });

        
    } );

  });

  function removeclases(){
    $(".alert").removeClass("alert-success-cus");
    $(".alert").removeClass("alert-error-cus");
    $(".alert-message" ).empty();
  }
  function showSuccess(){
    $(".alert").show("slow");
    $('.alert').delay(3000).fadeOut('slow');
  }
  function showError(){
    $(".alert").show("slow");
    $('.alert').delay(10000).fadeOut('slow');
  }
  function clearInputs(){
    $('.modal-body').find('input,select').val('');    
  }