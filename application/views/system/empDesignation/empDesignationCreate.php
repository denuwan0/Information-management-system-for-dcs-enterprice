<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Employee Designation Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-5 mb-3">
								<label for="emp_desig_name">Designation Name</label>
								<input type="text" class="form-control" id="emp_desig_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-7 mb-3">
								<label for="emp_desig_desc">Description</label>
								<input type="text" class="form-control" id="emp_desig_desc" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>							
						</div>
						<div class="form-row">							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_emp_desig" value="1">
								<label for="is_active_emp_desig" class="custom-control-label">is active</label>
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
		
	var emp_desig_name = "";
	var emp_desig_desc = "";
	var is_active_emp_desig = 0;
	
	emp_desig_name = $('#emp_desig_name').val();
	emp_desig_desc = $('#emp_desig_desc').val();
	is_active_emp_desig = $("#is_active_emp_desig").is(':checked')? 1 : 0;	
		
	if(typeof emp_desig_name !== 'undefined' && emp_desig_name !== '' 
	&& typeof emp_desig_desc !== 'undefined' && emp_desig_desc !== '')
	{
		
		var formData = new FormData();
        formData.append('emp_desig_name',emp_desig_name);
		formData.append('emp_desig_desc',emp_desig_desc);
		formData.append('is_active_emp_desig',is_active_emp_desig);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpDesignation/insert/",
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
					window.location = "<?php echo base_url() ?>EmpDesignation/view";
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