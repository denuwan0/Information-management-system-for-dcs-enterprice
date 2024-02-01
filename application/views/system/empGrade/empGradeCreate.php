<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Employee Grade</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-5 mb-3">
								<label for="emp_grade_name">Grade Name</label>
								<input type="text" class="form-control" id="emp_grade_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-7 mb-3">
								<label for="emp_grade_desc">Grade Description</label>
								<input type="text" class="form-control" id="emp_grade_desc" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>	
						</div>
						<div class="form-row">							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_emp_grade" value="1">
								<label for="is_active_emp_grade" class="custom-control-label">is active</label>
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


$('#submit').click(function(e){
	e.preventDefault();
		
	var emp_grade_name = "";
	var emp_grade_desc = "";
	var is_active_emp_grade = 0;
	
	emp_grade_name = $('#emp_grade_name').val();
	emp_grade_desc = $('#emp_grade_desc').val();
	is_active_emp_grade = $("#is_active_emp_grade").is(':checked')? 1 : 0;
	
		
	if(typeof emp_grade_name !== 'undefined' && emp_grade_name !== '' 
	&& typeof emp_grade_desc !== 'undefined' && emp_grade_desc !== '')
	{
		
		var formData = new FormData();
        formData.append('emp_grade_name',emp_grade_name);
		formData.append('emp_grade_desc',emp_grade_desc);
		formData.append('is_active_emp_grade',is_active_emp_grade);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpGrade/insert/",
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
					window.location = "<?php echo base_url() ?>EmpGrade/view";
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