<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Vehicle Insurance Claim Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-2 mb-3">
								<label for="claim_number">Claim No.</label>
								<input type="text" class="form-control" id="claim_number" required>
							</div>
							<div class="col-md-6 mb-3">
								<label for="repair_id">Repair</label>
								<select class="custom-select" id="repair_id" aria-describedby="" required>
								</select>
								<div id="validationServer04Feedback" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="claimed_date">Claimed Date</label>
								<input type="text" class="form-control" id="claimed_date" name="claimed_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="claim_amount">Claimed Amount</label>
								<input type="text" class="form-control" id="claim_amount" aria-describedby="validationServer03Feedback" required>
								<div id="validationServer03Feedback" class="invalid-feedback">
									Please provide a valid city.
								</div>
							</div>					
						</div>
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_claim" value="1">
									<label for="is_active_claim" class="custom-control-label">is active</label>
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
	var date_input=$('input[name="claimed_date"]'); //our date input has the name "date"
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
	url: API+"VehicleRepair/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var vehicle_drp = '<option value="">Select Repair</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			vehicle_drp += '<option value="'+item.repair_id+'">'+item.license_plate_no+' - '+item.repair_invoice_number+' - '+item.repair_description+'</option>';
        });
		$('#repair_id').append(vehicle_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadVehicle();

$('#submit').click(function(e){
	e.preventDefault();
		
	var claim_number = 0;
	var repair_id = "";
	var claim_amount = 0;
	var claimed_date = 0;
	var is_active_claim = 0;
	
	claim_number = $('#claim_number').val();
	repair_id = $('#repair_id').val();
	claim_amount = $('#claim_amount').val();
	claimed_date = $('#claimed_date').val();
	is_active_claim = $("#is_active_claim").is(':checked')? 1 : 0;
	
		
	if(typeof claim_number !== 'undefined' && claim_number !== '' 
	&& typeof repair_id !== 'undefined' && repair_id !== ''
	&& typeof claim_amount !== 'undefined' && claim_amount !== '' 
	&& typeof claimed_date !== 'undefined' && claimed_date !== '')
	{
		
		var formData = new FormData();
        formData.append('claim_number',claim_number);
		formData.append('repair_id',repair_id);
		formData.append('claim_amount',claim_amount);
		formData.append('claimed_date',claimed_date);
		formData.append('is_active_claim',is_active_claim);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"vehicleInsuranceClaim/insert/",
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
					window.location = "<?php echo base_url() ?>vehicleInsuranceClaim/view";
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