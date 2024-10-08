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
					<button type="button" class="btn btn-success" id="acceptBtn">Accept</button>
					<button type="button" class="btn btn-danger" id="rejectBtn">Reject</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
		</div>
	</div>
</div>
<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Stock Transfer Accept/ Reject</h3>
				<div style="text-align: right;">
					
				</div>
			</div>
			
			<form>
				<div class="card-body" style="overflow-x: auto">
					<table id="data" class="table table-bordered table-striped">
						<thead id="thead">
							<tr>
								<th>Stock Transfer id</th>
								<th>Date</th>
								<th>Request From</th>
								<th>Request To</th>
								<th>Approved</th>
								<th>Accepted</th>
								<th>Rejected</th>
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
						is_accepted = '<span class="right badge badge-success">Yes</span>';						
					}
					else{
						is_accepted = '<span class="right badge badge-danger">No</span>';
					}
					
					var is_rejected ='';
					if(item.is_rejected == 1){
						is_rejected = '<span class="right badge badge-danger">Yes</span>';
					}
					else{
						is_rejected = '<span class="right badge badge-success">No</span>';
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
								echo '<a style="display:none" type="button" id="editBtn" stock_batch_id="" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
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
					is_rejected,
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

var inventory_stock_transfer_header_id = "";
var stock_type = 0;

$(document).on('click','.viewBtn', function(){

	
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
			var is_rejected='';
			stock_type = data.header[0].stock_type;
			
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
				$('#acceptBtn').css('display', 'none');	
				$('#rejectBtn').css('display', 'none');	
				is_accepted  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_accepted  = '<span class="right badge badge-danger">No</span>';
			}
			
			if(data.header[0].is_rejected == 1){
				$('#acceptBtn').css('display', 'none');	
				$('#rejectBtn').css('display', 'none');	
				is_rejected  = '<span class="right badge badge-danger">Yes</span>';
			}
			else{
				is_rejected  = '<span class="right badge badge-success">No</span>';
			}
			console.log(data.detail);
			$.each(data.detail, function (i, item) {
				HTML2 +='<tr>'+
						  '<td>'+(i+1)+'</td>'+
						  '<td>'+item.item_name+' ('+(item.is_sub_item == 0 ? 'Main item' : 'Sub item')+')</td>'+
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
						  '<th><label for="repair_loc_contact">Rejected: </label></th>'+
						  '<td colspan="">'+is_rejected+'</td>'+
						'</tr>'+
						'<tr>'+	
						  '<th><label for="repair_loc_contact">Note: </label></th>'+
						  '<td colspan=""><textarea class="form-control" id="note" rows="3">'+data.header[0].note+'</textarea></td>'+	
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

$(document).on("click", "#acceptBtn", function (e) {
	e.preventDefault();
			
		var stockHeader = [];
			
		
		stockHeader.push(
			{
				'inventory_stock_transfer_header_id':inventory_stock_transfer_header_id,
				'stock_type':stock_type				
			}
		);
						
		
		
		var formData = new Object();
		formData = {
			stockHeader:stockHeader
		};
		
		
		
		if(stockHeader.length > 0){
			submitData();
		}
		else{
			const notyf = new Notyf();
			notyf.error({
			  message: 'Please fill all fields!',
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
				url: API+"stockTransfer/accept/",
				success: function(data, result){
					console.log(data);	
					const notyf = new Notyf();
					if(data['message'] == 'Stock Transfer Accepted!'){
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
							window.location = "<?php echo base_url() ?>stockTransfer/accept";
						}, 3000);
					}
					else if(data['error'] == true){
						notyf.error({
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

$(document).on("click", "#rejectBtn", function (e) {
	e.preventDefault();
	
		
	var note = "";
	
	note = $('#note').val();

	var stockHeader = [];
		
	
	stockHeader.push(
		{
			'stock_type':stock_type,
			'note':note,
			'inventory_stock_transfer_header_id':inventory_stock_transfer_header_id
		}
	);
					
	console.log(stockHeader);
	
	var formData = new Object();
	formData = {
		stockHeader:stockHeader
	};
	
	
	
	if(stockHeader.length > 0){
		submitData();
	}
	else{
		const notyf = new Notyf();
		notyf.error({
		  message: 'Please fill all fields!',
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
			url: API+"stockTransfer/reject/",
			success: function(data, result){
				console.log(data);	
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
						window.location = "<?php echo base_url() ?>stockTransfer/accept";
					}, 3000);
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
</script>