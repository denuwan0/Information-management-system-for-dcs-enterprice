<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Item with Sub-Items Details</h3>
			</div>

			<form id="form">
				<div class="card-body">
					<div class="form-row">
						<div class="col-md-6 mb-3">
							<label for="name">Name</label>
							<select class="form-control" id="main_item_id" name="main_item_id" required>
								</select>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-sm-12 mb-3">
							<table class="table table-bordered">
							  <thead>
								<tr>
								  <th style="width: 10px">#</th>
								  <th>Sub-Item</th>
								  <th style="width: 200px">No.of Sub-Items</th>
								  <th style="width: 150px">
									<button type="button" class="btn btn-block btn-success addBtn"><i class="nav-icon far fa-plus-square"> Add</i> </button>
								  </th>
								</tr>
							  </thead>
							  <tbody id="tbody">
								
							  </tbody>
							</table>
						</div>
						
						<!--div class="col-md-6 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_item_sub_item" name="is_active_item_sub_item" value="1">
								<label for="is_active_item_sub_item" class="custom-control-label">is active</label>
							</div>
						</div-->
					</div>
				</div>			

				<div class="card-footer text-center">
					<button class="btn btn-primary" type="submit" id="submit">Submit</button>
				</div>				
			</form>
		</div>
	</div>
</section>
<script>

$('#form')[0].reset(); 

var pageUrl = $(location).attr('href');
parts = pageUrl.split("/"),
last_part = parts[parts.length-1];
console.log(last_part);

function loadMainItem(id){
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		url: API+"item/fetch_all_active/",
		success: function(data, result){
			var item_drp = '<option value="">Select Main Item</option>';
			$.each(data, function(index, item) {
				//console.log(item);
				if(id == item.item_id){
					item_drp += '<option value="'+item.item_id+'" selected>'+item.item_name+'</option>';
				}
				else{
					item_drp += '<option value="'+item.item_id+'">'+item.item_name+'</option>';
				}
				
			});
			$('#main_item_id').append(item_drp);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			
			//console.log(errorThrown);
		}
	});
}


function loadSubItem(elem, id){
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		url: API+"subItem/fetch_all_active/",
		success: function(data1, result){
			var sub_item_drp = '<option value="">Select Sub-Item</option>';
			$.each(data1, function(index, item1) {
				//console.log(item1);
				if(id == item1.sub_item_id){
					sub_item_drp += '<option value="'+item1.sub_item_id+'" selected>'+item1.sub_item_name+'</option>';
				}
				else{
					sub_item_drp += '<option value="'+item1.sub_item_id+'">'+item1.sub_item_name+'</option>';
				}
				
			});
			
			elem.append(sub_item_drp);
			//$('.sub_item_id').append(sub_item_drp);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			
			//console.log(errorThrown);
		}
	});
}




//var country_id = 0;
function loadData() {
	
		
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"itemSubItem/fetch_single_join/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			loadMainItem(data[0].main_item_id);
			
				
			
			$('#main_item_id').val(data[0].main_item_id);
			$('#sub_item_id').val(data[0].sub_item_id);
			
			
			$.each(data, function(index, item1) {
				var row = '';
				if((index+1)==1){
					row += '<tr class="itemSet" id="'+(index+1)+'">'+
							  '<td class="rowId" value="'+item1.line_id+'">'+(index+1)+'.</td>'+
							  '<td>'+
								'<select class="form-control sub_item_id" id="sub_item_id" name="sub_item_id" required=""></select>'+
							  '</td>'+
							  '<td>'+
								'<input class="form-control" id="no_of_sub_items" name="no_of_sub_items" type="text" autocomplete="off" value="'+item1.no_of_sub_items+'">'+
							  '</td>'+
							  '<td>'+
							  '</td>'+
							'</tr>';
							
				}
				if((index+1)>1){
					row += '<tr class="itemSet" id="'+(index+1)+'">'+
							  '<td class="rowId" value="'+item1.line_id+'">'+(index+1)+'.</td>'+
							  '<td>'+
								'<select class="form-control sub_item_id" id="sub_item_id" name="sub_item_id" required=""></select>'+
							  '</td>'+
							  '<td>'+
								'<input class="form-control" id="no_of_sub_items" name="no_of_sub_items" type="text" autocomplete="off" value="'+item1.no_of_sub_items+'">'+
							  '</td>'+
							  '<td>'+
								'<button type="button" class="btn btn-block btn-danger removeBtn"><i class="nav-icon far fa-minus-square"> Remove</i> </button>'+
							  '</td>'+
							'</tr>';
							
				}
				$('#tbody').append(row);
				//console.log($('.itemSet').last().find('.sub_item_id'));
				loadSubItem($('.itemSet').last().find('.sub_item_id'), item1.sub_item_id);
			});
			
						
			if(data[0].is_active_inv_sub_item == 1){
				$('#is_active_inv_sub_item').prop('checked', true);
			}
			
			
				
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			//console.log(errorThrown);					
		}
	});
};

