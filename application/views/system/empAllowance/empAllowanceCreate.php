<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Allowance Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-4 mb-3">
								<label for="allowance_name">Allowance Name</label>
								<input type="text" class="form-control" id="allowance_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>							
							<div class="col-md-8 mb-3">
								<label for="allowance_desc">Description</label>
								<input type="text" class="form-control" id="allowance_desc" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>							
						</div>
						<div class="form-row">							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_emp_allow" value="1">
								<label for="is_active_emp_allow" class="custom-control-label">is active</label>
							</div>
						</div>
					  
					</form>
				</div>			

				<div class="card-footer text-center">
					<button class="btn btn-primary" id="submit" type="submit">Submit</button>
				</div>				
			</form>
		</div>
	</div>
</section>
<script>

$('#submit').click(function(e){
	e.preventDefault();
		
	var allowance_name = "";
	var allowance_desc = "";
	var is_active_emp_allow = 0;
	
	allowance_name = $('#allowance_name').val();
	allowance_desc = $('#allowance_desc').val();
	is_active_emp_allow = $("#is_active_emp_allow").is(':checked')? 1 : 0;
	
		
	if(typeof allowance_name !== 'undefined' && allowance_name !== '' 
	&& typeof allowance_desc !== 'undefined' && allowance_desc !== '')
	{
		
		var formData = new FormData();
        formData.append('allowance_name',allowance_name);
		formData.append('allowance_desc',allowance_desc);
		formData.append('is_active_emp_allow',is_active_emp_allow);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpAllowance/insert/",
			success: function(data, result){
				console.log(data);	
				const notyf = new Notyf();
			if(data['message'] == 'Data Saved!'){
				notyf.success({
				  message: data['message'],
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
					window.location = "<?php echo base_url() ?>EmpAllowance/view";
				}, 3000);
			}	
				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(XMLHttpRequest);
				console.log(textStatus);		
				console.log(errorThrown);	
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