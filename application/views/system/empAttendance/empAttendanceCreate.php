<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Attendance Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<label for="branch_id">Branch</label>
								<select class="custom-select" id="branch_id" aria-describedby="" required>
								</select>
							</div>
							<div class="col-md-9 mb-3">
								<label for="formFile" class="form-label">Attendance file upload</label>
								<input class="form-control" type="file" id="formFile">
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
	var date_input=$('input[name="date"]'); //our date input has the name "date"
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		orientation: 'bottom'
	};
	date_input.datepicker(date);
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

$('#submit').click(function(e){
	e.preventDefault();
		
	var date = 0;
	var formFile = 0;
	
	branch_id = $('#branch_id').val();
	formFile = $('#formFile').prop('files')[0];
	
		
	if(typeof branch_id !== 'undefined' && branch_id !== '' 
	&& typeof formFile !== 'undefined' && formFile !== '')
	{
		
		var formData = new FormData();
        formData.append('branch_id',branch_id);
		formData.append('formFile',formFile);
				
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpAttendance/insert/",
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
					window.location = "<?php echo base_url() ?>EmpAttendance/view";
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