
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
				<h3 class="card-title">Emplyee wise Leave Quota Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" ){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'EmpWiseLeaveQuota/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Add Leave Quota to Employee/s
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
								<th>Year</th>
								<th>Leave Quota</th>
								<th>Employee</th>
								<th>Total Leaves</th>
								<th>Occupied Leaves</th>
								<th>Balance Leaves</th>
								<th>Hold</th>
								<th>Active</th>
								<!--th>Option</th-->
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
		url: API+"EmpWiseLeaveQuota/fetch_all_join",
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {
				var table = $('#data').DataTable({
					"scrollX": true					
				}); 
							
				
				$.each(data, function (i, item) {
					console.log(item);
					var is_active_emp_wise_leave_quota  ='';
					var is_hold_emp_wise_leave_quota = '';
					if(item.is_active_emp_wise_leave_quota  == 1){
						is_active_emp_wise_leave_quota  = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_emp_wise_leave_quota  = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					if(item.is_hold_emp_wise_leave_quota  == 1){
						is_hold_emp_wise_leave_quota  = '<span class="right badge badge-danger">Hold</span>';
					}
					else{
						is_hold_emp_wise_leave_quota  = '<span class="right badge badge-success">Released</span>';
					}
					
					
					table.row.add([item.emp_wise_leave_quota_id,
					item.year,
					item.leave_type_name,
					item.emp_epf+' - '+item.emp_first_name,
					item.amount,
					(item.amount - item.balance_leave_quota),
					item.balance_leave_quota,
					is_hold_emp_wise_leave_quota,
					is_active_emp_wise_leave_quota ,
					'<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//echo '<div class="btn-group margin"><a type="button" id="viewBtn"  class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							//echo '<a type="button" id="editBtn" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
						}
						else{
							//echo '<a type="button" id="viewBtn" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
						}

					?>'
					//'<a type="button" id="editBtn" href="<?php echo base_url() ?>branch/edit/'+item.company_branch_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> '
					]).columns.adjust().draw();	
					
					//table.columns.adjust().draw();

					//console.log($(".editBtn").last());
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>EmpWiseLeaveQuota/edit/'+item.emp_wise_leave_quota_id);
					$(".viewBtn").last().attr('value', item.emp_wise_leave_quota_id);
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

	var leave_quota_id = "";
	var Header = "";
	var HTML = "";
	
	leave_quota_id = $(this).attr('value');
	console.log(leave_quota_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"EmpLeaveQuota/fetch_single_join?id="+leave_quota_id,
		success: function(data, result){
			console.log(data);
			
			Header = 'Leave Quota Id: '+data[0].leave_quota_id;
			console.log(Header);
			if(data[0].is_active_leave_quota  == 1){
				is_active_leave_quota  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_leave_quota  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			if(data[0].is_hold_emp_wise_leave_quota  == 1){
				is_hold_emp_wise_leave_quota  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_hold_emp_wise_leave_quota  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="license_plate_no">Quota Id: </label></th>'+
						  '<td>'+data[0].leave_quota_id+'</td>'+
						  '<td><label for="branch_id">Year: </label></td>'+
						  '<td>'+data[0].year+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_yom">Leave Type: </label></th>'+
						  '<td>'+data[0].leave_type_name+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<td><label for="max_load">Hold: </label></td>'+
						  '<td>'+is_hold_emp_wise_leave_quota+'</td>'+
						   '<td><label for="max_load">Active: </label></td>'+
						  '<td>'+is_active_leave_quota+'</td>'+
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