$(document).ready(function() {
	loadData();
});

$(document).on("click", ".addBtn", function () {
	
	var numItems = $('.itemSet').length;
	//console.log(numItems);
	var this_ = $(this);

	var rowHtml = '<tr class="itemSet" id="'+(numItems+1)+'">'+
				  '<td class="rowId" value="'+(numItems+1)+'">'+(numItems+1)+'.</td>'+
				  '<td>'+
					'<select class="form-control sub_item_id" id="sub_item_id" name="sub_item_id" required></select>'+
				  '</td>'+
				  '<td>'+
					'<input class="form-control" id="no_of_sub_items" name="no_of_sub_items" type="text" autocomplete="off">'+
				  '</td>'+
				  '<td>'+
					'<button type="button" class="btn btn-block btn-danger removeBtn"><i class="nav-icon far fa-minus-square"> Remove</i> </button>'+
				  '</td>'+
				'</tr>';
				
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"subItem/fetch_all_active/",
					success: function(data1, result){
						var sub_item_drp = '<option value="">Select Sub-Item</option>';
						$.each(data1, function(index, item1) {
							//console.log(item1);
							sub_item_drp += '<option value="'+item1.sub_item_id+'">'+item1.sub_item_name+'</option>';
						});
						
						$('.table ').find('.sub_item_id').last().append(sub_item_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(errorThrown);
					}
				});
				
	$('.itemSet').last().after(rowHtml);	
})

$(document).on("click", ".removeBtn", function () {
	$(this).parent().parent().remove();
	$('.itemSet').each( function(i){		
		$(this).find('.rowId').text((i+1)+'.');
	})
})

$('#submit').click(function(e){
	e.preventDefault();
		
	var line_id = 0;
	var main_item_id = 0;
	var sub_item_id = 0;
	var no_of_sub_items = 0;
	var is_active_inv_sub_item = 1;
	
	var itemSetArr = [];
		
	main_item_id = $('#main_item_id').val();
	
	$('.itemSet').each(function(i){		
		
		sub_item_id = $(this).find('#sub_item_id').val();
		no_of_sub_items = $(this).find('#no_of_sub_items').val();
		line_id = $(this).find('.rowId')[0].attributes[1].value;
		//console.log($(this).find('.rowId'));
		//console.log($(this).find('.rowId')[0].attributes[1].value);
		
		itemSetArr.push(
			{
				'line_id':line_id,
				'main_item_id':main_item_id,
				'sub_item_id':sub_item_id,
				'no_of_sub_items':no_of_sub_items,
				'is_active_inv_sub_item':is_active_inv_sub_item
			}
		);
	})
	
	console.log(itemSetArr);
	
	is_active_item_sub_item = $("#is_active_item_sub_item").is(':checked')? 1 : 0;	
		
	if(typeof main_item_id !== 'undefined' && main_item_id !== '')
	{
								
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: JSON.stringify(itemSetArr),	
			url: API+"itemSubItem/update/",
			success: function(data, result){
				console.log(data);	
				const notyf = new Notyf();
				if(data['message'] == 'Data Saved!'){
					notyf.success({
					  message: data['message'],
					  duration: 5000,
					  icon: true,
					  ripple: true,
					  dismissible: true,
					  position: {
						x: 'right',
						y: 'top',
					  }
					  
					})
					window.setTimeout(function() {
						window.location = "<?php echo base_url() ?>itemSubItem/view";
					}, 3000);
				}
				if(data['message'] == 'Error!'){
					notyf.error({
					  message: 'Please Fill Required Fields!',
					  duration: 5000,
					  icon: true,
					  ripple: true,
					  dismissible: true,
					  position: {
						x: 'right',
						y: 'top',
					  }
					  
					})
				}
				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(XMLHttpRequest);
				console.log(textStatus);		
				console.log(errorThrown);	
				const notyf = new Notyf();
			
				notyf.error({
				  message: 'Error!',
				  duration: 5000,
				  icon: true,
				  ripple: true,
				  dismissible: true,
				  position: {
					x: 'right',
					y: 'top',
				  }
				  
				})
				
			}
		});
		
	}
	else{
		const notyf = new Notyf();
			
		notyf.error({
		  message: 'Please Fill Required Fields!',
		  duration: 5000,
		  icon: true,
		  ripple: true,
		  dismissible: true,
		  position: {
			x: 'right',
			y: 'top',
		  }
		  
		})
		
		/* $(document).Toasts('create', {
			icon: 'fas fa-exclamation-triangle',
			class: 'bg-danger m-1',
			autohide: true,
			delay: 5000,
			title: 'An error has occured',
			body: 'Something went wrong'
		});	 */
	}
	
	
})



</script>