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
      <p class="login-box-msg">Please Sign in </p>
	  

      <form>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" autocomplete="off" name="username" id="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
		<center><p style="color:red;" id="error_msg"><?php if (isset($message)){echo $message;}  ?></p></center>
        <div class="row">
          <div class="col-4">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>	
		<div class="row">
			<div class="col-12">
				<p class="mb-1">
					<a href="<?php echo base_url() ?>login/forgotPassword">I forgot my password</a>
				</p>
			 </div>
		</div>
      </form>

      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html"></a>
      </p>
      <!--p class="mb-0">
        <a href="register.html" class="text-center">I forgot my password</a>
      </p-->
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
<script>

var API = "http://localhost/API/";
var web = "http://localhost/dcs/";

$('#submit').click(function(e){
	e.preventDefault();
		
	var username = "";
	var password = "";
	
	username = $('#username').val();
	password = $('#password').val();
		
	if(typeof username !== 'undefined' && username !== '' && typeof password !== 'undefined' && password !== '')
	{
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			data: {
				username: username,
				password: password
				},			
			url: web+"ApiRequest/authenticate/",
			success: function(data, result){
				//var count = Object.keys(data).length;
				console.log(data);	
				if(data.error == false){
					
					$.ajax({
						type: "POST",
						cache : false,
						async: true,
						dataType: "json",
						url: web+'ApiRequest/otpGen',
						success: function(data, result){							
							console.log(data);	
							if(data.error == false){
								$(location).prop('href', web+'login/otp');
							}
														
						}
					});					
				}
				else{
					const notyf = new Notyf();
			
					notyf.error({
					  message: data.message,
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
				
				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {						
				/* const notyf = new Notyf();
			
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
				  
				}) */
				
			}
		});
		
	}
	else{
		//const notyf = new Notyf();
			
		/* notyf.error({
		  message: 'Please Fill Required Fields!',
		  duration: 5000,
		  icon: true,
		  ripple: true,
		  dismissible: true,
		  position: {
			x: 'right',
			y: 'top',
		  }
		  
		}) */
		/* $(document).Toasts('create', {
			icon: 'fas fa-exclamation-triangle',
			class: 'bg-danger m-1',
			autohide: true,
			delay: 5000,
			title: 'An error has occured',
			body: 'Something went wrong'
		});	 */
	}
	
	
})



</script>
</html>
