<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Task Assign Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="special_task_id">Task</label>
								<select class="custom-select" id="special_task_id" aria-describedby="" required>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="branch_id">Branch Id</label>
								<select class="custom-select" id="branch_id" aria-describedby="" required>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="emp_id">Employee</label>
								<select class="custom-select" id="emp_id" aria-describedby="" required>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="order_type">Order Type</label>
								<select class="custom-select" id="order_type" aria-describedby="" required>
									<option value="">Select Order Type</option>
									<option value="Retail">Retail Order</option>
									<option value="Rental">Rental Order</option>
									<option value="Online">Online Order</option>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="invoice_id">Order</label>
								<select class="custom-select" id="invoice_id" aria-describedby="" required>
								</select>
							</div>
							
							<div class="col-md-3 mb-3">
								<label for="task_start_date">Start Date</label>
								<input class="form-control" id="task_start_date" name="task_start_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off"/>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="task_end_date">End Date</label>
								<input class="form-control" id="task_end_date" name="task_end_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off"/>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
													
						</div>
						<div class="form-row">
							<div class="col-md-2 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_sp_task_assign"  value="1">
									<label for="is_active_sp_task_assign" class="custom-control-label">is active</label>
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
	var date_input=$('input[name="task_start_date"]'); //our date input has the name "date"
	var date_input1=$('input[name="task_end_date"]'); //our date input has the name "date"
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
		var company_drp = '';
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

function loadEmployee(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"Employee/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var company_drp = '';
		$.each(data, function(index, item) {
			
			company_drp += '<option value="'+item.emp_id+'">'+item.emp_epf+' - '+item.emp_first_name+'</option>';
        });
		$('#emp_id').append(company_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadEmployee();

function loadTask(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"EmpSpecialTask/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var company_drp = '';
		$.each(data, function(index, item) {
			
			company_drp += '<option value="'+item.special_task_id+'">'+item.task_name+'</option>';
        });
		$('#special_task_id').append(company_drp);
		
		
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadTask();

function loadInvoice(type){
	
	var url = '';
	
	if(type == 'Retail'){
		url = API+"RetailInvoice/fetch_all_active_not_complete/";
	}
	else if(type == 'Rental'){
		url = API+"RentalInvoice/fetch_all_active_not_complete/";
	}
	else if(type == 'Online'){
		url = API+"OnlineInvoice/fetch_all_active_not_complete/";
	}
	
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		url: url,
		success: function(data2, result){
			console.log(data2);
			var company_drp = '<option value="">Select Order</option>';
			$.each(data2, function(index, item) {
				
				company_drp += '<option value="'+item.invoice_id+'">'+item.invoice_id+' - '+item.customer_old_nic_no+' - '+item.customer_name+'</option>';
			});
			$('#invoice_id').html(company_drp);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			const notyf = new Notyf();
			
			$('#invoice_id').html('');
			
			notyf.error({
			  message: 'Invoices not found!',
			  duration: 5000,
			  icon: true,
			  ripple: true,
			  dismissible: true,
			  position: {
				x: 'right',
				y: 'top',
			  }
			  
			})
			//console.log(errorThrown);
		}
	});
}


$(document).on('change','#order_type', function(){
	console.log($(this).val());
	loadInvoice($(this).val());
})


$('#submit').click(function(e){
	e.preventDefault();
		
	var special_task_id = 0;
	var branch_id = "";
	var emp_id = 0;
	var invoice_id = 0;
	var order_type = "";
	var task_start_date = "";
	var task_end_date = 0;
	var is_active_sp_task_assign = 0;
	
	special_task_id = $('#special_task_id').val();
	branch_id = $('#branch_id').val();
	emp_id = $('#emp_id').val();
	invoice_id = $('#invoice_id').val();
	order_type = $('#order_type').val();
	task_start_date = $('#task_start_date').val();
	task_end_date = $('#task_end_date').val();
	is_active_sp_task_assign = $("#is_active_sp_task_assign").is(':checked')? 1 : 0;
	

		
	if( typeof special_task_id !== 'undefined' && special_task_id !== ''
	&& typeof branch_id !== 'undefined' && branch_id !== ''
	&& typeof emp_id !== 'undefined' && emp_id !== ''
	&& typeof order_type !== 'undefined' && order_type !== ''
	&& typeof task_start_date !== 'undefined' && task_start_date !== ''
	&& typeof task_end_date !== 'undefined' && task_end_date !== ''
	&& typeof invoice_id !== 'undefined' && invoice_id !== '')
	{
		
		var formData = new FormData();
        formData.append('special_task_id',special_task_id);
		formData.append('branch_id',branch_id);
		formData.append('emp_id',emp_id);	
		formData.append('invoice_id',invoice_id);	
		formData.append('order_type',order_type);
		formData.append('task_start_date',task_start_date);
		formData.append('task_end_date',task_end_date);
		formData.append('is_active_sp_task_assign',is_active_sp_task_assign);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpTaskAssign/insert/",
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
					window.location = "<?php echo base_url() ?>EmpTaskAssign/view";
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