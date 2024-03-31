
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
				<h3 class="card-title">Attendance Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" ){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'EmpAttendance/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Upload Attendance
								</a>
								<a type="button" href="'.base_url().'EmpAttendance/approve" class="btn text-white btn-success btn-sm btn-outline-light">
									<i class="nav-icon far fa-check-square"></i> Approve Attendance
								</a>';
						}
						if($this->session->userdata('sys_user_group_name') == "Manager" ){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'EmpAttendance/approve" class="btn text-white btn-success btn-sm btn-outline-light">
									<i class="nav-icon far fa-check-square"></i> Approve Attendance
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
								<th>Branch</th>
								<th>Employee</th>
								<th>Date</th>
								<th>Time In</th>
								<th>Time Out</th>
								<th>Approved</th>
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
		url: API+"EmpAttendance/fetch_all_join/",
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {
				var table = $('#data').DataTable({
					"scrollX": true					
				}); 
							
				
				$.each(data, function (i, item) {
					//console.log(item.attendance_id);
					
					var is_approved  ='';
					if(item.is_approved  == 1){
						is_approved  = '<span class="right badge badge-success">Approved</span>';
					}
					else{
						is_approved  = '<span class="right badge badge-danger">Not Approved</span>';
					}
									
					table.row.add([item.attendance_id,
					item.company_branch_name,
					item.emp_epf,
					item.date, 					
					item.time_in,
					item.time_out,
					is_approved ,
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
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>EmpAttendance/edit/'+item.attendance_id);
					$(".viewBtn").last().attr('value', item.attendance_id);
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

	var attendance_id = "";
	var Header = "";
	var HTML = "";
	
	attendance_id = $(this).attr('value');
	console.log(attendance_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"EmpAttendance/fetch_single_join?id="+attendance_id,
		success: function(data, result){
			console.log(data);
			
			Header = 'Employee: '+data[0].emp_epf;
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
						  '<th><label for="license_plate_no">Epf: </label></th>'+
						  '<td>'+data[0].emp_epf+'</td>'+
						  '<td><label for="branch_id">Date: </label></td>'+
						  '<td>'+data[0].date+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_yom">Time In: </label></th>'+
						  '<td>'+data[0].time_in+'</td>'+
						  '<td><label for="chasis_no">Time Out: </label></td>'+
						  '<td>'+data[0].time_out+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_type_id">Upload by: </label></th>'+
						  '<td >'+data[0].uploaded_by+'</td>'+
						  '<td><label for="vehicle_category_id">Approved by: </label></td>'+
						  '<td >'+data[0].approved_by+'</td>'+
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