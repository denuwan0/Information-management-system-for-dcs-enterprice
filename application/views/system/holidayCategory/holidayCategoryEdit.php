<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Holiday Type Details</h3>
				<div style="text-align: right;">
				</div>
			</div>
			<div class="card-body">
				<form>
					<div class="form-row">
						<input type="hidden" class="form-control typeahead" id="holiday_type_id" name="holiday_type_id"   required>
						<div class="col-md-6 mb-3">
							<label for="name">Name</label>
							<input type="text" class="form-control typeahead" name="holiday_type_name"  id="holiday_type_name" placeholder="Enter Holiday Type Name" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="description">Description</label>
							<input type="text" class="form-control" name="holiday_type_desc"  id="holiday_type_desc" placeholder="Enter Description" required>
							<div id="descriptionError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_holiday_type" name="is_active_holiday_type" value="">
								<label for="is_active_holiday_type" class="custom-control-label">is active</label>
							</div>
						</div>						
					</div>					  
				</form>
				
			</div>
			<div class="card-footer text-center">
				<button class="btn btn-primary" type="submit" id="submit">Submit</button>
			</div>
			<div id="" class="" >
				
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
		url: API+"HolidayType/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#holiday_type_id').val(data[0].holiday_type_id);
			$('#holiday_type_name').val(data[0].holiday_type_name);
			$('#holiday_type_desc').val(data[0].holiday_type_desc);		
			
						
			if(data[0].is_active_holiday_type == 1){
				$('#is_active_holiday_type').prop('checked', true);
			}
			
						
			/* $('#name').autocomplete({
				lookup: data,
				onSelect: function (suggestion) {					  
					country_id = suggestion.data;
					$('#id').val(suggestion.data);
					$('#name').val(suggestion.value);
					$('#description').val(suggestion.country_desc);
					if(suggestion.is_active == 1){
						$('#is_active').prop('checked', true);
					}
				}
			}); */
				
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
	
	var holiday_type_id = 0;
	var holiday_type_name = "";
	var holiday_type_desc = "";
	var is_active_holiday_type = 0;
	
	holiday_type_id =  $('#holiday_type_id').val();
	holiday_type_name =  $('#holiday_type_name').val();
	holiday_type_desc = $('#holiday_type_desc').val();
	is_active_holiday_type = $("#is_active_holiday_type").is(':checked')? 1 : 0;
		
	if(typeof holiday_type_id !== 'undefined' && holiday_type_id !== '' && typeof holiday_type_name !== 'undefined' && holiday_type_name !== '' && typeof holiday_type_desc !== 'undefined' && holiday_type_desc !== '' )
	{
		var formData = new FormData();
		formData.append('holiday_type_id',holiday_type_id);
        formData.append('holiday_type_name',holiday_type_name);
		formData.append('holiday_type_desc',holiday_type_desc);
		formData.append('is_active_holiday_type',is_active_holiday_type);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"HolidayType/update/",
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
						window.location = "<?php echo base_url() ?>holidayTypes/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Holiday Type is being used by other modules at the moment!"){
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