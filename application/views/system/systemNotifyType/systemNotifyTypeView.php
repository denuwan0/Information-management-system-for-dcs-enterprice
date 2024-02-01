<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Notify Type Details</h3>
				<div style="text-align: right;">
					<a type="button" href="<?php echo base_url() ?>SystemNotifyType/create" class="btn text-dark btn-default btn-sm">
						<i class="nav-icon far fa-plus-square"></i> Add Notify Type
					</a>
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped" style="width:100%">
						<thead id="thead">
							<tr>
								<th>id</th>
								<th>Name</th>
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


var sys_notify_id = 0;
function loadData() {
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"SysNotifyType/",
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
					var is_active_sys_notify_type ='';
					if(item.is_active_sys_notify_type == 1){
						is_active_sys_notify_type = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_sys_notify_type = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					
					table.row.add([item.sys_notify_type_id  ,
					item.notify_name,
					is_active_sys_notify_type,
					'<a type="button" id="editBtn" href="<?php echo base_url() ?>SystemNotifyType/edit/'+item.sys_notify_type_id  +'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> ']
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