<?  $year  = date("Y"); ?>
<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Employee Salary Advance</h3>
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
								<label for="location">Advance</label>
								<select class="custom-select" id="advance_id" name="advance_id" required>
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
loadEmp();
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

loadBranch();
function loadBranch(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"Branch/fetch_all_active/",
	success: function(data, result){
		console.log(data);
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

loadAdvance();
function loadAdvance(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"EmpAdvance/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var location_drp = '<option value="">Select Advance</option>';
		$.each(data, function(index, item) {			
			location_drp += '<option value="'+item.advance_id+'">'+item.advance_name+'</option>';
        });
		$('#advance_id').append(location_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

$('#submit').click(function(e){
	e.preventDefault();
		
	var emp_id = "";
	var advance_id = "";
	var month = "";
	var year = "";
	var amount = "";
	var branch_id = "";
	var is_active_sal_advance = 0;
	
	emp_id = $('#emp_id').val();
	branch_id = $('#branch_id').val();
	advance_id = $('#advance_id').val();
	month = $('#month').val();
	year = $('#year').val();
	amount = $('#amount').val();
	is_active_sal_advance = $("#is_active_sal_advance").is(':checked')? 1 : 0;
	
		
	if(typeof emp_id !== 'undefined' && emp_id !== '' 
	&& typeof branch_id !== 'undefined' && branch_id !== ''
	&& typeof advance_id !== 'undefined' && advance_id !== ''
	&& typeof month !== 'undefined' && month !== ''
	&& typeof year !== 'undefined' && year !== ''
	&& typeof amount !== 'undefined' && amount !== '')
	{
		
		var formData = new FormData();
        formData.append('emp_id',emp_id);
		formData.append('branch_id',branch_id);
		formData.append('advance_id',advance_id);
		formData.append('month',month);
		formData.append('year',year);
		formData.append('amount',amount);
		formData.append('is_active_sal_advance',is_active_sal_advance);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpSalaryAdvance/insert/",
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
					window.location = "<?php echo base_url() ?>EmpSalaryAdvance/view";
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