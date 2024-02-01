<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Company Branch Details</h3>
			</div>

			<form id="form">
				<div class="card-body ">					
						<div class="form-row">
						<input type="hidden" class="form-control typeahead" id="company_branch_id" name="company_branch_id"  placeholder="" required>
							<div class="col-md-3 mb-3">
								<label for="name">Name</label>
								<input type="text" class="form-control" id="company_branch_name" name="company_branch_name" required>
								<div id="nameError" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="location">Location</label>
								<select class="custom-select" id="location_id" name="location_id" required>
								</select>
								<div id="locationError" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>							
							<div class="col-md-3 mb-3">
								<label for="company">Company</label>
								<select class="custom-select" id="company_id" name="company_id" required>
								</select>
								<div id="companyError" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="contact">Contact No.</label>
								<input type="text" class="form-control" id="branch_contact" name="branch_contact" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="manager">Manager</label>
								<select class="custom-select" id="branch_manager" name="branch_manager" required>
								</select>
								<div id="managerError" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="address">Address</label>
								<input type="text" class="form-control" id="branch_address" name="branch_address" required>
								<div id="addressError" class="invalid-feedback">
									Please provide a valid state.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_branch" name="is_active_branch" value="1">
									<label for="is_active_branch" class="custom-control-label">is active</label>
								</div>
							</div>
						</div>
				</div>			

				<div class="card-footer text-center">
					<button class="btn btn-primary" type="submit" id="submit">Submit</button>
				</div>				
			</form>
		</div>
	</div>
</section>
<script>

$('#form')[0].reset(); 

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
		url: API+"branch/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			//console.log(data);			
			//console.log(data[0].country_id);
			
			$('#company_branch_id').val(data[0].company_branch_id);
			$('#company_id').val(data[0].company_id);
			$('#company_branch_name').val(data[0].company_branch_name);
			$('#location_id').val(data[0].location_id);
			$('#branch_contact').val(data[0].branch_contact);
			$('#branch_manager').val(data[0].branch_manager);
			$('#branch_address').val(data[0].branch_address);			
			
						
			if(data[0].is_active_branch == 1){
				$('#is_active_branch').prop('checked', true);
			}
			
			loadCompany();
			loadLocation();
			loadEmployee();
			
			function loadCompany() {
				
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"company/fetch_all_active/",
					success: function(data1, result){
						//console.log(data1);
						
						var company_drp = '';
						$.each(data1, function(index, item) {
							
							if(data[0].company_id == item.company_id){
								company_drp += '<option selected value="'+item.company_id+'">'+item.company_name+'</option>';
							}
							else{
								company_drp += '<option value="'+item.company_id+'">'+item.company_name+'</option>';
							}

							
						});
						$('#company_id').append(company_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(textStatus);
					}
				});
			}
			
			function loadLocation() {
				
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"location/fetch_all_active/",
					success: function(data1, result){
						//console.log(data1);
						
						var loc_drp = '';
						$.each(data1, function(index, item) {
							
							if(data[0].location_id == item.location_id){
								loc_drp += '<option selected value="'+item.location_id+'">'+item.location_name+'</option>';
							}
							else{
								loc_drp += '<option value="'+item.location_id+'">'+item.location_name+'</option>';
							}

							
						});
						$('#location_id').append(loc_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(textStatus);
					}
				});
			}
			
			function loadEmployee() {
				
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"employee/fetch_all_active/",
					success: function(data1, result){
						//console.log(data1);
						
						var branch_drp = '';
						$.each(data1, function(index, item) {
							
							if(data[0].branch_manager == item.emp_id){
								branch_drp += '<option selected value="'+item.emp_id+'">'+item.emp_epf+'-'+item.emp_first_name+'</option>';
							}
							else{
								branch_drp += '<option value="'+item.emp_id+'">'+item.emp_epf+'-'+item.emp_first_name+'</option>';
							}

							
						});
						$('#branch_manager').append(branch_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(textStatus);
					}
				});
			}
			
			/* $('#name').autocomplete({
				lookup: data,
				onSelect: function (suggestion) {					  
					country_id = suggestion.data;
					$('#id').val(suggestion.data);
					$('#name').val(suggestion.value);
					$('#description').val(suggestion.country_desc);
					if(suggestion.is_active == 1){
						$('#is_active').prop('checked', true);
					}
				}
			}); */
				
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
	
	var company_branch_id = 0;
	var company_id = 0;
	var company_branch_name = "";
	var location_id = 0;
	var branch_contact = "";
	var branch_manager = "";
	var branch_address = "";
	var is_active_branch = 0;
	
	company_branch_id =  $('#company_branch_id').val();
	company_id =  $('#company_id').val();
	company_branch_name = $('#company_branch_name').val();
	location_id =  $('#location_id').val();
	branch_contact =  $('#branch_contact').val();
	branch_manager = $('#branch_manager').val();
	branch_address = $('#branch_address').val();
	is_active_branch = $("#is_active_branch").is(':checked')? 1 : 0;
		
	if(typeof company_branch_id !== 'undefined' && company_branch_id !== '' && typeof company_id !== 'undefined' && 
	company_id !== '' && typeof company_branch_name !== 'undefined' && company_branch_name !== '' && typeof location_id !== 'undefined' && location_id !== '' && typeof branch_contact !== 'undefined' && branch_contact !== '' && typeof branch_manager !== 'undefined' && branch_manager !== '' && typeof branch_address !== 'undefined' && branch_address !== '' )
	{
		var formData = new FormData();
		formData.append('company_branch_id',company_branch_id);
        formData.append('company_id',company_id);
		formData.append('company_branch_name',company_branch_name);
		formData.append('location_id',location_id);
        formData.append('branch_contact',branch_contact);
		formData.append('branch_manager',branch_manager);
		formData.append('branch_address',branch_address);
		formData.append('is_active_branch',is_active_branch);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"branch/update/",
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
						window.location = "<?php echo base_url() ?>branch/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Branch is being used by other modules at the moment!"){
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
		/* $(document).Toasts('create', {
			icon: 'fas fa-exclamation-triangle',
			class: 'bg-danger m-1',
			autohide: true,
			delay: 5000,
			title: 'An error has occured',
			body: 'Something went wrong'
		});	 */
	}
	
	
})



</script>