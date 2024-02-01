<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Repair Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<label for="repair_invoice_number">Invoice No.</label>
								<input type="text" class="form-control" id="repair_invoice_number" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="vehicle_id">Vehicle</label>
								<select class="custom-select" id="vehicle_id" aria-describedby="" required>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="start_date">Start Date</label>
								<input type="text" class="form-control" id="start_date" name="start_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="end_date">End Date</label>
								<input type="text" class="form-control" id="end_date" name="end_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="repair_type">Repair Type</label>
								<select class="custom-select" id="repair_type" aria-describedby="" required>
									<option value="accident">Accident</option>
									<option value="maintenance">Maintenance</option>
								</select>
								<div id="validationServer04Feedback" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="repair_location">Repair Location</label>
								<select class="custom-select" id="repair_location" aria-describedby="validationServer04Feedback" required>
								</select>
								<div id="validationServer04Feedback" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="repair_cost">Total Cost.</label>
								<input type="text" class="form-control" id="repair_cost" aria-describedby="validationServer03Feedback" required>
								<div id="validationServer03Feedback" class="invalid-feedback">
									Please provide a valid city.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="repair_description">Description</label>
								<input type="text" class="form-control" id="repair_description" aria-describedby="validationServer03Feedback" required>
								<div id="validationServer03Feedback" class="invalid-feedback">
									Please provide a valid city.
								</div>
							</div>						
						</div>
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_vhcl_repair" value="1">
									<label for="is_active_vhcl_repair" class="custom-control-label">is active</label>
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
$(document).ready(function(){
	var date_input=$('input[name="start_date"]'); //our date input has the name "date"
	var date_input1=$('input[name="end_date"]'); //our date input has the name "date"
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		orientation: 'bottom'
	};
	date_input.datepicker(options);
	date_input1.datepicker(options);
})

function loadVehicle(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"vehicle/fetch_all_active/",
	success: function(data, result){
		//console.log(data);
		var vehicle_drp = '<option value="">Select Vehicle</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			vehicle_drp += '<option value="'+item.vehicle_id+'">'+item.license_plate_no+'</option>';
        });
		$('#vehicle_id').append(vehicle_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

function loadRepairLoc(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"VehicleRepairLoc/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var repair_loc_drp = '<option value="">Select Location</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			repair_loc_drp += '<option value="'+item.repair_loc_id+'">'+item.repair_loc_name+'</option>';
        });
		$('#repair_location').append(repair_loc_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadVehicle();
loadRepairLoc();

$('#submit').click(function(e){
	e.preventDefault();
		
	var repair_invoice_number = 0;
	var repair_description = "";
	var vehicle_id = 0;
	var start_date = 0;
	var end_date = "";
	var repair_type = "";
	var repair_location = 0;
	var repair_cost = 0;
	var is_active_vhcl_repair = 0;
	
	repair_invoice_number = $('#repair_invoice_number').val();
	repair_description = $('#repair_description').val();
	vehicle_id = $('#vehicle_id').val();
	start_date = $('#start_date').val();
	end_date = $('#end_date').val();
	repair_type = $('#repair_type').val();
	repair_location = $('#repair_location').val();
	repair_cost = $('#repair_cost').val();
	is_active_vhcl_repair = $("#is_active_vhcl_repair").is(':checked')? 1 : 0;
	
		
	if(typeof repair_invoice_number !== 'undefined' && repair_invoice_number !== '' 
	&& typeof repair_description !== 'undefined' && repair_description !== ''
	&& typeof vehicle_id !== 'undefined' && vehicle_id !== '' 
	&& typeof start_date !== 'undefined' && start_date !== ''
	&& typeof end_date !== 'undefined' && end_date !== '' 
	&& typeof repair_type !== 'undefined' && repair_type !== ''
	&& typeof repair_location !== 'undefined' && repair_location !== '' 
	&& typeof repair_cost !== 'undefined' && repair_cost !== '')
	{
		
		var formData = new FormData();
        formData.append('repair_invoice_number',repair_invoice_number);
		formData.append('repair_description',repair_description);
		formData.append('vehicle_id',vehicle_id);
		formData.append('start_date',start_date);
		formData.append('end_date',end_date);
		formData.append('repair_type',repair_type);
		formData.append('repair_location',repair_location);
		formData.append('repair_cost',repair_cost);
		formData.append('is_active_vhcl_repair',is_active_vhcl_repair);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"VehicleRepair/insert/",
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
					window.location = "<?php echo base_url() ?>VehicleRepair/view";
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