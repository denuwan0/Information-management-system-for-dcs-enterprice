
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
				<h3 class="card-title">Vehicle Repair Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'vehicleRepair/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Add Repair Detail
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
								<th>Vehicle No.</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Repair Type</th>
								<th>Repair Location</th>
								<th>Active</th>
								<th>Complete</th>
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
		url: API+"VehicleRepair/fetch_all_join/",
		success: function(data, result){
			//console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {
				var table = $('#data').DataTable({
					"scrollX": true					
				}); 
							
				
				$.each(data, function (i, item) {
					//console.log(item);
					var is_complete  ='';
					var is_active_vhcl_repair  ='';
					
					if(item.is_complete  == 1){
						is_complete  = '<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_complete  = '<span class="right badge badge-danger">No</span>';
					}
					
					if(item.is_active_vhcl_repair  == 1){
						is_active_vhcl_repair  = '<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_active_vhcl_repair  = '<span class="right badge badge-danger">No</span>';
					}
					
					
					table.row.add([item.repair_id,
					item.license_plate_no,
					item.end_date, 					
					item.start_date,
					item.repair_type,
					item.repair_loc_name,
					is_active_vhcl_repair,
					is_complete ,
					'<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							echo '<div class="btn-group margin"><a type="button" id="viewBtn" vehicleId="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							echo '<a type="button" id="editBtn" vehicleId="" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
						}
						else{
							echo '<a type="button" id="viewBtn" vehicleId="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
						}

					?>'
					//'<a type="button" id="editBtn" href="<?php echo base_url() ?>branch/edit/'+item.company_branch_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> '
					]).columns.adjust().draw();	
					
					//table.columns.adjust().draw();

					//console.log($(".editBtn").last());
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>VehicleRepair/edit/'+item.repair_id);
					$(".viewBtn").last().attr('value', item.repair_id);
					//$(".editBtn").last().attr('vehicleId',item.vehicle_id);
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

	var repair_id = "";
	var Header = "";
	var HTML = "";
	
	repair_id = $(this).attr('value');
	//console.log(repair_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"VehicleRepair/fetch_single_join?id="+repair_id,
		success: function(data, result){
			console.log(data[0]);
			
			Header = 'Invoice No: '+data[0].repair_invoice_number;
			console.log(Header);
			
			var is_complete  ='';
			var is_active_vhcl_repair  ='';
			
			if(data[0].is_complete  == 1){
				is_complete  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_complete  = '<span class="right badge badge-danger">No</span>';
			}
			
			if(data[0].is_active_vhcl_repair  == 1){
				is_active_vhcl_repair  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_active_vhcl_repair  = '<span class="right badge badge-danger">No</span>';
			}
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="license_plate_no">Invoice No: </label></th>'+
						  '<td>'+data[0].repair_invoice_number+'</td>'+
						  '<th><label for="vehicle_yom">Vehicle No: </label></th>'+
						  '<td>'+data[0].license_plate_no+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<td><label for="chasis_no">Start Date: </label></td>'+
						  '<td>'+data[0].start_date+'</td>'+
						  '<td><label for="chasis_no">End Date: </label></td>'+
						  '<td>'+data[0].end_date+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_type_id">Repair Type: </label></th>'+
						  '<td >'+data[0].repair_type+'</td>'+
						  '<td><label for="vehicle_category_id">Repair Location: </label></td>'+
						  '<td >'+data[0].repair_loc_name+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="engine_no">Total Cost: </label></th>'+
						  '<td colspan="">'+data[0].repair_cost+'</td>'+
						  '<td><label for="branch_id">Description: </label></td>'+
						  '<td>'+data[0].repair_description+'</td>'+
						'</tr>'+
						'<tr>'+						 
						  '<td><label for="number_of_passengers">Active: </label></td>'+
						  '<td colspan="">'+is_active_vhcl_repair+'</td>'+
						  '<td><label for="max_load">Complete: </label></td>'+
						  '<td>'+is_complete+'</td>'+
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