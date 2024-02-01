<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Stock Purchase Details</h3>
				<div style="text-align: right;">
					<a type="button" href="<?php echo base_url() ?>stock/create" class="btn text-dark btn-default btn-sm">
						<i class="nav-icon far fa-plus-square"></i> Add Stock Purchase
					</a>
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped">
						<thead id="thead">
							<tr>
								<th>Batch id</th>
								<th>Purchase Date</th>
								<th>Approved</th>
								<th>Allocated</th>
								<th>Active</th>
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


var bank_id = 0;
function loadData() {
	
		
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"stock/",
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {
				var table = $('#data').DataTable(); 
				
				$.each(data, function (i, item) {
					//console.log(item);
					var is_active_stock_purchase ='';
					if(item.is_active_stock_purchase == 1){
						is_active_stock_purchase = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_stock_purchase = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					var is_allocated_stock ='';
					if(item.is_allocated_stock == 1){
						is_allocated_stock = '<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_allocated_stock = '<span class="right badge badge-danger">No</span>';
					}
					
					var is_approved_stock ='';
					if(item.is_approved_stock == 1){
						is_approved_stock = '<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_approved_stock = '<span class="right badge badge-danger">No</span>';
					}
					
					
					table.row.add([item.stock_batch_id,
					item.stock_purchase_date,
					is_approved_stock,
					is_allocated_stock,
					is_active_stock_purchase,
					'<a type="button" id="editBtn" href="<?php echo base_url() ?>stock/edit/'+item.stock_batch_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> ']).draw();				
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