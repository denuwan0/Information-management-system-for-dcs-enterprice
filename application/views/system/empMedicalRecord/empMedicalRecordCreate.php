<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Medical Record Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-2 mb-3">
								<label for="this_med_checkup_date">Current Checkup Date</label>
								<input class="form-control" id="this_med_checkup_date" name="this_med_checkup_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off"/>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="next_med_checkup_date">Next Checkup Date</label>
								<input class="form-control" id="next_med_checkup_date" name="next_med_checkup_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off"/>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-8 mb-3">
								<label for="special_note">Special Note</label>
								<input type="text" class="form-control" id="special_note" aria-describedby="validationServer05Feedback" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="location">Employee</label>
								<select class="custom-select" id="emp_id" name="emp_id" required>
								</select>
								<div id="locationError" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>	
							<div class="col-md-3 mb-3">
								<label for="location">Medical Center</label>
								<select class="custom-select" id="med_loc_id" name="med_loc_id" required>
								</select>
								<div id="locationError" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="location">Overall Health Status</label>
								<select class="custom-select" id="emp_med_status" name="emp_med_status" required>
									<option value="good">Good</option>
									<option value="moderate">Moderate</option>
									<option value="critical">Critical</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_medical_records" value="1">
								<label for="is_active_medical_records" class="custom-control-label">is active</label>
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
	var date_input=$('input[name="this_med_checkup_date"]'); //our date input has the name "date"
	var date_input1=$('input[name="next_med_checkup_date"]'); //our date input has the name "date"
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

function loadMedCenter(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"EmpMedicalLoc/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var company_drp = '<option value="">Select Medical Center</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			company_drp += '<option value="'+item.emp_med_loc_id+'">'+item.emp_med_loc_name+'</option>';
        });
		$('#med_loc_id').append(company_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadEmp();
loadMedCenter();

$('#submit').click(function(e){
	e.preventDefault();
		
	var this_med_checkup_date = "";
	var next_med_checkup_date = "";
	var special_note = 0;
	var emp_id = 0;
	var med_loc_id = "";
	var emp_med_status = "";
	var is_active_medical_records = 0;
	
	this_med_checkup_date = $('#this_med_checkup_date').val();
	next_med_checkup_date = $('#next_med_checkup_date').val();
	special_note = $('#special_note').val();
	emp_id = $('#emp_id').val();
	med_loc_id = $('#med_loc_id').val();
	emp_med_status = $('#emp_med_status').val();
	is_active_medical_records = $("#is_active_medical_records").is(':checked')? 1 : 0;
	
		
	if(typeof this_med_checkup_date !== 'undefined' && this_med_checkup_date !== '' 
	&& typeof next_med_checkup_date !== 'undefined' && next_med_checkup_date !== ''
	&& typeof special_note !== 'undefined' && special_note !== '' 
	&& typeof emp_id !== 'undefined' && emp_id !== ''
	&& typeof med_loc_id !== 'undefined' && med_loc_id !== '' 
	&& typeof emp_med_status !== 'undefined' && emp_med_status !== '')
	{
		
		var formData = new FormData();
        formData.append('this_med_checkup_date',this_med_checkup_date);
		formData.append('next_med_checkup_date',next_med_checkup_date);
		formData.append('special_note',special_note);
		formData.append('emp_id',emp_id);
		formData.append('med_loc_id',med_loc_id);
		formData.append('emp_med_status',emp_med_status);
		formData.append('is_active_medical_records',is_active_medical_records);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpMedicalRecord/insert/",
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
					window.location = "<?php echo base_url() ?>EmpMedicalRecord/view";
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