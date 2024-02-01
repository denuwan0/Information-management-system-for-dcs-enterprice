
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
				<h3 class="card-title">Eco Test Details</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'VehicleEcoTest/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Add Vehicle
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
								<th>Eco Test No.</th>
								<th>Vehicle No.</th>
								<th>Valid From</th>
								<th>Valid To</th>
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
		url: API+"VehicleEcoTest/fetch_all_join/",
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
					var is_active_vhcl_eco_test  ='';
					if(item.is_active_vhcl_eco_test  == 1){
						is_active_vhcl_eco_test  = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_vhcl_eco_test  = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					
					table.row.add([item.eco_test_id,
					item.eco_test_number,
					item.license_plate_no, 					
					item.valid_from_date,
					item.valid_to_date,
					is_active_vhcl_eco_test ,
					'<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							echo '<div class="btn-group margin"><a type="button" id="viewBtn" eco_test_id="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							echo '<a type="button" id="editBtn" eco_test_id="" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
						}
						else{
							echo '<a type="button" id="viewBtn" eco_test_id="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
						}

					?>'
					//'<a type="button" id="editBtn" href="<?php echo base_url() ?>branch/edit/'+item.company_branch_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> '
					]).columns.adjust().draw();	
					
					//table.columns.adjust().draw();

					//console.log($(".editBtn").last());
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>VehicleEcoTest/edit/'+item.eco_test_id);
					$(".viewBtn").last().attr('value', item.eco_test_id);
					//$(".editBtn").last().attr('eco_test_id',item.eco_test_id);					
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

	var eco_test_id = "";
	var Header = "";
	var HTML = "";
	
	eco_test_id = $(this).attr('value');
	console.log(eco_test_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"VehicleEcoTest/fetch_single_join?id="+eco_test_id,
		success: function(data, result){
			console.log(data);
			
			Header = 'Eco Test No: '+data[0].eco_test_number;
			console.log(Header);
			if(data[0].is_active_vhcl_eco_test  == 1){
				is_active_vhcl_eco_test  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_vhcl_eco_test  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<td><label for="eco_test_number">Eco Test No: </label></td>'+
						  '<td>'+data[0].eco_test_number+'</td>'+
						  '<th><label for="license_plate_no">License Plate No: </label></th>'+
						  '<td>'+data[0].license_plate_no+'</td>'+						 
						'</tr>'+
						'<tr>'+
						  '<th><label for="valid_from_date">Valid from: </label></th>'+
						  '<td>'+data[0].valid_from_date+'</td>'+
						  '<td><label for="valid_to_date">Valid to: </label></td>'+
						  '<td>'+data[0].valid_to_date+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<td><label for="is_active_vhcl_eco_test">Status: </label></td>'+
						  '<td>'+is_active_vhcl_eco_test+'</td>'+
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