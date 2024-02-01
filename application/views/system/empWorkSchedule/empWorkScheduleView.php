
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
				<h3 class="card-title">Work Schedule Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'EmpWorkSchedule/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Add Work Schedule
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
								<th>Name</th>
								<th>Working Hrs</th>
								<th>In Time</th>
								<th>Out Time</th>
								<th>Flexible</th>
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
		url: API+"EmpWorkSchedule/fetch_all_join/",
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
					var is_active_work_schedule  ='';
					var is_flexible  ='';
					if(item.is_active_work_schedule  == 1){
						is_active_work_schedule  = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_work_schedule  = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					if(item.is_flexible  == 1){
						is_flexible  = '<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_flexible  = '<span class="right badge badge-danger">No</span>';
					}
					
					
					table.row.add([item.ws_id,
					item.ws_name,
					item.working_hours_per_day, 					
					item.in_time,
					item.out_time,
					is_flexible ,
					is_active_work_schedule ,
					'<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							echo '<div class="btn-group margin"><a type="button" id="viewBtn" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							echo '<a type="button" id="editBtn" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
						}
						else{
							echo '<a type="button" id="viewBtn" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
						}

					?>'
					//'<a type="button" id="editBtn" href="<?php echo base_url() ?>branch/edit/'+item.company_branch_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> '
					]).columns.adjust().draw();	
					
					//table.columns.adjust().draw();

					//console.log($(".editBtn").last());
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>EmpWorkSchedule/edit/'+item.ws_id);
					$(".viewBtn").last().attr('value', item.ws_id);
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

	var ws_id = "";
	var Header = "";
	var HTML = "";
	
	ws_id = $(this).attr('value');
	console.log(ws_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"EmpWorkSchedule/fetch_single_join?id="+ws_id,
		success: function(data, result){
			console.log(data);
			
			Header = 'Work Schedule: '+data[0].ws_name;
			console.log(Header);
			if(data[0].is_active_work_schedule  == 1){
				is_active_work_schedule  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_work_schedule  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			if(data[0].is_flexible  == 1){
				is_flexible  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_flexible  = '<span class="right badge badge-danger">No</span>';
			}
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="license_plate_no">Name: </label></th>'+
						  '<td>'+data[0].ws_name+'</td>'+
						  '<td><label for="branch_id">Working Hrs: </label></td>'+
						  '<td>'+data[0].working_hours_per_day+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_yom">In Time: </label></th>'+
						  '<td>'+data[0].in_time+'</td>'+
						  '<td><label for="chasis_no">Out Time: </label></td>'+
						  '<td>'+data[0].out_time+'</td>'+
						'</tr>'+						
						'<tr>'+
							'<td><label for="max_load">Flexible: </label></td>'+
						  '<td>'+is_flexible+'</td>'+
						  '<td><label for="max_load">Status: </label></td>'+
						  '<td>'+is_active_work_schedule+'</td>'+
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