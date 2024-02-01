<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Item with Sub-Items Details</h3>
				<div style="text-align: right;">
					<a type="button" href="<?php echo base_url() ?>itemSubItem/create" class="btn text-dark btn-default btn-sm">
						<i class="nav-icon far fa-plus-square"></i> Add Sub-Items to Item
					</a>
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped">
						<thead id="thead">
							<tr>
								<th>Main Item</th>
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


var bank_id = 0;
function loadData() {
	
		
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"itemSubItem/fetch_all_join",
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {
				var table = $('#data').DataTable(); 
				
				$.each(data, function (i, item) {
					//console.log(item);
					var is_active_item_sub_item ='';
					if(item.is_active_item_sub_item == 1){
						is_active_item_sub_item = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_item_sub_item = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					table.row.add([item.item_name,
					is_active_item_sub_item,
					'<a type="button" id="editBtn" href="<?php echo base_url() ?>itemSubItem/edit/'+item.main_item_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> ']).draw();				
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