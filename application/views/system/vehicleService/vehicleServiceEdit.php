<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Vehicle Service Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<div class="form-row">
						<input type="hidden" class="form-control" id="service_detail_id" required>
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

var pageUrl = $(location).attr('href');
parts = pageUrl.split("/"),
last_part = parts[parts.length-1];
//console.log(last_part);

//var country_id = 0;
function loadData() {
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"VehicleService/fetch_single_all_join/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#service_detail_id').val(data[0].service_detail_id);
			$('#service_center_id').val(data[0].service_center_id);
			$('#vehicle_id').val(data[0].vehicle_id);
			$('#next_service_in_kms').val(data[0].next_service_in_kms);
			$('#next_service_in_months').val(data[0].next_service_in_months);
			$('#service_date').val(data[0].service_date);
			$('#service_invoice_number').val(data[0].service_invoice_number);
			$('#service_cost').val(data[0].service_cost);
			$('#description').val(data[0].description);
						
			if(data[0].is_complete == 1){
				$('#is_complete').prop('checked', true);
			}
			if(data[0].is_active_vhcl_srv_detail == 1){
				$('#is_active_vhcl_srv_detail').prop('checked', true);
			}
			
			function loadVehicle(){
			$.ajax({
				type: "POST",
				cache : false,
				async: true,
				dataType: "json",
				url: API+"Vehicle/fetch_all_active/",
				success: function(data1, result){
					//console.log(data1);
					var vehicle_drp = '<option value="">Select Vehicle</option>';
					$.each(data1, function(index, item) {
						if(data[0].vehicle_id == item.vehicle_id){
							vehicle_drp += '<option selected value="'+item.vehicle_id+'">'+item.license_plate_no+'</option>';
						}
						else{
							vehicle_drp += '<option value="'+item.vehicle_id+'">'+item.license_plate_no+'</option>';
						}
						//console.log(item);
						
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
				success: function(data2, result){
					console.log(data);
					var vehicle_drp = '<option value="">Select Service Center</option>';
					$.each(data2, function(index, item) {
						//console.log(item);
						if(data[0].service_center_id == item.service_center_id){
							vehicle_drp += '<option selected value="'+item.service_center_id+'">'+item.service_center_name+'</option>';
						}
						else{
							vehicle_drp += '<option value="'+item.service_center_id+'">'+item.service_center_name+'</option>';
						}
						
					});
					$('#service_center_id').append(vehicle_drp);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {						
					
					//console.log(errorThrown);
				}
			});
			}

			loadServiceCenter();
				
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			//console.log(errorThrown);					
		}
	});
};

$(document).ready(function() {
	loadData();
});

$('#submit').click(function(e){
	e.preventDefault();
	var service_detail_id = 0;
	var service_center_id = "";
	var vehicle_id = "";
	var next_service_in_kms = "";
	var next_service_in_months = 0;
	var service_date = 0;
	var service_invoice_number = "";
	var service_cost = "";
	var description = "";
	var is_complete = 0;
	var is_active_vhcl_srv_detail = 0;
	
	service_detail_id = $('#service_detail_id').val();
	service_center_id = $('#service_center_id').val();
	vehicle_id = $('#vehicle_id').val();
	next_service_in_kms = $('#next_service_in_kms').val();
	next_service_in_months = $('#next_service_in_months').val();
	service_date = $('#service_date').val();
	service_invoice_number = $('#service_invoice_number').val();
	service_cost = $('#service_cost').val();
	description = $('#description').val();
	is_complete = $("#is_complete").is(':checked')? 1 : 0;	
	is_active_vhcl_srv_detail = $("#is_active_vhcl_srv_detail").is(':checked')? 1 : 0;	
		
	if(typeof service_detail_id !== 'undefined' && service_detail_id !== ''
	&& typeof service_center_id !== 'undefined' && service_center_id !== ''	
	&& typeof vehicle_id !== 'undefined' && vehicle_id !== '' 
	&& typeof next_service_in_kms !== 'undefined' && next_service_in_kms !== ''
	&& typeof next_service_in_months !== 'undefined' && next_service_in_months !== ''
	&& typeof service_date !== 'undefined' && service_date !== ''	
	&& typeof service_invoice_number !== 'undefined' && service_invoice_number !== '' 
	&& typeof service_cost !== 'undefined' && service_cost !== ''
	&& typeof description !== 'undefined' && description !== '')
	{
		var formData = new FormData();
		formData.append('service_detail_id',service_detail_id);
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
			
		console.log(formData);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"VehicleService/update/",
			success: function(data, result){

				if(data.message == "Changes Updated!"){	
					const notyf = new Notyf();
				
					notyf.success({
					  message: 'Changes Updated!',
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
						window.location = "<?php echo base_url() ?>VehicleService/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Vehicle Service is being used by other modules at the moment!"){
					const notyf = new Notyf();
					
					notyf.error({
					  message: ''+data.message+'',
					  duration: 3000,
					  icon: true,
					  ripple: true,
					  dismissible: true,
					  position: {
						x: 'right',
						y: 'top',
					  }
					  
					})
					window.setTimeout(function() {
						loadData();
					}, 3000);
					
				}

			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {						
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