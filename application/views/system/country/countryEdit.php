<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Country Details</h3>
				<div style="text-align: right;">
				</div>
			</div>
			<div class="card-body">
				<form>
					<div class="form-row">
						<input type="hidden" class="form-control typeahead" id="country_id" placeholder="Enter Country Name" required>
						<div class="col-md-6 mb-3">
							<label for="name">Name</label>
							<input type="text" class="form-control typeahead" id="country_name" placeholder="Enter Country Name" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="description">Description</label>
							<input type="text" class="form-control" id="country_desc" placeholder="Enter Description" required>
							<div id="descriptionError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_country" name="is_active_country" value="1">
								<label for="is_active_country" class="custom-control-label">is active</label>
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
		url: API+"/country/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
						
			//console.log(data[0].country_id);
			
			$('#country_id').val(data[0].country_id);
			$('#country_name').val(data[0].country_name);
			$('#country_desc').val(data[0].country_desc);
			if(data[0].is_active_country == 1){
				$('#is_active_country').prop('checked', true);
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
			console.log(errorThrown);					
		}
	});
};

$(document).ready(function() {
	loadData();
});

$('#submit').click(function(e){
	e.preventDefault();
	
	var country_id = 0;	
	var country_name = "";
	var country_desc = "";
	var is_active_country = 0;
	
	country_id =  $('#country_id').val();;	
	country_name = $('#country_name').val();
	country_desc = $('#country_desc').val();
	is_active_country = $("#is_active_country").is(':checked')? 1 : 0;
		
	if(typeof country_id !== 'undefined' && country_id !== '' && typeof country_name !== 'undefined' && 
	country_name !== '' && typeof country_desc !== 'undefined' && country_desc !== '')
	{
		var formData = new FormData();
		 formData.append('country_id',country_id);
        formData.append('country_name',country_name);
		formData.append('country_desc',country_desc);
		formData.append('is_active_country',is_active_country);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"country/update/",
			success: function(data, result){
				console.log(data.message);	
				const notyf = new Notyf();
				
				if(data.message == "Changes Updated!"){
					notyf.success({
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
						window.location = "<?php echo base_url() ?>country/view";
					}, 3000);
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Country is being used by other modules at the moment!"){
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
				console.log(textStatus);
				notyf.error({
				  message: 'Error!',
				  duration: 3000,
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
		  duration: 3000,
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