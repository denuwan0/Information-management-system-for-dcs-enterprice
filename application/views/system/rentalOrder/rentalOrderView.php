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
				<div class="modal-footer justify-content-right">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Rental Order Details</h3>
				<div style="text-align: right;">
					<?php 
						/* if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'stockRetail/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Add Retail Stock
								</a>';
						} */
						
					?>
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped">
						<thead id="thead">
							<tr>
								<th width="10%">Invoice Id</th>
								<th width="10%">Customer</th>
								<th width="10%">Branch</th>
								<th width="10%">Date</th>
								<th width="10%">Time</th>
								<th width="10%">Deposite</th>
								<th width="10%">Total</th>
								<th width="10%">Confirmed/ Deposite</th>
								<th width="10%">Items delivered</th>
								<th width="10%">Items returned</th>
								<th width="10%">Status</th>
								<th width="10%">Option</th>
							</tr>
						</thead>
						<tbody id="tbody">                
						</tbody>
						<tfoot>
						</tfoot>
					</table>					
				</div>				
			</form>
			<div id="" class="" >
				
			</div>
		</div>
	</div>
</section>
<script>

$(document).ready(function($) {


function loadData() {
	
		
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"RentalOrder/fetch_all_header",
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {
				
				
				
				var table = $('#data').DataTable(
				{
					dom: 'Bfrtip',
					scrollX: true,
					scrollCollapse: true,
					scrollY: '400px',
					paging: false,
					buttons: [
						{
							extend: 'colvis',
							text: 'Show/hide columns'
						},
						{
							extend: 'excelHtml5',
							title: $('.card-title').text()
						},
						{
							extend: 'copyHtml5',
							title: $('.card-title').text()
						},
						{
							extend: 'csvHtml5',
							title: $('.card-title').text()
						},
						{
							extend: 'pdfHtml5',
							title: $('.card-title').text()
						}
					]
				} ); 
				
				$.each(data, function (i, item) {
					//console.log(item);
					//console.log($(this));
					var is_complete ='';
					var is_confirmed ='';
					var is_active_inv_rent_invoice_hdr ='';
					var option_html ='';
					var is_items_returned = '';
					
					if(item.is_confirmed == 1){
						is_confirmed ='<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_confirmed ='<span class="right badge badge-danger">No</span>';
					}
					
					if(item.is_complete == 1){
						is_complete ='<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_complete ='<span class="right badge badge-danger">No</span>';
					}
					
					if(item.is_items_returned == 1){
						is_items_returned ='<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_items_returned ='<span class="right badge badge-danger">No</span>';
					}
					
					if(item.is_active_inv_rent_invoice_hdr == 1){
						is_active_inv_rent_invoice_hdr = '<span class="right badge badge-success">Active</span>';
						
						if(item.is_confirmed == 1){
							option_html = '<?php if($this->session->userdata('sys_user_group_name') == "Admin" || $this->session->userdata('sys_user_group_name') == "Manager" ){
									echo '<div class="btn-group margin"><a type="button" id="viewBtn"  class="btn btn-primary btn-sm viewBtn" value=""><i class="fa fa-eye"></i></a>';
									echo '<a style="display:none" type="button" id="payBtn" class="btn btn-dark btn-sm payBtn"><i class="fas fa-money-bill-alt"></i></a>';
									echo '<a style="display:block" type="button" id="printBtn"  class="btn btn-warning btn-sm printBtn"><i class="fa fa-download"></i></a></div>';
								}
								else{
									echo '<a type="button" id="viewBtn" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
								}

							?>';
						}
						else{
							option_html = '<?php if($this->session->userdata('sys_user_group_name') == "Admin" || $this->session->userdata('sys_user_group_name') == "Manager" ){
									echo '<div class="btn-group margin"><a type="button" id="viewBtn"  class="btn btn-primary btn-sm viewBtn" value=""><i class="fa fa-eye"></i></a>';
									
									echo '<a style="display:block" type="button" id="printBtn"  class="btn btn-warning btn-sm printBtn"><i class="fa fa-download"></i></a>';
									
									echo '<a style="display:block" type="button" id="payBtn" class="btn btn-dark btn-sm payBtn"><i class="fas fa-money-bill-alt"></i></a></div>';
								}
								else{
									echo '<a type="button" id="viewBtn" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
								}

							?>';
						}
						
						
					}
					
					
					
					table.row.add([item.invoice_id,
					item.customer_name,
					item.company_branch_name,
					item.invoice_date,
					item.create_time,
					item.deposite_amount,
					item.total_amount,
					is_confirmed,
					is_complete,
					is_items_returned,
					is_active_inv_rent_invoice_hdr,
					option_html,
					]).draw();
					

					//$(".editBtn").last().attr('href', '<?php echo base_url() ?>stockRetail/edit/'+item.invoice_id );
					$(".viewBtn").last().attr('value',item.invoice_id );
					$(".printBtn").last().attr('value',item.invoice_id );
					$(".printBtn").last().attr('href', "http://localhost/API/RentalInvoice/printInvoice/?id="+item.invoice_id );
					$(".payBtn").last().attr('value',item.invoice_id );
					$(".payBtn").last().attr('customer_name',item.customer_name );
					$(".payBtn").last().attr('customer_id',item.customer_id );
				});
							
			});
			

			
						
			
					
			
			
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
			console.log(textStatus);					
		}
	});
};

