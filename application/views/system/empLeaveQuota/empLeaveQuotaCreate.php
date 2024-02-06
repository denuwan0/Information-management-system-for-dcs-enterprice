<?php $year = date("Y"); ?>
<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Leave Quota Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-2 mb-3">
								<label for="branch_id">Year</label>
								<select class="custom-select" id="year" aria-describedby="" required>
									<option value="<?php echo $year ?>"><?php echo $year ?></option>
									<option value="<?php echo $year+1 ?>"><?php echo $year+1 ?></option>
									<option value="<?php echo $year+2 ?>"><?php echo $year+2 ?></option>
									<option value="<?php echo $year+3 ?>"><?php echo $year+3 ?></option>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="leave_type_id">Leave Type</label>
								<select class="custom-select" id="leave_type_id" aria-describedby="" required>
								</select>
								<div id="validationServer04Feedback" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="valid_from_date">Valid from</label>
								<input class="form-control" id="valid_from_date" name="valid_from_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off"/>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="valid_to_date">Valid to</label>
								<input class="form-control" id="valid_to_date" name="valid_to_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off"/>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="amount">Amount</label>
								<input type="text" class="form-control" id="amount" aria-describedby="validationServer03Feedback" required>
								<div id="validationServer03Feedback" class="invalid-feedback">
									Please provide a valid city.
								</div>
							</div>	
						</div>
						<div class="form-row">							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_leave_quota" value="1">
								<label for="is_active_leave_quota" class="custom-control-label">is active</label>
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
	var valid_from_date=$('input[name="valid_from_date"]'); //our date input has the name "date"
	var valid_to_date=$('input[name="valid_to_date"]'); //our date input has the name "date"
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		orientation: 'bottom'
	};
	valid_from_date.datepicker(options);
	valid_to_date.datepicker(options);
})

function loadLeaveType(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"EmpLeaveType/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var location_drp = '<option value="">Select Leave Type</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			location_drp += '<option value="'+item.leave_type_id+'">'+item.leave_type_name+'</option>';
        });
		$('#leave_type_id').append(location_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {	
		//console.log(errorThrown);
	}
});
}

loadLeaveType();

$('#submit').click(function(e){
	e.preventDefault();
		
	var year = 0;
	var leave_type_id = "";
	var valid_from_date = "";
	var valid_to_date = "";
	var amount = 0;
	var is_active_leave_quota = 0;
	
	year = $('#year').val();
	leave_type_id = $('#leave_type_id').val();
	valid_from_date = $('#valid_from_date').val();
	valid_to_date = $('#valid_to_date').val();
	amount = $('#amount').val();
	is_active_leave_quota = $("#is_active_leave_quota").is(':checked')? 1 : 0;
	
		
	if(typeof year !== 'undefined' && year !== '' 
	&& typeof leave_type_id !== 'undefined' && leave_type_id !== ''
	&& typeof valid_from_date !== 'undefined' && valid_from_date !== ''
	&& typeof valid_to_date !== 'undefined' && valid_to_date !== ''
	&& typeof amount !== 'undefined' && amount !== '')
	{
		
		var formData = new FormData();
        formData.append('year',year);
		formData.append('leave_type_id',leave_type_id);
		formData.append('valid_from_date',valid_from_date);
		formData.append('valid_to_date',valid_to_date);
		formData.append('amount',amount);
		formData.append('is_active_leave_quota',is_active_leave_quota);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpLeaveQuota/insert/",
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
					window.location = "<?php echo base_url() ?>EmpLeaveQuota/view";
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