<?php $year = date("Y"); ?>
<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Emplyee wise Leave Quota Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">							
							<div class="col-md-3 mb-3">
								<label for="leave_quota_id">Leave Quota</label>
								<select class="custom-select" id="leave_quota_id" aria-describedby="" required>
								</select>
								<div id="validationServer04Feedback" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="emp_id">Employee</label>
								<select class="custom-select" id="emp_id" aria-describedby="" required>
									<option value="">Select Employee</option>
								</select>
								<div id="validationServer04Feedback" class="invalid-feedback">
									Please select a valid state.
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
function loadEmployee(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"Employee/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var location_drp = '';
		$('#emp_id').append('<option value="all">All Employees</option>');
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

function loadLeaveQuota(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"EmpLeaveQuota/fetch_all_active_join/",
	success: function(data, result){
		console.log(data);
		var location_drp = '<option value="">Select Leave Quota</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			location_drp += '<option value="'+item.leave_quota_id+'">'+item.leave_type_name+' - '+item.year+'</option>';
        });
		$('#leave_quota_id').append(location_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {	
		//console.log(errorThrown);
	}
});
}

loadLeaveQuota();

$('#submit').click(function(e){
	e.preventDefault();
		
	var leave_quota_id = 0;
	var emp_id = "";
	var is_active_emp_leave_quota = 0;
	
	leave_quota_id = $('#leave_quota_id').val();
	emp_id = $('#emp_id').val();
		
	if(typeof leave_quota_id !== 'undefined' && leave_quota_id !== '' 
	&& typeof emp_id !== 'undefined' && emp_id !== '')
	{
		
		var formData = new FormData();
        formData.append('leave_quota_id',leave_quota_id);
		formData.append('emp_id',emp_id);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpWiseLeaveQuota/insert/",
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
					window.location = "<?php echo base_url() ?>EmpWiseLeaveQuota/view";
				}, 3000);
			}
			if(data['message'] == 'Leave Quota already created for some Employees, Please double check!'
			|| data['message'] == 'Leave Quota already created for this Employees, Please double check!'){
				notyf.error({
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