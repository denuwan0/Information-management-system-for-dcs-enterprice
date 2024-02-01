<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Location Details</h3>
				<div style="text-align: right;">
				</div>
			</div>
			<div class="card-body">
				<form>
					<div class="form-row">
						<input type="hidden" class="form-control typeahead" id="location_id" name="location_id"  placeholder="Enter Company Name" required>
						<div class="col-md-6 mb-3">
							<label for="name">Name</label>
							<input type="text" class="form-control typeahead" name="location_name"  id="location_name" placeholder="Enter Location Name" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="description">Description</label>
							<input type="text" class="form-control" name="location_desc"  id="location_desc" placeholder="Enter Description" required>
							<div id="descriptionError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="company_country">Country</label>
							<select class="form-control" id="country_id" name="country_id">
							</select>
						</div>
						<div class="col-md-3 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_location" name="is_active_location" value="">
								<label for="is_active_location" class="custom-control-label">is active</label>
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
		url: API+"location/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			//console.log(data);			
			//console.log(data[0].country_id);
			
			$('#location_id').val(data[0].location_id);
			$('#location_name').val(data[0].location_name);
			$('#country_id').val(data[0].country_id);
			$('#location_desc').val(data[0].location_desc);			
			
						
			if(data[0].is_active_location == 1){
				$('#is_active_location').prop('checked', true);
			}
			
			loadCountry();
			
			function loadCountry() {
				
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"country/fetch_all_active/",
					success: function(data1, result){
						//console.log(data1);
						
						var country_drp = '';
						$.each(data1, function(index, item) {
							
							if(data[0].country_id == item.country_id){
								country_drp += '<option selected value="'+item.country_id+'">'+item.country_name+'</option>';
							}
							else{
								country_drp += '<option value="'+item.country_id+'">'+item.country_name+'</option>';
							}

							
						});
						$('#country_id').append(country_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(textStatus);
					}
				});
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
	
	var location_id = 0;
	var country_id = 0;
	var location_name = "";
	var location_desc = "";
	var is_active_location = 0;
	
	location_id =  $('#location_id').val();
	country_id =  $('#country_id').val();
	location_name = $('#location_name').val();
	location_desc = $('#location_desc').val();
	is_active_location = $("#is_active_location").is(':checked')? 1 : 0;
		
	if(typeof location_id !== 'undefined' && location_id !== '' && typeof location_name !== 'undefined' && 
	location_name !== '' && typeof location_desc !== 'undefined' && location_desc !== '' && typeof country_id !== 'undefined' && country_id !== '')
	{
		var formData = new FormData();
		formData.append('location_id',location_id);
        formData.append('location_name',location_name);
		formData.append('location_desc',location_desc);
		formData.append('country_id',country_id);
		formData.append('is_active_location',is_active_location);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"location/update/",
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
						window.location = "<?php echo base_url() ?>location/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Location is being used by other modules at the moment!"){
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