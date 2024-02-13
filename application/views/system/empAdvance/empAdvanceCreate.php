<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Advance Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-4 mb-3">
								<label for="advance_name">Advance Name</label>
								<input type="text" class="form-control" id="advance_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>							
							<div class="col-md-8 mb-3">
								<label for="advance_desc">Description</label>
								<input type="text" class="form-control" id="advance_desc" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>							
						</div>
						<div class="form-row">							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_advance" value="1">
								<label for="is_active_advance" class="custom-control-label">is active</label>
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
		
	var advance_name = "";
	var advance_desc = "";
	var is_active_advance = 0;
	
	advance_name = $('#advance_name').val();
	advance_desc = $('#advance_desc').val();
	is_active_advance = $("#is_active_advance").is(':checked')? 1 : 0;
	
		
	if(typeof advance_name !== 'undefined' && advance_name !== '' 
	&& typeof advance_desc !== 'undefined' && advance_desc !== '')
	{
		
		var formData = new FormData();
        formData.append('advance_name',advance_name);
		formData.append('advance_desc',advance_desc);
		formData.append('is_active_advance',is_active_advance);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpAdvance/insert/",
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
					window.location = "<?php echo base_url() ?>EmpAdvance/view";
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