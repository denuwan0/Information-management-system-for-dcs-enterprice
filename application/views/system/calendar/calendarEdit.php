<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Holiday Calendar Details</h3>
			</div>

			<form>
				<div class="card-body ">
					<div class="form-row">
					<input type="hidden" class="form-control typeahead" id="h_calendar_id" name="h_calendar_id"  placeholder="" value="" required>
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
								<input class="form-control" id="h_holiday_date_from" name="h_holiday_date_from" placeholder="YYYY-MM-DD" type="text"autocomplete="off" value=""/>
							</div>
						</div>
						
						<div class="col-md-6" >
							<div class="form-group"> <!-- Date input 1-->
								<label class="control-label" for="date">End Date</label>
								<input class="form-control" id="h_holiday_date_to" name="h_holiday_date_to" placeholder="YYYY-MM-DD" type="text" autocomplete="off" value=""/>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_h_calendar" name="is_active_h_calendar" value="1">
								<label for="is_active_h_calendar" class="custom-control-label">is active</label>
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
		url: API+"calendar/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			//console.log(data);			
			//console.log(data[0].country_id);
			
			$('#h_calendar_id').val(data[0].h_calendar_id);
			$('#holiday_id').val(data[0].holiday_id);
			$('#h_holiday_date_from').val(data[0].h_holiday_date_from);
			$('#h_holiday_date_to').val(data[0].h_holiday_date_to);
			$('#is_active_h_calendar').val(data[0].is_active_h_calendar);			
			
						
			if(data[0].is_active_h_calendar == 1){
				$('#is_active_h_calendar').prop('checked', true);
			}
			
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
			
			var realDate1 = new Date(data[0].h_holiday_date_from);
			var realDate2 = new Date(data[0].h_holiday_date_to);
			
			$('#h_holiday_date_from').datepicker({ dateFormat: 'yyyy-mm-dd' }); // format to show
			$('#h_holiday_date_from').datepicker('setDate', realDate1);
			
			$('#h_holiday_date_to').datepicker({ dateFormat: 'yyyy-mm-dd' }); // format to show
			$('#h_holiday_date_to').datepicker('setDate', realDate2);
			
			loadHoliday();
			
			function loadHoliday() {
				
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"holiday/fetch_all_active/",
					success: function(data1, result){
						//console.log(data1);
						
						var holiday_drp = '';
						$.each(data1, function(index, item) {
							
							if(data[0].holiday_id == item.holiday_id ){
								holiday_drp += '<option selected value="'+item.holiday_id +'">'+item.holiday_name+'</option>';
							}
							else{
								holiday_drp += '<option value="'+item.holiday_id+'">'+item.holiday_name+'</option>';
							}

							
						});
						$('#holiday_id').append(holiday_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(textStatus);
					}
				});
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
	
	var h_calendar_id = 0;
	var holiday_id = 0;
	var h_holiday_date_from = "";
	var h_holiday_date_to = "";
	var is_active_h_calendar = 0;
	
	h_calendar_id =  $('#h_calendar_id').val();
	holiday_id =  $('#holiday_id').val();
	h_holiday_date_from = $('#h_holiday_date_from').val();
	h_holiday_date_to =  $('#h_holiday_date_to').val();
	is_active_h_calendar = $("#is_active_h_calendar").is(':checked')? 1 : 0;
	
	//console.log(h_calendar_id+" "+h_holiday_id+" "+h_holiday_date_from+" "+h_holiday_date_to+" "+is_active_h_calendar);
		
	if(typeof h_calendar_id !== 'undefined' && h_calendar_id !== '' && typeof holiday_id !== 'undefined' && 
	holiday_id !== '' && typeof h_holiday_date_from !== 'undefined' && h_holiday_date_from !== '' && typeof h_holiday_date_to !== 'undefined' && h_holiday_date_to !== '' )
	{
		var formData = new FormData();
		formData.append('h_calendar_id',h_calendar_id);
        formData.append('holiday_id',holiday_id);
		formData.append('h_holiday_date_from',h_holiday_date_from);
		formData.append('h_holiday_date_to',h_holiday_date_to);
        formData.append('is_active_h_calendar',is_active_h_calendar);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"calendar/update/",
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
						window.location = "<?php echo base_url() ?>calendar/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Branch is being used by other modules at the moment!"){
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