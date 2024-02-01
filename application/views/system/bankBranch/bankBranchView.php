<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Bank Branch Details</h3>
				<div style="text-align: right;">
					<a type="button" href="<?php echo base_url() ?>bankbranch/create" class="btn text-dark btn-default btn-sm">
						<i class="nav-icon far fa-plus-square"></i> Add Bank Branch
					</a>
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped" style="width:100%">
						<thead id="thead">
							<tr>
								<th>id</th>
								<th>Branch Code</th>
								<th>Swift Code</th>
								<th>Bank Name</th>
								<th>Location</th>
								<th>Address</th>
								<th>Contact</th>								
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
		url: API+"bankBranch/fetch_all_join/",
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
					var is_active_bank_b_branch ='';
					if(item.is_active_bank_b_branch == 1){
						is_active_bank_b_branch = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_bank_b_branch = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					
					table.row.add([item.b_branch_id,
					item.b_branch_code,
					item.b_bank_swift_code, 					
					item.bank_name,
					item.location_name,
					item.b_branch_address,
					item.b_branch_contact,
					is_active_bank_b_branch,
					'<a type="button" id="editBtn" href="<?php echo base_url() ?>bankBranch/edit/'+item.b_branch_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> ']
					).columns.adjust().draw();					
				});
							
			});
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			console.log(textStatus);					
		}
	});
};

loadData();


</script>