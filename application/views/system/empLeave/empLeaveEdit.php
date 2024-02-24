<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Employee Leave Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<input type="hidden" class="form-control" id="leave_detail_id" required>
							<?php 
							if($this->session->userdata('sys_user_group_name') == "Admin" ){
								echo '<div class="col-md-2 mb-3">
										<label for="leave_from_date">From Date</label>
										<input class="form-control" id="leave_from_date" name="leave_from_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" disabled/>
										<div class="valid-feedback">
											Looks good!
										</div>
									</div>
									<div class="col-md-2 mb-3">
										<label for="leave_to_date">To Date</label>
										<input class="form-control" id="leave_to_date" name="leave_to_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" disabled/>
										<div class="valid-feedback">
											Looks good!
										</div>
									</div>
									<div class="col-md-3 mb-3">
										<label for="location">Employee</label>
										<select class="custom-select" id="emp_id" name="emp_id" required disabled>
										</select>
										<div id="locationError" class="invalid-feedback">
											Please select a valid state.
										</div>
									</div>	
									<div class="col-md-3 mb-3">
										<label for="emp_wise_leave_quota_id">Leave type</label>
										<select class="custom-select" id="emp_wise_leave_quota_id" name="emp_wise_leave_quota_id" required disabled>
										</select>
										<div id="locationError" class="invalid-feedback">
											Please select a valid state.
										</div>
									</div>
									<div class="col-md-2 mb-3">
										<label for="leave_amount">Amount</label>
										<input type="text" class="form-control" id="leave_amount" aria-describedby="validationServer03Feedback" required disabled>
										<div id="validationServer03Feedback" class="invalid-feedback">
											Please provide a valid city.
										</div>
									</div>';
								
							}
							else if($this->session->userdata('sys_user_group_name') == "Staff" || $this->session->userdata('sys_user_group_name') == "Manager" ){
								echo '<div class="col-md-2 mb-3">
										<label for="leave_from_date">From Date</label>
										<input class="form-control" id="leave_from_date" name="leave_from_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" />
										<div class="valid-feedback">
											Looks good!
										</div>
									</div>
									<div class="col-md-2 mb-3">
										<label for="leave_to_date">To Date</label>
										<input class="form-control" id="leave_to_date" name="leave_to_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" />
										<div class="valid-feedback">
											Looks good!
										</div>
									</div>
									<div class="col-md-3 mb-3">
										<label for="location">Employee</label>
										<select class="custom-select" id="emp_id" name="emp_id" required >
										</select>
										<div id="locationError" class="invalid-feedback">
											Please select a valid state.
										</div>
									</div>	
									<div class="col-md-3 mb-3">
										<label for="emp_wise_leave_quota_id">Leave type</label>
										<select class="custom-select" id="emp_wise_leave_quota_id" name="emp_wise_leave_quota_id" required >
										</select>
										<div id="locationError" class="invalid-feedback">
											Please select a valid state.
										</div>
									</div>
									<div class="col-md-2 mb-3">
										<label for="leave_amount">Amount</label>
										<input type="text" class="form-control" id="leave_amount" aria-describedby="validationServer03Feedback" required >
										<div id="validationServer03Feedback" class="invalid-feedback">
											Please provide a valid city.
										</div>
									</div>';
								
							}
							?>
								
							
						</div>
							<div class="col-md-2 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_leave_details" value="1">
									<label for="is_active_leave_details" class="custom-control-label">is active</label>
								</div>
							</div>
							<?php 
							if($this->session->userdata('sys_user_group_name') == "Admin" ){
								echo '<div class="col-md-3 mb-3">
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="checkbox" id="is_approved_leave" value="1">
										<label for="is_approved_leave" class="custom-control-label">is approve</label>
									</div>
								</div>';
							}
							
							?>
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
	var date_input=$('input[name="leave_from_date"]'); //our date input has the name "date"
	var date_input1=$('input[name="leave_to_date"]'); //our date input has the name "date"
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		orientation: 'bottom'
	};
	date_input.datepicker(options);
	date_input1.datepicker(options);
})
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
		url: API+"EmpLeave/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			
			$('#leave_detail_id').val(data[0].leave_detail_id);
			$('#leave_amount').val(data[0].leave_amount);
			$('#leave_from_date').val(data[0].leave_from_date);
			$('#leave_to_date').val(data[0].leave_to_date);
						
			if(data[0].is_active_leave_details == 1){
				$('#is_active_leave_details').prop('checked', true);
			}
			
			function loadEmp(){
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
						if(data[0].emp_id == item.emp_id){
							location_drp += '<option selected value="'+item.emp_id+'">'+item.emp_epf+' - '+item.emp_first_name+'</option>';
						}
						else{
							location_drp += '<option selected value="'+item.emp_id+'">'+item.emp_epf+' - '+item.emp_first_name+'</option>';
						}
						
					});
					$('#emp_id').append(location_drp);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {						
					
					//console.log(errorThrown);
				}
			});
			}

			function loadLeaveQuota(){
			$.ajax({
				type: "POST",
				cache : false,
				async: true,
				dataType: "json",
				url: API+"EmpWiseLeaveQuota/fetch_all_join_for_select/",
				success: function(data, result){
					console.log(data);
					var company_drp = '<option value="">Select Leave type</option>';
					$.each(data, function(index, item) {
						if(data[0].emp_id == item.emp_id){
							company_drp += '<option value="'+item.emp_wise_leave_quota_id+'" selected>'+item.leave_type_name+' - '+item.balance_leave_quota+' remaining</option>';
						}
						else{
							company_drp += '<option value="'+item.emp_wise_leave_quota_id+'">'+item.leave_type_name+' - '+item.balance_leave_quota+' remaining</option>';
						}
						
					});
					$('#emp_wise_leave_quota_id').append(company_drp);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {						
					
					//console.log(errorThrown);
				}
			});
			}
			
			loadEmp();
			loadLeaveQuota();
			
						
				
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
	
	var leave_detail_id = 0;
	var leave_from_date = 0;
	var leave_to_date = "";
	var emp_id = 0;
	var emp_wise_leave_quota_id = 0;
	var leave_amount = "";
	var is_active_leave_details = 0;
	var is_approved_leave = 0;
	
	leave_detail_id = $('#leave_detail_id').val();
	leave_from_date = $('#leave_from_date').val();
	leave_to_date = $('#leave_to_date').val();
	emp_id = $('#emp_id').val();
	emp_wise_leave_quota_id = $('#emp_wise_leave_quota_id').val();
	leave_amount = $('#leave_amount').val();
	is_active_leave_details = $("#is_active_leave_details").is(':checked')? 1 : 0;
	is_approved_leave = $("#is_approved_leave").is(':checked')? 1 : 0;
	
			
	if(typeof leave_detail_id !== 'undefined' && leave_detail_id !== '' 
	&& typeof leave_from_date !== 'undefined' && leave_from_date !== ''
	&& typeof leave_to_date !== 'undefined' && leave_to_date !== ''
	&& typeof emp_id !== 'undefined' && emp_id !== '' 
	&& typeof emp_wise_leave_quota_id !== 'undefined' && emp_wise_leave_quota_id !== ''
	&& typeof leave_amount !== 'undefined' && leave_amount !== '')
	{
		var formData = new FormData();
		formData.append('leave_detail_id',leave_detail_id);
		formData.append('leave_from_date',leave_from_date);
		formData.append('leave_to_date',leave_to_date);
		formData.append('emp_id',emp_id);
		formData.append('emp_wise_leave_quota_id',emp_wise_leave_quota_id);
		formData.append('leave_amount',leave_amount);
		formData.append('is_active_leave_details',is_active_leave_details);
		formData.append('is_approved_leave',is_approved_leave);
		
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"EmpLeave/update/",
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
						window.location = "<?php echo base_url() ?>EmpLeave/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Leave is being used by other modules at the moment!"){
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