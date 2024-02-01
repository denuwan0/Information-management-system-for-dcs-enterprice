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
				<button class="btn btn-primary" type="button" id="submit">Submit</button>
			</div>
			<div id="" class="" >
				
			</div>
		</div>
	</div>
</section>
<script>


$('#submit').click(function(e){
	e.preventDefault();
		
	var country_name = "";
	var country_desc = "";
	var is_active_country = 0;
	
	country_name = $('#country_name').val();
	country_desc = $('#country_desc').val();
	is_active_country = $("#is_active_country").is(':checked')? 1 : 0;
	
	//console.log(is_active);
	
		
	if(typeof country_name !== 'undefined' && country_name !== '' && typeof country_desc !== 'undefined' && country_desc !== '')
	{
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			data: {
				country_name: country_name,
				country_desc: country_desc,
				is_active_country: is_active_country
				},			
			url: API+"/country/insert/",
			success: function(data, result){
				console.log(data);	
				const notyf = new Notyf();
				if(data['success']){
					notyf.success({
					  message: 'Data Saved!',
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
				window.setTimeout(function() {
					window.location = "<?php echo base_url() ?>country/view";
				}, 3000);
				
				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {						
				const notyf = new Notyf();
			
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