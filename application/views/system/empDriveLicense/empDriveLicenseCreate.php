<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Driving License Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<div class="form-row">
						<div class="col-md-3 mb-3">
							<label for="location">Employee</label>
							<select class="custom-select" id="emp_id" name="emp_id" required>
							</select>
							<div id="locationError" class="invalid-feedback">
								Please select a valid state.
							</div>
						</div>	
						<div class="col-md-3 mb-3">
							<label for="license_number">License No.</label>
							<input type="text" class="form-control" id="license_number" required>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<label for="license_type">Vehicle Category</label>
							<select class="custom-select" id="license_type" aria-describedby="" required>
								<option value="">Select Category</option>
								<option value="Light">Light vehicle</option>
								<option value="Heavy">Heavy vehicle</option>
							</select>
						</div>
						<div class="col-md-3 mb-3">							
							<label class="control-label" for="date">Valid from</label>
							<input class="form-control" id="valid_from_date" name="valid_from_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off">							
						</div>	
						<div class="col-md-3 mb-3">							
							<label class="control-label" for="date">Valid to</label>
							<input class="form-control" id="valid_to_date" name="valid_to_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off">							
						</div>
						<div class="custom-control custom-checkbox">
							<input class="custom-control-input" type="checkbox" id="is_active_driving_lice" value="1">
							<label for="is_active_driving_lice" class="custom-control-label">is active</label>
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
	var date_input1=$('input[name="valid_from_date"]'); //our date input has the name "date"
	var date_input2=$('input[name="valid_to_date"]'); //our date input has the name "date"
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		orientation: 'bottom'
	};
	date_input1.datepicker(options);
	date_input2.datepicker(options);
})

function loadEmp(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"Employee/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var location_drp = '<option value="">Select Employee</option>';
		$.each(data, function(index, item) {			
			location_drp += '<option value="'+item.emp_id+'">'+item.emp_epf+' - '+item.emp_first_name+'</option>';
        });
		$('#emp_id').append(location_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadEmp();

$('#submit').click(function(e){
	e.preventDefault();
		
	var license_number = 0;
	var valid_from_date = "";
	var valid_to_date = "";
	var license_type = 0;
	var is_active_driving_lice = 0;
	var emp_id = 0;
	
	license_number = $('#license_number').val();
	valid_from_date = $('#valid_from_date').val();
	valid_to_date = $('#valid_to_date').val();
	license_type = $('#license_type').val();
	emp_id = $('#emp_id').val();
	is_active_driving_lice = $("#is_active_driving_lice").is(':checked')? 1 : 0;
	
		
	if(typeof license_number !== 'undefined' && license_number !== '' 
	&& typeof valid_from_date !== 'undefined' && valid_from_date !== ''
	&& typeof valid_to_date !== 'undefined' && valid_to_date !== '' 
	&& typeof license_type !== 'undefined' && license_type !== ''
	&& typeof emp_id !== 'undefined' && emp_id !== '')
	{
		
		var formData = new FormData();
        formData.append('license_number',license_number);
		formData.append('valid_from_date',valid_from_date);
		formData.append('valid_to_date',valid_to_date);
		formData.append('license_type',license_type);
		formData.append('emp_id',emp_id);
		formData.append('is_active_driving_lice',is_active_driving_lice);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpDrivingLicense/insert/",
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
					window.location = "<?php echo base_url() ?>EmpDrivingLicense/view";
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