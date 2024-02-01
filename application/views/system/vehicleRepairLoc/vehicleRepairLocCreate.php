<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Vehicle Repiar Location Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<div class="form-row">
						<div class="col-md-6 mb-3">
							<label for="repair_loc_name">Location Name</label>
							<input type="text" class="form-control" id="repair_loc_name" required>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="repair_loc_address">Address</label>
							<input type="text" class="form-control" id="repair_loc_address" required>
						</div>
												
					</div>
					<div class="form-row">	
						<div class="col-md-6 mb-3">
							<label for="repair_loc_contact">Contact</label>
							<input type="text" class="form-control" id="repair_loc_contact" required>
						</div>
						<div class="custom-control custom-checkbox">
							<input class="custom-control-input" type="checkbox" id="is_active_vhcl_repair_loc" value="1">
							<label for="is_active_vhcl_repair_loc" class="custom-control-label">is active</label>
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
		
	var repair_loc_name = "";
	var repair_loc_address = "";
	var repair_loc_contact = "";
	var is_active_vhcl_repair_loc = 0;
	
	repair_loc_name = $('#repair_loc_name').val();
	repair_loc_address = $('#repair_loc_address').val();
	repair_loc_contact = $('#repair_loc_contact').val();
	valid_to_date = $('#valid_to_date').val();
	is_active_vhcl_repair_loc = $("#is_active_vhcl_repair_loc").is(':checked')? 1 : 0;
	
		
	if(typeof repair_loc_name !== 'undefined' && repair_loc_name !== '' 
	&& typeof repair_loc_address !== 'undefined' && repair_loc_address !== ''
	&& typeof repair_loc_contact !== 'undefined' && repair_loc_contact !== '')
	{
		
		var formData = new FormData();
        formData.append('repair_loc_name',repair_loc_name);
		formData.append('repair_loc_address',repair_loc_address);
		formData.append('repair_loc_contact',repair_loc_contact);
		formData.append('is_active_vhcl_repair_loc',is_active_vhcl_repair_loc);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"VehicleRepairLoc/insert/",
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
					window.location = "<?php echo base_url() ?>VehicleRepairLoc/view";
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