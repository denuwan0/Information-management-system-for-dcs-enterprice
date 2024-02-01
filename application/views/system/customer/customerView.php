
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
				<h3 class="card-title">Customer Details</h3>
				<div style="text-align: right;">
					<a type="button" href="<?php echo base_url() ?>customer/create" class="btn text-dark btn-default btn-sm">
						<i class="nav-icon far fa-plus-square"></i> Add Customer
					</a>
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped" style="width:100%">
						<thead id="thead">
							<tr>
								<th>id</th>
								<th>Name</th>
								<th>NIC</th>
								<th>Contact No.</th>
								<th>Email</th>
								<th>Online Shopper</th>
								<th>Status</th>
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


var country_id = 0;
function loadData() {
	
		
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"customer/fetch_all/",
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {
				var table = $('#data').DataTable({
					"scrollX": true					
				});
				
				$.each(data, function (i, item) {
					//console.log(item);
					var is_active_customer ='';
					if(item.is_active_customer == 1){
						is_active_customer = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_customer = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					var is_web ='';
					if(item.is_web == 1){
						is_web = '<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_web = '<span class="right badge badge-danger">No</span>';
					}
					
					
					table.row.add([item.customer_id,
					item.customer_name,
					(item.customer_old_nic_no ? item.customer_old_nic_no: customer_new_nic_no), 					
					item.customer_contact_no,
					item.customer_email,
					is_web,
					is_active_customer,
					'<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							echo '<div class="btn-group margin"><a type="button" id="viewBtn"  class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							echo '<a type="button" id="editBtn"  href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
						}
						else{
							echo '<a type="button" id="viewBtn"  class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
						}

					?>'
					]
					).columns.adjust().draw();	


					$(".editBtn").last().attr('href', '<?php echo base_url() ?>customer/edit/'+item.customer_id);
					$(".viewBtn").last().attr('value', item.customer_id);
					
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

	var customer_id = "";
	var Header = "";
	var HTML = "";
	
	customer_id = $(this).attr('value');
	console.log(customer_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"customer/fetch_single?id="+customer_id,
		success: function(data1, result){
			console.log(data1);
			
			Header = 'Customer Id: '+data1[0].customer_id;
			console.log(Header);
			if(data1[0].is_active_customer  == 1){
				is_active_customer  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_customer  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			if(data1[0].is_web  == 1){
				is_web  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_web  = '<span class="right badge badge-danger">No</span>';
			}
			
			
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="license_plate_no">Customer Id: </label></th>'+
						  '<td>'+data1[0].customer_id+'</td>'+
						   '<th><label for="max_load">Name: </label></th>'+
						  '<td>'+data1[0].customer_name+'</td>'+
						'</tr>'+	
						'<tr>'+
						  '<th><label for="license_plate_no">NIC: </label></th>'+
						  '<td>'+(data1[0].customer_old_nic_no ? data1[0].customer_old_nic_no : data1[0].customer_new_nic_no)+'</td>'+
						   '<th><label for="max_load">Contact No: </label></th>'+
						  '<td>'+data1[0].customer_contact_no+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="license_plate_no">Email: </label></th>'+
						  '<td>'+data1[0].customer_email+'</td>'+
						   '<th><label for="max_load">Working Address: </label></th>'+
						  '<td>'+data1[0].customer_working_address+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="license_plate_no">Shipping Address: </label></th>'+
						  '<td>'+data1[0].customer_shipping_address+'</td>'+
						   '<th><label for="max_load">Online Shopper: </label></th>'+
						  '<td>'+is_web+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<td><label for="max_load">Status: </label></td>'+
						  '<td>'+is_active_customer+'</td>'+
						'</tr>'+
					  '</tbody>'+
					'</table>';
					
		
		$('#modalInfoHeader').html(Header);
		$('#modalInfoBody').html(HTML);
		$('#modalInfo').modal('show');
				
		}
	});
	
	
})
</script>