<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Bank Account Details</h3>
				<div style="text-align: right;">
					<a type="button" href="<?php echo base_url() ?>bankacc/create" class="btn text-dark btn-default btn-sm">
						<i class="nav-icon far fa-plus-square"></i> Add Bank Account
					</a>
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped" style="width:100%">
						<thead id="thead">
							<tr>
								<th>id</th>
								<th>Account No.</th>
								<th>Account Name</th>
								<th>Bank Name</th>
								<th>Branch Name</th>
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
		url: API+"bankAcc/fetch_all_join/",
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
					var is_active_bank_acc ='';
					if(item.is_active_bank_acc == 1){
						is_active_bank_acc = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_bank_acc = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					
					table.row.add([item.account_id,
					item.account_no,
					item.account_name,
					item.bank_name,
					item.b_branch_code,					 					
					item.contact_no,
					is_active_bank_acc,
					'<a type="button" id="editBtn" href="<?php echo base_url() ?>bankAcc/edit/'+item.account_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> ']
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