<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JEC Ticketing | Log in</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="<?php echo base_url();?>public/assets/vendors/css/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/assets/vendors/css/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/assets/vendors/css/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/assets/vendors/js/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/assets/core/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form id="loginform" method="POST">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <div class="input-group mb-3">
          <input name="userid" id="userid" type="text" class="form-control" placeholder="Userid">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="password" type="password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo base_url();?>public/assets/vendors/js/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>public/assets/vendors/js/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>public/assets/vendors/js/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="<?php echo base_url();?>public/assets/vendors/js/sweetalert2.js"></script>
<script src="<?php echo base_url();?>public/assets/core/js/adminlte.min.js"></script>
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
          $('.swalDefaultSuccess').click(function() {
            Toast.fire({
              icon: 'success',
              title: 'Please Wait . . . '
            })
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

</body>
</html>
