
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
				<h3 class="card-title">Employee Medical Record Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'EmpMedicalRecord/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Add Medical Record
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
								<th>Checkup date</th>
								<th>Medical Center</th>
								<th>Employee</th>
								<th>Overall Health</th>
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
		url: API+"EmpMedicalRecord/fetch_all_join/",
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
					
					var emp_med_status = "";
					
					if(item.emp_med_status  == 'good'){
						emp_med_status  = '<span class="right badge badge-success">Good</span>';
					}
					else if(item.emp_med_status  == 'moderate'){
						emp_med_status  = '<span class="right badge badge-warning">Moderate</span>';
					}
					else if(item.emp_med_status  == 'critical'){
						emp_med_status  = '<span class="right badge badge-danger">Critical</span>';
					}
					
					table.row.add([item.med_record_id,
					item.this_med_checkup_date,
					item.emp_med_loc_name, 					
					item.emp_epf+' - '+item.emp_first_name,
					emp_med_status,
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
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>EmpMedicalRecord/edit/'+item.med_record_id);
					$(".viewBtn").last().attr('value', item.med_record_id);
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

	var med_record_id = "";
	var Header = "";
	var HTML = "";
	
	med_record_id = $(this).attr('value');
	console.log(med_record_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"EmpMedicalRecord/fetch_single_join?id="+med_record_id,
		success: function(data, result){
			console.log(data);
			
			Header = 'Employee Epf: '+data[0].emp_epf;
			console.log(Header);
			if(data[0].is_active_medical_records  == 1){
				is_active_medical_records  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_medical_records  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			var emp_med_status = "";
					
			if(data[0].emp_med_status  == 'good'){
				emp_med_status  = '<span class="right badge badge-success">Good</span>';
			}
			else if(data[0].emp_med_status  == 'moderate'){
				emp_med_status  = '<span class="right badge badge-warning">Moderate</span>';
			}
			else if(data[0].emp_med_status  == 'critical'){
				emp_med_status  = '<span class="right badge badge-danger">Critical</span>';
			}
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="license_plate_no">Employee Epf: </label></th>'+
						  '<td>'+data[0].emp_epf+'</td>'+
						  '<td><label for="branch_id">Employee Name: </label></td>'+
						  '<td>'+data[0].emp_first_name+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_yom">This Checkup Date: </label></th>'+
						  '<td>'+data[0].this_med_checkup_date+'</td>'+
						  '<td><label for="chasis_no">Next Checkup Date: </label></td>'+
						  '<td>'+data[0].next_med_checkup_date+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_type_id">Medical Center: </label></th>'+
						  '<td >'+data[0].emp_med_loc_name+'</td>'+
						  '<td><label for="vehicle_category_id">Special Note: </label></td>'+
						  '<td >'+data[0].special_note+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="max_load">Overall Health: </label></th>'+
						  '<td>'+emp_med_status+'</td>'+
						  '<td><label for="max_load">Status: </label></td>'+
						  '<td>'+is_active_medical_records+'</td>'+
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