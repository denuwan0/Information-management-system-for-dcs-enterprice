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
		<p class="login-box-msg">Please enter your details</p>
      <form action="recover-password.html" method="post">
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<button class="btn btn-outline-secondary dropdown-toggle" id="resetMethodDisplay" value="Email" type="button" data-toggle="dropdown" >Email</button>
				<div class="dropdown-menu">
				  <a class="dropdown-item resetMethod" href="#" value="Email">Email</a>
				  <a class="dropdown-item resetMethod" href="#" value="Mobile">Mobile</a>
				</div>
			</div>
			<input type="text" id="inputMethodVal" class="form-control" placeholder="XXXX@email.com">
		</div>
		<div class="row">
		
		</div>
        <div class="row">
          <div class="col-12">
            <button type="submit" id="submit" class="btn btn-primary btn-block">Request reset code</button>
          </div>
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="<?php echo base_url() ?>login">Login</a>
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

<script>
var API = "http://localhost/API/";
var web = "http://localhost/dcs/";

$('.resetMethod').on('click', function(){
	console.log($(this));
	console.log();
	$('#resetMethodDisplay').val($(this)[0].attributes.value.value);
	$('#resetMethodDisplay').text($(this)[0].attributes.value.value);
	if($(this)[0].attributes.value.value == "Mobile"){
		$('#inputMethodVal').attr("placeholder", "94XXXXXXX");
	}
	if($(this)[0].attributes.value.value == "Email"){
		$('#inputMethodVal').attr("placeholder", "XXXX@email.com");
	}
})

$('#submit').click(function(e){
	e.preventDefault();
		
	var inputMethodVal = "";
	var resetMethodDisplay = "";
	const notyf = new Notyf();
	
	
	resetMethodDisplay = $('#resetMethodDisplay').val();
	if(resetMethodDisplay == "Email"){
		inputMethodVal = $('#inputMethodVal').val();
	}
	if(resetMethodDisplay == "Mobile"){
		inputMethodVal = $('#inputMethodVal').val();
	}
	
		
	if(typeof inputMethodVal !== 'undefined' && inputMethodVal !== ''
	&& typeof resetMethodDisplay !== 'undefined' && resetMethodDisplay !== '')
	{
		var state = false;
		
		if(resetMethodDisplay == "Email"){
			var email_pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			state = email_pattern.test( inputMethodVal );
		}
		if(resetMethodDisplay == "Mobile"){
			var phone_pattern = /([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/; 
			state = phone_pattern.test( inputMethodVal );
		}
		
		notyf.error({
		  message: "Please wait while Validating User!",
		  duration: 5000,
		  icon: true,
		  background: 'orange',
		  ripple: true,
		  dismissible: true,
		  position: {
			x: 'right',
			y: 'top',
		  }
		  
		})
		
		window.setTimeout(function() {	
			if(state){		
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					data: {
						inputMethodVal: inputMethodVal,
						resetMethodDisplay: resetMethodDisplay
						},			
					url: web+"ApiRequest/restCodeGenEmp/",
					success: function(data){
						//var count = Object.keys(data).length;
						console.log(data);
					
					
						
						
							if(data.error = true && data.message == 'Invalid credentials!'){
								
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
							else{
								
								notyf.success({
								  message: 'OTP code sent!',
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
									window.location = "<?php echo base_url() ?>login/recoverPassword/"+data.user_id;
								}, 3000);
							}
						
						
						
						/* if(data.error == false){
							
							$.ajax({
								type: "POST",
								cache : false,
								async: true,
								dataType: "json",
								url: web+'ApiRequest/otpGen',
								success: function(data, result){							
									console.log(data);	
									if(data.error == false){
										//$(location).prop('href', web+'login/otp');
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
						} */				
						
						
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
				const notyf = new Notyf();
					
				notyf.error({
				  message: 'Input format miss match!',
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
		}, 3000);
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
