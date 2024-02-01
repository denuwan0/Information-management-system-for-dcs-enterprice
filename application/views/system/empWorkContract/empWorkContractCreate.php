<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Employee Work Contract</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<label for="emp_id">Employee</label>
								<select class="custom-select" id="emp_id" aria-describedby="" required>
									<option value="">Select Employee</option>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="emp_grade_id">Grade</label>
								<select class="custom-select" id="emp_grade_id" aria-describedby="" required>
									<option value="">Select Grade</option>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="emp_branch_id">Branch</label>
								<select class="custom-select" id="emp_branch_id" aria-describedby="" required>
									<option value="">Select Branch</option>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="emp_company_id">Company</label>
								<select class="custom-select" id="emp_company_id" aria-describedby="" required>
									<option value="">Select Branch</option>
								</select>
							</div>							
						</div>
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<label for="emp_desig_id">Designation</label>
								<select class="custom-select" id="emp_desig_id" aria-describedby="" required>
									<option value="">Select Branch</option>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="emp_ws_id">Work Schedule</label>
								<select class="custom-select" id="emp_ws_id" aria-describedby="" required>
									<option value="">Select Branch</option>
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
								<input class="custom-control-input" type="checkbox" id="is_active_emp_work_cont" value="1">
								<label for="is_active_emp_work_cont" class="custom-control-label">is active</label>
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

function loadEmployee(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"Employee/fetch_all_active/",
	success: function(data, result){
		//console.log(data);
		var location_drp = '';
		$.each(data, function(index, item) {
			//console.log(item);
			location_drp += '<option value="'+item.emp_id+'">'+item.emp_epf+' - '+item.emp_first_name+'</option>';
        });
		$('#emp_id').append(location_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadEmployee();

function loadGrade(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"EmpGrade/fetch_all_active/",
	success: function(data, result){
		//console.log(data);
		var location_drp = '';
		$.each(data, function(index, item) {
			//console.log(item);
			location_drp += '<option value="'+item.emp_grade_id+'">'+item.emp_grade_name+' - '+item.emp_grade_desc+'</option>';
        });
		$('#emp_grade_id').append(location_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadGrade();

function loadBranch(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"Branch/fetch_all_active/",
	success: function(data, result){
		//console.log(data);
		var location_drp = '';
		$.each(data, function(index, item) {
			//console.log(item);
			location_drp += '<option value="'+item.company_branch_id+'">'+item.company_branch_name+' - '+item.branch_address+'</option>';
        });
		$('#emp_branch_id').append(location_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadBranch();

function loadCompany(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"Company/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var location_drp = '';
		$.each(data, function(index, item) {
			//console.log(item);
			location_drp += '<option value="'+item.company_id+'">'+item.company_name+'</option>';
        });
		$('#emp_company_id').append(location_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadCompany();

function loadDesignation(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"EmpDesignation/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var location_drp = '';
		$.each(data, function(index, item) {
			//console.log(item);
			location_drp += '<option value="'+item.emp_desig_id+'">'+item.emp_desig_name+'</option>';
        });
		$('#emp_desig_id').append(location_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadDesignation();

function loadWorkSchedule(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"EmpWorkSchedule/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var location_drp = '';
		$.each(data, function(index, item) {
			//console.log(item);
			location_drp += '<option value="'+item.ws_id+'">'+item.ws_name+'</option>';
        });
		$('#emp_ws_id').append(location_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadWorkSchedule();

$('#submit').click(function(e){
	e.preventDefault();
		
	var emp_id = 0;
	var emp_grade_id = "";
	var emp_branch_id = 0;
	var emp_company_id = 0;
	var emp_desig_id = "";
	var emp_ws_id = "";
	var valid_from_date = 0;
	var valid_to_date = 0;
	var is_active_emp_work_cont = 0;
	
	emp_id = $('#emp_id').val();
	emp_grade_id = $('#emp_grade_id').val();
	emp_branch_id = $('#emp_branch_id').val();
	emp_company_id = $('#emp_company_id').val();
	emp_desig_id = $('#emp_desig_id').val();
	emp_ws_id = $('#emp_ws_id').val();
	valid_from_date = $('#valid_from_date').val();
	valid_to_date = $('#valid_to_date').val();
	is_active_emp_work_cont = $("#is_active_emp_work_cont").is(':checked')? 1 : 0;	
		
	if(typeof emp_id !== 'undefined' && emp_id !== '' 
	&& typeof emp_grade_id !== 'undefined' && emp_grade_id !== ''
	&& typeof emp_branch_id !== 'undefined' && emp_branch_id !== '' 
	&& typeof emp_company_id !== 'undefined' && emp_company_id !== ''
	&& typeof emp_desig_id !== 'undefined' && emp_desig_id !== '' 
	&& typeof emp_ws_id !== 'undefined' && emp_ws_id !== ''
	&& typeof valid_from_date !== 'undefined' && valid_from_date !== '' 
	&& typeof valid_to_date !== 'undefined' && valid_to_date !== '')
	{
		
		var formData = new FormData();
        formData.append('emp_id',emp_id);
		formData.append('emp_grade_id',emp_grade_id);
		formData.append('emp_branch_id',emp_branch_id);
		formData.append('emp_company_id',emp_company_id);
		formData.append('emp_desig_id',emp_desig_id);
		formData.append('emp_ws_id',emp_ws_id);
		formData.append('valid_from_date',valid_from_date);
		formData.append('valid_to_date',valid_to_date);
		formData.append('is_active_emp_work_cont',is_active_emp_work_cont);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpWorkContract/insert/",
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
					window.location = "<?php echo base_url() ?>EmpWorkContract/view";
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