<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Vehicle Service Center Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<div class="form-row">
						<div class="col-md-6 mb-3">
							<label for="service_center_name">Name</label>
							<input type="text" class="form-control" id="service_center_name" required>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="service_center_address">Address</label>
							<input type="text" class="form-control" id="service_center_address" required>
						</div>
												
					</div>
					<div class="form-row">	
						<div class="col-md-6 mb-3">
							<label for="service_center_contact">Contact</label>
							<input type="text" class="form-control" id="service_center_contact" required>
						</div>
						<div class="custom-control custom-checkbox">
							<input class="custom-control-input" type="checkbox" id="is_active_vhcl_srv_cntr" value="1">
							<label for="is_active_vhcl_srv_cntr" class="custom-control-label">is active</label>
						</div>
					</div>
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
		
	var service_center_name = "";
	var service_center_contact = "";
	var service_center_address = "";
	var is_active_vhcl_srv_cntr = 0;
	
	service_center_name = $('#service_center_name').val();
	service_center_contact = $('#service_center_contact').val();
	service_center_address = $('#service_center_address').val();
	is_active_vhcl_srv_cntr = $("#is_active_vhcl_srv_cntr").is(':checked')? 1 : 0;
	
		
	if(typeof service_center_name !== 'undefined' && service_center_name !== '' 
	&& typeof service_center_contact !== 'undefined' && service_center_contact !== ''
	&& typeof service_center_address !== 'undefined' && service_center_address !== '')
	{
		
		var formData = new FormData();
        formData.append('service_center_name',service_center_name);
		formData.append('service_center_contact',service_center_contact);
		formData.append('service_center_address',service_center_address);
		formData.append('is_active_vhcl_srv_cntr',is_active_vhcl_srv_cntr);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"vehicleServiceCenter/insert/",
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
					window.location = "<?php echo base_url() ?>vehicleServiceCenter/view";
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