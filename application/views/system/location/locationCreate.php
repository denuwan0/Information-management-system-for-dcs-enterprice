<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Company Location Details</h3>
			</div>

			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="name">Location Name</label>
								<input type="text" class="form-control" name="location_name"  id="location_name" required>
								<div id="nameError" class="invalid-feedback">
									Please Enter Location Name.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="name">Location Description</label>
								<input type="text" class="form-control" name="location_desc"  id="location_desc" required>
								<div id="nameError" class="invalid-feedback">
									Please Enter Location Description.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="company_country">Country</label>
								<select class="form-control" id="country_id" name="country_id">
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_location" name="is_active_location" value="1">
									<label for="is_active_location" class="custom-control-label">is active</label>
								</div>
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
		$('#country_id').append(country_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});

$('#submit').click(function(e){
	e.preventDefault();
		
	var location_name = "";
	var country_id = "";
	var location_desc = "";
	var is_active_location = 0;
	
	location_name = $('#location_name').val();
	country_id = $('#country_id').val();
	location_desc = $('#location_desc').val();
	is_active_location = $("#is_active_location").is(':checked')? 1 : 0;
	
	
		
	if(typeof location_name !== 'undefined' && location_name !== '' && typeof location_desc !== 'undefined' && location_desc !== ''
	&& typeof country_id !== 'undefined' && country_id !== '')
	{
		
		var formData = new FormData();
        formData.append('location_name',location_name);
		formData.append('country_id',country_id);
		formData.append('location_desc',location_desc);
		formData.append('is_active_location',is_active_location);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"location/insert/",
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
					window.location = "<?php echo base_url() ?>location/view";
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