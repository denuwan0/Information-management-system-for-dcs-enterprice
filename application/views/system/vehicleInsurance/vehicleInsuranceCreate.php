<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Vehicle Insurance Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<label for="insuar_comp_id">Insurance Company</label>
								<select class="custom-select" id="insuar_comp_id" aria-describedby="" required>
								</select>
								<div id="validationServer04Feedback" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="insuarance_number">Insurance/ Policy No.</label>
								<input type="text" class="form-control" id="insuarance_number" required>
							</div>
							<div class="col-md-3 mb-3">
								<label for="insuar_type">Insurance Type</label>
								<select class="custom-select" id="insuar_type" aria-describedby="" required>
									<option value="third party">Third Party Insurance</option>
									<option value="full">Full Insurance</option>
								</select>
								<div id="validationServer04Feedback" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="vehicle_id">Vehicle</label>
								<select class="custom-select" id="vehicle_id" aria-describedby="" required>
								</select>
								<div id="validationServer04Feedback" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="valid_from_date">Valid from</label>
								<input type="text" class="form-control" id="valid_from_date" name="valid_from_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="valid_to_date">Valid to</label>
								<input type="text" class="form-control" id="valid_to_date" name="valid_to_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="premimum_amount">Premimum Amount</label>
								<input type="text" class="form-control" id="premimum_amount" aria-describedby="validationServer03Feedback" required>
								<div id="validationServer03Feedback" class="invalid-feedback">
									Please provide a valid city.
								</div>
							</div>					
						</div>
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_vhcl_ins_details" value="1">
									<label for="is_active_vhcl_ins_details" class="custom-control-label">is active</label>
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
	var date_input=$('input[name="valid_from_date"]'); //our date input has the name "date"
	var date_input1=$('input[name="valid_to_date"]'); //our date input has the name "date"
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

function loadInsCompany(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"VehicleInsuranceCompany/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var repair_loc_drp = '<option value="">Select Insurance Company</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			repair_loc_drp += '<option value="'+item.insuar_comp_id+'">'+item.insuar_comp_name+'</option>';
        });
		$('#insuar_comp_id').append(repair_loc_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadVehicle();
loadInsCompany();

$('#submit').click(function(e){
	e.preventDefault();
		
	var insuar_comp_id = 0;
	var insuarance_number = "";
	var insuar_type = 0;
	var valid_from_date = 0;
	var valid_to_date = "";
	var premimum_amount = "";
	var vehicle_id = 0;
	var is_active_vhcl_ins_details = 0;
	
	insuar_comp_id = $('#insuar_comp_id').val();
	insuarance_number = $('#insuarance_number').val();
	insuar_type = $('#insuar_type').val();
	valid_from_date = $('#valid_from_date').val();
	valid_to_date = $('#valid_to_date').val();
	premimum_amount = $('#premimum_amount').val();
	vehicle_id = $('#vehicle_id').val();
	is_active_vhcl_ins_details = $("#is_active_vhcl_ins_details").is(':checked')? 1 : 0;
	
		
	if(typeof insuar_comp_id !== 'undefined' && insuar_comp_id !== '' 
	&& typeof insuarance_number !== 'undefined' && insuarance_number !== ''
	&& typeof insuar_type !== 'undefined' && insuar_type !== '' 
	&& typeof valid_from_date !== 'undefined' && valid_from_date !== ''
	&& typeof valid_to_date !== 'undefined' && valid_to_date !== '' 
	&& typeof premimum_amount !== 'undefined' && premimum_amount !== ''
	&& typeof vehicle_id !== 'undefined' && vehicle_id !== '' )
	{
		
		var formData = new FormData();
        formData.append('insuar_comp_id',insuar_comp_id);
		formData.append('insuarance_number',insuarance_number);
		formData.append('insuar_type',insuar_type);
		formData.append('valid_from_date',valid_from_date);
		formData.append('valid_to_date',valid_to_date);
		formData.append('premimum_amount',premimum_amount);
		formData.append('vehicle_id',vehicle_id);
		formData.append('is_active_vhcl_ins_details',is_active_vhcl_ins_details);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"vehicleInsurance/insert/",
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
					window.location = "<?php echo base_url() ?>vehicleInsurance/view";
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