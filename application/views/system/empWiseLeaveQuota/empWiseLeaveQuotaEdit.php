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
						<input type="hidden" class="form-control" id="leave_quota_id" required>
							<div class="col-md-5 mb-3">
								<label for="amount">Leave Quota</label>
								<input type="text" class="form-control" id="leave_quota_name" aria-describedby="validationServer03Feedback" readonly>
								<div id="validationServer03Feedback" class="invalid-feedback">
									Please provide a valid city.
								</div>
							</div>
							<div class="col-md-5 mb-3">
								<label for="employee">Employee</label>
								<input type="text" class="form-control" id="employee" aria-describedby="validationServer03Feedback" readonly>
								<div id="validationServer03Feedback" class="invalid-feedback">
									Please provide a valid city.
								</div>
							</div>	
							<div class="col-md-2 mb-3">
								<label for="balance_leave_quota">Amount</label>
								<input type="text" class="form-control" id="balance_leave_quota" aria-describedby="validationServer03Feedback" required>
								<div id="validationServer03Feedback" class="invalid-feedback">
									Please provide a valid city.
								</div>
							</div>	
						</div>
						<div class="form-row">	
							<div class="col-md-2 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_hold_emp_wise_leave_quota" value="1">
									<label for="is_hold_emp_wise_leave_quota" class="custom-control-label">is hold</label>
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_emp_wise_leave_quota" value="1">
									<label for="is_active_emp_wise_leave_quota" class="custom-control-label">is active</label>
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
 

var pageUrl = $(location).attr('href');
parts = pageUrl.split("/"),
last_part = parts[parts.length-1];
//console.log(last_part);

var emp_wise_leave_quota_id  = 0;
var leave_quota_id = 0;
var emp_id = 0;

//var country_id = 0;
function loadData() {
	
		
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"EmpWiseLeaveQuota/fetch_single_join/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			//$('#leave_quota_id').val(data[0].leave_quota_id);
			$('#leave_quota_name').val(data[0].year+' - '+data[0].leave_type_name);
			$('#balance_leave_quota').val(data[0].amount);
			$('#employee').val(data[0].emp_epf+' - '+data[0].emp_first_name);
			$('#is_active_emp_wise_leave_quota').val(data[0].is_active_emp_wise_leave_quota);
			
			emp_wise_leave_quota_id = data[0].emp_wise_leave_quota_id;
			leave_quota_id = data[0].leave_quota_id;
			emp_id = data[0].emp_id;
						
			if(data[0].is_active_emp_wise_leave_quota == 1){
				$('#is_active_emp_wise_leave_quota').prop('checked', true);
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
	
	
	var balance_leave_quota = 0;
	var is_hold_emp_wise_leave_quota = 0;
	var is_active_emp_wise_leave_quota = 0;
	
	
	balance_leave_quota = $('#balance_leave_quota').val();
	is_hold_emp_wise_leave_quota = $("#is_hold_emp_wise_leave_quota").is(':checked')? 1 : 0;
	is_active_emp_wise_leave_quota = $("#is_active_emp_wise_leave_quota").is(':checked')? 1 : 0;
		
	if(typeof emp_wise_leave_quota_id !== 'undefined' && emp_wise_leave_quota_id !== ''
	&& typeof leave_quota_id !== 'undefined' && leave_quota_id !== ''	
	&& typeof emp_id !== 'undefined' && emp_id !== '' 
	&& typeof balance_leave_quota !== 'undefined' && balance_leave_quota !== '' )
	{
		var formData = new FormData();
		formData.append('emp_wise_leave_quota_id',emp_wise_leave_quota_id);
		formData.append('leave_quota_id',leave_quota_id);
        formData.append('emp_id',emp_id);
		formData.append('balance_leave_quota',balance_leave_quota);
		formData.append('is_hold_emp_wise_leave_quota',is_hold_emp_wise_leave_quota);
		formData.append('is_active_emp_wise_leave_quota',is_active_emp_wise_leave_quota);	
		
		console.log(formData);
		
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"EmpWiseLeaveQuota/update/",
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
						window.location = "<?php echo base_url() ?>EmpWiseLeaveQuota/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Employee Wise Leave Quota is being used by other modules at the moment!"){
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