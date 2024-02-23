
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
				<h3 class="card-title">Driving License Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'EmpDrivingLicense/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Add License
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
								<th>Employee</th>
								<th>License No.</th>
								<th>Valid from</th>
								<th>Valid to</th>
								<th>Vehicle Category</th>
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
		url: API+"EmpDrivingLicense/fetch_all_join",
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
					var is_active_driving_lice  ='';
					if(item.is_active_driving_lice  == 1){
						is_active_driving_lice  = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_driving_lice  = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					
					table.row.add([item.driving_license_id,
					item.emp_epf+' - '+item.emp_first_name,	
					item.license_number,
					item.valid_from_date, 					
					item.valid_to_date,
					item.license_type,
					is_active_driving_lice ,
					'<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							echo '<div class="btn-group margin"><a type="button" id="viewBtn"  class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							echo '<a type="button" id="editBtn"  href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
						}
						else{
							echo '<a type="button" id="viewBtn" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
						}

					?>'
					
					]).columns.adjust().draw();	
					
					//table.columns.adjust().draw();
					console.log($(".viewBtn").last());

					//console.log($(".editBtn").last());
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>EmpDrivingLicense/edit/'+item.driving_license_id);
					$(".viewBtn").last().attr('value', item.driving_license_id);
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

	var driving_license_id = "";
	var Header = "";
	var HTML = "";
	
	driving_license_id = $(this).attr('value');
	console.log(driving_license_id);
	
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"EmpDrivingLicense/fetch_single?id="+driving_license_id,
		success: function(data, result){
			console.log(data);
			
			Header = 'License No: '+data[0].license_number;
			console.log(Header);
			if(data[0].is_active_driving_lice  == 1){
				is_active_driving_lice  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_driving_lice  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="license_plate_no">License No: </label></th>'+
						  '<td>'+data[0].license_number+'</td>'+
						  '<td><label for="branch_id">Vehicle type: </label></td>'+
						  '<td>'+data[0].license_type+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_yom">Valid from: </label></th>'+
						  '<td>'+data[0].valid_from_date+'</td>'+
						  '<td><label for="chasis_no">Valid to: </label></td>'+
						  '<td>'+data[0].valid_to_date+'</td>'+
						'</tr>'+						
						'<tr>'+
						  '<td><label for="max_load">Status: </label></td>'+
						  '<td>'+is_active_driving_lice+'</td>'+
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