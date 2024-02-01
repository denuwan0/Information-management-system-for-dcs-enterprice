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
							<input type="hidden" class="form-control" id="emp_group_id" required>
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
		url: API+"EmpGroup/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#emp_group_id').val(data[0].emp_group_id);
			$('#emp_group_name').val(data[0].emp_group_name);
			$('#emp_group_desc').val(data[0].emp_group_desc);
			$('#emp_grade_id').val(data[0].emp_grade_id);
			$('#emp_designation_id').val(data[0].emp_designation_id);
						
			if(data[0].is_active_emp_group == 1){
				$('#is_active_emp_group').prop('checked', true);
			}
			
			loadGrade();
			loadDesignation();
			
			function loadGrade(){
			$.ajax({
				type: "POST",
				cache : false,
				async: true,
				dataType: "json",
				url: API+"EmpGrade/fetch_all_active/",
				success: function(data1, result){
					console.log(data[0].emp_grade_id);
					location_drp= '';
					$.each(data1, function(index, item) {
						if(data[0].emp_grade_id == item.emp_grade_id){
							location_drp += '<option selected value="'+item.emp_grade_id+'">'+item.emp_grade_name+'</option>';
						}
						else{
							location_drp += '<option value="'+item.emp_grade_id+'">'+item.emp_grade_name+'</option>';
						}
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
				success: function(data2, result){
					console.log(data[0].emp_designation_id);
					var company_drp = '';
					$.each(data2, function(index, item) {
						//console.log(item);
						if(data[0].emp_designation_id == item.emp_desig_id){
							company_drp += '<option selected value="'+item.emp_desig_id+'">'+item.emp_desig_name+'</option>';
						}
						else{
							company_drp += '<option value="'+item.emp_desig_id+'">'+item.emp_desig_name+'</option>';
						}
						
					});
					$('#emp_designation_id').append(company_drp);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {						
					
					//console.log(errorThrown);
				}
			});
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
	
	var emp_group_id = 0;
	var emp_group_name = "";
	var emp_group_desc = "";
	var emp_grade_id = 0;
	var emp_designation_id = 0;
	var is_active_emp_group = 0;
	
	emp_group_id = $('#emp_group_id').val();
	emp_group_name = $('#emp_group_name').val();
	emp_group_desc = $('#emp_group_desc').val();
	emp_grade_id = $('#emp_grade_id').val();
	emp_designation_id = $('#emp_designation_id').val();
	is_active_emp_group = $("#is_active_emp_group").is(':checked')? 1 : 0;
			
	if(typeof emp_group_id !== 'undefined' && emp_group_id !== ''
	&& typeof emp_group_name !== 'undefined' && emp_group_name !== ''	
	&& typeof emp_group_desc !== 'undefined' && emp_group_desc !== '' 
	&& typeof emp_grade_id !== 'undefined' && emp_grade_id !== '' 
	&& typeof emp_designation_id !== 'undefined' && emp_designation_id !== '')
	{
		var formData = new FormData();
		formData.append('emp_group_id',emp_group_id);
		formData.append('emp_group_name',emp_group_name);
        formData.append('emp_group_desc',emp_group_desc);
		formData.append('emp_grade_id',emp_grade_id);
		formData.append('emp_designation_id',emp_designation_id);
		formData.append('is_active_emp_group',is_active_emp_group);
				
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"EmpGroup/update/",
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
						window.location = "<?php echo base_url() ?>EmpGroup/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Employee Group is being used by other modules at the moment!"){
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