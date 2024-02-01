<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Vehicle Details</h3>
			</div>
			<?php var_dump($this->session->userdata()); ?>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="license_plate_no">License Plate No.</label>
								<input type="text" class="form-control" id="license_plate_no" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<?php var_dump($this->session->userdata()); 
								if($this->session->userdata('')){
									
								}
							?>
							<!--div class="col-md-3 mb-3">
								<label for="branch_id">Branch</label>
								<input type="text" class="form-control" id="branch_id" aria-describedby="validationServer05Feedback" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div-->
							<div class="col-md-3 mb-3">
								<label for="vehicle_yom">YOM</label>
								<input type="text" class="form-control" id="vehicle_yom" aria-describedby="validationServer05Feedback" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="chasis_no">Chasis No.</label>
								<input type="text" class="form-control" id="chasis_no" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="vehicle_type_id">Vehicle Type</label>
								<select class="custom-select" id="vehicle_type_id" aria-describedby="" required>
									<option value="">Select Type</option>
								</select>
								<div id="validationServer04Feedback" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="vehicle_category_id">Vehicle Category</label>
								<select class="custom-select" id="vehicle_category_id" aria-describedby="validationServer04Feedback" required>
									<option value="">Select Category</option>
								</select>
								<div id="validationServer04Feedback" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							
						</div>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="engine_no">Engine No.</label>
								<input type="text" class="form-control" id="engine_no" aria-describedby="validationServer03Feedback" required>
								<div id="validationServer03Feedback" class="invalid-feedback">
									Please provide a valid city.
								</div>
							</div>	
							<div class="col-md-3 mb-3">
								<label for="number_of_passengers">No. of Passengers</label>
								<input type="text" class="form-control" id="number_of_passengers" aria-describedby="validationServer05Feedback" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="max_load">Max Load Kg</label>
								<input type="text" class="form-control" id="max_load" aria-describedby="validationServer05Feedback" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_vhcl_details" value="1">
								<label for="customCheckbox1" class="custom-control-label">is active</label>
							</div>
						</div>
					  
					</form>
				</div>			

				<div class="card-footer text-center">
					<button class="btn btn-primary" type="submit">Submit form</button>
				</div>				
			</form>
		</div>
	</div>
</section>
<script>


function loadVhType(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"location/fetch_all_active/",
	success: function(data, result){
		var location_drp = '<option value="">Select Location</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			location_drp += '<option value="'+item.location_id+'">'+item.location_name+'</option>';
        });
		$('#location_id').append(location_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

function loadVhCat(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"company/fetch_all_active/",
	success: function(data, result){
		var company_drp = '<option value="">Select Company</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			company_drp += '<option value="'+item.company_id+'">'+item.company_name+'</option>';
        });
		$('#company_id').append(company_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"employee/fetch_all_active/",
	success: function(data, result){
		var emp_drp = '<option value="">Select Employee</option>';
		$.each(data, function(index, item) {
			console.log(item);
			emp_drp += '<option value="'+item.emp_id+'">'+item.emp_epf+' - '+item.emp_first_name+'</option>';
        });
		$('#branch_manager').append(emp_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});

$('#submit').click(function(e){
	e.preventDefault();
		
	var company_id = 0;
	var company_branch_name = "";
	var location_id = "";
	var branch_contact = "";
	var branch_manager = "";
	var branch_address = "";
	var is_active_branch = 0;
	
	company_id = $('#company_id').val();
	company_branch_name = $('#company_branch_name').val();
	location_id = $('#location_id').val();
	branch_contact = $('#branch_contact').val();
	branch_manager = $('#branch_manager').val();
	branch_address = $('#branch_address').val();
	is_active_branch = $("#is_active_branch").is(':checked')? 1 : 0;
	
	
		
	if(typeof company_id !== 'undefined' && company_id !== '' && typeof company_branch_name !== 'undefined' && company_branch_name !== ''
	&& typeof location_id !== 'undefined' && location_id !== '' && typeof branch_contact !== 'undefined' && branch_contact !== ''
	&& typeof branch_manager !== 'undefined' && branch_manager !== '' && typeof branch_address !== 'undefined' && branch_address !== '')
	{
		
		var formData = new FormData();
        formData.append('company_id',company_id);
		formData.append('company_branch_name',company_branch_name);
		formData.append('location_id',location_id);
		formData.append('branch_contact',branch_contact);
		formData.append('branch_manager',branch_manager);
		formData.append('branch_address',branch_address);
		formData.append('is_active_branch',is_active_branch);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"branch/insert/",
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
					window.location = "<?php echo base_url() ?>branch/view";
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