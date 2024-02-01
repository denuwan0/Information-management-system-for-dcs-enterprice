<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Revenue License Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<div class="form-row">
						<input type="hidden" class="form-control" id="rev_license_id" required>
						<div class="col-md-3 mb-3">
							<label for="rev_license_no">Revenue License No.</label>
							<input type="text" class="form-control" id="rev_license_no" required>
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
							<label for="valid_from_date">Date from</label>
							<input class="form-control" id="valid_from_date" name="valid_from_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off"/>
							<div id="validationServer05Feedback" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<label for="valid_to_date">Date to</label>
							<input class="form-control" id="valid_to_date" name="valid_to_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off"/>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						
					</div>
					<div class="form-row">							
						<div class="custom-control custom-checkbox">
							<input class="custom-control-input" type="checkbox" id="is_active_vhcl_rev_lice" value="1">
							<label for="is_active_vhcl_rev_lice" class="custom-control-label">is active</label>
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
		url: API+"VehicleRevenue/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#rev_license_id').val(data[0].rev_license_id);
			$('#rev_license_no').val(data[0].rev_license_no);
			$('#vehicle_id').val(data[0].vehicle_id);
			$('#valid_from_date').val(data[0].valid_from_date);
			$('#valid_to_date').val(data[0].valid_to_date);
						
			if(data[0].is_active_vhcl_rev_lice == 1){
				$('#is_active_vhcl_rev_lice').prop('checked', true);
			}
			
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
			
			var realDate1 = new Date(data[0].valid_from_date);
			var realDate2 = new Date(data[0].valid_to_date);
			
			$('#valid_from_date').datepicker({ dateFormat: 'yyyy-mm-dd' }); // format to show
			$('#valid_from_date').datepicker('setDate', realDate1);
			
			$('#valid_to_date').datepicker({ dateFormat: 'yyyy-mm-dd' }); // format to show
			$('#valid_to_date').datepicker('setDate', realDate2);
			
			loadVehicle();
			
			function loadVehicle(){
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"vehicle/fetch_all_active/",
					success: function(data, result){
						var vehicle_drp = '';
						$.each(data, function(index, item) {							
							if(data[0].vehicle_id == item.vehicle_id){
								vehicle_drp += '<option selected value="'+item.vehicle_id+'">'+item.license_plate_no+'</option>';
							}
							else{
								vehicle_drp += '<option value="'+item.vehicle_id+'">'+item.license_plate_no+'</option>';
							}
						});
						$('#vehicle_id').append(vehicle_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(errorThrown);
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
	
	var rev_license_id = 0;
	var rev_license_no = 0;
	var vehicle_id = "";
	var valid_from_date = "";
	var valid_to_date = "";
	var is_active_vhcl_rev_lice = 0;
	
	rev_license_id = $('#rev_license_id').val();
	rev_license_no = $('#rev_license_no').val();
	vehicle_id = $('#vehicle_id').val();
	valid_from_date = $('#valid_from_date').val();
	valid_to_date = $('#valid_to_date').val();
	is_active_vhcl_rev_lice = $("#is_active_vhcl_rev_lice").is(':checked')? 1 : 0;	
		
	if(typeof rev_license_id !== 'undefined' && rev_license_id !== ''
	&& typeof rev_license_no !== 'undefined' && rev_license_no !== ''	
	&& typeof vehicle_id !== 'undefined' && vehicle_id !== '' 
	&& typeof valid_from_date !== 'undefined' && valid_from_date !== '' 
	&& typeof valid_to_date !== 'undefined' && valid_to_date !== '' )
	{
		var formData = new FormData();
		formData.append('rev_license_id',rev_license_id);
		formData.append('rev_license_no',rev_license_no);
        formData.append('vehicle_id',vehicle_id);
		formData.append('valid_from_date',valid_from_date);
		formData.append('valid_to_date',valid_to_date);
		formData.append('is_active_vhcl_rev_lice',is_active_vhcl_rev_lice);
			
		console.log(formData);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"VehicleRevenue/update/",
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
						window.location = "<?php echo base_url() ?>VehicleRevenue/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "License is being used by other modules at the moment!"){
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