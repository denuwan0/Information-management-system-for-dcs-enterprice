<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Vehicle Type Details</h3>
				<div style="text-align: right;">
					<a type="button" href="<?php echo base_url() ?>vehicleType/create" class="btn text-dark btn-default btn-sm">
						<i class="nav-icon far fa-plus-square"></i> Add Vehicle Type
					</a>
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped">
						<thead id="thead">
							<tr>
								<th>id</th>
								<th>Type Name</th>
								<th>Type description</th>
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
		url: API+"vehicleType/",
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {
				var table = $('#data').DataTable(); 
				
				$.each(data, function (i, item) {
					//console.log(item);
					var is_active_vhcl_type ='';
					if(item.is_active_vhcl_type == 1){
						is_active_vhcl_type = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_vhcl_type = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					
					table.row.add([item.vehicle_type_id,
					item.vehicle_type_name,
					item.vehicle_type_decs,
					is_active_vhcl_type,
					'<a type="button" id="editBtn" href="<?php echo base_url() ?>vehicleType/edit/'+item.vehicle_type_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> ']).draw();				
				});
							
			});
			

			
						
			
					
			
			
			/* $('#name').autocomplete({
				lookup: data,
				onSelect: function (suggestion) {					  
					country_id = suggestion.data;
					$('#id').val(suggestion.data);
					$('#name').val(suggestion.value);
					$('#description').val(suggestion.country_desc);
					if(suggestion.is_active == 1){
						$('#is_active').prop('checked', true);
					}
				}
			}); */
				
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			console.log(textStatus);					
		}
	});
};

loadData();


</script>