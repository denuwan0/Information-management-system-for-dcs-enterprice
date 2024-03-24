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
				<h3 class="card-title">Retail Order Details</h3>
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
								<th width="10%">Total</th>
								<th width="10%">Complete</th>
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


var bank_id = 0;
function loadData() {
	
		
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"RetailOrder/fetch_all_header",
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
					var is_active_inv_retail_invoice_hdr ='';
					var option_html ='';
					
					if(item.is_complete == 1){
						is_complete ='<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_complete ='<span class="right badge badge-danger">No</span>';
					}
					
					if(item.is_active_inv_retail_invoice_hdr == 1){
						is_active_inv_retail_invoice_hdr = '<span class="right badge badge-success">Active</span>';
						option_html = '<?php if($this->session->userdata('sys_user_group_name') == "Admin" ){
								echo '<div class="btn-group margin"><a type="button" id="viewBtn" retail_stock_header_id="" class="btn btn-primary btn-sm viewBtn" value=""><i class="fa fa-eye"></i></a>';
								
								echo '<a style="display:block" type="button" id="editBtn" retail_stock_header_id="" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
							}
							else{
								echo '<a type="button" id="viewBtn" retail_stock_header_id="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							}

						?>';
					}
					else{
						is_active_inv_retail_invoice_hdr = '<span class="right badge badge-danger">Inactive</span>';
						option_html = '<?php if($this->session->userdata('sys_user_group_name') == "Admin" ){
								echo '<div class="btn-group margin"><a type="button" id="viewBtn" retail_stock_header_id="" class="btn btn-primary btn-sm viewBtn" value=""><i class="fa fa-eye"></i></a>';
								echo '<a type="button" id="editBtn" retail_stock_header_id="" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
							}
							else{
								echo '<a type="button" id="viewBtn" retail_stock_header_id="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							}

						?>';
						//'<a type="button" id="editBtn" href="<?php echo base_url() ?>stockRetail/edit/'+item.retail_stock_header_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> ';
					}
					
					
					table.row.add([item.invoice_id,
					item.customer_name,
					item.company_branch_name,
					item.invoice_date,
					item.create_time,
					item.total_amount,
					is_complete,
					is_active_inv_retail_invoice_hdr,
					option_html,
					]).draw();

					$(".editBtn").last().attr('href', '<?php echo base_url() ?>stockRetail/edit/'+item.retail_stock_id );
					$(".viewBtn").last().attr('value',item.retail_stock_id );
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

	var retail_stock_id = "";
	var Header = "";
	var HTML = "";
	var HTML2 = "";
	
	retail_stock_id = $(this).attr('value');
	console.log(retail_stock_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"StockRetail/fetch_all_total_stock_join_by_id/?id="+retail_stock_id,
		success: function(data, result){
			console.log(data);
			//console.log(data.header[0].retail_stock_assigned_date);
			
			var is_active_retail_stock='';
			
			if(data[0].is_active_retail_stock == 1){
				is_active_retail_stock  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_retail_stock  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			$.each(data, function (i, item) {
				console.log(item);
				HTML2 ='<tr>'+
						  '<td>'+(i+1)+'</td>'+
						  '<td>'+item.item_name+'</td>'+
						  '<td>'+item.max_sale_price+'</td>'+
						  '<td>'+item.min_sale_price+'</td>'+
						  '<td>'+item.full_stock_count+'</td>'+
						  '<td>'+item.stock_re_order_level+'</td>'+
						'</tr>';
				//console.log(HTML2);		
				//$('#detail_table').append(HTML2);
					  
			});	
			
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="repair_loc_address">Stock Id: </label></th>'+
						  '<td>'+data[0].retail_stock_id+'</td>'+
						  '<td><label for="repair_loc_name">Branch: </label></td>'+
						  '<td>'+data[0].company_branch_name+'</td>'+						  						 
						'</tr>'+
						'<tr>'+
						  '<td><label for="is_active_vhcl_repair_loc">Status: </label></td>'+
						  '<td>'+is_active_retail_stock+'</td>'+
						'</tr>'+
					  '</tbody>'+
					'</table>'+
					'<table class=" table table-bordered table-striped">'+
						'<thead id="thead">'+
							'<tr>'+
								'<th style="width: 5%">#</th>'+
								'<th style="width: 30%">Sub Item Name</th>'+
								'<th style="width: 15%">Max Price</th>'+
								'<th style="width: 15%">Min Price</th>	'+										  
								'<th style="width: 15%">No.of Items</th>'+
								'<th style="width: 15%">Re-order level</th>'+
							'</tr>'+
						'</thead>'+
					  '<tbody id="detail_table">'+
					  HTML2
					  '</tbody>'+
					'</table>';
					
				
			
					
		
		$('#modalInfoHeader').html('Retail Stock Assigned No: '+data[0].retail_stock_header_id);
		$('#modalInfoBody').html(HTML);
		$('#modalInfo').modal('show');
				
		}
	});
	
	
})
</script>