<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Driving License Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<div class="form-row">
					<input type="hidden" class="form-control typeahead" id="driving_license_id" name="driving_license_id"  placeholder="" value="" required>
						<div class="col-md-3 mb-3">
							<label for="license_number">License No.</label>
							<input type="text" class="form-control" id="license_number" required>
							<div class="valid-feedback">
								Looks good!
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<label for="license_type">Vehicle Category</label>
							<select class="custom-select" id="license_type" aria-describedby="" required>
								<option value="">Select Category</option>
								<option value="Light">Light vehicle</option>
								<option value="Heavy">Heavy vehicle</option>
							</select>
						</div>
						<div class="col-md-3 mb-3">							
							<label class="control-label" for="date">Valid from</label>
							<input class="form-control" id="valid_from_date" name="valid_from_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off">							
						</div>	
						<div class="col-md-3 mb-3">							
							<label class="control-label" for="date">Valid to</label>
							<input class="form-control" id="valid_to_date" name="valid_to_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off">							
						</div>
						<div class="custom-control custom-checkbox">
							<input class="custom-control-input" type="checkbox" id="is_active_driving_lice" value="1">
							<label for="is_active_driving_lice" class="custom-control-label">is active</label>
						</div>
					</div>
					
				</div>			

				<div class="card-footer text-center">
					<button class="btn btn-primary" id="submit" type="submit">Submit</button>
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

$(document).ready(function(){
	var date_input1=$('input[name="valid_from_date"]'); //our date input has the name "date"
	var date_input2=$('input[name="valid_to_date"]'); //our date input has the name "date"
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		orientation: 'bottom'
	};
	date_input1.datepicker(options);
	date_input2.datepicker(options);
})


//var country_id = 0;
function loadData() {
	
		
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"EmpDrivingLicense/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#driving_license_id').val(data[0].driving_license_id);
			$('#license_number').val(data[0].license_number);
			$('#valid_from_date').val(data[0].valid_from_date);
			$('#valid_to_date').val(data[0].valid_to_date);
			$('#license_type').val(data[0].license_type);
						
			if(data[0].is_active_driving_lice == 1){
				$('#is_active_driving_lice').prop('checked', true);
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
	
	var driving_license_id = 0;
	var license_number = 0;
	var valid_from_date = "";
	var valid_to_date = "";
	var license_type = "";
	var is_active_driving_lice = 0;
	
	driving_license_id = $('#driving_license_id').val();
	license_number = $('#license_number').val();
	valid_from_date = $('#valid_from_date').val();
	valid_to_date = $('#valid_to_date').val();
	license_type = $('#license_type').val();
	is_active_driving_lice = $("#is_active_driving_lice").is(':checked')? 1 : 0;
	
			
	if(typeof driving_license_id !== 'undefined' && driving_license_id !== ''
	&& typeof license_number !== 'undefined' && license_number !== ''	
	&& typeof valid_from_date !== 'undefined' && valid_from_date !== '' 
	&& typeof valid_to_date !== 'undefined' && valid_to_date !== '' 
	&& typeof license_type !== 'undefined' && license_type !== '')
	{
		var formData = new FormData();
		formData.append('driving_license_id',driving_license_id);
		formData.append('license_number',license_number);
        formData.append('valid_from_date',valid_from_date);
		formData.append('valid_to_date',valid_to_date);
		formData.append('license_type',license_type);
		formData.append('is_active_driving_lice',is_active_driving_lice);
		
		
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"EmpDrivingLicense/update/",
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
						window.location = "<?php echo base_url() ?>EmpDrivingLicense/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Driving License is being used by other modules at the moment!"){
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
	}
	
	
})



</script>