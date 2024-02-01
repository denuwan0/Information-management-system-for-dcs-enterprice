
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
				<h3 class="card-title">System User Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'user/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Create User
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
								<th>Username.</th>
								<th>User Group</th>
								<th>Is Customer</th>
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

function loadData() {
	
		
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"sysuser/fetch_all_join/",
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
					var is_active_sys_user ='';
					if(item.is_active_sys_user == 1){
						is_active_sys_user = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_sys_user = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					var is_customer ='';
					if(item.is_customer == 1){
						is_customer = '<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_customer = '<span class="right badge badge-danger">No</span>';
					}
					
					
					
					
					table.row.add([item.user_id,
					item.username,
					item.sys_user_group_name, 
					is_customer,
					is_active_sys_user,
					'<?php if($this->session->userdata('sys_user_group_name') == "Admin" ){
							echo '<div class="btn-group margin"><a type="button" id="viewBtn"  class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							echo '<a type="button" id="editBtn"  href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
						}
						else{
							echo '<a type="button" id="viewBtn"  class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
						}

					?>'
					
					]
					).columns.adjust().draw();	

					$(".editBtn").last().attr('href', '<?php echo base_url() ?>user/edit/'+item.user_id);
					$(".viewBtn").last().attr('value', item.user_id);
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

	var user_id = "";
	var Header = "";
	var HTML = "";
	
	user_id = $(this).attr('value');
	console.log(user_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"sysuser/fetch_single_join?id="+user_id,
		success: function(data, result){
			console.log(data);
			
			Header = 'System User Id: '+data[0].user_id;
			console.log(Header);
			if(data[0].is_active_sys_user  == 1){
				is_active_sys_user  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_sys_user  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			if(data[0].is_customer  == 1){
				is_customer  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_customer  = '<span class="right badge badge-danger">No</span>';
			}
			
			
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="license_plate_no">Username: </label></th>'+
						  '<td>'+data[0].username+'</td>'+
						  '<td><label for="branch_id">User Group: </label></td>'+
						  '<td>'+data[0].sys_user_group_name+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="max_load">Is Customer: </label></th>'+
						  '<td>'+is_customer+'</td>'+
						  '<td><label for="max_load">Status: </label></td>'+
						  '<td>'+is_active_sys_user+'</td>'+
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