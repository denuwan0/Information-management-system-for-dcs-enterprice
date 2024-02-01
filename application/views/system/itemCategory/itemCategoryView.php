<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Item Category Details</h3>
				<div style="text-align: right;">
					<a type="button" href="<?php echo base_url() ?>itemCategory/create" class="btn text-dark btn-default btn-sm">
						<i class="nav-icon far fa-plus-square"></i> Add Item Category
					</a>
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped">
						<thead id="thead">
							<tr>
								<th>id</th>
								<th>Category Name</th>
								<th>Description</th>
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


var item_category_id = 0;
function loadData() {
	
		
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"itemCategory/",
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {
				var table = $('#data').DataTable(); 
				
				$.each(data, function (i, item) {
					//console.log(item);
					var is_active_inv_item_cat ='';
					if(item.is_active_inv_item_cat == 1){
						is_active_inv_item_cat = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_inv_item_cat = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					
					table.row.add([item.item_category_id,
					item.category_name,
					item.description,
					is_active_inv_item_cat,
					'<a type="button" id="editBtn" href="<?php echo base_url() ?>itemCategory/edit/'+item.item_category_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> ']).draw();				
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