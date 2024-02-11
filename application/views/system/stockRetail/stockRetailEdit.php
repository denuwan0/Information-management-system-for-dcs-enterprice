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
									  <th style="width: 30%">Sub Item Name</th>
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
				'<input type="text" class="form-control" id="item_id" name="item_id" value="'+data[0].item_id+'" disabled>'+
			  '</td>'+
			   '<td>'+
				'<input type="text" class="form-control" id="item_id" name="item_id" value="'+data[0].item_id+'" disabled>'+
			  '</td>'+
			   '<td>'+
				'<input type="text" class="form-control" id="item_id" name="item_id" value="'+data[0].item_id+'" disabled>'+
			  '</td>'+
			   '<td>'+
				'<input type="text" class="form-control" id="item_id" name="item_id" value="'+data[0].item_id+'" disabled>'+
			  '</td>'+
				 '<td>'+
				'<input type="text" class="form-control" id="item_id" name="item_id" value="'+data[0].item_id+'" disabled>'+
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
	
	
	var stock_batch_id = 0;
	var stock_purchase_date = "";
	var stock_purchase_time = 0;
	var created_by = 0;
	var branch_id = 0;
	var approved_by = 0;
	var is_approved_inv_stock_retail = 0;
	var is_active_inv_stock_retail = 0;
	var retail_stock_header_id = 0;
	var is_sub_item = 0;
	var retail_stock_detail_id = 0;
	
			
	/* if(typeof stock_purchase_date !== 'undefined' && stock_purchase_date !== ''
	&& typeof item_cost !== 'undefined' && item_cost !== ''
	&& typeof no_of_items !== 'undefined' && no_of_items !== '')
	{ */
					
		stock_purchase_date = $('#stock_purchase_date').val();
		retail_stock_header_id = $('#retail_stock_header_id').val();
		stock_batch_id = $('#stock_batch_id').val();
		is_approved_inv_stock_retail = $("#is_approved_inv_stock_retail").is(':checked')? 1 : 0;
		is_active_inv_stock_retail = $("#is_active_inv_stock_retail").is(':checked')? 1 : 0;
		
		var itemsArr = [];
		var stockHeader = [];
		
		$('.itemRow').each(function(){
			
			retail_stock_detail_id = $(this).find('#retail_stock_detail_id').val();
			item_id = $(this).find('.item_id').val();
			max_sale_price = $(this).find('#max_sale_price').val();
			min_sale_price = $(this).find('#min_sale_price').val();
			full_stock_count = $(this).find('#full_stock_count').val();
			stock_re_order_level = $(this).find('#stock_re_order_level').val();
			is_sub_item = $(this).find('#is_sub_item').val();
			
			//console.log(retail_stock_detail_id);
			
			if(item_id != ''){
				itemsArr.push({
					retail_stock_detail_id: retail_stock_detail_id,
					item_id: item_id,
					max_sale_price: max_sale_price,
					min_sale_price: min_sale_price,
					full_stock_count: full_stock_count,
					stock_re_order_level: stock_re_order_level,
					is_sub_item: is_sub_item
				})
			}
			
			
		})
		
		
		//console.log(itemsArr);
		
		stockHeader.push(
			{
				'retail_stock_header_id':retail_stock_header_id,
				'stock_batch_id':stock_batch_id,
				'stock_purchase_date':stock_purchase_date,
				'is_approved_inv_stock_retail':is_approved_inv_stock_retail,
				'is_active_inv_stock_retail':is_active_inv_stock_retail
			}
		);
		
				
		//console.log(itemsArr);
		
		
		var formData = new Object();
		formData = {
			stockHeader:stockHeader,
			itemsArr:itemsArr
		};
		
		console.log(formData);
				
		/* $.ajax({
			type: "POST",
			cache : false,
			async: true,
			contentType: 'application/json',
			dataType: "json",
			processData: false,
			data: JSON.stringify(formData),	
			url: API+"stockRetail/update/",
			success: function(data, result){
				console.log(data.message);	
				const notyf = new Notyf();
				if(data['message'] == 'Data Updated!'){
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
						window.location = "<?php echo base_url() ?>stockRetail/view";
					}, 3000);
				}
				if(data['message'] == "Cannont approve inactive document!"){
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
		}); */
		
	//}
	/* else{
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
	} */
	
	
})



</script>