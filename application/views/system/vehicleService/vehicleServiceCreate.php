<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Vehicle Service Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<div class="form-row">
						<div class="col-md-3 mb-3">
							<label for="service_center_id">Service Center</label>
							<select class="custom-select" id="service_center_id" aria-describedby="" required>
							</select>
						</div>
						<div class="col-md-3 mb-3">
							<label for="vehicle_id">Vehicle</label>
							<select class="custom-select" id="vehicle_id" aria-describedby="" required>
							</select>
						</div>
						<div class="col-md-2 mb-3">
							<label for="next_service_in_kms">Next Service in Kms</label>
							<input type="text" class="form-control" id="next_service_in_kms" required>
						</div>
						<div class="col-md-2 mb-3">
							<label for="next_service_in_months">Next Service in Months</label>
							<input type="text" class="form-control" id="next_service_in_months" required>
						</div>
						<div class="col-md-2 mb-3">
							<label for="service_date">Service Date</label>
							<input type="text" class="form-control" id="service_date" name="service_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" required>
						</div>
						<div class="col-md-2 mb-3">
							<label for="service_invoice_number">Service Invoice No.</label>
							<input type="text" class="form-control" id="service_invoice_number" required>
						</div>
						<div class="col-md-2 mb-3">
							<label for="service_cost">Cost</label>
							<input type="text" class="form-control" id="service_cost" required>
						</div>
						<div class="col-md-8 mb-3">
							<label for="description">Description</label>
							<input type="text" class="form-control" id="description" required>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-2 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_vhcl_srv_detail" value="1">
								<label for="is_active_vhcl_srv_detail" class="custom-control-label">is active</label>
							</div>
						</div>
						<div class="col-md-2 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_complete" value="1">
								<label for="is_complete" class="custom-control-label">is complete</label>
							</div>
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
$(document).ready(function(){
	var date_input=$('input[name="service_date"]'); //our date input has the name "date"
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		orientation: 'bottom'
	};
	date_input.datepicker(options);
})

function loadVehicle(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"Vehicle/fetch_all_active/",
	success: function(data, result){
		console.log(data);
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

loadVehicle();

function loadServiceCenter(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"VehicleServiceCenter/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var vehicle_drp = '<option value="">Select Service Center</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			vehicle_drp += '<option value="'+item.service_center_id+'">'+item.service_center_name+'</option>';
        });
		$('#service_center_id').append(vehicle_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadServiceCenter();


$('#submit').click(function(e){
	e.preventDefault();
		
	var service_center_id = 0;
	var vehicle_id = 0;
	var next_service_in_kms = 0;
	var next_service_in_months = 0;
	var service_date = 0;
	var service_invoice_number = 0;
	var service_cost = 0;
	var description = 0;
	var is_complete = 0;
	var is_active_vhcl_srv_detail = 0;
	
	service_center_id = $('#service_center_id').val();
	vehicle_id = $('#vehicle_id').val();
	next_service_in_kms = $('#next_service_in_kms').val();
	next_service_in_months = $('#next_service_in_months').val();
	service_date = $('#service_date').val();
	service_invoice_number = $('#service_invoice_number').val();
	service_cost = $('#service_cost').val();
	description = $('#description').val();
	is_complete = $('#is_complete').val();
	is_active_vhcl_srv_detail = $("#is_active_vhcl_srv_detail").is(':checked')? 1 : 0;
	
		
	if(typeof service_center_id !== 'undefined' && service_center_id !== '' 
	&& typeof vehicle_id !== 'undefined' && vehicle_id !== ''
	&& typeof next_service_in_kms !== 'undefined' && next_service_in_kms !== ''
	&& typeof next_service_in_months !== 'undefined' && next_service_in_months !== ''
	&& typeof service_date !== 'undefined' && service_date !== '' 
	&& typeof service_invoice_number !== 'undefined' && service_invoice_number !== ''
	&& typeof service_cost !== 'undefined' && service_cost !== ''
	&& typeof description !== 'undefined' && description !== '')
	{
		
		var formData = new FormData();
        formData.append('service_center_id',service_center_id);
		formData.append('vehicle_id',vehicle_id);
		formData.append('next_service_in_kms',next_service_in_kms);
		formData.append('next_service_in_months',next_service_in_months);
		formData.append('service_date',service_date);
		formData.append('service_invoice_number',service_invoice_number);
		formData.append('service_cost',service_cost);
		formData.append('description',description);
		formData.append('is_complete',is_complete);
		formData.append('is_active_vhcl_srv_detail',is_active_vhcl_srv_detail);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"vehicleService/insert/",
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
					window.location = "<?php echo base_url() ?>vehicleService/view";
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