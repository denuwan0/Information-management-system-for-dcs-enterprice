<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Holiday Details</h3>
			</div>

			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="name">Holiday Name</label>
								<input type="text" class="form-control" name="holiday_name"  id="holiday_name" required>
								<div id="nameError" class="invalid-feedback">
									Please Enter Location Name.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="name">Holiday Description</label>
								<input type="text" class="form-control" name="holiday_desc"  id="holiday_desc" required>
								<div id="nameError" class="invalid-feedback">
									Please Enter Location Description.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="company_country">Country</label>
								<select class="form-control" id="holiday_type_id" name="holiday_type_id">
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_holiday" name="is_active_holiday" value="1">
									<label for="is_active_holiday" class="custom-control-label">is active</label>
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


$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"holidayType/fetch_all_active/",
	success: function(data, result){
		var h_type_drp = '<option value="">Select Holiday Type</option>';
		$.each(data, function(index, item) {
			console.log(item);
			h_type_drp += '<option value="'+item.holiday_type_id +'">'+item.holiday_type_name+'</option>';
        });
		$('#holiday_type_id').append(h_type_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});

$('#submit').click(function(e){
	e.preventDefault();
		
	var holiday_name = "";
	var holiday_desc = "";
	var holiday_type_id = "";
	var is_active_holiday = 0;
	
	holiday_name = $('#holiday_name').val();
	holiday_desc = $('#holiday_desc').val();
	holiday_type_id = $('#holiday_type_id').val();
	is_active_holiday = $("#is_active_holiday").is(':checked')? 1 : 0;
	
	
		
	if(typeof holiday_name !== 'undefined' && holiday_name !== '' && typeof holiday_desc !== 'undefined' && holiday_desc !== '' && typeof holiday_type_id !== 'undefined' && holiday_type_id !== '')
	{
		
		var formData = new FormData();
        formData.append('holiday_name',holiday_name);
		formData.append('holiday_desc',holiday_desc);
		formData.append('holiday_type_id',holiday_type_id);
		formData.append('is_active_holiday',is_active_holiday);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"holiday/insert/",
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
					window.location = "<?php echo base_url() ?>holiday/view";
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