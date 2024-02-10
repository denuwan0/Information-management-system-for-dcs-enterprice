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
					<button type="button" class="btn btn-success" data-dismiss="modal">Accept</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
		</div>
	</div>
</div>
<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Stock Transfer Accept</h3>
				<div style="text-align: right;">
					
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped">
						<thead id="thead">
							<tr>
								<th>Stock Transfer id</th>
								<th>Date</th>
								<th>Request From</th>
								<th>Request To</th>
								<th>Approved</th>
								<th>Accepted</th>
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
		url: API+"stockTransfer/fetch_all_other",
		success: function(data, result){
			//console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {
				var table = $('#data').DataTable(); 
				
				$.each(data, function (i, item) {
					console.log(item);
					var is_active_inv_stock_trans ='';
					if(item.is_active_inv_stock_trans == 1){
						is_active_inv_stock_trans = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_inv_stock_trans = '<span class="right badge badge-danger">Inactive</span>';
					}
										
					var is_accepted ='';
					if(item.is_accepted == 1){
						is_accepted = '<span class="right badge badge-success">Accepted</span>';
					}
					else{
						is_accepted = '<span class="right badge badge-danger">Not Accepted</span>';
					}
					
					var is_approved ='';
					var option_html ='';
					
					if(item.is_approved == 1){
						is_approved = '<span class="right badge badge-success">Yes</span>';
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
						is_approved = '<span class="right badge badge-danger">No</span>';
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
					
					
					table.row.add([item.inventory_stock_transfer_header_id,
					item.create_date,
					item.from_branch,
					item.to_branch,
					is_approved,
					is_accepted,
					is_active_inv_stock_trans,
					option_html,
					]).draw();
					
					console.log($(this));

					$(".editBtn").last().attr('href', '<?php echo base_url() ?>stockTransfer/edit/'+item.inventory_stock_transfer_header_id);
					$(".viewBtn").last().attr('value', item.inventory_stock_transfer_header_id);
					
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

	var inventory_stock_transfer_header_id = "";
	var Header = "";
	var HTML = "";
	var HTML2 = "";
	
	inventory_stock_transfer_header_id = $(this).attr('value');
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"stockTransfer/fetch_single_join/?id="+inventory_stock_transfer_header_id,
		success: function(data, result){
			console.log(data);
			//console.log(data.header[0].retail_stock_assigned_date);
			var is_active_inv_stock_trans='';
			var is_approved='';
			var is_accepted='';
			
			if(data.header[0].is_active_inv_stock_trans == 1){
				is_active_inv_stock_trans  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_inv_stock_trans  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			if(data.header[0].is_approved == 1){
				is_approved  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_approved  = '<span class="right badge badge-danger">No</span>';
			}
			
			if(data.header[0].is_accepted == 1){
				is_accepted  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_accepted  = '<span class="right badge badge-danger">No</span>';
			}
			console.log(data.detail);
			$.each(data.detail, function (i, item) {
				HTML2 +='<tr>'+
						  '<td>'+(i+1)+'</td>'+
						  '<td>'+item.item_name+' ('+(item.is_sub_item == 0 ? 'Sub item' : 'Main item')+')</td>'+
						  '<td>'+item.no_of_items+'</td>'+
						'</tr>';
				//console.log(HTML2);		
				//$('#detail_table').append(HTML2);
					  
			});	
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="repair_loc_address">Stock Transfer No: </label></th>'+
						  '<td>'+data.header[0].inventory_stock_transfer_header_id+'</td>'+
						  '<td><label for="repair_loc_name">Date: </label></td>'+
						  '<td>'+data.header[0].create_date+'</td>'+						  						 
						'</tr>'+
						'<tr>'+
						  '<th><label for="repair_loc_contact">Approved: </label></th>'+
						  '<td colspan="">'+is_approved+'</td>'+
						  '<td><label for="is_active_vhcl_repair_loc">Status: </label></td>'+
						  '<td>'+is_active_inv_stock_trans+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="repair_loc_contact">Stock Type: </label></th>'+
						  '<td colspan="">'+data.header[0].stock_type+'</td>'+
						  '<td><label for="is_active_vhcl_repair_loc">Transfer Type: </label></td>'+
						  '<td>'+(data.header[0].transfer_type == 'OUT' ?'IN':'OUT')+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="repair_loc_contact">Accepted: </label></th>'+
						  '<td colspan="">'+is_accepted+'</td>'+
						'</tr>'+
					  '</tbody>'+
					'</table>'+
					'<table class=" table table-bordered table-striped">'+
						'<thead id="thead">'+
							'<tr>'+
								'<th style="width: 5%">#</th>'+
								'<th style="width: 30%">Item Name</th>'+
								'<th style="width: 15%">No.of items</th>'+	
							'</tr>'+
						'</thead>'+
					  '<tbody id="detail_table">'+
					  HTML2
					  '</tbody>'+
					'</table>';
					
				
			
					
		
		$('#modalInfoHeader').html('Stock Transfer No: '+data.header[0].inventory_stock_transfer_header_id + 
		' (Request From: '+data.header[0].from_branch+' To:'+data.header[0].to_branch+')');
		$('#modalInfoBody').html(HTML);
		$('#modalInfo').modal('show');
				
		}
	});
	
	
})
</script>