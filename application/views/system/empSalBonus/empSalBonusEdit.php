<?  $year  = date("Y"); ?>
<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Employee Salary Bonus</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<input type="hidden" class="form-control" id="emp_bonus_id" required>
							<div class="col-md-2 mb-3">
								<label for="branch_id">Year</label>
								<select class="custom-select" id="year" aria-describedby="" required>
									<option value="<?php echo date("Y") ?>"><?php echo date("Y") ?></option>
									<option value="<?php echo date("Y")+1 ?>"><?php echo date("Y")+1 ?></option>
									<option value="<?php echo date("Y")+2 ?>"><?php echo date("Y")+2 ?></option>
									<option value="<?php echo date("Y")+3 ?>"><?php echo date("Y")+3 ?></option>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="month">Month</label>
								<select class="custom-select" id="month" aria-describedby="" required>
									<option value="1">January</option>
									<option value="2">February</option>
									<option value="3">March</option>
									<option value="4">April</option>
									<option value="5">May</option>
									<option value="6">June</option>
									<option value="7">July</option>
									<option value="8">August</option>
									<option value="9">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>
								</select>
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
								<label for="location">Bonus</label>
								<select class="custom-select" id="bonus_id" name="bonus_id" required>
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
							<div class="col-md-2 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_sal_bonus" value="1">
									<label for="is_active_sal_bonus" class="custom-control-label">is active</label>
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_approve_sal_bonus" value="1">
									<label for="is_approve_sal_bonus" class="custom-control-label">is approve</label>
								</div>
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
		url: API+"EmpSalaryBonus/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#emp_bonus_id').val(data[0].emp_bonus_id);
			$('#month').val(data[0].month);
			$('#year').val(data[0].year);
			$('#amount').val(data[0].amount);
			$('#emp_salary_advance_id').val(data[0].emp_salary_advance_id);
			
						
			if(data[0].is_approved_sal_advance == 1){
				$('#is_approved_sal_advance').prop('checked', true);
			}
			if(data[0].is_active_sal_advance == 1){
				$('#is_active_sal_advance').prop('checked', true);
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

			loadBonus();
			function loadBonus(){
			$.ajax({
				type: "POST",
				cache : false,
				async: true,
				dataType: "json",
				url: API+"EmpBonus/fetch_all_active/",
				success: function(data3, result){
					console.log(data3);
					var location_drp = '<option value="">Select Bonus</option>';
					$.each(data3, function(index, item) {
						if(data[0].bonus_id == item.bonus_id){
							location_drp += '<option value="'+item.bonus_id+'" selected>'+item.bonus_name+'</option>';
						}
						else{
							location_drp += '<option value="'+item.bonus_id+'">'+item.bonus_name+'</option>';
						}
						
					});
					$('#bonus_id').append(location_drp);
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
	
	var emp_bonus_id = 0;
	var emp_id = "";
	var branch_id = "";
	var bonus_id = "";
	var year = "";
	var amount = "";
	var month = "";
	var is_approve_sal_bonus = 0;
	var is_active_sal_bonus = 0;
	
	emp_bonus_id = $('#emp_bonus_id').val();
	emp_id = $('#emp_id').val();
	branch_id = $('#branch_id').val();
	bonus_id = $('#bonus_id').val();
	year = $('#year').val();
	amount = $('#amount').val();
	month = $('#month').val();
	is_approve_sal_bonus = $("#is_approve_sal_bonus").is(':checked')? 1 : 0;
	is_active_sal_bonus = $("#is_active_sal_bonus").is(':checked')? 1 : 0;
					
	if(typeof emp_bonus_id !== 'undefined' && emp_bonus_id !== ''
	&& typeof emp_id !== 'undefined' && emp_id !== ''	
	&& typeof branch_id !== 'undefined' && branch_id !== '' 
	&& typeof bonus_id !== 'undefined' && bonus_id !== '' 
	&& typeof year !== 'undefined' && year !== '' 
	&& typeof amount !== 'undefined' && amount !== '' 
	&& typeof month !== 'undefined' && month !== '')
	{
		var formData = new FormData();
		formData.append('emp_bonus_id',emp_bonus_id);
		formData.append('emp_id',emp_id);
        formData.append('branch_id',branch_id);
		formData.append('bonus_id',bonus_id);
		formData.append('year',year);
		formData.append('amount',amount);
        formData.append('month',month);
		formData.append('is_approve_sal_bonus',is_approve_sal_bonus);
		formData.append('is_active_sal_bonus',is_active_sal_bonus);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"EmpSalaryBonus/update/",
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
						window.location = "<?php echo base_url() ?>EmpSalaryBonus/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Salary Bonus is being used by other modules at the moment!"){
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