<div class="modal fade" id="modalInfo"  aria-hidden="true" style="">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalInfoHeader"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body" id="modalInfoBody" >	
				
			</div>
			<div class="modal-footer justify-content-right" id="modalFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="qrModal"  aria-hidden="true" style="">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalInfoHeader" style="font-size: inherit;">Scan with any LankaQR certified app</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body" id="modalInfoBody" >	
				<img src="<?php echo base_url()?>assets/system/backend/dist/img/lankaQR.jpg" class="card-img-top" style="display: block; margin-left: auto; margin-right: auto;" alt="Centered Image">
			</div>
			<div class="modal-footer justify-content-right" id="modalFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">        
		<div class="row" id="categoryDiv">
		  
		</div>

        <!-- Main row -->
        <div class="row" >
          <!-- Left col -->
          <div class="col-md-7">
            <!-- MAP & BOX PANE -->
            <div class="card" style="height:350px">
              <div class="card-header">
                <h3 class="card-title" id="prdHeader">Products</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="max-height: 350px; overflow-y: auto;">
				<div class="row" id="productDiv">
					
				</div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-5" >
            <!-- PRODUCT LIST -->
            <div class="card" style="height:350px;">
              <div class="card-header">
                <h3 class="card-title">Checkout</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
			  <table class="table">
			  <thead>
				<tr>
					<th scope="col" width="10%">#</th>
					<th scope="col" width="40%" style="text-align:left">Name</th>
					<th scope="col" width="10%" style="text-align:left">Qty</th>
					<th scope="col" width="30%" style="text-align:center">Price</th>						
					<th scope="col" width="10%" style="text-align:left"></th>
				</tr>
			  </thead>
			  </table>
			  <div style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
			  <table class="table">				  
				  <tbody id="checkoutDiv">
					
					
				  </tbody>
				</table>
              </div>
			  </div>
              <!-- /.card-body -->
              <div class="bg-info">
				<div class="row">
					<table class="table">
					  <tbody>
						<tr style="border-style : hidden!important;">
							<td scope="col" width="10%"></th>
							<th scope="col" width="40%">Total</th>
							<th scope="col" width="10%"></th>
							<th scope="col" width="30%" style="text-align:center" class="total">0.00</th>						
							<th scope="col" width="10%"></th>
						</tr>
					  </tbody>
					</table>
				</div>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
		<div class="row" style="justify-content: right;">
			<div class="col-md-4 col-sm-4 col-12">
				<div class="info-box bg-gradient-danger" style="cursor: pointer;" id="cancelBtn">
					<span class="info-box-icon"><i class="fa fa-trash"></i></span>
					<div class="info-box-content">
					<span class="info-box-text">Cancel</span>
					</div>
				</div>
			</div>	
			<div class="col-md-4 col-sm-4 col-12">
				<div class="info-box bg-gradient-success" style="cursor: pointer;" id="payBtn">
					<span class="info-box-icon"><i class="fa fa-check-circle"></i></span>
					<div class="info-box-content">
					<span class="info-box-text">Pay</span>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-12">
				<div class="info-box bg-gradient-warning" style="cursor: pointer;" id="payBtn">
					<span class="info-box-icon"><i class="fa fa-check-circle"></i></span>
					<div class="info-box-content">
					<span class="info-box-text">Complete</span>
					</div>
				</div>
			</div>
		</div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>

 
  <script>
  
function loadData() {
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"ItemCategory/fetch_all_active",
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {

				var catHtml = '';
			
				var color = ["bg-gradient-info",
				"bg-gradient-danger",
				"bg-gradient-success",
				"bg-gradient-warning",
				"bg-gradient-primary",
				"bg-gradient-light",
				"bg-gradient-dark",
				"bg-gradient-secondary"]
				$.each(data, function (i, item) {
					
					catHtml = '<div class="col-12 col-sm-6 col-md-3" style="max-width:12%; cursor: pointer;">'+		
								'<div class="info-box '+color[i]+' catDiv" value="'+item.item_category_id+'" style="min-width:100%;">'+
								  '<div class="info-box-content">'+
									'<span class="info-box-text text-wrap"><h6>'+item.category_name+'</h6></span>'+
								  '</div>'+
								'</div>'+
							  '</div>';
					
					
					$('#categoryDiv').append(catHtml);		
				});
				
				
							
			});
			

		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			console.log(textStatus);					
		}
	});
};

