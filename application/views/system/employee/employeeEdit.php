<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Employee Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
						<input type="hidden" class="form-control typeahead" id="emp_id" name="emp_id"  placeholder="" value="" required>
							<div class="col-md-2 mb-3">
								<label for="emp_epf">Epf No.</label>
								<input type="text" class="form-control" id="emp_epf" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="emp_first_name">First Name</label>
								<input type="text" class="form-control" id="emp_first_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="emp_middle_name">Middle Name</label>
								<input type="text" class="form-control" id="emp_middle_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-4 mb-3">
								<label for="emp_last_name">Last Name</label>
								<input type="text" class="form-control" id="emp_last_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="emp_nic">NIC No.</label>
								<input type="text" class="form-control" id="emp_nic" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>						
							<div class="col-md-3 mb-3">
								<label for="emp_branch_id">Branch</label>
								<select class="custom-select" id="emp_branch_id" aria-describedby="" required>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="emp_company_id">Company</label>
								<select class="custom-select" id="emp_company_id" aria-describedby="" required>
								</select>
							</div>							
							<div class="col-md-3 mb-3">
								<label for="emp_contact_no">Contact No.</label>
								<input type="text" class="form-control" id="emp_contact_no" aria-describedby="validationServer05Feedback" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>							
							<div class="col-md-3 mb-3">
								<label for="emp_emg_contact_no">Emergency Contact No.</label>
								<input type="text" class="form-control" id="emp_emg_contact_no" aria-describedby="validationServer05Feedback" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="col-md-3 mb-3"> <!-- Date input 1-->
								<label class="control-label" for="date">Date of birth</label>
								<input class="form-control" id="emp_dob" name="emp_dob" placeholder="YYYY-MM-DD" type="text" autocomplete="off">
							</div>
							<div class="col-md-6 mb-3">
								<label for="emp_email">Email</label>
								<input type="text" class="form-control" id="emp_email" aria-describedby="validationServer05Feedback" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="emp_perm_address">Permenant Address</label>
								<input type="text" class="form-control" id="emp_perm_address" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="emp_temp_address">Temporary Address</label>
								<input type="text" class="form-control" id="emp_temp_address" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
						</div>
						<div class="form-row">							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_emp" value="1">
								<label for="is_active_emp" class="custom-control-label">is active</label>
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
		url: API+"Employee/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#emp_id').val(data[0].emp_id);
			$('#emp_epf').val(data[0].emp_epf);
			$('#emp_first_name').val(data[0].emp_first_name);
			$('#emp_middle_name').val(data[0].emp_middle_name);
			$('#emp_last_name').val(data[0].emp_last_name);
			$('#emp_nic').val(data[0].emp_nic);
			$('#emp_contact_no').val(data[0].emp_contact_no);	
			$('#emp_emg_contact_no').val(data[0].emp_emg_contact_no);
			$('#emp_dob').val(data[0].emp_dob);
			$('#emp_email').val(data[0].emp_email);
			$('#emp_perm_address').val(data[0].emp_perm_address);
			$('#emp_temp_address').val(data[0].emp_temp_address);
			
			var date_input=$('input[name="emp_dob"]'); //our date input has the name "date"
			var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
			var options={
				format: 'yyyy-mm-dd',
				container: container,
				todayHighlight: true,
				autoclose: true,
				orientation: 'bottom'
			};
			date_input.datepicker(options);
			
			var emp_dob = new Date(data[0].emp_dob);
			
			$('#h_holiday_date_from').datepicker({ dateFormat: 'yyyy-mm-dd' }); // format to show
			$('#emp_dob').datepicker('setDate', emp_dob);
						
			if(data[0].is_active_emp == 1){
				$('#is_active_emp').prop('checked', true);
			}
			
			loadCompanyBranch();
			loadCompany();
			
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
							
							if(data[0].branch_id == item.emp_branch_id){
								branch_drp += '<option selected value="'+item.company_branch_id+'">'+item.company_branch_name+'</option>';
							}
							else{
								branch_drp += '<option value="'+item.company_branch_id+'">'+item.company_branch_name+'</option>';
							}

							
						});
						$('#emp_branch_id').append(branch_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(textStatus);
					}
				});
			}
			
			function loadCompany() {
				
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"company/fetch_all_active/",
					success: function(data1, result){
						console.log(data1);
						
						var company_drp = '';
						$.each(data1, function(index, item) {
							
							if(data[0].company_id == item.company_id){
								company_drp += '<option selected value="'+item.company_id+'">'+item.company_name+'</option>';
							}
							else{
								company_drp += '<option value="'+item.company_id+'">'+item.company_name+'</option>';
							}

							
						});
						$('#emp_company_id').append(company_drp);
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
	
	var emp_id = 0;
	var emp_epf = 0;
	var emp_branch_id = "";
	var emp_company_id = 0;
	var emp_first_name = 0;
	var emp_middle_name = "";
	var emp_last_name = "";
	var emp_nic = 0;
	var emp_dob = 0;
	var emp_perm_address = 0;
	var emp_temp_address = "";
	var emp_contact_no = "";
	var emp_email = 0;
	var emp_emg_contact_no = 0;
	var emp_drive_license_id = 0;
	var is_active_emp = 0;
	
	emp_id = $('#emp_id').val();
	emp_epf = $('#emp_epf').val();
	emp_branch_id = $('#emp_branch_id').val();
	emp_company_id = $('#emp_company_id').val();
	emp_first_name = $('#emp_first_name').val();
	emp_middle_name = $('#emp_middle_name').val();
	emp_last_name = $('#emp_last_name').val();
	emp_nic = $('#emp_nic').val();
	emp_dob = $('#emp_dob').val();
	emp_perm_address = $('#emp_perm_address').val();
	emp_temp_address = $('#emp_temp_address').val();
	emp_contact_no = $('#emp_contact_no').val();
	emp_email = $('#emp_email').val();
	emp_emg_contact_no = $('#emp_emg_contact_no').val();	
	is_active_emp = $("#is_active_emp").is(':checked')? 1 : 0;
	
			
	if(typeof emp_id !== 'undefined' && emp_id !== ''
	&& typeof emp_epf !== 'undefined' && emp_epf !== '' 
	&& typeof emp_branch_id !== 'undefined' && emp_branch_id !== ''
	&& typeof emp_company_id !== 'undefined' && emp_company_id !== '' 
	&& typeof emp_first_name !== 'undefined' && emp_first_name !== ''
	&& typeof emp_middle_name !== 'undefined' && emp_middle_name !== '' 
	&& typeof emp_last_name !== 'undefined' && emp_last_name !== ''	
	&& typeof emp_dob !== 'undefined' && emp_dob !== ''
	&& typeof emp_perm_address !== 'undefined' && emp_perm_address !== '' 
	&& typeof emp_temp_address !== 'undefined' && emp_temp_address !== ''
	&& typeof emp_contact_no !== 'undefined' && emp_contact_no !== '' 
	&& typeof emp_email !== 'undefined' && emp_email !== ''
	&& typeof emp_emg_contact_no !== 'undefined' && emp_emg_contact_no !== ''
	&& typeof emp_nic !== 'undefined' && emp_nic !== '')
	{
		var formData = new FormData();
		formData.append('emp_id',emp_id);
		formData.append('emp_epf',emp_epf);
		formData.append('emp_branch_id',emp_branch_id);
		formData.append('emp_company_id',emp_company_id);
		formData.append('emp_first_name',emp_first_name);
		formData.append('emp_middle_name',emp_middle_name);
		formData.append('emp_last_name',emp_last_name);
		formData.append('emp_nic',emp_nic);
		formData.append('emp_dob',emp_dob);
		formData.append('emp_perm_address',emp_perm_address);
		formData.append('emp_temp_address',emp_temp_address);
		formData.append('emp_contact_no',emp_contact_no);
		formData.append('emp_email',emp_email);
		formData.append('emp_emg_contact_no',emp_emg_contact_no);
		formData.append('is_active_emp',is_active_emp);
		
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"Employee/update/",
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
						window.location = "<?php echo base_url() ?>employee/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Employee is being used by other modules at the moment!"){
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