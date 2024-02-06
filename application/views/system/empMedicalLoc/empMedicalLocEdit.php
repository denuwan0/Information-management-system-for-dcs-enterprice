<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Medical Center Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<input type="hidden" class="form-control" id="emp_med_loc_id" required>
							<div class="col-md-8 mb-3">
								<label for="emp_med_loc_name">Medical Center Name</label>
								<input type="text" class="form-control" id="emp_med_loc_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-4 mb-3">
								<label for="emp_med_loc_contact">Contact</label>
								<input type="text" class="form-control" id="emp_med_loc_contact" aria-describedby="validationServer05Feedback" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							
						</div>
						<div class="form-row">
							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_medical_checkup" value="1">
								<label for="is_active_medical_checkup" class="custom-control-label">is active</label>
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
		url: API+"EmpMedicalLoc/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#emp_med_loc_id').val(data[0].emp_med_loc_id);
			$('#emp_med_loc_name').val(data[0].emp_med_loc_name);
			$('#emp_med_loc_contact').val(data[0].emp_med_loc_contact);
						
			if(data[0].is_active_medical_checkup == 1){
				$('#is_active_medical_checkup').prop('checked', true);
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
	
	var emp_med_loc_id  = 0;
	var emp_med_loc_name = 0;
	var emp_med_loc_contact = "";
	var is_active_medical_checkup = 0;
	
	emp_med_loc_id = $('#emp_med_loc_id').val();
	emp_med_loc_name = $('#emp_med_loc_name').val();
	emp_med_loc_contact = $('#emp_med_loc_contact').val();
	is_active_medical_checkup = $("#is_active_medical_checkup").is(':checked')? 1 : 0;
		
	if(typeof emp_med_loc_id !== 'undefined' && emp_med_loc_id !== ''
	&& typeof emp_med_loc_name !== 'undefined' && emp_med_loc_name !== ''	
	&& typeof emp_med_loc_contact !== 'undefined' && emp_med_loc_contact !== '')
	{
		var formData = new FormData();
		formData.append('emp_med_loc_id',emp_med_loc_id);
		formData.append('emp_med_loc_name',emp_med_loc_name);
        formData.append('emp_med_loc_contact',emp_med_loc_contact);
		formData.append('is_active_medical_checkup',is_active_medical_checkup);
		
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"EmpMedicalLoc/update/",
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
						window.location = "<?php echo base_url() ?>EmpMedicalLoc/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Medical Center is being used by other modules at the moment!"){
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