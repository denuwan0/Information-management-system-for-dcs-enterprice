
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
				<h3 class="card-title">Leave Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager" || 
						$this->session->userdata('sys_user_group_name') == "Staff"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'vehicle/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Apply Leave
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
								<th>Leave Type</th>
								<th>From Date</th>
								<th>To Date</th>
								<th>Amount</th>
								<th>Emplyee</th>
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
		url: API+"EmpLeave/fetch_all_join/",
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
					var is_active_vhcl_details  ='';
					if(item.is_active_vhcl_details  == 1){
						is_active_vhcl_details  = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_vhcl_details  = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					
					table.row.add([item.emp_wise_leave_quota_id,
					item.leave_type_name,
					item.leave_from_date, 					
					item.leave_to_date,
					item.leave_amount,
					item.emp_epf +' - '+item.emp_first_name,
					is_active_vhcl_details ,
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
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>vehicle/edit/'+item.vehicle_id);
					$(".viewBtn").last().attr('value', item.vehicle_id);
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

	var vehicleId = "";
	var Header = "";
	var HTML = "";
	
	vehicleId = $(this).attr('value');
	console.log(vehicleId);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"vehicle/fetch_single_join?id="+vehicleId,
		success: function(data, result){
			console.log(data);
			
			Header = 'License Plate No: '+data[0].license_plate_no;
			console.log(Header);
			if(data[0].is_active_vhcl_details  == 1){
				is_active_vhcl_details  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_vhcl_details  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="license_plate_no">License Plate No: </label></th>'+
						  '<td>'+data[0].license_plate_no+'</td>'+
						  '<td><label for="branch_id">Branch: </label></td>'+
						  '<td>'+data[0].company_branch_name+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_yom">YOM: </label></th>'+
						  '<td>'+data[0].vehicle_yom+'</td>'+
						  '<td><label for="chasis_no">Chasis No: </label></td>'+
						  '<td>'+data[0].chasis_no+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_type_id">Vehicle Type: </label></th>'+
						  '<td >'+data[0].vehicle_type_name+'</td>'+
						  '<td><label for="vehicle_category_id">Vehicle Category: </label></td>'+
						  '<td >'+data[0].vehicle_category_name+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="engine_no">Engine No.: </label></th>'+
						  '<td colspan="">'+data[0].engine_no+'</td>'+
						  '<td><label for="number_of_passengers">No. of Passengers: </label></td>'+
						  '<td colspan="">'+data[0].number_of_passengers+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="max_load">Max Load (Kg): </label></th>'+
						  '<td>'+data[0].max_load+'</td>'+
						  '<td><label for="max_load">Status: </label></td>'+
						  '<td>'+is_active_vhcl_details+'</td>'+
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