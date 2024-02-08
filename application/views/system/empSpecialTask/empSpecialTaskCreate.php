<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Special Task Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="task_name">Task Name</label>
								<input type="text" class="form-control" id="task_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="branch_id">Branch Id</label>
								<select class="custom-select" id="branch_id" aria-describedby="" required>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="invoice_id">Invoice Id</label>
								<select class="custom-select" id="invoice_id" aria-describedby="" required>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="task_type">Task Type</label>
								<select class="custom-select" id="task_type" aria-describedby="" required>
									<option value="">Select Task Type</option>
									<option value="Scaffolding">Scaffolding</option>
									<option value="Heavy Machine Operating">Heavy Machine Operating</option>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="valid_from_date">Date from</label>
								<input class="form-control" id="valid_from_date" name="valid_from_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off"/>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="valid_to_date">Date to</label>
								<input class="form-control" id="valid_to_date" name="valid_to_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off"/>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="task_start_time">Task Start Time</label>
								<input type="text" class="form-control" id="task_start_time" placeholder="ex 10:00:00" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="task_end_time">Task End Time</label>
								<input type="text" class="form-control" id="task_end_time" placeholder="ex 17:20:00" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>							
						</div>
						<div class="form-row">
							<div class="col-md-2 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_sp_task"  value="1">
									<label for="is_active_sp_task" class="custom-control-label">is active</label>
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_complete" value="1">
									<label for="is_complete" class="custom-control-label">is complete</label>
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
$(document).ready(function(){
	var date_input=$('input[name="valid_from_date"]'); //our date input has the name "date"
	var date_input1=$('input[name="valid_to_date"]'); //our date input has the name "date"
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

function loadBranch(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"branch/fetch_all_active/",
	success: function(data, result){
		var company_drp = '<option value="">Select Branch</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			company_drp += '<option value="'+item.company_branch_id+'">'+item.company_branch_name+'</option>';
        });
		$('#branch_id').append(company_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadBranch();



function loadRentInvoice(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"InventoryRentalInvoice/fetch_all_active/",
	success: function(data2, result){
		console.log(data2);
		var company_drp = '<option value="">Select Invoice</option>';
		$.each(data2, function(index, item) {
			
			company_drp += '<option value="'+item.invoice_id+'">'+item.invoice_id+' - '+item.customer_old_nic_no+' - '+item.customer_name+'</option>';
        });
		$('#invoice_id').append(company_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadRentInvoice();

$('#submit').click(function(e){
	e.preventDefault();
		
	var branch_id = 0;
	var task_name = "";
	var invoice_id = 0;
	var task_type = 0;
	var task_start_date = "";
	var task_end_date = "";
	var task_start_time = 0;
	var task_end_time = 0;
	var is_active_sp_task = 0;
	var is_complete = 0;
	
	branch_id = $('#branch_id').val();
	task_name = $('#task_name').val();
	invoice_id = $('#invoice_id').val();
	task_type = $('#task_type').val();
	task_start_date = $('#task_start_date').val();
	task_end_date = $('#task_end_date').val();
	task_start_time = $('#task_start_time').val();
	task_end_time = $('#task_end_time').val();
	is_active_sp_task = $("#is_active_sp_task").is(':checked')? 1 : 0;
	is_complete = $("#is_complete").is(':checked')? 1 : 0;
	
		
	if(typeof branch_id !== 'undefined' && branch_id !== '' 
	&& typeof task_name !== 'undefined' && task_name !== ''
	&& typeof invoice_id !== 'undefined' && invoice_id !== '' 
	&& typeof task_type !== 'undefined' && task_type !== ''
	&& typeof task_start_date !== 'undefined' && task_start_date !== '' 
	&& typeof task_end_date !== 'undefined' && task_end_date !== ''
	&& typeof task_start_time !== 'undefined' && task_start_time !== '' 
	&& typeof task_end_time !== 'undefined' && task_end_time !== '')
	{
		
		var formData = new FormData();
        formData.append('branch_id',branch_id);
		formData.append('task_name',task_name);
		formData.append('invoice_id',invoice_id);
		formData.append('task_type',task_type);
		formData.append('task_start_date',task_start_date);
		formData.append('task_end_date',task_end_date);
		formData.append('task_start_time',task_start_time);
		formData.append('task_end_time',task_end_time);
		formData.append('is_active_sp_task',is_active_sp_task);
		formData.append('is_complete',is_complete);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpSpecialTask/insert/",
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
					window.location = "<?php echo base_url() ?>EmpSpecialTask/view";
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