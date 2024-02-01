<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Company Branch Details</h3>
			</div>

			<form id="form">
				<div class="card-body ">					
					<div class="form-row">
					<input type="hidden" class="form-control" id="vehicle_type_id" required>
						<div class="col-md-6 mb-3">
							<label for="vehicle_type_name">Vehicle Type Name</label>
							<input type="text" class="form-control" id="vehicle_type_name" required>
							<div id="validationServer03Feedback" class="invalid-feedback">
								Please provide a valid city.
							</div>
						</div>	
						<div class="col-md-6 mb-3">
							<label for="vehicle_type_decs">Description</label>
							<input type="text" class="form-control" id="vehicle_type_decs" required>
							<div id="validationServer05Feedback" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
					</div>
					<div class="form-row">													
						<div class="custom-control custom-checkbox">
							<input class="custom-control-input" type="checkbox" id="is_active_vhcl_type" value="1">
							<label for="is_active_vhcl_type" class="custom-control-label">is active</label>
						</div>
					</div>
				</div>			

				<div class="card-footer text-center">
					<button class="btn btn-primary" type="submit" id="submit">Submit</button>
				</div>				
			</form>
		</div>
	</div>
</section>
<script>

$('#form')[0].reset(); 

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
		url: API+"vehicleType/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#vehicle_type_id').val(data[0].vehicle_type_id);
			$('#vehicle_type_decs').val(data[0].vehicle_type_decs);
			$('#vehicle_type_name').val(data[0].vehicle_type_name);			
						
			if(data[0].is_active_vhcl_type == 1){
				$('#is_active_vhcl_type').prop('checked', true);
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
	
	var vehicle_type_id = 0;
	var vehicle_type_name = "";
	var vehicle_type_decs = "";
	var is_active_vhcl_type = 0;
	
	vehicle_type_id =  $('#vehicle_type_id').val();
	vehicle_type_name =  $('#vehicle_type_name').val();
	vehicle_type_decs = $('#vehicle_type_decs').val();
	is_active_vhcl_type = $("#is_active_vhcl_type").is(':checked')? 1 : 0;
		
	if(typeof vehicle_type_id !== 'undefined' && vehicle_type_id !== '' 
	&& typeof vehicle_type_name !== 'undefined' && 	vehicle_type_name !== '' 
	&& typeof vehicle_type_decs !== 'undefined' && vehicle_type_decs !== '' 
	&& typeof is_active_vhcl_type !== 'undefined' && is_active_vhcl_type !== '')
	{
		var formData = new FormData();
		formData.append('vehicle_type_id',vehicle_type_id);
        formData.append('vehicle_type_name',vehicle_type_name);
		formData.append('vehicle_type_decs',vehicle_type_decs);
		formData.append('is_active_vhcl_type',is_active_vhcl_type);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"vehicleType/update/",
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
						window.location = "<?php echo base_url() ?>vehicleType/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Vehicle type is being used by other modules at the moment!"){
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