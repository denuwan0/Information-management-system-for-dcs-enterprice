<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Holiday Calendar Details</h3>
			</div>

			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-6">
								<label for="Holiday">Holiday</label>
								<select class="custom-select" id="holiday_id" name="holiday_id" required>
								</select>
								<div id="locationError" class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
						
							<div class="col-md-6" >
								<div class="form-group"> <!-- Date input 1-->
									<label class="control-label" for="date">Start Date</label>
									<input class="form-control" id="h_holiday_date_from" name="h_holiday_date_from" placeholder="YYYY-MM-DD" type="text" autocomplete="off"/>
								</div>
							</div>
							
							<div class="col-md-6" >
								<div class="form-group"> <!-- Date input 1-->
									<label class="control-label" for="date">End Date</label>
									<input class="form-control" id="h_holiday_date_to" name="h_holiday_date_to" placeholder="YYYY-MM-DD" type="text"autocomplete="off"/>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_h_calendar" name="is_active_h_calendar" value="1">
									<label for="is_active_h_calendar" class="custom-control-label">is active</label>
								</div>
							</div>
					  
					</form>
				</div>			

				<div class="card-footer text-center">
					<button class="btn btn-primary" type="submit" id="submit">Submit</button>
				</div>				
			</form>
		</div>
	</div>
</section>
<script>


$(document).ready(function(){
	var date_input=$('input[name="h_holiday_date_from"]'); //our date input has the name "date"
	var date_input1=$('input[name="h_holiday_date_to"]'); //our date input has the name "date"
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		orientation: 'bottom'
	};
	date_input.datepicker(options);
	date_input1.datepicker(options);
})
	


$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"holiday/fetch_all_active/",
	success: function(data, result){
		var holiday_drp = '<option value="">Select Holiday</option>';
		$.each(data, function(index, item) {
			//console.log(item);
			holiday_drp += '<option value="'+item.holiday_id+'">'+item.holiday_name+'</option>';
        });
		$('#holiday_id').append(holiday_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});

$('#submit').click(function(e){
	e.preventDefault();
		
	var h_calendar_id = 0;
	var holiday_id = 0;
	var h_holiday_date_from = "";
	var h_holiday_date_to = "";
	var is_active_h_calendar = 0;
	
	
	holiday_id = $('#holiday_id').val();
	h_holiday_date_from = $('#h_holiday_date_from').val();
	h_holiday_date_to = $('#h_holiday_date_to').val();
	is_active_h_calendar = $("#is_active_h_calendar").is(':checked')? 1 : 0;
	
	//console.log(holiday_id);		
		
	if(typeof h_calendar_id !== 'undefined' && h_calendar_id !== '' && typeof holiday_id !== 'undefined' && holiday_id !== ''
	&& typeof h_holiday_date_from !== 'undefined' && h_holiday_date_from !== '' && typeof h_holiday_date_to !== 'undefined' && h_holiday_date_to !== '')
	{
		
		var formData = new FormData();
        formData.append('h_calendar_id',h_calendar_id);
		formData.append('holiday_id',holiday_id);
		formData.append('h_holiday_date_from',h_holiday_date_from);
		formData.append('h_holiday_date_to',h_holiday_date_to);
		formData.append('is_active_h_calendar',is_active_h_calendar);
		

				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"calendar/insert/",
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
					window.location = "<?php echo base_url() ?>calendar/view";
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