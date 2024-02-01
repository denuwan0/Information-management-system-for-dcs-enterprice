<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DCS Enterprices</title>

  <!-- Google Font: Source Sans Pro -->
  <!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"-->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/system/backend/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/system/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/system/backend/dist/css/adminlte.min.css">
  <!-- notyf css -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/system/backend/dist/css/notyf.min.css">
  <!-- notyf js -->
  <script src="<?php echo base_url() ?>assets/system/backend/dist/js/notyf.min.js"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>DCS</b> Enterprices</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Please enter OTP and new password.</p>

      <form action="login.html" method="post">
		<div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="OTP Code" id="otp_code" name="otp_code">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm Password" id="confirmPassword" name="confirmPassword">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" id="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.html">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>assets/system/backend/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/system/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/system/backend/dist/js/adminlte.min.js"></script>
</body>

</html>
<script>
var API = "http://localhost/API/";
var web = "http://localhost/dcs/";

var pageUrl = $(location).attr('href');
parts = pageUrl.split("/"),
last_part = parts[parts.length-1];

$('#submit').click(function(e){
	e.preventDefault();
		
	var otp_code = "";
	var password = "";
	var confirmPassword = "";
	
	otp_code = $('#otp_code').val();
	password = $('#password').val();
	confirmPassword = $('#confirmPassword').val();

	console.log(password+' '+confirmPassword);
		
	if(typeof otp_code !== 'undefined' && otp_code !== ''
	&& typeof password !== 'undefined' && password !== ''
	&& typeof confirmPassword !== 'undefined' && confirmPassword !== '')
	{
		if(password == confirmPassword){
			$.ajax({
				type: "POST",
				cache : false,
				async: true,
				dataType: "json",
				data: {
					otp_code: otp_code,
					password: password,
					confirmPassword: confirmPassword,
					user_id: last_part
					},			
				url: web+"ApiRequest/resetPass/",
				success: function(data, result){
					//var count = Object.keys(data).length;
					console.log(data);
					
					const notyf = new Notyf();
					notyf.success({
					  message: 'Password reset successful!',
					  duration: 5000,
					  icon: true,
					  ripple: true,
					  dismissible: true,
					  position: {
						x: 'right',
						y: 'top',
					  }
					  
					})
					
					window.setTimeout(function() {
						window.location = "<?php echo base_url() ?>login";
					}, 3000);
					
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {						
					const notyf = new Notyf();
				
					notyf.error({
					  message: 'Error!',
					  duration: 5000,
					  icon: true,
					  ripple: true,
					  dismissible: true,
					  position: {
						x: 'right',
						y: 'top',
					  }
					  
					})
					
				}
			});			
		}
		else{
			const notyf = new Notyf();
				
			notyf.error({
			  message: 'New password does not match with confirm password!',
			  duration: 5000,
			  icon: true,
			  ripple: true,
			  dismissible: true,
			  position: {
				x: 'right',
				y: 'top',
			  }
			  
			})
		}
	}
	else{
		const notyf = new Notyf();
			
		notyf.error({
		  message: 'Please Fill Required Fields!',
		  duration: 5000,
		  icon: true,
		  ripple: true,
		  dismissible: true,
		  position: {
			x: 'right',
			y: 'top',
		  }
		  
		})
		
	}
	
	
})
</script>