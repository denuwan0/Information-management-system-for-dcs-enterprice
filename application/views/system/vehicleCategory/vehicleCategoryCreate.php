<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Vehicle Category Details</h3>
			</div>

			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="vehicle_category_name">Vehicle Category Name</label>
								<input type="text" class="form-control" id="vehicle_category_name" required>
								<div id="validationServer03Feedback" class="invalid-feedback">
									Please provide a valid city.
								</div>
							</div>	
							<div class="col-md-6 mb-3">
								<label for="vehicle_category_desc">Description</label>
								<input type="text" class="form-control" id="vehicle_category_desc" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
						</div>
						<div class="form-row">													
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_vhcl_cat" value="1">
								<label for="is_active_vhcl_cat" class="custom-control-label">is active</label>
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
		
	var vehicle_category_id = 0;
	var vehicle_category_name = "";
	var vehicle_category_desc = "";
	var is_active_vhcl_cat = 0;	
	
	vehicle_category_name = $('#vehicle_category_name').val();
	vehicle_category_desc = $('#vehicle_category_desc').val();
	is_active_vhcl_cat = $("#is_active_vhcl_cat").is(':checked')? 1 : 0;
		
	if(typeof vehicle_category_name !== 'undefined' && vehicle_category_name !== ''
	&& typeof vehicle_category_desc !== 'undefined' && vehicle_category_desc !== '')
	{
		
		var formData = new FormData();
        formData.append('vehicle_category_id',vehicle_category_id);
		formData.append('vehicle_category_desc',vehicle_category_desc);
		formData.append('vehicle_category_name',vehicle_category_name);
		formData.append('is_active_vhcl_cat',is_active_vhcl_cat);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"vehicleCategory/insert/",
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
					window.location = "<?php echo base_url() ?>vehicleCategory/view";
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