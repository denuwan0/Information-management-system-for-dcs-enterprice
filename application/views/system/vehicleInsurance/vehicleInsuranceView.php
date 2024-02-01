
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
				<h3 class="card-title">Vehicle Insurance Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'vehicleInsurance/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Add Vehicle Insurance
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
								<th>Insurance Company</th>
								<th>Insurance Type</th>
								<th>Valid from</th>
								<th>Valid to</th>
								<th>Premium Amount</th>
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
		url: API+"vehicleInsurance/fetch_all_join/",
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
					var is_active_vhcl_ins_details  ='';
					
					
					if(item.is_active_vhcl_ins_details  == 1){
						is_active_vhcl_ins_details  = '<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_active_vhcl_ins_details  = '<span class="right badge badge-danger">No</span>';
					}
					
					
					table.row.add([item.insuar_detail_id,
					item.license_plate_no,
					item.insuar_comp_name,
					item.insuar_type, 					
					item.valid_from_date,
					item.valid_to_date,
					item.premimum_amount,
					is_active_vhcl_ins_details,
					'<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							echo '<div class="btn-group margin"><a type="button" id="viewBtn"  class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							echo '<a type="button" id="editBtn"  href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
						}
						else{
							echo '<a type="button" id="viewBtn"  class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
						}

					?>'
					//'<a type="button" id="editBtn" href="<?php echo base_url() ?>branch/edit/'+item.company_branch_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> '
					]).columns.adjust().draw();	
					
					//table.columns.adjust().draw();

					//console.log($(".editBtn").last());
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>vehicleInsurance/edit/'+item.insuar_detail_id);
					$(".viewBtn").last().attr('value', item.insuar_detail_id);
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

	var insuar_detail_id = "";
	var Header = "";
	var HTML = "";
	
	insuar_detail_id = $(this).attr('value');
	//console.log(repair_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"vehicleInsurance/fetch_single_join?id="+insuar_detail_id,
		success: function(data, result){
			console.log(data[0]);
			
			Header = 'Insurance/ Policy No: '+data[0].insuarance_number;
			console.log(Header);
			
			var is_active_vhcl_ins_details  ='';
						
			if(data[0].is_active_vhcl_ins_details  == 1){
				is_active_vhcl_ins_details  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_active_vhcl_ins_details  = '<span class="right badge badge-danger">No</span>';
			}
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="license_plate_no">Insurance Compay: </label></th>'+
						  '<td>'+data[0].insuar_comp_name+'</td>'+
						  '<th><label for="vehicle_yom">Insurance/ Policy No: </label></th>'+
						  '<td>'+data[0].insuarance_number+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<td><label for="chasis_no">Insurance Type: </label></td>'+
						  '<td>'+data[0].insuar_type+'</td>'+
						  '<td><label for="chasis_no">Vehicle No: </label></td>'+
						  '<td>'+data[0].license_plate_no+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_type_id">Valid from: </label></th>'+
						  '<td >'+data[0].valid_from_date+'</td>'+
						  '<td><label for="vehicle_category_id">Valid to: </label></td>'+
						  '<td >'+data[0].valid_to_date+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="engine_no">Premium Amount: </label></th>'+
						  '<td colspan="">'+data[0].premimum_amount+'</td>'+
						'</tr>'+
						'<tr>'+						 
						  '<td><label for="number_of_passengers">Active: </label></td>'+
						  '<td colspan="">'+is_active_vhcl_ins_details+'</td>'+
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