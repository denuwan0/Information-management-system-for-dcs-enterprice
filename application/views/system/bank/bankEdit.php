<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Bank Details</h3>
			</div>

			<form id="form">
				<div class="card-body ">
					<div class="form-row">
						<div class="col-md-6 mb-3">
						<input type="hidden" class="form-control" id="bank_id" name="bank_id" value="">
							<label for="name">Name</label>
							<input type="text" class="form-control" id="bank_name" name="bank_name" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>							
						<div class="col-md-6 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_bank" name="is_active_bank" value="1">
								<label for="is_active_bank" class="custom-control-label">is active</label>
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
		url: API+"bank/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			//console.log(data);			
			//console.log(data[0].country_id);
			
			$('#bank_id').val(data[0].bank_id);
			$('#bank_name').val(data[0].bank_name);			
			
						
			if(data[0].is_active_bank == 1){
				$('#is_active_bank').prop('checked', true);
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
	var bank_id = 0;
	var bank_name = "";
	var is_active_bank = 0;
	
	
	bank_id =  $('#bank_id').val();
	bank_name = $('#bank_name').val();
	is_active_bank = $("#is_active_bank").is(':checked')? 1 : 0;
		
	if(typeof bank_id !== 'undefined' && bank_id !== '' && typeof bank_name !== 'undefined' && bank_name !== '')
	{
		var formData = new FormData();
		formData.append('bank_id',bank_id);
        formData.append('bank_name',bank_name);
		formData.append('is_active_bank',is_active_bank);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"bank/update/",
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
						window.location = "<?php echo base_url() ?>bank/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Bank is being used by other modules at the moment!"){
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