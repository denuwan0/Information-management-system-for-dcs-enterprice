<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Customer Details</h3>
			</div>

			<form>
				<div class="card-body ">
					<div class="form-row">
						<input type="hidden" class="form-control" id="customer_id" name="customer_id" required>
						<div class="col-md-6 mb-3">
							<label for="name">Name</label>
							<input type="text" class="form-control" id="customer_name" name="customer_name" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<label for="name">NIC</label>
							<input type="text" class="form-control" id="customer_old_nic_no" name="customer_old_nic_no" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<label for="name">Contact No.</label>
							<input type="text" class="form-control" id="customer_contact_no" name="customer_contact_no" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<label for="name">Email</label>
							<input type="text" class="form-control" id="customer_email" name="customer_email" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<label for="name">Working Address</label>
							<input type="text" class="form-control" id="customer_working_address" name="customer_working_address" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>							
						<div class="col-md-4 mb-3">
							<label for="company">Shipping Address</label> 
							<input type="text" class="form-control" id="customer_shipping_address" name="customer_shipping_address" required>
							<div id="companyError" class="invalid-feedback">
								Please select a valid state.
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-3 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_web" name="is_web" value="1">
								<label for="is_web" class="custom-control-label">is Online Shopper</label>
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_customer" name="is_active_customer" value="1">
								<label for="is_active_customer" class="custom-control-label">is active</label>
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
		url: API+"customer/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#customer_id').val(data[0].customer_id);
			$('#customer_name').val(data[0].customer_name);
			$('#customer_working_address').val(data[0].customer_working_address);
			$('#customer_shipping_address').val(data[0].customer_shipping_address);
			$('#customer_old_nic_no').val(data[0].customer_old_nic_no ? data[0].customer_old_nic_no : data[0].customer_new_nic_no);
			$('#customer_contact_no').val(data[0].customer_contact_no);
			$('#customer_email').val(data[0].customer_email);			
			
						
			if(data[0].is_web == 1){
				$('#is_web').prop('checked', true);
			}
			
			if(data[0].is_active_customer == 1){
				$('#is_active_customer').prop('checked', true);
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
	
	var customer_id  = 0;
	var customer_name = 0;
	var customer_working_address = "";
	var customer_shipping_address = 0;
	var customer_old_nic_no = "";
	var customer_contact_no = "";
	var customer_email = "";
	var is_web = 0;
	var is_active_customer = 0;
	
	customer_id =  $('#customer_id').val();
	customer_name =  $('#customer_name').val();
	customer_working_address = $('#customer_working_address').val();
	customer_shipping_address =  $('#customer_shipping_address').val();
	customer_old_nic_no =  $('#customer_old_nic_no').val();
	customer_contact_no = $('#customer_contact_no').val();
	customer_email = $('#customer_email').val();
	is_web = $("#is_web").is(':checked')? 1 : 0;
	is_active_customer = $("#is_active_customer").is(':checked')? 1 : 0;
		
	if(typeof customer_id !== 'undefined' && customer_id !== '' 
	&& typeof customer_name !== 'undefined' && customer_name !== '' 
	&& typeof customer_working_address !== 'undefined' && customer_working_address !== '' 
	&& typeof customer_shipping_address !== 'undefined' && customer_shipping_address !== '' 
	&& typeof customer_old_nic_no !== 'undefined' && customer_old_nic_no !== '' 
	&& typeof customer_contact_no !== 'undefined' && customer_contact_no !== '' 
	&& typeof customer_email !== 'undefined' && customer_email !== '' )
	{
		var formData = new FormData();
		formData.append('customer_id',customer_id);
        formData.append('customer_name',customer_name);
		formData.append('customer_working_address',customer_working_address);
		formData.append('customer_shipping_address',customer_shipping_address);
        formData.append('customer_old_nic_no',customer_old_nic_no);
		formData.append('customer_contact_no',customer_contact_no);
		formData.append('customer_email',customer_email);
		formData.append('is_web',is_web);
		formData.append('is_active_customer',is_active_customer);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"customer/update/",
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
						window.location = "<?php echo base_url() ?>customer/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Customer is being used by other modules at the moment!"){
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