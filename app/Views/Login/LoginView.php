<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href ="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href ="<?php echo base_url(); ?>/assets/css/login.css" rel="stylesheet">
        <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/brand/EmbLogo.png"/>
    </head>
    <body style="background-image:url(<?php echo base_url(); ?>/assets/brand/BG2.jpg)">
        <div class="wrapper">
            <div id="formContent">
                <!-- Tabs Titles -->
                <div class="title">
                    <h2>EMB WORK FINANCIAL PLAN SYSTEM</h2>
                </div>
                <!-- Icon -->
                <div>
                    <img class="mb-2" src="<?php echo base_url(); ?>/assets/brand/EmbLogo.png" alt="" width="72" height="72">
                </div>

                <!-- Login Form -->
                <form>
                    <input type="text" id="txtEmail" placeholder="Email">
                    <input type="password" id="txtPassword" placeholder="Password">
                    <input type="button" value="Log In" id="btnSubmit">
                </form>
                <?= csrf_field() ?>
                <!-- Remind Passowrd -->
                <div id="formFooter">
                    <a class="underlineHover" href="#">Forgot Password?</a>
                </div>

            </div>
        </div>
    </body>
     
    <script  src = "<?php echo base_url();  ?>/assets/js/bootstrap.bundle.min.js"></script>
    <!-- <script  src = "<?php echo base_url();  ?>/assets/dist/js/jquery-development.js"></script> -->
    <script src="<?php echo base_url();  ?>/assets/assets/jquery/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script  src = "<?php echo base_url();  ?>/assets/js/modules/login/Login.js"></script>
</html>