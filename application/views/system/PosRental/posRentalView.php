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
<div class="modal fade" id="bankAccModal"  aria-hidden="true" style="">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalBankHeader" style="font-size: inherit;">Bank Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body" id="modalBankBody" >	
				
			</div>
			<div class="modal-footer justify-content-right" id="modalFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="invoiceModal"  aria-hidden="true" style="">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalBankHeader" style="font-size: large;">Customer Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body" id="modalInvoiceBody" >	
				
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
				
		<div class="float-right" style="text-align: right;">
			<h4><span class="badge badge-danger" style="background-color: black">Rental POS</span></h4>  
			<h6>Order Status: <span class="badge badge-danger orderStatus">Not Saved</span></h6>   
			<h6>Payment Status: <span class="badge badge-danger paymentStatus">Not Paid</span></h6>   		
		</div>	

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
					<th scope="col" width="30%" style="text-align:left">Name</th>
					<th scope="col" width="10%" style="text-align:left">Qty</th>
					<!--th scope="col" width="30%" style="text-align:center">Price</th-->						
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
              <!--div class="bg-info">
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
				</div-->
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
				<div class="info-box bg-gradient-warning" style="cursor: pointer;" id="invoiceBtn">
					<span class="info-box-icon"><i class="fa fa-check-circle"></i></span>
					<div class="info-box-content">
					<span class="info-box-text">Invoice</span>
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
			
		</div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>

 
  <script>
	var customer_old_nic_no = '';
	var customer_name = '';
	var customer_contact_no = '';
	var customer_email = '';
	var deposite_amount = 0;
	var customer_working_address = '';
	var customer_shipping_address = '';
	var invoice_header_header_id ='';
	var customer_id = '';
	
	var is_order_saved = 0;
	var is_order_paid = 0;
  
  
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
					
					if(item.category_name != "Material" && item.category_name != "Services"){
						catHtml = '<div class="col-12 col-sm-6 col-md-3" style="max-width:12%; cursor: pointer;">'+		
								'<div class="info-box '+color[i]+' catDiv" value="'+item.item_category_id+'" style="min-width:100%;">'+
								  '<div class="info-box-content">'+
									'<span class="info-box-text text-wrap"><h6>'+item.category_name+'</h6></span>'+
								  '</div>'+
								'</div>'+
							  '</div>';
							  
						$('#categoryDiv').append(catHtml);		  
					}
					
					
					
					
						
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
		url: API+"Item/fetch_all_items_by_category_id/?id="+catId,
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
									'<img src="'+item.item_image_url+'" class="rounded float-left" alt="..." style="width:100px; height:100px">'+
								'</div>'+
								'<div class="card-footer">'+
									'<button type="button" item_id="'+item.item_id+'" is_sub_item="0" class="btn btn-block btn-outline-dark btn-sm addItem">Add</button>'+
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
		url: API+"StockRental/get_rental_item_details_by_item_id_branch_id_is_sub_item/",
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
					
					console.log(item.max_rent_price);
					var sale_price = 0;
					if(item.max_rent_price == "0.00"){
						 sale_price = item.min_rent_price;
					}
					else{
						sale_price = item.max_rent_price;
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
							  //'<td width="10%" align="right" class="price">'+sale_price+'</td>	'+				  
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
	//console.log($(this).find('.count').last());
	
	var tot = 0;
	
	$('.detailRow').each( function(i){		
		$(this).find('.count').text((i+1));
		//console.log($(this).find('.price').text());
		tot += parseFloat($(this).find('.price').text());
	})
	
	console.log(tot.toFixed(2));
	$('.total').text((tot.toFixed(2)));
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
	
	if(is_order_saved == 1){
		$('#modalInfoBody').html('');
		$('#modalInfoHeader').html('');
		$('#modalInfoHeader').html('Payment Option');
		$('#modalInfoBody').html('<div class="row col-md-12">'+
							
						'<form class="row col-md-12">'+
							'<div class="col-md-4 mb-3">'+
								'<div class="form-group">'+
								  '<label for="customer_old_nic_no">Customer</label>'+
								  '<input type="text" class="form-control" id="customer_old_nic_no" value="'+customer_name+'" readonly>'+
								  '<input type="hidden" class="form-control" id="customer_id" value="'+customer_id+'" readonly>'+
								'</div>'+							
							'</div>'+
							'<div class="col-md-4 mb-3">'+
								'<div class="form-group">'+
								  '<label for="invoice_header_header_id">Invoice Id</label>'+
								  '<input type="text" class="form-control" id="invoice_header_header_id" value="'+invoice_header_header_id+'" readonly>'+
								'</div>'+								
							'</div>'+
							'<div class="col-md-4 mb-3">'+
								'<div class="form-group">'+
								  '<label for="payment_reference">Payment Reference</label>'+
								  '<input type="text" class="form-control" id="payment_reference" value="" placeholder="Payment Reference">'+
								'</div>'+								
							'</div>'+
						'</form>'+	
						'</div>'+
						'<div class="row">'+
						'<div class="col-md-6">'+
							'<div class="info-box bg-gradient-danger payMethod" style="cursor: pointer;" value="cashBtn">'+
								'<span class="info-box-icon"><i class="fas fa-money-bill-alt"></i></span>'+
								'<div class="info-box-content">'+
								'<span class="info-box-text" style="font-size: large;">Paid by Cash</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="col-md-6">'+
							'<div class="info-box bg-gradient-danger payMethod" style="cursor: pointer;" value="qrBtn">'+
								'<span class="info-box-icon"><i class="fas fa-qrcode"></i></span>'+
								'<div class="info-box-content">'+
								'<span class="info-box-text" style="font-size: large;">Paid by Lanka QR</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="col-md-6">'+
							'<div class="info-box bg-gradient-danger payMethod" style="cursor: pointer;" value="bankTransferBtn">'+
								'<span class="info-box-icon"><i class="fas fa-landmark"></i></span>'+
								'<div class="info-box-content">'+
								'<span class="info-box-text" style="font-size: large;">Paid by Bank Transfer</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="col-md-6">'+
							'<div class="info-box bg-gradient-danger payMethod" style="cursor: pointer;" value="bankCardBtn">'+
								'<span class="info-box-icon"><i class="far fa-credit-card"></i></span>'+
								'<div class="info-box-content">'+
								'<span class="info-box-text" style="font-size: large;">Paid by Bank Card</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>');
			$('#modalFooter').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
		//$('#modalInfo').show();
		$('#modalInfo').modal('show');
	}
	else{
		const notyf = new Notyf();
				
		notyf.error({
		  message: 'Please Generate Invoice before Payment!',
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

$(document).on('click', '#invoiceBtn', function(){
	
	var rowCount = $('.detailRow').length;
	
	if(rowCount == 0){
		const notyf = new Notyf();
				
		notyf.error({
		  message: 'Please add items!',
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
		$('#modalInvoiceBody').html('');
		$('#modalInfoHeader').html('');
		$('#modalInfoHeader').html('Customer Details/ Print Invoice');
		$('#modalInvoiceBody').html('<div class="row col-md-12">'+
							
							'<form class="row col-md-12">'+
								'<div class="col-md-6">'+
									'<div class="form-group">'+
									  '<label for="customer_old_nic_no">NIC</label>'+
									  '<input type="text" class="form-control" id="customer_old_nic_no" placeholder="NIC search">'+
									'</div>'+
									'<div class="form-group">'+
									  '<label for="customer_name">Customer Name</label>'+
									  '<input type="text" class="form-control" id="customer_name" placeholder="Customer username">'+
									'</div>'+								
								'</div>'+
								'<div class="col-md-6">'+
									'<div class="form-group">'+
									  '<label for="customer_contact_no">Mobile</label>'+
									  '<input type="text" class="form-control" id="customer_contact_no" placeholder="Mobile No.">'+
									'</div>'+
									'<div class="form-group">'+
									  '<label for="customer_email">E-mail</label>'+
									  '<input type="text" class="form-control" id="customer_email" placeholder="Email">'+
									'</div>'+
								'</div>'+
								'<div class="col-md-6">'+
									'<div class="form-group">'+
									  '<label for="customer_working_address">Deposite Amount</label>'+
									  '<input type="text" class="form-control" id="deposite_amount" placeholder="Deposite Amount">'+
									'</div>'+
								'</div>'+
								'<div class="col-md-12">'+
									'<div class="form-group">'+
									  '<label for="customer_working_address">Billing Address</label>'+
									  '<input type="text" class="form-control" id="customer_working_address" placeholder="Billing Address">'+
									'</div>'+
									'<div class="form-group">'+
									  '<label for="customer_shipping_address">Shipping Address</label>'+
									  '<input type="text" class="form-control" id="customer_shipping_address" placeholder="Shipping Address">'+
									'</div>'+
								'</div>'+
							'</form>'+
						'</div>'+
						'<div class="row">'+
						'<div class="col-md-3">'+
						'</div>'+
						'<div class="col-md-6">'+
							'<div class="info-box bg-gradient-danger" style="cursor: pointer;" id="invoicePrintBtn">'+
								'<span class="info-box-icon"><i class="fas fa-file-download"></i></span>'+
								'<div class="info-box-content">'+
								'<span class="info-box-text" style="font-size:large;">Download Invoice</span>'+
								'</div>'+
							'</div>'+
							'<a style="display:none;" class="downloadPdf" id="downloadPdf" href="http://localhost/API/RentalInvoice/printInvoice/" target="_blank"></a>'+
						'</div>'+
						'<div class="col-md-3">'+
						'</div>'+
					'</div>');
			$('#modalFooter').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
		//$('#modalInfo').show();
		$('#invoiceModal').modal('show');
	}
	
	
	
	
});

$(document).on('click', '#qrBtn', function(){
	$('#modalInfo').modal('hide');;
	$('#qrModal').modal('show');
})

$(document).on('click', '#bankTransferBtn', function(){
	$('#modalInfo').modal('hide');
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"BankAcc/fetch_all_active_join",
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			//console.log(data);
			var bankHtml = '';
			bankHtml += '<table class="table table-bordered table-striped dataTable no-footer">'+
							  '<thead>'+
								'<tr>'+
								  '<td scope="col">Accout Name</td>'+
								  '<td scope="col">Accout No.</td>'+
								  '<td scope="col">Bank</td>'+
								  '<td scope="col">Branch</td>'+
								'</tr>'+
								'</thead>'+
								'<tbody>';
			$.each(data, function (i, item) {
				
				bankHtml += '<tr>'+
							  '<td>'+item.account_name+'</td>'+
							  '<td>'+item.account_no+'</td>'+
							  '<td>'+item.bank_name+'</td>'+
							  '<td>'+item.b_branch_address+'</td>'+
							'</tr>';
			})
								
			bankHtml += '</tbody>'+
							'</table>';
								
							  
			$('#modalBankBody').html(bankHtml);
			$('#bankAccModal').modal('show');
			

		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			console.log(textStatus);					
		}
	});
	
	
})

$(document).on('click', '#confirmYes', function(){
	location.reload(true);
})

$(document).on('keyup', '#customer_old_nic_no', function(){
	//console.log($(this).val());
	var nic = $(this).val();
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"Customer/fetch_single_by_nic/?nic="+nic,
		success: function(data, result){
			
			if (Object.keys(data).length > 0){
				const notyf = new Notyf();
			
				notyf.error({
				  message: 'Existing Customer',
				  duration: 5000,
				  background: 'blue',
				  icon: true,
				  ripple: true,
				  dismissible: true,
				  position: {
					x: 'right',
					y: 'top',
				  }
				  
				})
				
				$('#customer_old_nic_no').val(data[0].customer_old_nic_no);	
				$('#customer_name').val(data[0].customer_name);
				$('#customer_contact_no').val(data[0].customer_contact_no);
				$('#customer_email').val(data[0].customer_email);
				$('#customer_working_address').val(data[0].customer_working_address);
				$('#customer_shipping_address').val(data[0].customer_shipping_address);
				
				customer_old_nic_no = data[0].customer_old_nic_no;
				customer_name = data[0].customer_name;
				customer_id = data[0].customer_id;
				customer_contact_no = data[0].customer_contact_no;
				customer_email = data[0].customer_email;
				customer_working_address = data[0].customer_working_address;
				customer_shipping_address = data[0].customer_shipping_address;
			}
			else{
				
				
				$('#customer_name').val('');
				$('#customer_contact_no').val('');
				$('#customer_email').val('');
				$('#customer_working_address').val('');
				$('#customer_shipping_address').val('');
				
				
				
			}
			
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			console.log(textStatus);					
		}
	});
})


$(document).on('click', '#invoicePrintBtn', function(){
	
	customer_old_nic_no = $('#customer_old_nic_no').val();
	customer_name = $('#customer_name').val();
	customer_contact_no = $('#customer_contact_no').val();
	customer_email = $('#customer_email').val();
	deposite_amount = $('#deposite_amount').val();
	customer_working_address = $('#customer_working_address').val();
	customer_shipping_address = $('#customer_shipping_address').val();
	var selectedItemsArr = [];
	var customerDataArr = [];
	
	$('.detailRow').each(function(){
		selectedItemsArr.push({
			'item_id': parseFloat($(this).find(".item_id").text()),
			'qty': parseFloat($(this).find(".qty").text()),
			'unit_price': parseFloat($(this).find(".unit_price").text())
		})
	});
	
	customerDataArr.push({
		'customer_old_nic_no': customer_old_nic_no,
		'customer_name': customer_name,
		'customer_contact_no': customer_contact_no,
		'customer_email': customer_email,
		'deposite_amount': deposite_amount,
		'customer_working_address': customer_working_address,
		'customer_shipping_address': customer_shipping_address
	})
	
	
	
	if(customer_old_nic_no && customerDataArr.length > 0 &&  selectedItemsArr.length > 0 && deposite_amount)
	{
		
		var formData = new Object();
		formData = {
			customerDataArr:customerDataArr,
			selectedItemsArr:selectedItemsArr
		};
		
		console.log(formData);
		
		submitData();
		
		
		
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
	
	
	function submitData(){
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			contentType: 'application/json',
			dataType: "json",
			processData: false,
			data: JSON.stringify(formData),	
			url: API+"RentalInvoice/insert/",
			success: function(data, result){
				console.log(data['invoice_header_header_id']);	
				const notyf = new Notyf();
				if(data['message'] == 'Data Saved!'){
					is_order_saved = 1;
					
					var id = data['invoice_header_header_id'];
					invoice_header_header_id =  data['invoice_header_header_id'];
					
					
					$('#downloadPdf').attr("href", "http://localhost/API/RentalInvoice/printInvoice/?id="+id);
					$('#downloadPdf')[0].click();					
						
					$('.orderStatus').text('Saved');
					$('.orderStatus').removeClass('badge-danger');
					$('.orderStatus').addClass('badge-success');
					
					$('#invoiceModal').modal('hide');
					
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
					
					
					
					/* window.setTimeout(function() {
						window.location = "<?php echo base_url() ?>stockTransfer/view";
					}, 3000); */
				}	
				else{
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
	 
	
	
	
	
})


	function print(id){
		$.ajax({
			type: "GET",
			cache : false,
			async: true,
			dataType: "json",
			contentType: 'application/json',
			url: API+"RetailInvoice/printInvoice/?id="+id,
			success: function(data, result){
				
				
				
				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {						
				console.log(textStatus);					
			}
		});	
	}
	
	$(document).on('click', '.payMethod', function(){
		console.log($(this).parent().parent().parent());
		console.log($('#customer_id').attr('value'));
		console.log($('#invoice_header_header_id').attr('value'));
		console.log($('#payment_reference').attr('value'));
		
		var payement_method = $(this).attr('value');
		var customer_id = $('#customer_id').attr('value');
		var invoice_header_header_id = $('#invoice_header_header_id').attr('value');
		var payment_reference = $(document).find('#payment_reference').val();
		
	
		
		payement(customer_id, invoice_header_header_id, payment_reference, payement_method);
	})
	
	function payement(customer_id, invoice_header_header_id, payment_reference, payement_method){
		
		var paymentArr = [];
		
		paymentArr.push({
			'customer_id': customer_id,
			'invoice_header_header_id': invoice_header_header_id,
			'payment_reference': payment_reference,
			'payement_method': payement_method
		})
		
		
		console.log(paymentArr);
		
		var formData = new Object();
		formData = {
			paymentArr:paymentArr
		};
		
		
		
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			contentType: 'application/json',
			dataType: "json",
			processData: false,
			data: JSON.stringify(formData),	
			url: API+"RetailInvoice/updatePayment/",
			success: function(data, result){
				console.log(data);
				const notyf = new Notyf();
				if(data.message == "Payment Updated!"){

					$('.paymentStatus').text('Paid');
					$('.paymentStatus').removeClass('badge-danger');
					$('.paymentStatus').addClass('badge-success');

					
					notyf.success({
					  message: 'Payment Updated!',
					  duration: 5000,
					  icon: true,
					  ripple: true,
					  dismissible: true,
					  position: {
						x: 'right',
						y: 'top',
					  }
					  
					})
					//window.setTimeout(function() {
					//	window.location = "<?php echo base_url() ?>branch/view";
					//}, 3000);
				}
				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {						
				console.log(textStatus);					
			}
		});	
	}

window.addEventListener('beforeunload', function (e) {
  // Cancel the event as stated by the standard.
  e.preventDefault();
  // Chrome requires returnValue to be set.
  e.returnValue = '';
});


  </script>