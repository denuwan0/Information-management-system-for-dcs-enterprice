<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Special Task Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
						<input type="hidden" class="form-control" id="vehicle_id" required>
							<div class="col-md-6 mb-3">
								<label for="license_plate_no">License Plate No.</label>
								<input type="text" class="form-control" id="license_plate_no" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="branch_id">Branch</label>
								<select class="custom-select" id="branch_id" aria-describedby="" required>
									<option value="">Select Branch</option>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="vehicle_yom">YOM</label>
								<input type="text" class="form-control" id="vehicle_yom" aria-describedby="validationServer05Feedback" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="chasis_no">Chasis No.</label>
								<input type="text" class="form-control" id="chasis_no" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="vehicle_type_id">Vehicle Type</label>
								<select class="custom-select" id="vehicle_type_id" aria-describedby="" required>
									<option value="">Select Type</option>
								</select>
								<div id="validationServer04Feedback" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="vehicle_category_id">Vehicle Category</label>
								<select class="custom-select" id="vehicle_category_id" aria-describedby="validationServer04Feedback" required>
									<option value="">Select Category</option>
								</select>
								<div id="validationServer04Feedback" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							
						</div>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="engine_no">Engine No.</label>
								<input type="text" class="form-control" id="engine_no" aria-describedby="validationServer03Feedback" required>
								<div id="validationServer03Feedback" class="invalid-feedback">
									Please provide a valid city.
								</div>
							</div>	
							<div class="col-md-3 mb-3">
								<label for="number_of_passengers">No. of Passengers</label>
								<input type="text" class="form-control" id="number_of_passengers" aria-describedby="validationServer05Feedback" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="max_load">Max Load (Kg)</label>
								<input type="text" class="form-control" id="max_load" aria-describedby="validationServer05Feedback" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_vhcl_details" value="1">
								<label for="is_active_vhcl_details" class="custom-control-label">is active</label>
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

//$('#form')[0].reset(); 

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
		url: API+"vehicle/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#chasis_no').val(data[0].chasis_no);
			$('#engine_no').val(data[0].engine_no);
			$('#license_plate_no').val(data[0].license_plate_no);
			$('#max_load').val(data[0].max_load);
			$('#number_of_passengers').val(data[0].number_of_passengers);
			$('#vehicle_category_id').val(data[0].vehicle_category_id);
			$('#vehicle_id').val(data[0].vehicle_id);	
			$('#vehicle_type_id').val(data[0].vehicle_type_id);
			$('#vehicle_yom').val(data[0].vehicle_yom);
			$('#branch_id').val(data[0].branch_id);
						
			if(data[0].is_active_vhcl_details == 1){
				$('#is_active_vhcl_details').prop('checked', true);
			}
			
			loadCompanyBranch();
			vehType();
			vehCategory();
			
			function loadCompanyBranch() {
				
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"branch/fetch_all_active/",
					success: function(data1, result){
						console.log(data1);
						
						var branch_drp = '';
						$.each(data1, function(index, item) {
							
							if(data[0].branch_id == item.company_branch_id){
								branch_drp += '<option selected value="'+item.company_branch_id+'">'+item.company_branch_name+'</option>';
							}
							else{
								branch_drp += '<option value="'+item.company_branch_id+'">'+item.company_branch_name+'</option>';
							}

							
						});
						$('#branch_id').append(branch_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(textStatus);
					}
				});
			}
			
			function vehType() {
				
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"vehicleType/fetch_all_active/",
					success: function(data1, result){
						console.log(data1);
						
						var vtype_drp = '';
						$.each(data1, function(index, item) {
							
							if(data[0].vehicle_type_id == item.vehicle_type_id){
								vtype_drp += '<option selected value="'+item.vehicle_type_id+'">'+item.vehicle_type_name+'</option>';
							}
							else{
								vtype_drp += '<option value="'+item.vehicle_type_id+'">'+item.vehicle_type_name+'</option>';
							}

							
						});
						$('#vehicle_type_id').append(vtype_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(textStatus);
					}
				});
			}
			
			function vehCategory() {
				
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"vehicleCategory/fetch_all_active/",
					success: function(data1, result){
						console.log(data1);
						
						var branch_drp = '';
						$.each(data1, function(index, item) {
							
							if(data[0].vehicle_category_id == item.vehicle_category_id){
								branch_drp += '<option selected value="'+item.vehicle_category_id+'">'+item.vehicle_category_name+'</option>';
							}
							else{
								branch_drp += '<option value="'+item.vehicle_category_id+'">'+item.vehicle_category_name+'</option>';
							}

							
						});
						$('#vehicle_category_id').append(branch_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(textStatus);
					}
				});
			}
			
				
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
	
	var vehicle_id = 0;
	var license_plate_no = 0;
	var vehicle_yom = "";
	var vehicle_type_id = 0;
	var vehicle_category_id = 0;
	var chasis_no = "";
	var engine_no = "";
	var number_of_passengers = 0;
	var max_load = 0;
	var branch_id = 0;
	var is_active_vhcl_details = 0;
	
	vehicle_id = $('#vehicle_id').val();
	license_plate_no = $('#license_plate_no').val();
	vehicle_yom = $('#vehicle_yom').val();
	vehicle_type_id = $('#vehicle_type_id').val();
	vehicle_category_id = $('#vehicle_category_id').val();
	chasis_no = $('#chasis_no').val();
	engine_no = $('#engine_no').val();
	number_of_passengers = $('#number_of_passengers').val();
	max_load = $('#max_load').val();
	branch_id = $('#branch_id').val();
	is_active_vhcl_details = $("#is_active_vhcl_details").is(':checked')? 1 : 0;
	
	console.log(vehicle_id+'/'+vehicle_yom+'/'+vehicle_type_id+'/'+vehicle_category_id+'/'+chasis_no+'/'+engine_no
	+'/'+number_of_passengers+'/'+max_load+'/'+branch_id);
		
	if(typeof license_plate_no !== 'undefined' && license_plate_no !== ''
	&& typeof vehicle_id !== 'undefined' && vehicle_id !== ''	
	&& typeof vehicle_yom !== 'undefined' && vehicle_yom !== '' 
	&& typeof vehicle_type_id !== 'undefined' && vehicle_type_id !== '' 
	&& typeof vehicle_category_id !== 'undefined' && vehicle_category_id !== '' 
	&& typeof chasis_no !== 'undefined' && chasis_no !== '' 
	&& typeof engine_no !== 'undefined' && engine_no !== ''
	&& typeof number_of_passengers !== 'undefined' && number_of_passengers !== '' 
	&& typeof max_load !== 'undefined' && max_load !== ''
	&& typeof branch_id !== 'undefined' && branch_id !== '')
	{
		var formData = new FormData();
		formData.append('vehicle_id',vehicle_id);
		formData.append('license_plate_no',license_plate_no);
        formData.append('vehicle_yom',vehicle_yom);
		formData.append('vehicle_type_id',vehicle_type_id);
		formData.append('vehicle_category_id',vehicle_category_id);
        formData.append('chasis_no',chasis_no);
		formData.append('engine_no',engine_no);
		formData.append('number_of_passengers',number_of_passengers);
		formData.append('max_load',max_load);
		formData.append('branch_id',branch_id);
		formData.append('is_active_vhcl_details',is_active_vhcl_details);
		
		
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"vehicle/update/",
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
						window.location = "<?php echo base_url() ?>vehicle/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Vehicle is being used by other modules at the moment!"){
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