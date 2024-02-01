
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
				<h3 class="card-title">Employee Work Contract Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'EmpWorkContract/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Add Work Contract
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
								<th>Epf</th>
								<th>Name</th>
								<th>Grade</th>
								<th>Branch</th>
								<th>Company</th>
								<th>Designation</th>
								<th>Work Schedule</th>
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
		url: API+"EmpWorkContract/fetch_all_join/",
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
					var is_active_emp_work_cont  ='';
					if(item.is_active_emp_work_cont  == 1){
						is_active_emp_work_cont  = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_emp_work_cont  = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					
					table.row.add([item.work_contract_id,
					item.emp_epf,
					item.emp_first_name, 					
					item.emp_grade_name,
					item.company_branch_name,
					item.company_name,
					item.emp_desig_name,
					item.ws_name,
					is_active_emp_work_cont ,
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
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>EmpWorkContract/edit/'+item.work_contract_id);
					$(".viewBtn").last().attr('value', item.work_contract_id);
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

	var work_contract_id = "";
	var Header = "";
	var HTML = "";
	
	work_contract_id = $(this).attr('value');
	console.log(work_contract_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"EmpWorkContract/fetch_single_join?id="+work_contract_id,
		success: function(data, result){
			console.log(data);
			
			Header = 'Work Contract Id: '+data[0].work_contract_id;
			console.log(Header);
			if(data[0].is_active_emp_work_cont  == 1){
				is_active_emp_work_cont  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_emp_work_cont  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="license_plate_no">Epf: </label></th>'+
						  '<td>'+data[0].emp_epf+'</td>'+
						  '<td><label for="branch_id">Name: </label></td>'+
						  '<td>'+data[0].emp_first_name+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_yom">Grade: </label></th>'+
						  '<td>'+data[0].emp_grade_name+'</td>'+
						  '<td><label for="chasis_no">Branch: </label></td>'+
						  '<td>'+data[0].company_branch_name+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_type_id">Company: </label></th>'+
						  '<td >'+data[0].company_name+'</td>'+
						  '<th><label for="engine_no">Designation: </label></th>'+
						  '<td colspan="">'+data[0].emp_desig_name+'</td>'+
						'</tr>'+
						'<tr>'+						  
						  '<td><label for="number_of_passengers">Work Schedule: </label></td>'+
						  '<td colspan="">'+data[0].ws_name+'</td>'+
						   '<td><label for="max_load">Status: </label></td>'+
						  '<td>'+is_active_emp_work_cont+'</td>'+
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