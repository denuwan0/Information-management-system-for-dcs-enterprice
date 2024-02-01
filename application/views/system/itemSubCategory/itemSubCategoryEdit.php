<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Bank Details</h3>
			</div>

			<form id="form">
				<div class="card-body ">
					<div class="form-row">
						<input type="hidden" class="form-control" id="item_sub_cat_id" name="item_sub_cat_id" value="">
						<div class="col-md-6 mb-3">
							<label for="name">Sub Category Name</label>
							<input type="text" class="form-control" id="sub_cat_name" name="sub_cat_name" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>	
						<div class="col-md-6 mb-3">
							<label for="location">Main Category</label>
							<select class="custom-select" id="item_category_id" name="item_category_id" required>
							</select>
							<div id="locationError" class="invalid-feedback">
								Please select a valid state.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="name">Description</label>
							<input type="text" class="form-control" id="sub_cat_description" name="sub_cat_description" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>	
						<div class="col-md-6 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_inv_item_sub_cat" name="is_active_inv_item_sub_cat" value="1">
								<label for="is_active_inv_item_sub_cat" class="custom-control-label">is active</label>
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
		url: API+"ItemSubCategory/fetch_single_join/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#item_sub_cat_id').val(data[0].item_sub_cat_id);
			$('#item_category_id').val(data[0].item_category_id);	
			$('#sub_cat_name').val(data[0].sub_cat_name);
			$('#sub_cat_description').val(data[0].sub_cat_description);
			
			loadCategory();
			
			function loadCategory() {
				
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"ItemCategory/fetch_all_active/",
					success: function(data1, result){
						//console.log(data1);
						
						var item_category_drp = '';
						$.each(data1, function(index, item) {
							
							if(data[0].item_category_id == item.item_category_id){
								item_category_drp += '<option selected value="'+item.item_category_id+'">'+item.category_name+'</option>';
							}
							else{
								item_category_drp += '<option value="'+item.item_category_id+'">'+item.category_name+'</option>';
							}

							
						});
						$('#item_category_id').append(item_category_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(textStatus);
					}
				});
			}
						
			if(data[0].is_active_inv_item_sub_cat == 1){
				$('#is_active_inv_item_sub_cat').prop('checked', true);
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
	
	var item_sub_cat_id = 0;
	var item_category_id = 0;
	var sub_cat_name = "";
	var sub_cat_description = "";
	var is_active_inv_item_sub_cat = 0;
	
	
	item_sub_cat_id =  $('#item_sub_cat_id').val();
	item_category_id = $('#item_category_id').val();
	sub_cat_name =  $('#sub_cat_name').val();
	sub_cat_description = $('#sub_cat_description').val();
	is_active_inv_item_sub_cat = $("#is_active_inv_item_sub_cat").is(':checked')? 1 : 0;
		
	if(typeof item_sub_cat_id !== 'undefined' && item_sub_cat_id !== '' && typeof item_category_id !== 'undefined' && item_category_id !== ''
	&& typeof sub_cat_name !== 'undefined' && sub_cat_name !== '' && typeof sub_cat_description !== 'undefined' && sub_cat_description !== '')
	{
		var formData = new FormData();
		formData.append('item_sub_cat_id',item_sub_cat_id);
        formData.append('item_category_id',item_category_id);
		formData.append('sub_cat_name',sub_cat_name);
        formData.append('sub_cat_description',sub_cat_description);
		formData.append('is_active_inv_item_sub_cat',is_active_inv_item_sub_cat);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"ItemSubCategory/update/",
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
						window.location = "<?php echo base_url() ?>ItemSubCategory/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Item Sub Category is being used by other modules at the moment!"){
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