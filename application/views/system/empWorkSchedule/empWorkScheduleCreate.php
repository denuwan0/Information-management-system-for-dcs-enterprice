<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Work Schedule Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="ws_name">Name</label>
								<input type="text" class="form-control" id="ws_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="working_hours_per_day">Working Hrs</label>
								<select class="custom-select" id="working_hours_per_day" aria-describedby="" required>
									<option value="5">5 hrs</option>
									<option value="6">6 hrs</option>
									<option value="7">7 hrs</option>
									<option value="8">8 hrs</option>
									<option value="9">9 hrs</option>
									<option value="10">10 hrs</option>
									<option value="12">12 hrs</option>
									<option value="24">24 hrs</option>
									<option value="48">48 hrs</option>
								</select>
							</div>
							<div class="col-md-2 mb-3">
								<label for="in_time">In Time</label>
								<select class="custom-select" id="in_time" aria-describedby="" required>
									<option value="05:00">5 A.M</option>
									<option value="06:00">6 A.M</option>
									<option value="07:00">7 A.M</option>
									<option value="08:00">8 A.M</option>
									<option value="09:00">9 A.M</option>
									<option value="10:00">10 A.M</option>
									<option value="12:00">12 P.M</option>
								</select>
							</div>
							<div class="col-md-2 mb-3">
								<label for="out_time">Out Time</label>
								<select class="custom-select" id="out_time" aria-describedby="" required>
									<option value="17:00">5 P.M</option>
									<option value="18:00">6 P.M</option>
									<option value="19:00">7 P.M</option>
									<option value="20:00">8 P.M</option>
									<option value="21:00">9 P.M</option>
									<option value="22:00">10 P.M</option>
									<option value="00:00">12 A.M</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_flexible" value="1">
									<label for="is_flexible" class="custom-control-label">is flexible</label>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_work_schedule" value="1">
									<label for="is_active_work_schedule" class="custom-control-label">is active</label>
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
		
	var ws_name = "";
	var working_hours_per_day = "";
	var in_time = 0;
	var out_time = 0;
	var is_flexible = 0;
	var is_active_work_schedule = 0;
	
	ws_name = $('#ws_name').val();
	working_hours_per_day = $('#working_hours_per_day').val();
	in_time = $('#in_time').val();
	out_time = $('#out_time').val();
	is_flexible = $("#is_flexible").is(':checked')? 1 : 0;
	is_active_work_schedule = $("#is_active_work_schedule").is(':checked')? 1 : 0;
	
		
	if(typeof ws_name !== 'undefined' && ws_name !== '' 
	&& typeof working_hours_per_day !== 'undefined' && working_hours_per_day !== ''
	&& typeof in_time !== 'undefined' && in_time !== '' 
	&& typeof out_time !== 'undefined' && out_time !== '')
	{
		
		var formData = new FormData();
        formData.append('ws_name',ws_name);
		formData.append('working_hours_per_day',working_hours_per_day);
		formData.append('in_time',in_time);
		formData.append('out_time',out_time);
		formData.append('is_flexible',is_flexible);
		formData.append('is_active_work_schedule',is_active_work_schedule);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"EmpWorkSchedule/insert/",
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
						window.location = "<?php echo base_url() ?>EmpWorkSchedule/view";
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