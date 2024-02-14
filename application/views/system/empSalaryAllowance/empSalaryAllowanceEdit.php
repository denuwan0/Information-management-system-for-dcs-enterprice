<?  $year  = date("Y"); ?>
<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Employee Salary Allowance</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<input type="hidden" class="form-control" id="emp_salary_allowance_id" required>
							<div class="col-md-3 mb-3">
								<label for="location">Allowance</label>
								<select class="custom-select" id="allowance_id" name="allowance_id" required>
								</select>
								<div id="locationError" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="valid_from_date">From Date</label>
								<input type="text" class="form-control" id="valid_from_date" name="valid_from_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" required>
							</div>
							<div class="col-md-2 mb-3">
								<label for="valid_to_date">To Date</label>
								<input type="text" class="form-control" id="valid_to_date" name="valid_to_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" required>
							</div>
							<div class="col-md-4 mb-3">
								<label for="location">Employee</label>
								<select class="custom-select" id="emp_id" name="emp_id" required>
								</select>
								<div id="locationError" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>	
							<div class="col-md-3 mb-3">
								<label for="location">Branch</label>
								<select class="custom-select" id="branch_id" name="branch_id" required>
								</select>
								<div id="locationError" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>							
							<div class="col-md-3 mb-3">
								<label for="amount">Amount</label>
								<input type="text" class="form-control" id="amount" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<!--div class="col-md-4 mb-3">
								<label for="percentage">Percentage</label>
								<input type="text" class="form-control" id="percentage" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div-->
						</div>
						<div class="form-row">							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_sal_advance" value="1">
								<label for="is_active_sal_advance" class="custom-control-label">is active</label>
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
		url: API+"EmpSalaryAllowance/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			//console.log(data[0].emp_id);			
			console.log(data);
			
			$('#emp_salary_allowance_id').val(data[0].emp_salary_allowance_id);
			$('#allowance_id').val(data[0].allowance_id);
			$('#branch_id').val(data[0].branch_id);
			$('#amount').val(data[0].amount);
			$('#valid_from_date').val(data[0].valid_from_date);
			$('#valid_to_date').val(data[0].valid_to_date);
			$('#emp_id').val(data[0].emp_id);
			$('#created_by').val(data[0].created_by);
			$('#approved_by').val(data[0].approved_by);
						
			if(data[0].is_approve_sal_allow == 1){
				$('#is_approve_sal_allow').prop('checked', true);
			}
			if(data[0].is_active_sal_allow == 1){
				$('#is_active_sal_allow').prop('checked', true);
			}
			
			loadEmp();
			function loadEmp(){
			$.ajax({
				type: "POST",
				cache : false,
				async: true,
				dataType: "json",
				url: API+"Employee/fetch_all_active/",
				success: function(data1, result){
					console.log(data[0].emp_id);
					var location_drp = '<option value="">Select Employee</option>';
					$.each(data1, function(index, item) {
						if(data[0].emp_id == item.emp_id){
							location_drp += '<option value="'+item.emp_id+'" selected>'+item.emp_epf+' - '+item.emp_first_name+'</option>';
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

			loadBranch();
			function loadBranch(){
			$.ajax({
				type: "POST",
				cache : false,
				async: true,
				dataType: "json",
				url: API+"Branch/fetch_all_active/",
				success: function(data2, result){
					//console.log(data);
					var location_drp = '';
					$.each(data2, function(index, item) {	
						if(data[0].company_branch_id == item.company_branch_id){
							location_drp += '<option value="'+item.company_branch_id+'" selected>'+item.company_branch_name+'</option>';
						}
						else{
							location_drp += '<option value="'+item.company_branch_id+'">'+item.company_branch_name+'</option>';
						}
						
					});
					$('#branch_id').append(location_drp);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {						
					
					//console.log(errorThrown);
				}
			});
			}

			loadAllowance();
			function loadAllowance(){
			$.ajax({
				type: "POST",
				cache : false,
				async: true,
				dataType: "json",
				url: API+"EmpAllowance/fetch_all_active/",
				success: function(data4, result){
					console.log(data4);
					var location_drp = '<option value="">Select Allowance</option>';
					$.each(data4, function(index, item) {	
						if(data[0].allowance_id == item.allowance_id){
							location_drp += '<option value="'+item.allowance_id+'" selected>'+item.allowance_name+'</option>';
						}
						else{
							location_drp += '<option value="'+item.allowance_id+'">'+item.allowance_name+'</option>';
						}
						
					});
					$('#allowance_id').append(location_drp);
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
	
	var emp_salary_advance_id = 0;
	var emp_id = "";
	var branch_id = "";
	var advance_id = "";
	var month = "";
	var amount = "";
	var year = "";
	var is_approved_sal_advance = 0;
	var is_active_sal_advance = 0;
	
	emp_salary_advance_id = $('#emp_salary_advance_id').val();
	emp_id = $('#emp_id').val();
	branch_id = $('#branch_id').val();
	advance_id = $('#advance_id').val();
	month = $('#month').val();
	amount = $('#amount').val();
	year = $('#year').val();
	is_approved_sal_advance = $("#is_approved_sal_advance").is(':checked')? 1 : 0;
	is_active_sal_advance = $("#is_active_sal_advance").is(':checked')? 1 : 0;
	
				
	if(typeof emp_salary_advance_id !== 'undefined' && emp_salary_advance_id !== ''
	&& typeof emp_id !== 'undefined' && emp_id !== ''	
	&& typeof branch_id !== 'undefined' && branch_id !== '' 
	&& typeof advance_id !== 'undefined' && advance_id !== '' 
	&& typeof month !== 'undefined' && month !== '' 
	&& typeof amount !== 'undefined' && amount !== '' 
	&& typeof year !== 'undefined' && year !== '')
	{
		var formData = new FormData();
		formData.append('emp_salary_advance_id',emp_salary_advance_id);
		formData.append('emp_id',emp_id);
        formData.append('branch_id',branch_id);
		formData.append('advance_id',advance_id);
		formData.append('month',month);
		formData.append('amount',amount);
        formData.append('year',year);
		formData.append('is_approved_sal_advance',is_approved_sal_advance);
		formData.append('is_active_sal_advance',is_active_sal_advance);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"EmpSalaryAdvance/update/",
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
						window.location = "<?php echo base_url() ?>EmpSalaryAdvance/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Salary Advance is being used by other modules at the moment!"){
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