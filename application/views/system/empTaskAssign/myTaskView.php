
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
				<h3 class="card-title">My Daily Task Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'EmpTaskAssign/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Assign Task
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
								<th>Task Name</th>
								<th>Branch</th>
								<th>Employee</th>
								<th>Order Id</th>
								<th>Order type</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Status</th>
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
		url: API+"EmpTaskAssign/fetch_all_daily_task_join/",
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
					var is_active_sp_task_assign  ='';
					if(item.is_active_sp_task_assign  == 1){
						is_active_sp_task_assign  = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_sp_task_assign  = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					var is_complete  ='';
					if(item.is_complete  == 1){
						is_complete  = '<span class="right badge badge-success">Complete</span>';
					}
					else{
						is_complete  = '<span class="right badge badge-danger">Not Complete</span>';
					}
					
					
					table.row.add([item.assign_emp_line_id ,
					item.task_name,					
					item.company_branch_name,
					item.emp_epf+' - '+item.emp_first_name,
					item.invoice_id,
					item.order_type,
					item.task_start_date,
					item.task_end_date,					
					is_active_sp_task_assign ,
					is_complete,
					'<?php if($this->session->userdata('sys_user_group_name') == "Staff" ){
							echo '<div class="btn-group margin"><a type="button" id="viewBtn" vehicleId="" class="btn btn-primary btn-sm viewBtn" order_type=""><i class="fa fa-eye"></i></a>';
							echo '<div class="btn-group margin"><a type="button" id="completeBtn" class="btn btn-success btn-sm completeBtn"><i class="far fa-calendar-check"></i></a>';
							//echo '<a type="button" id="skipBtn" href="" class="btn btn-danger btn-sm skipBtn"><i class="fa fa-share"></i></a></div>';
						}

					?>'
					//'<a type="button" id="editBtn" href="<?php echo base_url() ?>branch/edit/'+item.company_branch_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> '
					]).columns.adjust().draw();	
					
					//table.columns.adjust().draw();

					//console.log($(".editBtn").last());
					//$(".skipBtn").last().attr('value', item.assign_emp_line_id );
					$(".completeBtn").last().attr('value', item.assign_emp_line_id );
					$(".viewBtn").last().attr('value', item.assign_emp_line_id );
					$(".viewBtn").last().attr('order_type', item.order_type );
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

	var assign_emp_line_id = "";
	var order_type = "";
	var Header = "";
	var HTML = "";
	
	assign_emp_line_id = $(this).attr('value');
	order_type = $(this).attr('order_type');
	console.log(order_type);
	
	if(order_type == 'Retail'){
		$.ajax({
			type: "GET",
			cache : false,
			async: true,
			dataType: "json",
			contentType: 'application/json',
			url: API+"EmpSpecialTask/fetch_single_join?id="+assign_emp_line_id,
			success: function(data, result){
				console.log(data);
				
				Header = 'Task Name: '+data[0].task_name;
				console.log(Header);
				if(data[0].is_active_sp_task  == 1){
					is_active_sp_task  = '<span class="right badge badge-success">Active</span>';
				}
				else{
					is_active_sp_task  = '<span class="right badge badge-danger">Inactive</span>';
				}
				
				HTML ='<table class="table table-borderless">'+					  
						  '<tbody>'+
							'<tr>'+
							  '<th><label for="license_plate_no">Task Id: </label></th>'+
							  '<td>'+data[0].special_task_id+'</td>'+
							  '<td><label for="branch_id">Name: </label></td>'+
							  '<td>'+data[0].task_name+'</td>'+
							'</tr>'+
							'<tr>'+
							  '<th><label for="vehicle_yom">Type: </label></th>'+
							  '<td>'+data[0].task_type+'</td>'+
							  '<td><label for="max_load">Status: </label></td>'+
							  '<td>'+is_active_sp_task+'</td>'+
							'</tr>'+
						  '</tbody>'+
						'</table>';
						
			
			$('#modalInfoHeader').html(Header);
			$('#modalInfoBody').html(HTML);
			$('#modalInfo').modal('show');
					
			}
		});
	}
	else if(order_type == 'Rental'){
		$.ajax({
			type: "GET",
			cache : false,
			async: true,
			dataType: "json",
			contentType: 'application/json',
			url: API+"EmpSpecialTask/fetch_single_join?id="+assign_emp_line_id,
			success: function(data, result){
				console.log(data);
				
				Header = 'Task Name: '+data[0].task_name;
				console.log(Header);
				if(data[0].is_active_sp_task  == 1){
					is_active_sp_task  = '<span class="right badge badge-success">Active</span>';
				}
				else{
					is_active_sp_task  = '<span class="right badge badge-danger">Inactive</span>';
				}
				
				HTML ='<table class="table table-borderless">'+					  
						  '<tbody>'+
							'<tr>'+
							  '<th><label for="license_plate_no">Task Id: </label></th>'+
							  '<td>'+data[0].special_task_id+'</td>'+
							  '<td><label for="branch_id">Name: </label></td>'+
							  '<td>'+data[0].task_name+'</td>'+
							'</tr>'+
							'<tr>'+
							  '<th><label for="vehicle_yom">Type: </label></th>'+
							  '<td>'+data[0].task_type+'</td>'+
							  '<td><label for="max_load">Status: </label></td>'+
							  '<td>'+is_active_sp_task+'</td>'+
							'</tr>'+
						  '</tbody>'+
						'</table>';
						
			
			$('#modalInfoHeader').html(Header);
			$('#modalInfoBody').html(HTML);
			$('#modalInfo').modal('show');
					
			}
		});
	}
	else if(order_type == 'Online'){
		$.ajax({
			type: "GET",
			cache : false,
			async: true,
			dataType: "json",
			contentType: 'application/json',
			url: API+"EmpSpecialTask/fetch_single_join?id="+assign_emp_line_id,
			success: function(data, result){
				console.log(data);
				
				Header = 'Task Name: '+data[0].task_name;
				console.log(Header);
				if(data[0].is_active_sp_task  == 1){
					is_active_sp_task  = '<span class="right badge badge-success">Active</span>';
				}
				else{
					is_active_sp_task  = '<span class="right badge badge-danger">Inactive</span>';
				}
				
				HTML ='<table class="table table-borderless">'+					  
						  '<tbody>'+
							'<tr>'+
							  '<th><label for="license_plate_no">Task Id: </label></th>'+
							  '<td>'+data[0].special_task_id+'</td>'+
							  '<td><label for="branch_id">Name: </label></td>'+
							  '<td>'+data[0].task_name+'</td>'+
							'</tr>'+
							'<tr>'+
							  '<th><label for="vehicle_yom">Type: </label></th>'+
							  '<td>'+data[0].task_type+'</td>'+
							  '<td><label for="max_load">Status: </label></td>'+
							  '<td>'+is_active_sp_task+'</td>'+
							'</tr>'+
						  '</tbody>'+
						'</table>';
						
			
			$('#modalInfoHeader').html(Header);
			$('#modalInfoBody').html(HTML);
			$('#modalInfo').modal('show');
					
			}
		});
	}
	
	
	
	
})

</script>