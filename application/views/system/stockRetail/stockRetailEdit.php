<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Retail Stock Item Details</h3>
			</div>

			<form>
				<div class="card-body itemBody">
					<div class="row">
						<div class="col-lg-12 row">
							<input class="form-control" id="retail_stock_header_id" name="retail_stock_header_id" type="hidden"/>
							
							<?php 
								
								if($this->session->userdata('sys_user_group_name') == 'Admin'){
									echo '<div class="col-md-2 mb-3">
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" id="is_active_retail_stock" name="is_active_retail_stock" value="1">
											<label for="is_active_retail_stock" class="custom-control-label">is active</label>
										</div>
									</div>';
								}
								
							?>
						</div>
						<div class="col-lg-12 row">
							<div class="col-sm-12 mb-3">
								<table class="table table-bordered">
								  <thead>
									<tr>
									  <th style="width: 5%">#</th>
									  <th style="width: 30%">Item Name</th>
									  <th style="width: 15%">Max Price</th>
									  <th style="width: 15%">Min Price</th>											  
									  <th style="width: 15%">No.of Items</th>
									  <th style="width: 15%">Re-order level</th>
									</tr>
								  </thead>
								  <tbody id="Body">
																			
								  </tbody>
								</table>
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
		url: API+"StockRetail/fetch_all_total_stock_join_by_id/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);
			
									
			if(data[0].is_active_retail_stock == 1){
				$('#is_active_retail_stock').prop('checked', true);
			}
				
					

			mainItemRowHtml = '<tr class="mainItemSet itemRow">'+
			  '<td class="mainRowId">'+data[0].retail_stock_id+'</td>'+
			  '<td>'+
				'<input type="hidden" class="form-control" id="retail_stock_id" name="retail_stock_id" value="'+data[0].retail_stock_id+'" disabled>'+
				'<input type="hidden" class="form-control" id="item_id" name="item_id" value="'+data[0].item_id+'" disabled>'+
				'<input type="text" class="form-control" id="item_name" name="item_name" value="'+data[0].item_name+'" disabled>'+
			  '</td>'+
			   '<td>'+
				'<input type="number" class="form-control" id="max_sale_price" name="max_sale_price" value="'+data[0].max_sale_price+'" >'+
			  '</td>'+
			   '<td>'+
				'<input type="number" class="form-control" id="min_sale_price" name="min_sale_price" value="'+data[0].min_sale_price+'" >'+
			  '</td>'+
			   '<td>'+
				'<input type="text" class="form-control" id="full_stock_count" name="full_stock_count" value="'+data[0].full_stock_count+'" disabled>'+
			  '</td>'+
				 '<td>'+
				'<input type="number" class="form-control" id="stock_re_order_level" name="stock_re_order_level" value="'+data[0].stock_re_order_level+'" >'+
			  '</td>'+
			'</tr>';
			
			$('#Body').html(mainItemRowHtml);
				
							
		
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			//console.log(errorThrown);					
		}
	});
};



	
$(':input[type="number"]').keydown(function (e) { 
	//console.log(e.keyCode);
	if (e.keyCode == 189 || e.keyCode == 40 || e.keyCode == 38) { //it does't allow user to enter minus(-) symbol
		
		const notyf = new Notyf();
		
		notyf.error({
		  message: 'Operation Not allowed!',
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



loadData();
});

$(document).on("click", "#submit", function (e) {
	e.preventDefault();
	
	
	var retail_stock_id = 0;
	var item_id = 0;
	var max_sale_price = 0;
	var min_sale_price = 0;
	var stock_re_order_level = 0;
	var is_active_retail_stock = 0;
						
	retail_stock_id = $('#retail_stock_id').val();
	item_id = $('#item_id').val();
	max_sale_price = $('#max_sale_price').val();
	min_sale_price = $('#min_sale_price').val();
	stock_re_order_level = $('#stock_re_order_level').val();
	is_active_retail_stock = $("#is_active_retail_stock").is(':checked')? 1 : 0;
	
	
	if(typeof retail_stock_id !== 'undefined' && retail_stock_id !== '' && typeof item_id !== 'undefined' && item_id !== ''
	&& typeof max_sale_price !== 'undefined' && max_sale_price !== '' && typeof min_sale_price !== 'undefined' && min_sale_price !== ''
	&& typeof stock_re_order_level !== 'undefined' && stock_re_order_level !== '')
	{
		var formData = new FormData();
		formData.append('retail_stock_id',retail_stock_id);
		formData.append('item_id',item_id);
		formData.append('max_sale_price',max_sale_price);
		formData.append('min_sale_price',min_sale_price);
		formData.append('stock_re_order_level',stock_re_order_level);
		formData.append('is_active_retail_stock',is_active_retail_stock);
		
		console.log(formData);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,			
			url: API+"stockRetail/update_item_details/",
			success: function(data, result){
				console.log(data.message);	
				const notyf = new Notyf();
				if(data.message == 'Changes Updated!'){
					notyf.success({
					  message: data.message,
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
						window.location = "<?php echo base_url() ?>stockRetail/view";
					}, 3000);
				}
				if(data['message'] == "Retail Stock is being used by other modules at the moment!"){
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