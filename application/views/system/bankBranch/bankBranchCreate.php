<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Bank Branch Details</h3>
			</div>

			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="name">Branch Code</label>
								<input type="text" class="form-control" id="b_branch_code" name="b_branch_code" required>
								<div id="nameError" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="location">Swift Code</label>
								<input type="text" class="form-control" id="b_bank_swift_code" name="b_bank_swift_code" required>
								<div id="locationError" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>							
							<div class="col-md-6 mb-3">
								<label for="company">Bank</label>
								<select class="custom-select" id="bank_id" name="bank_id" required>
								</select>
								<div id="companyError" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="contact">Location</label>
								<select class="custom-select" id="location_id" name="location_id" required>
								</select>
								<div id="companyError" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="manager">Address</label>
								<input type="text" class="form-control" id="b_branch_address" name="b_branch_address" required>
								<div id="addressError" class="invalid-feedback">
									Please provide a valid state.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="address">Contact</label>
								<input type="text" class="form-control" id="b_branch_contact" name="b_branch_contact" required>
								<div id="addressError" class="invalid-feedback">
									Please provide a valid state.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_bank_b_branch" name="is_active_bank_b_branch" value="1">
									<label for="is_active_bank_b_branch" class="custom-control-label">is active</label>
								</div>
							</div>
						</div>
					  
					</form>
				</div>			

				<div class="card-footer text-center">
					<button class="btn btn-primary" type="submit" id="submit">Submit</button>
				</div>				
			</form>
		</div>
	</div>
</section>
<script>

$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"location/fetch_all_active/",
	success: function(data, result){
		var location_id = '<option value="">Select Location</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			location_id += '<option value="'+item.location_id+'">'+item.location_name+'</option>';
        });
		$('#location_id').append(location_id);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});

$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"bank/fetch_all_active/",
	success: function(data, result){
		var bank_drp = '<option value="">Select Bank</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			bank_drp += '<option value="'+item.bank_id+'">'+item.bank_name+'</option>';
        });
		$('#bank_id').append(bank_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});

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
	
	var bank_id = 0;
	var location_id = "";
	var b_branch_code = "";
	var b_branch_address = "";
	var b_branch_contact = "";
	var b_bank_swift_code = "";
	var is_active_bank_b_branch = 0;
	
	bank_id = $('#bank_id').val();
	location_id = $('#location_id').val();
	b_branch_code = $('#b_branch_code').val();
	b_branch_address = $('#b_branch_address').val();
	b_branch_contact = $('#b_branch_contact').val();
	b_bank_swift_code = $('#b_bank_swift_code').val();
	is_active_bank_b_branch = $("#is_active_bank_b_branch").is(':checked')? 1 : 0;
	
	
		
	if(typeof bank_id !== 'undefined' && bank_id !== '' && typeof location_id !== 'undefined' && location_id !== ''
	&& typeof b_branch_code !== 'undefined' && b_branch_code !== '' && typeof b_branch_address !== 'undefined' && b_branch_address !== ''
	&& typeof b_branch_contact !== 'undefined' && b_branch_contact !== '' && typeof b_bank_swift_code !== 'undefined' && b_bank_swift_code !== '')
	{
		
		var formData = new FormData();
        formData.append('bank_id',bank_id);
		formData.append('location_id',location_id);
		formData.append('b_branch_code',b_branch_code);
		formData.append('b_branch_address',b_branch_address);
		formData.append('b_branch_contact',b_branch_contact);
		formData.append('b_bank_swift_code',b_bank_swift_code);
		formData.append('is_active_bank_b_branch',is_active_bank_b_branch);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"bankbranch/insert/",
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
					window.location = "<?php echo base_url() ?>bankbranch/view";
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