loadData();
  
  
$(document).on('click', '.catDiv', function(){
 //$('#modalInfo').modal('show');
	//console.log($(this).attr('value'));
	var catId = 0;
	catId = $(this).attr('value');
	
	console.log();
	$('#prdHeader').text($(this)[0].innerText+' Products');
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"Item/fetch_all_main_sub_item_by_category_id/?id="+catId,
		success: function(data, result){
			console.log(data);
			
			
			
			$(function () {

				var prdHtml = '';
			
				$.each(data, function (i, item) {
												  
					prdHtml += '<div class="col-md-3">'+
									'<div class="card bg-gradient-white" style="cursor: pointer;">'+
										'<div class="card-header">'+
											'<font class="">'+item.item_name+'</font>'+
											'<div class="card-tools">'+
												'<button type="button" class="btn btn-tool" data-card-widget="collapse">'+
													'<i class="fas fa-minus"></i>'+
												'</button>'+
											'</div>'+
										'</div>'+
										'<div class="card-body">'+
											'<img src="'+item.image_url+'" class="rounded float-left" alt="..." style="width:100px; height:100px">'+
										'</div>'+
										'<div class="card-footer">'+
											'<button type="button" item_id="'+item.item_id+'" is_sub_item="'+item.is_sub_item+'" class="btn btn-block btn-outline-dark btn-sm addItem">Add</button>'+
										'</div>'+
									'</div>'+
								'</div>';
					
					
						
				});
				
				$('#productDiv').html(prdHtml);	
							
			});
				
		}
	});
})

