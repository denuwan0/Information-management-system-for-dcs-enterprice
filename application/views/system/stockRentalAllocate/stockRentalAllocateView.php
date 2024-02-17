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
				<h3 class="card-title">Rental Stock Allocation Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'StockRentalAllocate/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Add Rental Stock
								</a>';
						}
						
					?>
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped">
						<thead id="thead">
							<tr>
								<th width="10%">Stock assigned id</th>
								<th width="10%">Stock Batch No</th>
								<th width="10%">Branch</th>
								<th width="20%">Assigned date</th>
								<th width="20%">Approved</th>
								<th width="20%">Active</th>
								<th width="20%">Option</th>
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
		url: API+"StockRental/",
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {
				var table = $('#data').DataTable(); 
				
				$.each(data, function (i, item) {
					//console.log(item);
					var is_active_inv_stock_rental ='';
					if(item.is_active_inv_stock_rental == 1){
						is_active_inv_stock_rental = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_inv_stock_rental = '<span class="right badge badge-danger">Inactive</span>';
					}
										
					var is_approved_inv_stock_rental ='';
					var option_html ='';
					if(item.is_approved_inv_stock_rental == 1){
						is_approved_inv_stock_rental = '<span class="right badge badge-success">Yes</span>';
						option_html = '<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
							$this->session->userdata('sys_user_group_name') == "Manager"){
								echo '<div class="btn-group margin"><a type="button" id="viewBtn" rental_stock_header_id="" class="btn btn-primary btn-sm viewBtn" value=""><i class="fa fa-eye"></i></a>';
								echo '<a style="display:none" type="button" id="editBtn" rental_stock_header_id="" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
							}
							else{
								echo '<a type="button" id="viewBtn" rental_stock_header_id="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							}

						?>';
					}
					else{
						is_approved_inv_stock_rental = '<span class="right badge badge-danger">No</span>';
						option_html = '<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
							$this->session->userdata('sys_user_group_name') == "Manager"){
								echo '<div class="btn-group margin"><a type="button" id="viewBtn" rental_stock_header_id="" class="btn btn-primary btn-sm viewBtn" value=""><i class="fa fa-eye"></i></a>';
								echo '<a type="button" id="editBtn" rental_stock_header_id="" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
							}
							else{
								echo '<a type="button" id="viewBtn" rental_stock_header_id="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							}

						?>';
					}
					
					
					table.row.add([item.rental_stock_header_id,
					item.stock_batch_id,
					item.company_branch_name,
					item.rental_stock_assigned_date,
					is_approved_inv_stock_rental,
					is_active_inv_stock_rental,
					option_html,
					]).draw();

					$(".editBtn").last().attr('href', '<?php echo base_url() ?>stockRentalAllocate/edit/'+item.rental_stock_header_id);
					$(".viewBtn").last().attr('value',item.rental_stock_header_id);
				});
							
			});
			

				
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			console.log(textStatus);					
		}
	});
};

loadData();

$(document).on('click','.viewBtn', function(){

	var rental_stock_header_id = "";
	var Header = "";
	var HTML = "";
	var HTML2 = "";
	
	rental_stock_header_id = $(this).attr('value');
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"StockRental/fetch_single_join/?id="+rental_stock_header_id,
		success: function(data, result){
			console.log(data);
			//console.log(data.header[0].retail_stock_assigned_date);
			var is_approved_inv_stock_rental='';
			var is_active_inv_stock_rental='';
			
			if(data.header[0].is_approved_inv_stock_rental == 1){
				is_approved_inv_stock_rental  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_approved_inv_stock_rental  = '<span class="right badge badge-danger">No</span>';
			}
			
			if(data.header[0].is_active_inv_stock_rental == 1){
				is_active_inv_stock_rental  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_inv_stock_rental  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			$.each(data.detail, function (i, item) {
				console.log(item);
				HTML2 +='<tr>'+
						  '<td>'+(i+1)+'</td>'+
						  '<td>'+item.item_name+' ('+(item.is_sub_item == 0 ? 'Sub item' : 'Main item')+')</td>'+
						  '<td>'+item.full_stock_count+'</td>'+
						'</tr>';
				//console.log(HTML2);		
				//$('#detail_table').append(HTML2);
					  
			});	
			console.log(HTML2);
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="repair_loc_address">Stock Batch No: </label></th>'+
						  '<td>'+data.header[0].stock_batch_id+'</td>'+
						  '<td><label for="repair_loc_name">Stock Assigned Date: </label></td>'+
						  '<td>'+data.header[0].rental_stock_assigned_date+'</td>'+						  						 
						'</tr>'+
						'<tr>'+
						  '<th><label for="repair_loc_contact">Approved: </label></th>'+
						  '<td colspan="">'+is_approved_inv_stock_rental+'</td>'+
						  '<td><label for="is_active_vhcl_repair_loc">Status: </label></td>'+
						  '<td>'+is_active_inv_stock_rental+'</td>'+
						'</tr>'+
					  '</tbody>'+
					'</table>'+
					'<table class=" table table-bordered table-striped">'+
						'<thead id="thead">'+
							'<tr>'+
								'<th style="width: 5%">#</th>'+
								'<th style="width: 30%">Item Name</th>'+										  
								'<th style="width: 15%">No.of Items</th>'+
							'</tr>'+
						'</thead>'+
					  '<tbody id="detail_table">'+
					  HTML2
					  '</tbody>'+
					'</table>';
					
				
			
					
		
		$('#modalInfoHeader').html('Rental Stock Assigned No: '+data.header[0].rental_stock_header_id);
		$('#modalInfoBody').html(HTML);
		$('#modalInfo').modal('show');
				
		}
	});
	
	
})
</script>