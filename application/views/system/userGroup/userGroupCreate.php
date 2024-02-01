<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Vehicle Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="sys_user_group_name">User Group Name</label>
								<input type="text" class="form-control" id="sys_user_group_name" required>
								<div id="validationServer03Feedback" class="invalid-feedback">
									Please provide a valid city.
								</div>
							</div>	
							<div class="col-md-6 mb-3">
								<label for="sys_user_group_desc">Description</label>
								<input type="text" class="form-control" id="sys_user_group_desc" required>
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
					<button class="btn btn-primary" type="submit" id="submit">Submit form</button>
				</div>				
			</form>
		</div>
	</div>
</section>
<script>



$('#submit').click(function(e){
	e.preventDefault();
		
	var sys_user_group_id = 0;
	var sys_user_group_name = "";
	var sys_user_group_desc = "";
	var is_active_sys_user_group = 0;
	
	sys_user_group_name = $('#sys_user_group_name').val();
	sys_user_group_desc = $('#sys_user_group_desc').val();
	is_active_sys_user_group = $("#is_active_sys_user_group").is(':checked')? 1 : 0;
	
	
		
	if(typeof sys_user_group_name !== 'undefined' && sys_user_group_name !== '' 
	&& typeof sys_user_group_desc !== 'undefined' && sys_user_group_desc !== '')
	{
		
		var formData = new FormData();
        formData.append('sys_user_group_name',sys_user_group_name);
		formData.append('sys_user_group_desc',sys_user_group_desc);
		formData.append('is_active_sys_user_group',is_active_sys_user_group);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"SysUserGroup/insert/",
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
					window.location = "<?php echo base_url() ?>userGroup/view";
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