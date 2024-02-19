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
				<h3 class="card-title">Stock Purchase Details</h3>
				<div style="text-align: right;">
					<a type="button" href="<?php echo base_url() ?>stock/create" class="btn text-dark btn-default btn-sm">
						<i class="nav-icon far fa-plus-square"></i> Add Stock Purchase
					</a>
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped">
						<thead id="thead">
							<tr>
								<th>Batch id</th>
								<th>Purchase Date</th>
								<th>Approved</th>
								<th>Allocated</th>
								<th>Active</th>
								<th>Option</th>
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
		url: API+"stock/",
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {
				var table = $('#data').DataTable(); 
				
				$.each(data, function (i, item) {
					//console.log(item);
					var is_active_stock_purchase ='';
					if(item.is_active_stock_purchase == 1){
						is_active_stock_purchase = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_stock_purchase = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					var is_allocated_stock ='';
					if(item.is_allocated_stock == 1){
						is_allocated_stock = '<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_allocated_stock = '<span class="right badge badge-danger">No</span>';
					}
					
					var is_approved_stock ='';
					var option_html ='';
					
					if(item.is_approved_stock == 1){
						is_approved_stock = '<span class="right badge badge-success">Yes</span>';
						option_html = '<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
							$this->session->userdata('sys_user_group_name') == "Manager"){
								echo '<div class="btn-group margin"><a type="button" id="viewBtn" stock_batch_id="" class="btn btn-primary btn-sm viewBtn" value=""><i class="fa fa-eye"></i></a>';
								echo '</div>';
								echo '<a style="display:none" type="button" id="editBtn" stock_batch_id="" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
							}
							else{
								echo '<a type="button" id="viewBtn" stock_batch_id="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							}

						?>';
					}
					else{
						is_approved_stock = '<span class="right badge badge-danger">No</span>';
						option_html = '<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
							$this->session->userdata('sys_user_group_name') == "Manager"){
								echo '<div class="btn-group margin"><a type="button" id="viewBtn" stock_batch_id="" class="btn btn-primary btn-sm viewBtn" value=""><i class="fa fa-eye"></i></a>';
								echo '<a type="button" id="editBtn" stock_batch_id="" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
							}
							else{
								echo '<a type="button" id="viewBtn" stock_batch_id="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							}

						?>';
					}
					
					
					table.row.add([item.stock_batch_id,
					item.stock_purchase_date,
					is_approved_stock,
					is_allocated_stock,
					is_active_stock_purchase,
					option_html,
					]).draw();

					$(".editBtn").last().attr('href', '<?php echo base_url() ?>stock/edit/'+item.stock_batch_id);
					$(".viewBtn").last().attr('value', item.stock_batch_id);
					
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

	var stock_batch_id = "";
	var Header = "";
	var HTML = "";
	var HTML2 = "";
	
	stock_batch_id = $(this).attr('value');
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"stock/fetch_single_join/?id="+stock_batch_id,
		success: function(data, result){
			console.log(data);
			//console.log(data.header[0].retail_stock_assigned_date);
			var is_active_stock_purchase='';
			var is_approved_stock='';
			var is_allocated_stock='';
			
			if(data.header[0].is_active_stock_purchase == 1){
				is_active_stock_purchase  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_stock_purchase  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			if(data.header[0].is_approved_stock == 1){
				is_approved_stock  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_approved_stock  = '<span class="right badge badge-danger">No</span>';
			}
			
			if(data.header[0].is_allocated_stock == 1){
				is_allocated_stock  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_allocated_stock  = '<span class="right badge badge-danger">No</span>';
			}
			console.log(data.detail);
			$.each(data.detail, function (i, item) {
				HTML2 +='<tr>'+
						  '<td>'+(i+1)+'</td>'+
						  '<td>'+item.item_name+' ('+(item.is_sub_item == 1 ? 'Sub item' : 'Main item')+')</td>'+
						  '<td>'+item.item_cost+'</td>'+
						  '<td>'+item.no_of_items+'</td>'+
						  '<td>'+item.allocated_no_of_items+'</td>'+
						  '<td>'+item.available_no_of_items+'</td>'+
						'</tr>';
				//console.log(HTML2);		
				//$('#detail_table').append(HTML2);
					  
			});	
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="repair_loc_address">Stock Batch No: </label></th>'+
						  '<td>'+data.header[0].stock_batch_id+'</td>'+
						  '<td><label for="repair_loc_name">Purchase Date: </label></td>'+
						  '<td>'+data.header[0].stock_purchase_date+'</td>'+						  						 
						'</tr>'+
						'<tr>'+
						  '<th><label for="repair_loc_contact">Approved: </label></th>'+
						  '<td colspan="">'+is_approved_stock+'</td>'+
						  '<td><label for="is_active_vhcl_repair_loc">Status: </label></td>'+
						  '<td>'+is_active_stock_purchase+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="repair_loc_contact">Fully allocated: </label></th>'+
						  '<td colspan="">'+is_allocated_stock+'</td>'+
						'</tr>'+
					  '</tbody>'+
					'</table>'+
					'<table class=" table table-bordered table-striped">'+
						'<thead id="thead">'+
							'<tr>'+
								'<th style="width: 5%">#</th>'+
								'<th style="width: 30%">Item Name</th>'+
								'<th style="width: 15%">Item Cost Price</th>'+
								'<th style="width: 15%">No.of items</th>	'+										  
								'<th style="width: 15%">No.of Allocated Items</th>'+
								'<th style="width: 15%">No.of Available Items</th>'+
							'</tr>'+
						'</thead>'+
					  '<tbody id="detail_table">'+
					  HTML2
					  '</tbody>'+
					'</table>';
					
				
			
					
		
		$('#modalInfoHeader').html('Stock Purchase No: '+data.header[0].stock_batch_id);
		$('#modalInfoBody').html(HTML);
		$('#modalInfo').modal('show');
				
		}
	});
	
	
})
</script>