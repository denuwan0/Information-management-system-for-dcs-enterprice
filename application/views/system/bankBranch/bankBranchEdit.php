<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Bank Branch Details</h3>
			</div>

			<form id="form">
				<input type="hidden" class="form-control typeahead" id="b_branch_id" name="b_branch_id" value=""  placeholder="" required>
				<div class="card-body ">
					<div class="form-row">
						<div class="col-md-6 mb-3">
							<label for="name">Branch Code</label>
							<input type="text" class="form-control" id="b_branch_code" name="b_branch_code" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="location">Swift Code</label>
							<input type="text" class="form-control" id="b_bank_swift_code" name="b_bank_swift_code" required>
							<div id="locationError" class="invalid-feedback">
								Please select a valid state.
							</div>
						</div>							
						<div class="col-md-6 mb-3">
							<label for="company">Bank</label>
							<select class="custom-select" id="bank_id" name="bank_id" required>
							</select>
							<div id="companyError" class="invalid-feedback">
								Please select a valid state.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="contact">Location</label>
							<select class="custom-select" id="location_id" name="location_id" required>
							</select>
							<div id="companyError" class="invalid-feedback">
								Please select a valid state.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="manager">Address</label>
							<input type="text" class="form-control" id="b_branch_address" name="b_branch_address" required>
							<div id="addressError" class="invalid-feedback">
								Please provide a valid state.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="address">Contact</label>
							<input type="text" class="form-control" id="b_branch_contact" name="b_branch_contact" required>
							<div id="addressError" class="invalid-feedback">
								Please provide a valid state.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_bank_b_branch" name="is_active_bank_b_branch" value="1">
								<label for="is_active_bank_b_branch" class="custom-control-label">is active</label>
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
		url: API+"bankbranch/fetch_single_join/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#b_branch_id').val(data[0].b_branch_id);
			$('#bank_id').val(data[0].bank_id);
			$('#location_id').val(data[0].location_id);
			$('#b_branch_code').val(data[0].b_branch_code);
			$('#b_branch_address').val(data[0].b_branch_address);
			$('#b_branch_contact').val(data[0].b_branch_contact);
			$('#b_bank_swift_code').val(data[0].b_bank_swift_code);				
						
			if(data[0].is_active_bank_b_branch == 1){
				$('#is_active_bank_b_branch').prop('checked', true);
			}
			
			loadBank();
			loadLocation();
			
			function loadBank() {
				
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"bank/fetch_all_active/",
					success: function(data1, result){
						//console.log(data1);
						
						var bank_drp = '';
						$.each(data1, function(index, item) {
							
							if(data[0].bank_id == item.bank_id){
								bank_drp += '<option selected value="'+item.bank_id+'">'+item.bank_name+'</option>';
							}
							else{
								bank_drp += '<option value="'+item.bank_id+'">'+item.bank_name+'</option>';
							}

							
						});
						$('#bank_id').append(bank_drp);
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
	
	var b_branch_id = 0;
	var bank_id = 0;
	var location_id = 0;
	var b_branch_code = "";
	var b_branch_address = "";
	var b_branch_contact = "";
	var b_bank_swift_code = "";
	var is_active_bank_b_branch = 0;
	
	b_branch_id =  $('#b_branch_id').val();
	bank_id =  $('#bank_id').val();
	location_id = $('#location_id').val();
	b_branch_code =  $('#b_branch_code').val();
	b_branch_address =  $('#b_branch_address').val();
	b_branch_contact = $('#b_branch_contact').val();
	b_bank_swift_code = $('#b_bank_swift_code').val();
	is_active_bank_b_branch = $("#is_active_bank_b_branch").is(':checked')? 1 : 0;
	
	
		
	if(typeof b_branch_id !== 'undefined' && b_branch_id !== '' && typeof bank_id !== 'undefined' &&  bank_id !== '' && typeof location_id !== 'undefined' && location_id !== '' && typeof b_branch_code !== 'undefined' && b_branch_code !== '' && typeof b_branch_address !== 'undefined' && b_branch_address !== '' && typeof b_branch_contact !== 'undefined' && b_branch_contact !== '' && typeof b_bank_swift_code !== 'undefined' && b_bank_swift_code !== '' )
	{
		var formData = new FormData();
		formData.append('b_branch_id',b_branch_id);
        formData.append('bank_id',bank_id);
		formData.append('location_id',location_id);
		formData.append('b_branch_code',b_branch_code);
        formData.append('b_branch_address',b_branch_address);
		formData.append('b_branch_contact',b_branch_contact);
		formData.append('b_bank_swift_code',b_bank_swift_code);
		formData.append('is_active_bank_b_branch',is_active_bank_b_branch);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"bankbranch/update/",
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
						window.location = "<?php echo base_url() ?>bankbranch/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Bank Branch is being used by other modules at the moment!"){
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