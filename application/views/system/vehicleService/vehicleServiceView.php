
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
				<h3 class="card-title">Vehicle Service Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'vehicleService/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Add Service Details
								</a>';
						}
						
					?>
					
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped" style="width:100%">
						<thead id="thead">
							<tr>
								<th>id</th>
								<th>Service Center</th>
								<th>Date</th>
								<th>Service Invoice</th>
								<th>Cost</th>
								<th>Complete</th>
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
		url: API+"vehicleService/",
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
					var is_active_vhcl_srv_cntr  ='';
					if(item.is_active_vhcl_srv_cntr  == 1){
						is_active_vhcl_srv_cntr  = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_vhcl_srv_cntr  = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					
					table.row.add([item.service_center_id,
					item.service_center_name,
					item.service_center_contact, 					
					item.service_center_address,
					is_active_vhcl_srv_cntr ,
					'<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							echo '<div class="btn-group margin"><a type="button" id="viewBtn" repair_loc_id="" class="btn btn-primary btn-sm viewBtn" value=""><i class="fa fa-eye"></i></a>';
							echo '<a type="button" id="editBtn" repair_loc_id="" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
						}
						else{
							echo '<a type="button" id="viewBtn" repair_loc_id="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
						}

					?>'
					//'<a type="button" id="editBtn" href="<?php echo base_url() ?>branch/edit/'+item.company_branch_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> '
					]).columns.adjust().draw();	
					
					//table.columns.adjust().draw();

					//console.log($(".editBtn").last());
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>vehicleServiceCenter/edit/'+item.service_center_id);
					$(".viewBtn").last().attr('value',item.service_center_id);
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

	var service_center_id = "";
	var Header = "";
	var HTML = "";
	
	service_center_id = $(this).attr('value');
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"vehicleServiceCenter/fetch_single/?id="+service_center_id,
		success: function(data, result){
			console.log(data);
			
			Header = data[0].service_center_name;
			console.log(Header);
			if(data[0].is_active_vhcl_srv_cntr == 1){
				is_active_vhcl_srv_cntr  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_vhcl_srv_cntr  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<td><label for="repair_loc_name">Name: </label></td>'+
						  '<td>'+data[0].service_center_name+'</td>'+
						  '<th><label for="repair_loc_address">Address: </label></th>'+
						  '<td>'+data[0].service_center_address+'</td>'+						 
						'</tr>'+
						'<tr>'+
						  '<th><label for="repair_loc_contact">Contact: </label></th>'+
						  '<td colspan="">'+data[0].service_center_contact+'</td>'+
						  '<td><label for="is_active_vhcl_repair_loc">Status: </label></td>'+
						  '<td>'+is_active_vhcl_srv_cntr+'</td>'+
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