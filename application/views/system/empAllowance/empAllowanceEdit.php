<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Allowance Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<input type="hidden" class="form-control" id="allowance_id" required>
							<div class="col-md-4 mb-3">
								<label for="allowance_name">Allowance Name</label>
								<input type="text" class="form-control" id="allowance_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>							
							<div class="col-md-8 mb-3">
								<label for="allowance_desc">Description</label>
								<input type="text" class="form-control" id="allowance_desc" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>							
						</div>
						<div class="form-row">							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_emp_allow" value="1">
								<label for="is_active_emp_allow" class="custom-control-label">is active</label>
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
		url: API+"EmpAllowance/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#allowance_desc').val(data[0].allowance_desc);
			$('#allowance_id').val(data[0].allowance_id);
			$('#allowance_name').val(data[0].allowance_name);
						
			if(data[0].is_active_emp_allow == 1){
				$('#is_active_emp_allow').prop('checked', true);
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
	
	var allowance_id = 0;
	var allowance_name = "";
	var allowance_desc = "";
	var is_active_emp_allow = 0;
	
	allowance_id = $('#allowance_id').val();
	allowance_name = $('#allowance_name').val();
	allowance_desc = $('#allowance_desc').val();
	is_active_emp_allow = $("#is_active_emp_allow").is(':checked')? 1 : 0;
	
				
	if(typeof allowance_id !== 'undefined' && allowance_id !== ''
	&& typeof allowance_name !== 'undefined' && allowance_name !== ''	
	&& typeof allowance_desc !== 'undefined' && allowance_desc !== '' )
	{
		var formData = new FormData();
		formData.append('allowance_id',allowance_id);
		formData.append('allowance_name',allowance_name);
        formData.append('allowance_desc',allowance_desc);
		formData.append('is_active_emp_allow',is_active_emp_allow);
		
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"EmpAllowance/update/",
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
						window.location = "<?php echo base_url() ?>EmpAllowance/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Allowance is being used by other modules at the moment!"){
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