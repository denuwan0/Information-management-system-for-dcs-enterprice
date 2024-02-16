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
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_sal_bonus" value="1">
								<label for="is_active_sal_bonus" class="custom-control-label">is active</label>
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

loadEmp();
function loadEmp(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"Employee/fetch_all_active/",
	success: function(data, result){
		//console.log(data);
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

loadBranch();
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
			location_drp += '<option value="'+item.company_branch_id+'">'+item.company_branch_name+'</option>';
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
	success: function(data, result){
		console.log(data);
		var location_drp = '<option value="">Select Bonus</option>';
		$.each(data, function(index, item) {			
			location_drp += '<option value="'+item.bonus_id+'">'+item.bonus_name+'</option>';
        });
		$('#bonus_id').append(location_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

$('#submit').click(function(e){
	e.preventDefault();
		
	var bonus_id = "";
	var branch_id = "";
	var amount = "";
	var year = "";
	var month = "";
	var emp_id = "";
	var is_approve_sal_bonus = 0;
	var is_active_sal_bonus = 0;
	
	bonus_id = $('#bonus_id').val();
	branch_id = $('#branch_id').val();
	amount = $('#amount').val();
	year = $('#year').val();
	month = $('#month').val();
	emp_id = $('#emp_id').val();
	is_approve_sal_bonus = $("#is_approve_sal_bonus").is(':checked')? 1 : 0;
	is_active_sal_bonus = $("#is_active_sal_bonus").is(':checked')? 1 : 0;
		
	if(typeof bonus_id !== 'undefined' && bonus_id !== '' 
	&& typeof branch_id !== 'undefined' && branch_id !== ''
	&& typeof amount !== 'undefined' && amount !== ''
	&& typeof year !== 'undefined' && year !== ''
	&& typeof month !== 'undefined' && month !== ''
	&& typeof emp_id !== 'undefined' && emp_id !== '')
	{
		
		var formData = new FormData();
        formData.append('bonus_id',bonus_id);
		formData.append('branch_id',branch_id);
		formData.append('amount',amount);
		formData.append('year',year);
		formData.append('month',month);
		formData.append('emp_id',emp_id);
		formData.append('is_approve_sal_bonus',is_approve_sal_bonus);
		formData.append('is_active_sal_bonus',is_active_sal_bonus);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpSalaryBonus/insert/",
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
					window.location = "<?php echo base_url() ?>EmpSalaryBonus/view";
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