<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Vehicle Repiar Location Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<div class="form-row">
						<input type="hidden" class="form-control" id="repair_loc_id" required>
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
		url: API+"VehicleRepairLoc/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#repair_loc_id').val(data[0].repair_loc_id);
			$('#repair_loc_name').val(data[0].repair_loc_name);
			$('#repair_loc_address').val(data[0].repair_loc_address);
			$('#repair_loc_contact').val(data[0].repair_loc_contact);
						
			if(data[0].is_active_vhcl_repair_loc == 1){
				$('#is_active_vhcl_repair_loc').prop('checked', true);
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
	var repair_loc_id = 0;
	var repair_loc_name = "";
	var repair_loc_address = "";
	var repair_loc_contact = "";
	var is_active_vhcl_repair_loc = 0;
	
	repair_loc_id = $('#repair_loc_id').val();
	repair_loc_name = $('#repair_loc_name').val();
	repair_loc_address = $('#repair_loc_address').val();
	repair_loc_contact = $('#repair_loc_contact').val();
	is_active_vhcl_repair_loc = $("#is_active_vhcl_repair_loc").is(':checked')? 1 : 0;	
		
	if(typeof repair_loc_id !== 'undefined' && repair_loc_id !== ''
	&& typeof repair_loc_name !== 'undefined' && repair_loc_name !== ''	
	&& typeof repair_loc_address !== 'undefined' && repair_loc_address !== '' 
	&& typeof repair_loc_contact !== 'undefined' && repair_loc_contact !== '' )
	{
		var formData = new FormData();
		formData.append('repair_loc_id',repair_loc_id);
		formData.append('repair_loc_name',repair_loc_name);
        formData.append('repair_loc_address',repair_loc_address);
		formData.append('repair_loc_contact',repair_loc_contact);
		formData.append('is_active_vhcl_repair_loc',is_active_vhcl_repair_loc);
			
		console.log(formData);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"VehicleRepairLoc/update/",
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
						window.location = "<?php echo base_url() ?>VehicleRepairLoc/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Repair Location is being used by other modules at the moment!"){
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