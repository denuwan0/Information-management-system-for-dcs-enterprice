<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Notify Type Details</h3>
			</div>

			<form id="form">
				<div class="card-body ">
					<div class="form-row">
						<div class="col-md-6 mb-3">
						<input type="hidden" class="form-control" id="sys_notify_type_id" name="sys_notify_type_id" value="">
							<label for="name">Name</label>
							<input type="text" class="form-control" id="notify_name" name="notify_name" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>							
						<div class="col-md-6 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_sys_notify_type" name="is_active_sys_notify_type" value="1">
								<label for="is_active_sys_notify_type" class="custom-control-label">is active</label>
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
		url: API+"SysNotifyType/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			//console.log(data);			
			//console.log(data[0].country_id);
			
			$('#sys_notify_type_id').val(data[0].sys_notify_type_id);
			$('#notify_name').val(data[0].notify_name);			
			
						
			if(data[0].is_active_sys_notify_type == 1){
				$('#is_active_sys_notify_type').prop('checked', true);
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
	var sys_notify_type_id = 0;
	var notify_name = "";
	var is_active_sys_notify_type = 0;
	
	
	sys_notify_type_id =  $('#sys_notify_type_id').val();
	notify_name = $('#notify_name').val();
	is_active_sys_notify_type = $("#is_active_sys_notify_type").is(':checked')? 1 : 0;
	
	
		
	if(typeof sys_notify_type_id !== 'undefined' && sys_notify_type_id !== '' && typeof notify_name !== 'undefined' && notify_name !== '')
	{
		var formData = new FormData();
		formData.append('sys_notify_type_id',sys_notify_type_id);
        formData.append('notify_name',notify_name);
		formData.append('is_active_sys_notify_type',is_active_sys_notify_type);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"SysNotifyType/update/",
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
						window.location = "<?php echo base_url() ?>SystemNotifyType/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Notify Type is being used by other modules at the moment!"){
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