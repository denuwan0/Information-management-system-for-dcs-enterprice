<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Item Category Details</h3>
			</div>

			<form>
				<div class="card-body ">
					<div class="form-row">
						<div class="col-md-6 mb-3">
							<label for="name">Category Name</label>
							<input type="text" class="form-control" id="category_name" name="category_name" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>	
						<div class="col-md-6 mb-3">
							<label for="name">Category Description</label>
							<input type="text" class="form-control" id="description" name="description" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_inv_item_cat" name="is_active_inv_item_cat" value="1">
								<label for="is_active_inv_item_cat" class="custom-control-label">is active</label>
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



$('#submit').click(function(e){
	e.preventDefault();
		
	var item_category_id = 0;
	var category_name = "";
	var description = "";
	var is_active_inv_item_cat = 0;
		
	category_name = $('#category_name').val();
	description = $('#description').val();
	is_active_inv_item_cat = $("#is_active_inv_item_cat").is(':checked')? 1 : 0;
	
	
		
	if(typeof category_name !== 'undefined' && category_name !== '' && typeof description !== 'undefined' && description !== '')
	{
		
		var formData = new FormData();
        formData.append('category_name',category_name);
		formData.append('description',description);
		formData.append('is_active_inv_item_cat',is_active_inv_item_cat);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"itemCategory/insert/",
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
						window.location = "<?php echo base_url() ?>itemCategory/view";
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