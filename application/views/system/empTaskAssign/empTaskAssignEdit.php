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
							<input type="hidden" id="special_task_id" name="special_task_id">
							<div class="col-md-6 mb-3">
								<label for="task_name">Task Name</label>
								<input type="text" class="form-control" id="task_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<!--div class="col-md-3 mb-3">
								<label for="branch_id">Branch Id</label>
								<select class="custom-select" id="branch_id" aria-describedby="" required>
								</select>
							</div-->
							<!--div class="col-md-3 mb-3">
								<label for="invoice_id">Invoice Id</label>
								<select class="custom-select" id="invoice_id" aria-describedby="" required>
								</select>
							</div-->
							<div class="col-md-3 mb-3">
								<label for="task_type">Task Type</label>
								<select class="custom-select" id="task_type" aria-describedby="" required>
									<option value="">Select Task Type</option>
									<option value="General Work">General Work</option>
									<option value="Scaffolding">Scaffolding</option>
									<option value="Heavy Vehicle Operation">Heavy Vehicle Operation</option>
								</select>
							</div>
							<!--div class="col-md-3 mb-3">
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
							</div-->							
						</div>
						<div class="form-row">
							<div class="col-md-2 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_sp_task"  value="1">
									<label for="is_active_sp_task" class="custom-control-label">is active</label>
								</div>
							</div>
							<!--div class="col-md-2 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_complete" value="1">
									<label for="is_complete" class="custom-control-label">is complete</label>
								</div>
							</div-->
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
		url: API+"EmpSpecialTask/fetch_single_join/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#special_task_id').val(data[0].special_task_id);
			$('#task_name').val(data[0].task_name);
			$('#task_type').val(data[0].task_type);
			$('#is_active_sp_task').val(data[0].is_active_sp_task);
						
			if(data[0].is_active_sp_task == 1){
				$('#is_active_sp_task').prop('checked', true);
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
	
	var special_task_id = 0;
	var task_name = 0;
	var task_type = "";
	var is_active_sp_task = 0;
	
	special_task_id = $('#special_task_id').val();
	task_name = $('#task_name').val();
	task_type = $('#task_type').val();
	is_active_sp_task = $("#is_active_sp_task").is(':checked')? 1 : 0;
		
	if(typeof special_task_id !== 'undefined' && special_task_id !== ''
	&& typeof task_name !== 'undefined' && task_name !== ''	
	&& typeof task_type !== 'undefined' && task_type !== '' )
	{
		var formData = new FormData();
		formData.append('special_task_id',special_task_id);
		formData.append('task_name',task_name);
        formData.append('task_type',task_type);
		formData.append('is_active_sp_task',is_active_sp_task);
		
		
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"EmpSpecialTask/update/",
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
						window.location = "<?php echo base_url() ?>EmpSpecialTask/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Task is being used by other modules at the moment!"){
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