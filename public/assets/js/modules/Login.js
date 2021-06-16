$(document).ready(function() {
    $( "#btnSubmit" ).click(function() {
       const username = $("#txtUsername").val();
       const password = $("#txtPassword").val();
       const csrfHash = $("input[name=access_token]").val(); // CSRF hash
      
        $.ajax({
            url: "UserLogin",
            type: "POST",
            data: {
                access_token: csrfHash,
                username: username,
                password: password			
            },
            cache: false,
            success: function(dataResult){
                // var dataResult = JSON.parse(dataResult);
                if(dataResult.user!=null){
                    window.location.href="Home";
                    // $("#butsave").removeAttr("disabled");
                    // $('#fupForm').find('input:text').val('');
                    // $("#success").show();
                    // $('#success').html('Data added successfully !'); 						
                }
                
            }
        });
    });
  });