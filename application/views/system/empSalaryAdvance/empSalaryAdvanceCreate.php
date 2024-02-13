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
							<div class="col-md-4 mb-3">
								<label for="allowance_name">Allowance Name</label>
								<input type="text" class="form-control" id="allowance_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>							
							<div class="col-md-2 mb-3">
								<label for="branch_id">Year</label>
								<select class="custom-select" id="year" aria-describedby="" required>
									<option value="<?php echo date("Y") ?>"><?php echo date("Y") ?></option>
									<option value="<?php echo date("Y")+1 ?>"><?php echo date("Y")+1 ?></option>
									<option value="<?php echo date("Y")+2 ?>"><?php echo date("Y")+2 ?></option>
									<option value="<?php echo date("Y")+3 ?>"><?php echo date("Y")+3 ?></option>
								</select>
							</div>
							<div class="col-md-2 mb-3">
								<label for="branch_id">Month</label>
								<select class="custom-select" id="year" aria-describedby="" required>
									<option value="January">January</option>
									<option value="February">February</option>
									<option value="March">March</option>
									<option value="April">April</option>
									<option value="May">May</option>
									<option value="June">June</option>
									<option value="July">July</option>
									<option value="August">August</option>
									<option value="September">September</option>
									<option value="October">October</option>
									<option value="November">November</option>
									<option value="December">December</option>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="location">Employee</label>
								<select class="custom-select" id="emp_id" name="emp_id" required>
								</select>
								<div id="locationError" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>	
						</div>
						<div class="form-row">							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_emp_allow" value="1">
								<label for="is_active_emp_allow" class="custom-control-label">is active</label>
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

$('#submit').click(function(e){
	e.preventDefault();
		
	var allowance_name = "";
	var allowance_desc = "";
	var is_active_emp_allow = 0;
	
	allowance_name = $('#allowance_name').val();
	allowance_desc = $('#allowance_desc').val();
	is_active_emp_allow = $("#is_active_emp_allow").is(':checked')? 1 : 0;
	
		
	if(typeof allowance_name !== 'undefined' && allowance_name !== '' 
	&& typeof allowance_desc !== 'undefined' && allowance_desc !== '')
	{
		
		var formData = new FormData();
        formData.append('allowance_name',allowance_name);
		formData.append('allowance_desc',allowance_desc);
		formData.append('is_active_emp_allow',is_active_emp_allow);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpAllowance/insert/",
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
					window.location = "<?php echo base_url() ?>EmpAllowance/view";
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