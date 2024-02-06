<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Medical Center Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-8 mb-3">
								<label for="emp_med_loc_name">Medical Center Name</label>
								<input type="text" class="form-control" id="emp_med_loc_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-4 mb-3">
								<label for="emp_med_loc_contact">Contact</label>
								<input type="text" class="form-control" id="emp_med_loc_contact" aria-describedby="validationServer05Feedback" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							
						</div>
						<div class="form-row">
							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_medical_checkup" value="1">
								<label for="is_active_medical_checkup" class="custom-control-label">is active</label>
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
		
	var emp_med_loc_name = "";
	var emp_med_loc_contact = "";
	var is_active_medical_checkup = 0;
	
	emp_med_loc_name = $('#emp_med_loc_name').val();
	emp_med_loc_contact = $('#emp_med_loc_contact').val();
	is_active_medical_checkup = $("#is_active_medical_checkup").is(':checked')? 1 : 0;
	
		
	if(typeof emp_med_loc_name !== 'undefined' && emp_med_loc_name !== '' 
	&& typeof emp_med_loc_contact !== 'undefined' && emp_med_loc_contact !== '')
	{
		
		var formData = new FormData();
        formData.append('emp_med_loc_name',emp_med_loc_name);
		formData.append('emp_med_loc_contact',emp_med_loc_contact);
		formData.append('is_active_medical_checkup',is_active_medical_checkup);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpMedicalLoc/insert/",
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
					window.location = "<?php echo base_url() ?>EmpMedicalLoc/view";
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