$(document).on('click', '.addItem', function(){

	var item_id = $(this).attr('item_id');
	var is_sub_item = $(this).attr('is_sub_item');
	
	var formData = new FormData();
	formData.append('item_id',item_id);
	formData.append('is_sub_item',is_sub_item);
	
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		processData: false,
		contentType: false,
		data: formData,
		url: API+"StockRetail/get_retail_item_details_by_item_id_branch_id_is_sub_item/",
		success: function(data, result){
			
			var prdHtml = '';
			console.log(data);
			
			if(data.message == "Product not Available at the moment!"){	
				const notyf = new Notyf();
			
				notyf.error({
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
				
			}
			else{
				$.each(data, function (i, item) {			
					var duplicate = 0;
					duplicate = $('.row'+item.item_id+''+item.is_sub_item+'').length;
					
					console.log(item.max_sale_price);
					var sale_price = 0;
					if(item.max_sale_price == "0.00"){
						 sale_price = item.min_sale_price;
					}
					else{
						sale_price = item.max_sale_price;
					}
					
					if(duplicate == 0){
						prdHtml += '<tr class="detailRow row'+item.item_id+''+item.is_sub_item+'">'+
							  '<th scope="row" class="count">'+numbering()+'</th>'+
							  '<th scope="row">'+item.item_name+'</th>'+
							  '<td width="10%">'+
								'<div class="btn-group">'+
									'<a class="btn"><i class="fa fa-minus-circle minBtn" style="color:red"></i></a>'+
									'<a class="btn qty" id="" value="">1</a>'+
									'<a class="btn"><i class="fas fa-plus-circle plusBtn" style="color:green"></i></a>'+
								'</div>'+
								'</td>'+
								'<td width="10%" style="display:none" align="right" class="item_id">'+item.item_id+'</td>	'+	
								'<td width="10%" style="display:none" align="right" class="unit_price">'+sale_price+'</td>	'+	
							  '<td width="10%" align="right" class="price">'+sale_price+'</td>	'+				  
							  '<td width="10%"><a class="btn deleteBtn"><i class="fa fa-trash"></i></a></td>'+
							'</tr>';
							$('#checkoutDiv').append(prdHtml);	
							
							var tot = parseFloat($('.total').text()).toFixed(2);
							tot = parseFloat(tot)+parseFloat(sale_price);
							$('.total').text('');
							$('.total').text(tot);
							
							const notyf = new Notyf();
				
							notyf.success({
							  message: 'Product added!',
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
					else if(duplicate>0){
						const notyf = new Notyf();
				
						notyf.error({
						  message: 'Item already in the list',
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
		
			
			
			
				
		}
	});
	
	
});

function numbering(){
	var count = $('.count').length + 1;
	return count;
}

$(document).on('click', '.minBtn', function(){
		
	var qty = parseInt($(this).parent().parent().find('.qty').text());
	var line_tot = parseFloat($(this).parent().parent().parent().parent().find('.price').text());
	var unit_price = parseFloat($(this).parent().parent().parent().parent().find('.unit_price').text());
	var tot = parseFloat($('.total').text());
	
	if(qty > 1){
		qty = qty - 1;
		line_tot = line_tot - unit_price;
		tot = tot - unit_price;
		
		console.log(tot.toFixed(2));
		console.log(line_tot.toFixed(2));
		
		$(this).parent().parent().find('.qty').text(qty);
		$(this).parent().parent().parent().parent().find('.price').text((line_tot.toFixed(2)));
		$('.total').text((tot.toFixed(2)));
	}
	else{
		const notyf = new Notyf();
				
		notyf.error({
		  message: 'Cannot reduce below 1',
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

$(document).on('click', '.plusBtn', function(){
	
	var qty = parseInt($(this).parent().parent().find('.qty').text());
	var line_tot = parseFloat($(this).parent().parent().parent().parent().find('.price').text());
	var unit_price = parseFloat($(this).parent().parent().parent().parent().find('.unit_price').text());
	var tot = parseFloat($('.total').text());
	
	qty = qty + 1;
	line_tot = line_tot + unit_price;
	tot = tot + unit_price;
	
	console.log(tot.toFixed(2));
	console.log(line_tot.toFixed(2));
	
	$(this).parent().parent().find('.qty').text(qty);
	$(this).parent().parent().parent().parent().find('.price').text((line_tot.toFixed(2)));
	$('.total').text((tot.toFixed(2)));
	
});

$(document).on('click', '.deleteBtn', function(){
	
	
	$(this).parent().parent().remove();
	console.log($(this).find('.count').last());
	
	$('.detailRow').each( function(i){		
		$(this).find('.count').text((i+1));
	})
	
	
});

$(document).on('click', '#cancelBtn', function(){
	$('#modalInfoBody').html('');
	$('#modalInfoHeader').html('');
	$('#modalInfoHeader').html('Order Cancelation Confirm');
	$('#modalInfoBody').html('This Order will be no loger accessible, Are you sure?');
	$('#modalFooter').html('<button type="button" class="btn btn-danger" data-dismiss="modal" id="confirmYes">Yes</button><button type="button" class="btn btn-warning" data-dismiss="modal">No</button>');
	//$('#modalInfo').show();
	$('#modalInfo').modal('show');
	
	
});

$(document).on('click', '#payBtn', function(){
	$('#modalInfoBody').html('');
	$('#modalInfoHeader').html('');
	$('#modalInfoHeader').html('Select Payment Option');
	$('#modalInfoBody').html('<div class="row">'+
					'<div class="col-md-4">'+
						'<div class="info-box bg-gradient-danger" style="cursor: pointer;" id="cashBtn">'+
							'<span class="info-box-icon"><i class="fas fa-money-bill-alt"></i></span>'+
							'<div class="info-box-content">'+
							'<span class="info-box-text" style="font-size: x-large;">Cash</span>'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="col-md-4">'+
						'<div class="info-box bg-gradient-danger" style="cursor: pointer;" id="qrBtn">'+
							'<span class="info-box-icon"><i class="fas fa-qrcode"></i></span>'+
							'<div class="info-box-content">'+
							'<span class="info-box-text" style="font-size: x-large;">Lanka QR</span>'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="col-md-4">'+
						'<div class="info-box bg-gradient-danger" style="cursor: pointer;" id="bankCardBtn">'+
							'<span class="info-box-icon"><i class="far fa-credit-card"></i></span>'+
							'<div class="info-box-content">'+
							'<span class="info-box-text" style="font-size: large;">Bank Transfer</span>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>');
		$('#modalFooter').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
	//$('#modalInfo').show();
	$('#modalInfo').modal('show');
	
	
});

$(document).on('click', '#qrBtn', function(){
	$('#modalInfo').modal('hide');;
	$('#qrModal').modal('show');
})

$(document).on('click', '#confirmYes', function(){
	location.reload(true);
})

  </script>