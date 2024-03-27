
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
				<h3 class="card-title">Task Assign Details</h3>
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
								<th>Task status</th>
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
		url: API+"EmpTaskAssign/fetch_all_join/",
		success: function(data, result){
			//console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {
				var table = $('#data').DataTable({
					"scrollX": true					
				}); 
							
				
				$.each(data, function (i, item) {
					console.log(item);
					var is_active_sp_task_assign  ='';
					var task_comp_skip  ='';
					
					if(item.is_complete  == 1){
						task_comp_skip  = '<span class="right badge badge-success">Complete</span>';
					}					
					if(item.is_skipped  == 1){
						task_comp_skip  = '<span class="right badge badge-danger">Skipped</span>';
					}
					else{
						task_comp_skip  = '<span class="right badge badge-danger">Not Complete</span>';
					}
					
					if(item.is_active_sp_task_assign  == 1){
						is_active_sp_task_assign  = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_sp_task_assign  = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					
					//console.log(task_comp_skip);
					
					table.row.add([item.assign_emp_line_id,
					item.task_name,					
					item.company_branch_name,
					item.emp_epf+' - '+item.emp_first_name,
					item.invoice_id,
					item.order_type,
					item.task_start_date,
					item.task_end_date,
					task_comp_skip,
					is_active_sp_task_assign ,
					'<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							echo '<div class="btn-group margin"><a style="display:none" type="button" id="viewBtn" vehicleId="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							echo '<a style="display:block" type="button" id="inactiveBtn" vehicleId=""  class="btn btn-danger btn-sm inactiveBtn"><i class="fa fa-ban"></i></a>';
							echo '<a style="display:none" type="button" id="editBtn" vehicleId=""  class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
						}
						else{
							echo '<a style="display:none" type="button" id="viewBtn" vehicleId="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
						}

					?>'
					//'<a type="button" id="editBtn" href="<?php echo base_url() ?>branch/edit/'+item.company_branch_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> '
					]).columns.adjust().draw();	
					
					//table.columns.adjust().draw();

					//console.log($(".editBtn").last());
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>EmpSpecialTask/edit/'+item.assign_emp_line_id);
					$(".viewBtn").last().attr('value', item.assign_emp_line_id);
					$(".inactiveBtn").last().attr('value', item.assign_emp_line_id);
					$(".inactiveBtn").last().attr('order_type', item.order_type );
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

	var special_task_id = "";
	var Header = "";
	var HTML = "";
	
	special_task_id = $(this).attr('value');
	console.log(special_task_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"EmpSpecialTask/fetch_single_join?id="+special_task_id,
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
	
	
})

$(document).on('click','.inactiveBtn', function(){

	var assign_emp_line_id = "";
	var order_type = '';
	var Header = "";
	var HTML = "";
	
	assign_emp_line_id = $(this).attr('value');
	order_type = $(this).attr('order_type');
	console.log(assign_emp_line_id);
	
	var formData = new FormData();
	formData.append('assign_emp_line_id',assign_emp_line_id);
	formData.append('is_active_sp_task_assign',0);
	formData.append('order_type',order_type);
	
	$.ajax({
		type: "POST",
		//enctype: 'multipart/form-data',
		cache : false,
		async: true,
		dataType: "json",
		processData: false,
		contentType: false,
		data: formData,	
		url: API+"EmpTaskAssign/updateInactive",
		success: function(data, result){
			console.log(data);
			
			const notyf = new Notyf();	
			if(data['message'] == 'Changes Updated!'){
				notyf.success({
				  message: data['message'],
				  duration: 5000,
				  icon: true,
				  ripple: true,
				  dismissible: true,
				  position: {
					x: 'right',
					y: 'top',
				  }
				  
				})
				window.setTimeout(function() {
					window.location = "<?php echo base_url() ?>EmpTaskAssign/view";
				}, 3000);
			}	
				
		}
	});
	
	
})

</script>