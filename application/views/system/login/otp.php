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
  <style>
	  .span {
		 cursor:pointer;
		 color:blue;
		 text-decoration:underline;
	}
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
		<h5 class="login-box-msg">Please Enter OTP </h5>	 
		<p class="" id="countDown" style="text-align: center"></p>
      <form>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="OTP Code" autocomplete="off" name="otp_code" id="otp_code">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-sms" ></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
		  <div class="col-4">
            
          </div>
          <!-- /.col -->
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

var web = "http://localhost/dcs/";

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    var intervalId = setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            $('#countDown').html("");
			
			$.ajax({
				type: "GET",
				cache : false,
				async: true,
				dataType: "json",	
				url: web+"ApiRequest/logout/",
				success: function(data, result){
					//var count = Object.keys(data).length;
					console.log(data);	
					if(data.error == false){
						$(location).prop('href', web+'logout/')				
					}
					else{
						//console.log('error');
					}				
					
					
				},
				
			});	
			//$('#countDown').append( "<p><span class='span'>Request new OTP</span></p>" );
        }
    }, 1000);
    
      
}

window.onload = function () {
    var count = 60,
        display = document.querySelector('#countDown');
       // display.textContent = "00:"+count;
     startTimer(count, display);       

        
};


$(document).on('click', '.span', function(){
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",	
		url: web+"ApiRequest/otpGen/",
		success: function(data, result){
			//var count = Object.keys(data).length;
			console.log(data);	
			if(data.error == false){
				const notyf = new Notyf();
				notyf.success({
				  message: 'New OTP Sent!',
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
		
	});
})

$(document).on('click', '#submit', function(e){
	
	e.preventDefault();
		
	var otp_code = "";
	
	otp_code = $('#otp_code').val();
	
	const notyf = new Notyf();
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
	
		
	if(typeof otp_code !== 'undefined' && otp_code !== '')
	{
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			data: {
				otp_code: otp_code
				},			
			url: web+"ApiRequest/otpVerify/",
			success: function(data, result){
				
				console.log(data);	
				if(data.error == false){
					$(location).prop('href', web+'login/')				
				}
				else{
					const notyf = new Notyf();
					notyf.error({
					  message: 'Invalid OTP!',
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
