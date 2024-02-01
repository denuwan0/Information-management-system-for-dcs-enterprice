<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Holiday Types Details</h3>
				<div style="text-align: right;">
					<a type="button" href="<?php echo base_url() ?>holidayTypes/create" class="btn text-dark btn-default btn-sm">
						<i class="nav-icon far fa-plus-square"></i> Add Holiday Type
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


var country_id = 0;
function loadData() {
	
		
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"HolidayType/",
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
					var is_active_holiday_type ='';
					if(item.is_active_holiday_type == 1){
						is_active_holiday_type = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_holiday_type = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					
					table.row.add([item.holiday_type_id,
					item.holiday_type_name, 
					item.holiday_type_desc,
					is_active_holiday_type,
					'<a type="button" id="editBtn" href="<?php echo base_url() ?>holidayTypes/edit/'+item.holiday_type_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> ']
					).columns.adjust().draw();				
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