<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Item Details</h3>
			</div>

			<form id="form">
				<div class="card-body ">
					<div class="form-row">
						<div class="col-md-6 mb-3">
						<input type="hidden" class="form-control" id="item_id" name="item_id" value="">
							<label for="name">Name</label>
							<input type="text" class="form-control" id="item_name" name="item_name" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="location">Category</label>
							<select class="custom-select" id="item_category" name="item_category" required>
							</select>
							<div id="locationError" class="invalid-feedback">
								Please select a valid state.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="item_image_url">Item Image</label>
							<div class="input-group">							
								<div class="custom-file">
									<input type="file" class="custom-file-input" name="item_image_url" id="item_image_url" onchange="document.getElementById('imagePreview').src = window.URL.createObjectURL(this.files[0]);">
									<label class="custom-file-label" for="item_image_url">Choose file</label>
								</div>
							</div>
							<h4><!-- Selected file will get here --></h4>
						</div>
					</div>
					<div class="form">
						<div class="col-md-6 mb-3">
							<img id="imagePreview" alt="your image" width="200" height="200" src=""/>
						</div>
						<div class="col-md-6 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_inv_item" name="is_active_inv_item" value="1">
								<label for="is_active_inv_item" class="custom-control-label">is active</label>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_feature" name="is_feature" value="1">
								<label for="is_feature" class="custom-control-label">is feature</label>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_web_pattern" name="is_web_pattern" value="1" >
								<label for="is_web_pattern" class="custom-control-label">is web pattern</label>
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
var old_image ="";
var item_image = "";

//var country_id = 0;
function loadData() {
	
		
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"item/fetch_single_join/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			//console.log(data);			
			//console.log(data[0].country_id);
			
			$('#item_id').val(data[0].item_id);
			$('#item_name').val(data[0].item_name);		
			$('#item_image_url').attr("src",data[0].item_image_url);
			$("#imagePreview").attr("src",data[0].item_image_url);
			old_image = data[0].item_image_url;
						
			if(data[0].is_active_inv_item == 1){
				$('#is_active_inv_item').prop('checked', true);
			}
			
			if(data[0].is_feature == 1){
				$('#is_feature').prop('checked', true);
			}
			
			if(data[0].is_web_pattern == 1){
				$('#is_web_pattern').prop('checked', true);
			}
			
			loadCtegory();
			
			function loadCtegory(){
				$.ajax({
					type: "GET",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"ItemCategory/",
					success: function(data1, result){
						var category_drp = '<option value="">Select Category</option>';
						
						$.each(data1, function(index, item) {
							
							if(data[0].item_category_id == item.item_category_id){
								category_drp += '<option selected value="'+item.item_category_id+'">'+item.category_name+'</option>';
							}
							else{
								category_drp += '<option value="'+item.item_category_id+'">'+item.category_name+'</option>';
							}

							
						});
						$('#item_category').append(category_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(errorThrown);
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

function set_logo_image(){
	
	company_logo = $('#company_logo').prop('files')[0];	
	console.log(company_logo);
}

$('#submit').click(function(e){
	e.preventDefault();
	
	var item_id = 0;
	var item_name = "";
	var item_category = 0;
	var item_image_url = "";
	var is_active_inv_item = 0;
	var is_feature = 0;
	var is_web_pattern = 0;
	
	
	item_id =  $('#item_id').val();
	item_name = $('#item_name').val();
	item_category = $('#item_category').val();
	item_image_url = $('#item_image_url').prop('files')[0];
	is_active_inv_item = $("#is_active_inv_item").is(':checked')? 1 : 0;
	is_feature = $("#is_feature").is(':checked')? 1 : 0;
	is_web_pattern = $("#is_web_pattern").is(':checked')? 1 : 0;
		
	if(typeof item_id !== 'undefined' && item_id !== '' && typeof item_name !== 'undefined' && item_name !== ''
	&& typeof item_category !== 'undefined' && item_category !== '')
	{
		var formData = new FormData();
		formData.append('item_id',item_id);
        formData.append('item_name',item_name);
		formData.append('item_category',item_category);
		formData.append('item_image_url',item_image_url);
		formData.append('old_image',old_image);
		formData.append('is_active_inv_item',is_active_inv_item);
		formData.append('is_feature',is_feature);
		formData.append('is_web_pattern',is_web_pattern);
		
		
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"item/update/",
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
						window.location = "<?php echo base_url() ?>item/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Item is being used by other modules at the moment!"){
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