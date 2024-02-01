<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Vehicle Type Details</h3>
			</div>

			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="vehicle_type_name">Vehicle Type Name</label>
								<input type="text" class="form-control" id="vehicle_type_name" required>
								<div id="validationServer03Feedback" class="invalid-feedback">
									Please provide a valid city.
								</div>
							</div>	
							<div class="col-md-6 mb-3">
								<label for="vehicle_type_decs">Description</label>
								<input type="text" class="form-control" id="vehicle_type_decs" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
						</div>
						<div class="form-row">													
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_vhcl_type" value="1">
								<label for="is_active_vhcl_type" class="custom-control-label">is active</label>
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


$('#submit').click(function(e){
	e.preventDefault();
		
	var vehicle_type_id = 0;
	var vehicle_type_name = "";
	var vehicle_type_decs = "";
	var is_active_vhcl_type = 0;	
	
	vehicle_type_name = $('#vehicle_type_name').val();
	vehicle_type_decs = $('#vehicle_type_decs').val();
	is_active_vhcl_type = $("#is_active_vhcl_type").is(':checked')? 1 : 0;
		
	if(typeof vehicle_type_name !== 'undefined' && vehicle_type_name !== ''
	&& typeof vehicle_type_decs !== 'undefined' && vehicle_type_decs !== '')
	{
		
		var formData = new FormData();
        formData.append('vehicle_type_id',vehicle_type_id);
		formData.append('vehicle_type_name',vehicle_type_name);
		formData.append('vehicle_type_decs',vehicle_type_decs);
		formData.append('is_active_vhcl_type',is_active_vhcl_type);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"vehicleType/insert/",
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
					window.location = "<?php echo base_url() ?>vehicleType/view";
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