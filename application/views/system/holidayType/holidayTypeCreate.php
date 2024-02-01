<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Holiday Type Details</h3>
			</div>

			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="name">Holiday Type Name</label>
								<input type="text" class="form-control" name="holiday_type_name"  id="holiday_type_name" required>
								<div id="nameError" class="invalid-feedback">
									Please Enter Location Name.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="name">Description</label>
								<input type="text" class="form-control" name="holiday_type_desc"  id="holiday_type_desc" required>
								<div id="nameError" class="invalid-feedback">
									Please Enter Location Description.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_holiday_type" name="is_active_holiday_type" value="1">
									<label for="is_active_holiday_type" class="custom-control-label">is active</label>
								</div>
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
		
	var holiday_type_name = "";
	var holiday_type_desc = "";
	var is_active_holiday_type = 0;
	
	holiday_type_name = $('#holiday_type_name').val();
	holiday_type_desc = $('#holiday_type_desc').val();
	is_active_holiday_type = $("#is_active_holiday_type").is(':checked')? 1 : 0;
	
	
		
	if(typeof holiday_type_name !== 'undefined' && holiday_type_name !== '' && typeof holiday_type_desc !== 'undefined' && holiday_type_desc !== '')
	{
		
		var formData = new FormData();
        formData.append('holiday_type_name',holiday_type_name);
		formData.append('holiday_type_desc',holiday_type_desc);
		formData.append('is_active_holiday_type',is_active_holiday_type);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"HolidayType/insert/",
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
					window.location = "<?php echo base_url() ?>holidayTypes/view";
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