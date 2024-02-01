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
							<input type="hidden" class="form-control" id="work_contract_id" required>
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

//$('#form')[0].reset(); 

var pageUrl = $(location).attr('href');
parts = pageUrl.split("/"),
last_part = parts[parts.length-1];
//console.log(last_part);

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

//var country_id = 0;
function loadData() {
	
		
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"EmpWorkContract/fetch_single_join/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#work_contract_id').val(data[0].work_contract_id);
			$('#emp_id').val(data[0].emp_id);
			$('#emp_grade_id').val(data[0].emp_grade_id);
			$('#emp_branch_id').val(data[0].emp_branch_id);
			$('#emp_company_id').val(data[0].emp_company_id);
			$('#emp_desig_id').val(data[0].emp_desig_id);
			$('#emp_ws_id').val(data[0].emp_ws_id);	
			$('#valid_from_date').val(data[0].valid_from_date);
			$('#valid_to_date').val(data[0].valid_to_date);
						
			if(data[0].is_active_emp_work_cont == 1){
				$('#is_active_emp_work_cont').prop('checked', true);
			}
			
			loadEmployee();
			
						
			function loadEmployee(){
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"Employee/fetch_all_active/",
					success: function(data1, result){
						//console.log(data);
						var location_drp = '';
						$.each(data1, function(index, item) {
							//console.log(item);
							if(data[0].emp_id == item.emp_id){
								location_drp += '<option selected value="'+item.emp_id+'">'+item.emp_epf+' - '+item.emp_first_name+'</option>';
							}
							else{
								location_drp += '<option value="'+item.emp_id+'">'+item.emp_epf+' - '+item.emp_first_name+'</option>';
							}
							
						});
						$('#emp_id').append(location_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(errorThrown);
					}
				});
			}
			
			loadGrade();
			
			function loadGrade(){
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"EmpGrade/fetch_all_active/",
					success: function(data2, result){
						//console.log(data);
						var location_drp = '';
						$.each(data2, function(index, item) {
							console.log(item);
							if(data[0].emp_grade_id == item.emp_grade_id){
								location_drp += '<option selected value="'+item.emp_grade_id+'">'+item.emp_grade_name+' - '+item.emp_grade_desc+'</option>';
							}
							else{
								location_drp += '<option value="'+item.emp_grade_id+'">'+item.emp_grade_name+' - '+item.emp_grade_desc+'</option>';
							}
							
						});
						$('#emp_grade_id').append(location_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(errorThrown);
					}
				});
			}
			
			loadBranch();
			
			function loadBranch(){
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"Branch/fetch_all_active/",
					success: function(data3, result){
						console.log(data3);
						var location_drp = '';
						$.each(data3, function(index, item) {
							//console.log(item);
							if(data[0].company_branch_id == item.company_branch_id){
								location_drp += '<option selected value="'+item.company_branch_id+'">'+item.company_branch_name+' - '+item.branch_address+'</option>';
							}
							else{
								location_drp += '<option value="'+item.company_branch_id+'">'+item.company_branch_name+' - '+item.branch_address+'</option>';
							}
							
						});
						$('#emp_branch_id').append(location_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(errorThrown);
					}
				});
			}

			loadCompany();
			
			function loadCompany(){
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"Company/fetch_all_active/",
					success: function(data4, result){
						console.log(data4);
						var location_drp = '';
						$.each(data4, function(index, item) {
							//console.log(item);
							if(data[0].company_id == item.company_id){
								location_drp += '<option selected value="'+item.company_id+'">'+item.company_name+' - '+item.company_address+'</option>';
							}
							else{
								location_drp += '<option value="'+item.company_id+'">'+item.company_name+'</option>';
							}
							
						});
						$('#emp_company_id').append(location_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(errorThrown);
					}
				});
			}
			
			loadDesignation();
			
			function loadDesignation(){
			$.ajax({
				type: "POST",
				cache : false,
				async: true,
				dataType: "json",
				url: API+"EmpDesignation/fetch_all_active/",
				success: function(data5, result){
					console.log(data5);
					var location_drp = '';
					$.each(data5, function(index, item) {
						//console.log(item);
						if(data[0].emp_desig_id == item.emp_desig_id){
							location_drp += '<option selected value="'+item.emp_desig_id+'">'+item.emp_desig_name+'</option>';
						}
						else{
							location_drp += '<option value="'+item.emp_desig_id+'">'+item.emp_desig_name+'</option>';
						}
						
					});
					$('#emp_desig_id').append(location_drp);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {						
					
					//console.log(errorThrown);
				}
			});
			}

			
			loadWorkSchedule();

			function loadWorkSchedule(){
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"EmpWorkSchedule/fetch_all_active/",
					success: function(data6, result){
						console.log(data6);
						var location_drp = '';
						$.each(data6, function(index, item) {
							//console.log(item);
							if(data[0].emp_ws_id == item.ws_id){
								location_drp += '<option selected value="'+item.ws_id+'">'+item.ws_name+'</option>';
							}
							else{
								location_drp += '<option value="'+item.ws_id+'">'+item.ws_name+'</option>';
							}
							
						});
						$('#emp_ws_id').append(location_drp);
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
	
	var work_contract_id  = 0;
	var emp_id = 0;
	var emp_grade_id = 0;
	var emp_branch_id = 0;
	var emp_company_id = 0;
	var emp_desig_id = "";
	var emp_ws_id = "";
	var valid_from_date = 0;
	var valid_to_date = 0;
	var is_active_emp_work_cont = 0;
	
	work_contract_id = $('#work_contract_id').val();
	emp_id = $('#emp_id').val();
	emp_grade_id = $('#emp_grade_id').val();
	emp_branch_id = $('#emp_branch_id').val();
	emp_company_id = $('#emp_company_id').val();
	emp_desig_id = $('#emp_desig_id').val();
	emp_ws_id = $('#emp_ws_id').val();
	valid_from_date = $('#valid_from_date').val();
	valid_to_date = $('#valid_to_date').val();
	is_active_emp_work_cont = $("#is_active_emp_work_cont").is(':checked')? 1 : 0;
		
	if(typeof work_contract_id !== 'undefined' && work_contract_id !== ''
	&& typeof emp_id !== 'undefined' && emp_id !== ''	
	&& typeof emp_grade_id !== 'undefined' && emp_grade_id !== '' 
	&& typeof emp_branch_id !== 'undefined' && emp_branch_id !== '' 
	&& typeof emp_company_id !== 'undefined' && emp_company_id !== '' 
	&& typeof emp_desig_id !== 'undefined' && emp_desig_id !== '' 
	&& typeof emp_ws_id !== 'undefined' && emp_ws_id !== ''
	&& typeof valid_from_date !== 'undefined' && valid_from_date !== '' 
	&& typeof valid_to_date !== 'undefined' && valid_to_date !== '')
	{
		var formData = new FormData();
		formData.append('work_contract_id',work_contract_id);
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
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"EmpWorkContract/update/",
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
						window.location = "<?php echo base_url() ?>EmpWorkContract/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Work Contract is being used by other modules at the moment!"){
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