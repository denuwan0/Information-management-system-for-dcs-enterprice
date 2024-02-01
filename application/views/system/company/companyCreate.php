<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Company Details</h3>
				<div style="text-align: right;">
				</div>
			</div>
			<div class="card-body">
				<form enctype="multipart/form-data" id="company_form">
					<div class="form-row">
						<input type="hidden" class="form-control typeahead" id="company_id" placeholder="Enter Company Name" required>
						<div class="col-md-6 mb-3">
							<label for="name">Name</label>
							<input type="text" class="form-control typeahead" id="company_name" placeholder="Enter Company Name" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="description">Address</label>
							<input type="text" class="form-control" id="company_address" placeholder="Enter Address" required>
							<div id="descriptionError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="description">Contact</label>
							<input type="text" class="form-control" id="company_contact" placeholder="Enter Contact" required>
							<div id="descriptionError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="description">About us</label>
							<input type="text" class="form-control" id="company_about_us" placeholder="Enter Description" required>
							<div id="descriptionError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="company_country">Country</label>
							<select class="form-control" id="company_country">
							</select>
						</div>
						<div class="col-md-6 mb-3">
							<label for="company_logo">Company logo</label>
							<div class="input-group">							
								<div class="custom-file">
									<input type="file" class="custom-file-input" name="company_logo" id="company_logo" onchange="document.getElementById('imagePreview').src = window.URL.createObjectURL(this.files[0]);">
									<label class="custom-file-label" for="company_logo">Choose file</label>
								</div>
							</div>
							<h4><!-- Selected file will get here --></h4>
						</div>
						<div class="col-md-6 mb-3">
							<img id="imagePreview" alt="your image" width="200" height="200" src=""/>
						</div>
						<div class="col-md-3 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_company" name="is_active_company" value="1">
								<label for="is_active_company" class="custom-control-label">is active</label>
							</div>
						</div>						
					</div>					  
				</form>
				
			</div>
			<div class="card-footer text-center">
				<button class="btn btn-primary" type="button" id="submit">Submit</button>
			</div>
			<div id="" class="" >
				
			</div>
		</div>
	</div>
</section>
<script>

$("#imagePreview").attr("src",API+"assets/img/download.png");

$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"country/fetch_all_active/",
	success: function(data, result){
		var country_drp = '<option value="">Select Country</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			country_drp += '<option value="'+item.country_id+'">'+item.country_name+'</option>';
        });
		$('#company_country').append(country_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});

$('#submit').click(function(e){
	e.preventDefault();
		
	var company_name = "";
	var company_address = "";
	var company_contact = "";
	var company_about_us = "";
	var company_country = "";
	var company_logo = "";
	var is_active_company = 0;
	
	company_name = $('#company_name').val();
	company_address = $('#company_address').val();
	company_contact = $('#company_contact').val();
	company_about_us = $('#company_about_us').val();
	company_country = $('#company_country').val();
	company_logo = $('#company_logo').prop('files')[0];
	is_active_company = $("#is_active_company").is(':checked')? 1 : 0;
	
	//console.log(company_logo);
	
		
	if(typeof company_name !== 'undefined' && company_name !== '' && typeof company_address !== 'undefined' && company_address !== ''
	&& typeof company_contact !== 'undefined' && company_contact !== '' && typeof company_about_us !== 'undefined' && company_about_us !== ''
	&& typeof company_country !== 'undefined' && company_country !== '' && typeof company_logo !== 'undefined' && company_logo !== '')
	{
		
		var formData = new FormData();
        formData.append('company_name',company_name);
		formData.append('company_address',company_address);
		formData.append('company_contact',company_contact);
		formData.append('company_about_us',company_about_us);
		formData.append('company_country',company_country);
		formData.append('company_logo',company_logo);
		formData.append('is_active_company',is_active_company);
				
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"company/insert/",
			success: function(data, result){
				//console.log(data);	
				const notyf = new Notyf();
				if(data['success']){
					notyf.success({
					  message: 'Data Saved!',
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
						window.location = "<?php echo base_url() ?>company/view";
					}, 3000);
					
				}
				
				
				
				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				//console.log(XMLHttpRequest);
				//console.log(textStatus);		
				//console.log(errorThrown);	
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