<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Employee Group Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-4 mb-3">
								<label for="emp_group_name">Employee Group Name</label>
								<input type="text" class="form-control" id="emp_group_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-8 mb-3">
								<label for="emp_group_desc">Description</label>
								<input type="text" class="form-control" id="emp_group_desc" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="emp_grade_id">Grade</label>
								<select class="custom-select" id="emp_grade_id" aria-describedby="" required>
									<option value="">Select Employee Grade</option>
								</select>
							</div>							
							<div class="col-md-6 mb-3">
								<label for="emp_designation_id">Designation</label>
								<select class="custom-select" id="emp_designation_id" aria-describedby="" required>
									<option value="">Select Employee Designation</option>
								</select>
							</div>							
						</div>
						<div class="form-row">							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_emp_group" value="1">
								<label for="is_active_emp_group" class="custom-control-label">is active</label>
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


function loadGrade(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"EmpGrade/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		location_drp= '';
		$.each(data, function(index, item) {
			
			location_drp += '<option value="'+item.emp_grade_id+'">'+item.emp_grade_name+'</option>';
        });
		$('#emp_grade_id').append(location_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

function loadDesignation(){
$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"EmpDesignation/fetch_all_active/",
	success: function(data, result){
		console.log(data);
		var company_drp = '';
		$.each(data, function(index, item) {
			//console.log(item);
			company_drp += '<option value="'+item.emp_desig_id+'">'+item.emp_desig_name+'</option>';
        });
		$('#emp_designation_id').append(company_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}


loadGrade();
loadDesignation();

$('#submit').click(function(e){
	e.preventDefault();
		
	var emp_group_name = "";
	var emp_group_desc = "";
	var emp_grade_id = 0;
	var emp_designation_id = 0;
	var is_active_emp_group = 0;
	
	emp_group_name = $('#emp_group_name').val();
	emp_group_desc = $('#emp_group_desc').val();
	emp_grade_id = $('#emp_grade_id').val();
	emp_designation_id = $('#emp_designation_id').val();
	is_active_emp_group = $("#is_active_emp_group").is(':checked')? 1 : 0;	
		
	if(typeof emp_group_name !== 'undefined' && emp_group_name !== '' 
	&& typeof emp_group_desc !== 'undefined' && emp_group_desc !== ''
	&& typeof emp_grade_id !== 'undefined' && emp_grade_id !== '' 
	&& typeof emp_designation_id !== 'undefined' && emp_designation_id !== '')
	{
		
		var formData = new FormData();
        formData.append('emp_group_name',emp_group_name);
		formData.append('emp_group_desc',emp_group_desc);
		formData.append('emp_grade_id',emp_grade_id);
		formData.append('emp_designation_id',emp_designation_id);
		formData.append('is_active_emp_group',is_active_emp_group);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpGroup/insert/",
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
					window.location = "<?php echo base_url() ?>EmpGroup/view";
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