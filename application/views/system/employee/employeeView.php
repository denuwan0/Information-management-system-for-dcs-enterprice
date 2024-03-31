
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
				<h3 class="card-title">Employee Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'Employee/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Add Employee
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
								<th>Epf No.</th>
								<th>Branch</th>
								<th>Company</th>
								<th>First Name</th>
								<th>Last Name</th>
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
		url: API+"Employee/fetch_all_join/",
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
					var is_active_emp  ='';
					if(item.is_active_emp  == 1){
						is_active_emp  = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_emp  = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					
					
					table.row.add([item.emp_id,
					item.emp_epf,
					(item.company_branch_name == null ? 'All' : item.company_branch_name) , 					
					item.company_name,
					item.emp_first_name,
					item.emp_last_name,
					is_active_emp ,
					'<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							echo '<div class="btn-group margin"><a type="button" id="viewBtn" emp_id="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							echo '<a type="button" id="editBtn" emp_id="" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
						}
						else{
							echo '<a type="button" id="viewBtn" emp_id="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
						}

					?>'
					//'<a type="button" id="editBtn" href="<?php echo base_url() ?>branch/edit/'+item.company_branch_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> '
					]).columns.adjust().draw();	
					
					//table.columns.adjust().draw();

					//console.log($(".editBtn").last());
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>employee/edit/'+item.emp_id);
					$(".viewBtn").last().attr('value', item.emp_id);
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

	var emp_id  = "";
	var Header = "";
	var HTML = "";
	
	emp_id  = $(this).attr('value');
	console.log(emp_id );
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"employee/fetch_single_join?id="+emp_id ,
		success: function(data, result){
			console.log(data);
			
			Header = 'Epf No: '+data[0].emp_epf;
			console.log(Header);
			if(data[0].is_active_emp  == 1){
				is_active_emp  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_emp  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="emp_epf">Epf No: </label></th>'+
						  '<td>'+data[0].emp_epf+'</td>'+
						  '<td><label for="branch_id">Full Name: </label></td>'+
						  '<td>'+data[0].emp_first_name+' '+data[0].emp_middle_name+' '+data[0].emp_last_name+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="company_branch_name">Branch: </label></th>'+
						  '<td>'+data[0].company_branch_name+'</td>'+
						  '<td><label for="emp_nic_old">NIC No: </label></td>'+
						  '<td>'+data[0].emp_nic+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="emp_dob">Date of birth: </label></th>'+
						  '<td>'+data[0].emp_dob+'</td>'+
						  '<td><label for="emp_contact_no">Contact No: </label></td>'+
						  '<td >'+data[0].emp_contact_no+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="emp_perm_address">Permanent Address: </label></th>'+
						  '<td colspan="">'+data[0].emp_perm_address+'</td>'+
						  '<td><label for="emp_temp_address">Temporary Address: </label></td>'+
						  '<td colspan="">'+data[0].emp_temp_address+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="emp_email">Email: </label></th>'+
						  '<td>'+data[0].emp_email+'</td>'+
						  '<td><label for="emp_emg_contact_no">Emergency Contact: </label></td>'+
						  '<td>'+data[0].emp_emg_contact_no+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<td><label for="is_active_emp">Status: </label></td>'+
						  '<td>'+is_active_emp+'</td>'+
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