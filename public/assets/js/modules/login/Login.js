$(document).ready(function() {
    $( "#btnSubmit" ).click(function() {
       const email = $("#txtEmail").val();
       const password = $("#txtPassword").val();
       const csrfHash = $("input[name=access_token]").val(); // CSRF hash
      
        $.ajax({
            url: "UserLogin",
            type: "POST",
            data: {
                access_token: csrfHash,
                email: email,
                password: password			
            },
            cache: false,
            success: function(dataResult){		
                // var dataResult = JSON.parse(dataResult);				
                if(dataResult.user!=null){
                    window.location.href="Home";				
                }

            },error: function (data) {
                swal("Login Failed", "Incorrect credentials.");
            }
        });
    });
  });