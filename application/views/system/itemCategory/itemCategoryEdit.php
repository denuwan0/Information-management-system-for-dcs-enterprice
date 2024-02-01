<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Item Category Details</h3>
			</div>

			<form id="form">
				<div class="card-body ">
					<div class="form-row">
						<input type="hidden" class="form-control" id="item_category_id" name="item_category_id" value="">
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

$('#form')[0].reset(); 

function loadData() {
	var pageUrl = $(location).attr('href');
	parts = pageUrl.split("/"),
	last_part = parts[parts.length-1];
	//console.log(last_part);
	
	
	
		
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"itemCategory/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			//console.log(data);			
			//console.log(data[0].country_id);
			
			$('#item_category_id').val(data[0].item_category_id);
			$('#category_name').val(data[0].category_name);	
			$('#description').val(data[0].description);	
			
						
			if(data[0].is_active_inv_item_cat == 1){
				$('#is_active_inv_item_cat').prop('checked', true);
			}
			
			
				
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			//console.log(errorThrown);					
		}
	});
};

//var country_id = 0;
$(document).ready(function() {
	loadData();
});



$('#submit').click(function(e){
	e.preventDefault();
	
	var item_category_id = 0;
	var category_name = "";
	var description = "";
	var is_active_inv_item_cat = 0;
	
	
	item_category_id =  $('#item_category_id').val();
	category_name = $('#category_name').val();
	description = $('#description').val();
	is_active_inv_item_cat = $("#is_active_inv_item_cat").is(':checked')? 1 : 0;
		
	if(typeof item_category_id !== 'undefined' && item_category_id !== '' && typeof category_name !== 'undefined' && category_name !== '' 
	&& typeof description !== 'undefined' && description !== '')
	{
		var formData = new FormData();
		formData.append('item_category_id',item_category_id);
        formData.append('category_name',category_name);
		formData.append('description',description);
		formData.append('is_active_inv_item_cat',is_active_inv_item_cat);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"itemCategory/update/",
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
						window.location = "<?php echo base_url() ?>itemCategory/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Item Category is being used by other modules at the moment!"){
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