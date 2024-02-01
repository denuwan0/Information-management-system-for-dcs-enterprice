<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Company Branch Details</h3>
			</div>

				<div class="card-body ">
					<form>
						<div class="form-row">
						<input type="hidden" class="form-control" id="sys_user_group_id" >
							<div class="col-md-6 mb-3">
								<label for="sys_user_group_name">User Group Name</label>
								<input type="text" class="form-control" id="sys_user_group_name" >
								<div id="validationServer03Feedback" class="invalid-feedback">
									Please provide a valid city.
								</div>
							</div>	
							<div class="col-md-6 mb-3">
								<label for="sys_user_group_desc">Description</label>
								<input type="text" class="form-control" id="sys_user_group_desc" >
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>
						</div>
						<div class="form-row">													
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_sys_user_group" value="1">
								<label for="is_active_sys_user_group" class="custom-control-label">is active</label>
							</div>
						</div>
					</form>
				</div>				

				<div class="card-footer text-center">
					<button class="btn btn-primary" type="submit" id="submit">Submit</button>
				</div>
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
		url: API+"SysUserGroup/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#sys_user_group_id').val(data[0].sys_user_group_id);
			$('#sys_user_group_name').val(data[0].sys_user_group_name);
			$('#sys_user_group_desc').val(data[0].sys_user_group_desc);			
						
			if(data[0].is_active_sys_user_group == 1){
				$('#is_active_sys_user_group').prop('checked', true);
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
	
	var sys_user_group_id = 0;
	var sys_user_group_name = "";
	var sys_user_group_desc = "";
	var is_active_sys_user_group = 0;
	
	sys_user_group_id =  $('#sys_user_group_id').val();
	sys_user_group_name =  $('#sys_user_group_name').val();
	sys_user_group_desc = $('#sys_user_group_desc').val();
	is_active_sys_user_group = $("#is_active_sys_user_group").is(':checked')? 1 : 0;
		
	if(typeof sys_user_group_id !== 'undefined' && sys_user_group_id !== '' 
	&& typeof sys_user_group_name !== 'undefined' && sys_user_group_name !== '' 
	&& typeof sys_user_group_desc !== 'undefined' && sys_user_group_desc !== '' )
	{
		var formData = new FormData();
		formData.append('sys_user_group_id',sys_user_group_id);
        formData.append('sys_user_group_name',sys_user_group_name);
		formData.append('sys_user_group_desc',sys_user_group_desc);
		formData.append('is_active_sys_user_group',is_active_sys_user_group);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"SysUserGroup/update/",
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
						window.location = "<?php echo base_url() ?>UserGroup/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "User Group is being used by other modules at the moment!"){
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