loadData();


$(document).on('click','.viewBtn', function(){
	
	var rental_invoice_id = "";
	var Header = "";
	var HTML = "";
	var HTML2 = "";
	
	rental_invoice_id = $(this).attr('value');
	console.log(rental_invoice_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"RentalOrder/fetch_single_join_by_invoice_id/?id="+rental_invoice_id,
		success: function(data, result){
			console.log(data);
			//console.log(data.header[0].retail_stock_assigned_date);
			
			var is_active_inv_rent_invoice_hdr='';
			var is_complete='';
			var is_confirmed='';
			
			if(data.header[0].is_active_inv_rent_invoice_hdr == 1){
				is_active_inv_rent_invoice_hdr  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_inv_rent_invoice_hdr  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			if(data.header[0].is_complete == 1){
				is_complete ='<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_complete ='<span class="right badge badge-danger">No</span>';
			}
			
			if(data.header[0].is_confirmed == 1){
				is_confirmed ='<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_confirmed ='<span class="right badge badge-danger">No</span>';
			}
			
			$.each(data.detail, function (i, item) {
				//console.log(item);
				HTML2 +='<tr>'+
						  '<td>'+(i+1)+'</td>'+
						  '<td>'+item.item_name+'</td>'+
						  '<td>'+item.item_price+'</td>'+
						  '<td>'+item.no_of_items+'</td>'+
						  '<td>'+(item.item_price * item.no_of_items)+'</td>'+
						'</tr>';
				//console.log(HTML2);		
				//$('#detail_table').append(HTML2);
					  
			});	
			
			var payement_method = 'Not paid yet';
			var payment_date = 'Not paid yet';
			var payment_time = 'Not paid yet';
			
			console.log(data.payment_details);
			
			if(data.payment_details != ''){
				payement_method = data.payment_details[0].payment_method;
				payment_date = data.payment_details[0].payment_date;
				payment_time = data.payment_details[0].payment_time;
			}
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="repair_loc_address">Invoice No: </label></th>'+
						  '<td>'+data.header[0].invoice_id+'</td>'+
						  '<td><label for="repair_loc_name">Customer Contact: </label></td>'+
						  '<td>'+data.header[0].customer_contact_no+'</td>'+						  						 
						'</tr>'+
						'<tr>'+
						  '<td><label for="repair_loc_name">Customer NIC: </label></td>'+
						  '<td>'+data.header[0].customer_old_nic_no+'</td>'+
						  '<td><label for="repair_loc_name">Customer Name: </label></td>'+
						  '<td>'+data.header[0].customer_name+'</td>'+						  						 
						'</tr>'+
						'<tr>'+
						   '<td><label for="is_active_vhcl_repair_loc">Deposite amount: </label></td>'+
						  '<td>'+data.header[0].deposite_amount+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<td><label for="is_active_vhcl_repair_loc">Paid by: </label></td>'+
						  '<td>'+payement_method+'</td>'+						
						  '<td><label for="is_active_vhcl_repair_loc">Date: </label></td>'+
						  '<td>'+payment_date+'</td>'+
						'</tr>'+
						'<tr>'+
						   '<td><label for="is_active_vhcl_repair_loc">Time: </label></td>'+
						  '<td>'+payment_time+'</td>'+
						   '<td><label for="is_active_vhcl_repair_loc">Confirmed: </label></td>'+
						  '<td>'+is_confirmed+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<td><label for="is_active_vhcl_repair_loc">Complete: </label></td>'+
						  '<td>'+is_complete+'</td>'+						
						  '<td><label for="is_active_vhcl_repair_loc">Status: </label></td>'+
						  '<td>'+is_active_inv_rent_invoice_hdr+'</td>'+
						'</tr>'+
					  '</tbody>'+
					'</table>'+
					'<table class=" table table-bordered table-striped">'+
						'<thead id="thead">'+
							'<tr>'+
								'<th style="width: 5%">#</th>'+
								'<th style="width: 30%">Item Name</th>'+
								'<th style="width: 15%">Rate</th>'+									  
								'<th style="width: 15%">No.of Items</th>'+
								'<th style="width: 15%">Sub total</th>'+
							'</tr>'+
						'</thead>'+
					  '<tbody id="detail_table">'+
					  HTML2
					  '</tbody>'+
					'</table>';
					
				
			
					
		
		$('#modalInfoHeader').html('Rental invoice No: '+data.header[0].invoice_id);
		$('#modalInfoBody').html(HTML);
		$('#modalInfo').modal('show');
				
		}
	});
	
		
	
})

$(document).on('click', '#payBtn', function(){
	
	var invoice_id = $(this).attr('value');	
	var customer_name = $(this).attr('customer_name');	
	var customer_id = $(this).attr('customer_id');	
	
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
							  '<input type="text" class="form-control" id="invoice_header_header_id" value="'+invoice_id+'" readonly>'+
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
	
	
	
	
	
});

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
		url: API+"RentalInvoice/updatePayment/",
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
				window.setTimeout(function() {
					window.location = "<?php echo base_url() ?>RentalOrder/view";
				}, 3000);
			}
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			console.log(textStatus);					
		}
	});	
}

})
</script>