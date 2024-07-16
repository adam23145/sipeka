<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title>Login Page | SIPEKA</title>
 
	<link rel="icon" type="image/png"  href="<?php echo base_url();?>public/assets/core/images/logo1.png" sizes="32x32"/>
    <!-- Favicons-->
    <!--link rel="icon" href="<?php //echo base_url();?>public/assets/additional/login/images/favicon/favicon-32x32.png" -->
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>public/assets/additional/login/images/favicon/apple-touch-icon-152x152.png">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="<?php echo base_url();?>public/assets/additional/login/images/favicon/mstile-144x144.png">
    <!-- For Windows Phone -->
    
    <link rel="stylesheet" href="<?php echo base_url();?>public/assets/vendors/css/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">


    <!-- CORE CSS-->

    <link href="<?php echo base_url();?>public/assets/additional/login/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo base_url();?>public/assets/additional/login/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo base_url();?>public/assets/additional/login/css/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?php echo base_url();?>public/assets/additional/login/css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo base_url();?>public/assets/additional/login/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">

</head>

<body class="grey" id="mod-login">
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->

    <div id="login-page" class="row">
        <div class="col s12 z-depth-4 card-panel">
            <form class="login-form" id="loginform" method="POST">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="row">
                    <div class="input-field col s12 center">
                        <img src="<?php echo base_url();?>public/assets/core/images/logo1.png" alt="" class="responsive-img valign profile-image-login">
                        <p class="center login-form-text">Please login using your account</p>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input name="userid" id="username" type="text">
                        <label for="username" class="center-align">Username</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-action-lock-outline prefix"></i>
                        <input name="password" id="password" type="password">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light col s12" type="submit">Sign In</button>
                    </div>
                </div>
            </form>
        </div>      
    </div>
</body>

<!-- jQuery Library -->
<script type="text/javascript" src="<?php echo base_url();?>public/assets/additional/login/js/jquery-1.11.2.min.js"></script>
<!--materialize js-->
<script type="text/javascript" src="<?php echo base_url();?>public/assets/additional/login/js/materialize.js"></script>
<!--prism-->
<script type="text/javascript" src="<?php echo base_url();?>public/assets/additional/login/js/prism.js"></script>
<!--scrollbar-->
<script type="text/javascript" src="<?php echo base_url();?>public/assets/additional/login/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url();?>public/assets/vendors/js/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="<?php echo base_url();?>public/assets/vendors/js/sweetalert2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/assets/additional/login/js/plugins.js"></script>


<script type="text/javascript">

    $(document).ready(function(){
        $("#loginform").submit(function(){
            Swal({
                title: 'Please wait . . .',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                }
            });
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().'login/verifylogin'?>",
                data: $(this).serialize(),
                success : function(data){
                    if (data == 0) {
                        swal({
                            type: 'warning',
                            title: 'Oops...',
                            text: 'Kombinasi User ID dengan Password tidak sesuai!',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Oke, saya coba lagi'
                        });
                    } 
                    else if (data == 1) {
                        window.location.replace("<?php echo base_url().'home'?>");
                    }
                }
            });
            return false;
        });

    });
</script>

</html>