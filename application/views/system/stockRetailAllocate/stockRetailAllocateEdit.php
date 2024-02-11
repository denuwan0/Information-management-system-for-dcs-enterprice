<div class="modal fade" id="modalInfo"  aria-hidden="true" style="">
	<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modalInfoHeader">confirmation</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body" id="modalInfoBody" >	
					Do you confirm delete ?
				</div>
				<div class="modal-footer justify-content-right">
					<button type="button" class="btn btn-danger confirmBtn" id="confirmBtn" data-dismiss="modal">Yes</button>
					<button type="button" class="btn btn-default cancelBtn" id="cancelBtn" data-dismiss="modal">No</button>
				</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Retail Stock Allocation</h3>
			</div>

			<form>
				<div class="card-body itemBody">
					<div class="row">
						<div class="col-lg-9 row">
							<input class="form-control" id="retail_stock_header_id" name="retail_stock_header_id" type="hidden"/>
							<div class="col-lg-3 mb-3" >
								<div class="form-group"> <!-- Date input 1-->
									<label class="control-label" for="date">Date: </label>
									<input class="form-control" id="stock_purchase_date" name="stock_purchase_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" disabled/>
								</div>
							</div>	
							<div class="col-md-5 mb-3">
								<label class="control-label" for="date">Stock Batch No: </label>
								<div class="form-group"> <!-- Date input 1-->
									<input class="form-control stock_batch_id" id="stock_batch_id" name="stock_batch_id" type="text" autocomplete="off" readonly/>
								</div>								
							</div>
							<?php 
								
								if($this->session->userdata('sys_user_group_name') == 'Admin'){
									echo '<div class="col-md-2 mb-3">
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" id="is_active_inv_stock_retail" name="is_active_inv_stock_retail" value="1">
											<label for="is_active_inv_stock_retail" class="custom-control-label">is active</label>
										</div>
									</div>
									<div class="col-md-2 mb-3">
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" id="is_approved_inv_stock_retail" name="is_approved_inv_stock_retail" value="1">
											<label for="is_approved_inv_stock_retail" class="custom-control-label">is approved</label>
										</div>
									</div>';
								}
								
							?>
						</div>
						
					</div>
						<div class="card card-primary card-tabs">
						  <div class="card-header p-0 pt-1">
							<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
							  <li class="nav-item">
								<a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Main Items</a>
							  </li>
							  <li class="nav-item">
								<a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Sub Items</a>
							  </li>
							</ul>
						  </div>
						  <div class="card-body itemBody">
							<div class="tab-content" id="custom-tabs-one-tabContent">
							  <div class="tab-pane fade active show" id="custom-tabs-one-home"  role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
								 <div class="form-row">
									<div class="col-sm-12 mb-3">
										<table class="table table-bordered">
										  <thead>
											<tr>
											  <th style="width: 5%">#</th>
											  <th style="width: 30%">Main Item Name</th>									  
											  <th style="width: 15%">No.of Items</th>
											  <th style="width: 5%"></th>
											</tr>
										  </thead>
										  <tbody id="mainItemBody">
																					
										  </tbody>
										</table>
									</div>
								</div>
							  </div>
							  <div class="tab-pane fade" id="custom-tabs-one-profile"  role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
								 <div class="form-row">
									<div class="col-sm-12 mb-3">
										<table class="table table-bordered">
										  <thead>
											<tr>
											  <th style="width: 5%">#</th>
											  <th style="width: 30%">Sub Item Name</th>									  
											  <th style="width: 15%">No.of Items</th>
											  <th style="width: 5%"></th>
											</tr>
										  </thead>
										  <tbody id="subItemBody">
																					
										  </tbody>
										</table>
									</div>
								</div>
							  </div>
							  
							</div>
						  </div>
						  <!-- /.card -->
						</div>
				<div class="card-footer text-center">
					<button class="btn btn-primary" type="submit" id="submit">Submit</button>
				</div>				
			</form>
		</div>
	</div>
</section>
<script>
$(document).ready(function(){	

var pageUrl = $(location).attr('href');
parts = pageUrl.split("/"),
last_part = parts[parts.length-1];
//console.log(last_part);



//var country_id = 0;
function loadData() {
	
		
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"StockRetail/fetch_single_join/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);
			
			$('#stock_purchase_date').val(data.header[0].retail_stock_assigned_date);
			$('#stock_batch_id').val(data.header[0].stock_batch_id);
			$('#retail_stock_header_id').val(data.header[0].retail_stock_header_id);		
			loadStockBatch(data.header[0].stock_batch_id);
						
			if(data.header[0].is_approved_inv_stock_retail == 1){
				$('#is_approved_inv_stock_retail').prop('checked', true);
			}
						
			if(data.header[0].is_active_inv_stock_retail == 1){
				$('#is_active_inv_stock_retail').prop('checked', true);
			}
			
			var count1 = 1;
			var count2 = 1;
			var mainItemRowHtml="";
			var subItemRowHtml="";
			
			$.each(data.detail, function (i, item) {
				console.log(item);
				
				if(item.is_sub_item == 0){
					var numItems = $('.mainItemSet').length;
					//console.log(numItems);
					//console.log(item);

					mainItemRowHtml += '<tr class="mainItemSet itemRow" id="'+(count1)+'">'+
					  '<td class="mainRowId" value="'+(count1)+'">'+(count1)+'.</td>'+
					  '<td>'+
						'<input type="hidden" class="form-control retail_stock_detail_id" id="retail_stock_detail_id" name="retail_stock_detail_id" value="'+item.retail_stock_detail_id+'">'+
						'<input type="hidden" class="form-control item_id" id="item_id" name="item_id" value="'+item.item_id+'">'+
						'<input type="hidden" class="form-control is_sub_item" id="is_sub_item" name="is_sub_item" value="'+item.is_sub_item+'">'+
						'<input type="text" class="form-control sub_item_name" id="sub_item_name" name="sub_item_name" value="'+item.item_name+'" disabled>'+
					  '</td>'+
					  '<td>'+
						'<input class="form-control full_stock_count" id="full_stock_count" name="full_stock_count" max="'+item.full_stock_count+'" value="'+item.full_stock_count+'" type="number" min="0" autocomplete="off" oninput="this.value = Math.round(this.value);">'+
					  '</td>'+				  
					  '<td>'+
						'<button type="button" class="btn btn-block btn-danger mainRemoveBtn"><i class="nav-icon far fa-minus-square"> </i> </button>'+
					  '</td>'+
					'</tr>';
					count1++;
					
					$('#mainItemBody').html(mainItemRowHtml);
					
					
					//console.log(item.item_id);
					//console.log($('#mainItemTable').find('.main_item_id').last());
					var elem = $('#mainItemTable').find('.main_item_id').last();
					if((numItems+1) == 1){
						elem.parent().parent().find('.mainRemoveBtn').remove();
					}
					setMainItem(elem, item.item_id);
					
				}
				if(item.is_sub_item == 1){
					var numItems = $('.subItemSet').length;
					//console.log(numItems);

					subItemRowHtml += '<tr class="subItemSet itemRow" id="'+(numItems+1)+'">'+
					  '<td class="subRowId" value="'+(numItems+1)+'">'+(numItems+1)+'.</td>'+
					   '<td>'+
					   '<input type="hidden" class="form-control retail_stock_detail_id" id="retail_stock_detail_id" name="retail_stock_detail_id" value="'+item.retail_stock_detail_id+'">'+
						'<input type="hidden" class="form-control item_id" id="item_id" name="item_id" value="'+item.item_id+'">'+
						'<input type="hidden" class="form-control is_sub_item" id="is_sub_item" name="is_sub_item" value="'+item.is_sub_item+'">'+
						'<input type="text" class="form-control sub_item_name" id="sub_item_name" name="sub_item_name" value="'+item.item_name+'" disabled>'+
					  '</td>'+
					   '<td>'+
						'<input class="form-control full_stock_count" id="full_stock_count" name="full_stock_count" max="'+item.full_stock_count+'" value="'+item.full_stock_count+'" type="number" min="0" autocomplete="off" oninput="this.value = Math.round(this.value);">'+
					  '</td>'+
					  '<td>'+
						'<button type="button" class="btn btn-block btn-danger subRemoveBtn"><i class="nav-icon far fa-minus-square"></i> </button>'+
					  '</td>'+
					'</tr>';
		
					$('#subItemBody').html(subItemRowHtml);
					
					var elem = $('#subItemTable').find('.sub_item_id').last();
					if((numItems+1) == 1){
						elem.parent().parent().find('.subRemoveBtn').remove();
					}
					setSubItem(elem, item.item_id);							
					
				}
				
			})
			
				function setMainItem(elem, id){
					//console.log(id);
					$.ajax({
						type: "POST",
						cache : false,
						async: true,
						dataType: "json",
						url: API+"item/fetch_all_active/",
						success: function(data, result){
							var item_drp = '<option value="">Select Main Item</option>';
							$.each(data, function(index, item) {
								
								if(item.item_id == id){
									item_drp += '<option value="'+item.item_id+'" selected>'+item.item_name+'</option>';
								}
								else{
									item_drp += '<option value="'+item.item_id+'">'+item.item_name+'</option>';
								}
								
							});
							elem.html(item_drp);
						}
					});
				}
				
				function setSubItem(elem, id){
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
								if(item1.sub_item_id == id){
									sub_item_drp += '<option value="'+item1.sub_item_id+'" selected>'+item1.sub_item_name+'</option>';
								}
								else{
									sub_item_drp += '<option value="'+item1.sub_item_id+'">'+item1.sub_item_name+'</option>';
								}
								
							});
							elem.html(sub_item_drp);
						}
					});
				}
		
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			//console.log(errorThrown);					
		}
	});
};


function loadStockBatch(id){
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		url: API+"Stock/fetch_all_active/",
		success: function(data, result){
			//console.log(data);
			var batch_drp = '<option value="">Select Stock Batch</option>';
			$.each(data, function(index, item) {
				//console.log(item);
				if(item.stock_batch_id == id){
					batch_drp += '<option value="'+item.stock_batch_id+'" selected>'+item.stock_batch_id+' / '+item.stock_purchase_date+'</option>';
				}
				else{
					batch_drp += '<option value="'+item.stock_batch_id+'">'+item.stock_batch_id+' / '+item.stock_purchase_date+'</option>';
				}
				
			});
			$('.stock_batch_id').append(batch_drp);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			
			//console.log(errorThrown);
		}
	});
}


	
	$(':input[type="number"]').keydown(function (e) { 
		//console.log(e.keyCode);
		if (e.keyCode == 189 || e.keyCode == 40 || e.keyCode == 38) { //it does't allow user to enter minus(-) symbol
			
			const notyf = new Notyf();
			
			notyf.error({
			  message: 'Operation Not allowed!',
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



loadData();
});

$(document).on("click", ".addMainBtn", function () {
	
	var numItems = $('.mainItemSet').length;
	//console.log(numItems);
	var this_ = $(this);

	var rowHtml = '<tr class="mainItemSet itemRow" id="'+(numItems+1)+'">'+
				  '<td class="mainRowId" value="'+(numItems+1)+'">'+(numItems+1)+'.</td>'+
				  '<td>'+
					'<select class="form-control item_id main_item_id" id="main_item_id" name="main_item_id" required></select>'+
				  '</td>'+
				  '<td>'+
					'<input class="form-control" id="no_of_items" name="no_of_items" type="number" autocomplete="off">'+
				  '</td>'+
				  '<td>'+
					'<input type="number" class="form-control" id="item_cost" name="item_cost" required>'+
				  '</td>'+
				  '<td>'+
					'<button type="button" class="btn btn-block btn-danger mainRemoveBtn"><i class="nav-icon far fa-minus-square"> Remove</i> </button>'+
				  '</td>'+
				'</tr>';
				
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
							item_drp += '<option value="'+item.item_id+'">'+item.item_name+'</option>';
						});
						
						$('.table ').find('.main_item_id').last().append(item_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(errorThrown);
					}
				});
								
				
	$('.mainItemSet').last().after(rowHtml);	
})

$(document).on("click", ".addSubBtn", function () {
	
	var numItems = $('.subItemSet').length;
	//console.log(numItems);
	var this_ = $(this);

	var rowHtml = '<tr class="subItemSet itemRow" id="'+(numItems+1)+'">'+
				  '<td class="subRowId" value="'+(numItems+1)+'">'+(numItems+1)+'.</td>'+
				   '<td>'+
					'<select class="form-control item_id sub_item_id" id="sub_item_id" name="sub_item_id" required></select>'+
				  '</td>'+
				  '<td>'+
					'<input class="form-control" id="no_of_items" name="no_of_items" type="number" autocomplete="off">'+
				  '</td>'+
				  '<td>'+
					'<input type="number" class="form-control" id="item_cost" name="item_cost" required>'+
				  '</td>'+
				  '<td>'+
					'<button type="button" class="btn btn-block btn-danger subRemoveBtn"><i class="nav-icon far fa-minus-square"> Remove</i> </button>'+
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
				
				
				
	$('.subItemSet').last().after(rowHtml);	
})

$(document).on("click", ".mainRemoveBtn", function () {
	//$('#modalInfo').modal('show');
	
	var this_ = $(this);
	var class_ ="mainRemoveBtn";
	
	var mainItems = $('.mainItemSet').length;
	var line_id = $(this).parent().parent().find('#retail_stock_detail_id').val();
	
	console.log($(this).parent().parent().find('#retail_stock_detail_id').val());
	if(mainItems>1){
		
		removeItem(this_, class_, line_id);
		
	}
	else{
		const notyf = new Notyf();
				
		notyf.error({
		  message: 'Cannot remove last item!',
		  duration: 3000,
		  icon: true,
		  ripple: true,
		  dismissible: true,
		  position: {
			x: 'right',
			y: 'top',
		  }
		  
		})
	}
	
	
})

$(document).on("click", ".subRemoveBtn", function () {
	
	var this_ = $(this);
	var class_ = "subRemoveBtn";
	
	var subItems = $('.subItemSet').length;
	var line_id = $(this).parent().parent().find('#retail_stock_detail_id').val();
	
	
	if(subItems>1){
		
		removeItem(this_, class_, line_id);
		
	}
	else{
		const notyf = new Notyf();
				
		notyf.error({
		  message: 'Cannot remove last item!',
		  duration: 3000,
		  icon: true,
		  ripple: true,
		  dismissible: true,
		  position: {
			x: 'right',
			y: 'top',
		  }
		  
		})
	}
	
	
})

function removeItem(this_, class_, line_id){
	var formData = new Object();
		formData = {
			retail_stock_detail_id:line_id,
			is_active_retail_stock_detail:0
		};
		
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			contentType: 'application/json',
			dataType: "json",
			processData: false,
			data: JSON.stringify(formData),	
			url: API+"stockRetail/remove_detail_item_by_line_id/",
			success: function(data, result){
				console.log(data.message);	
				const notyf = new Notyf();
				if(data.message == 'Data Updated!'){
					
					if(class_ == "mainRemoveBtn"){
						this_.parent().parent().remove();
						$('.mainItemSet').each( function(i){		
							$(this).find('.mainRowId').text((i+1)+'.');
						})
					}
					if(class_ == "subRemoveBtn"){
						this_.parent().parent().remove();
						$('.subItemSet').each( function(i){		
							$(this).find('.subRowId').text((i+1)+'.');
						})
					}
					
					const notyf = new Notyf();
							
					notyf.success({
					  message: 'Item removed!',
					  duration: 3000,
					  icon: true,
					  ripple: true,
					  dismissible: true,
					  position: {
						x: 'right',
						y: 'top',
					  }
					  
					})
					
				}
				else{
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


$(document).on("click", "#submit", function (e) {
	e.preventDefault();
	
	
	var stock_batch_id = 0;
	var stock_purchase_date = "";
	var stock_purchase_time = 0;
	var created_by = 0;
	var branch_id = 0;
	var approved_by = 0;
	var is_approved_inv_stock_retail = 0;
	var is_active_inv_stock_retail = 0;
	var retail_stock_header_id = 0;
	var is_sub_item = 0;
	var retail_stock_detail_id = 0;
	
			
	
					
		stock_purchase_date = $('#stock_purchase_date').val();
		retail_stock_header_id = $('#retail_stock_header_id').val();
		stock_batch_id = $('#stock_batch_id').val();
		is_approved_inv_stock_retail = $("#is_approved_inv_stock_retail").is(':checked')? 1 : 0;
		is_active_inv_stock_retail = $("#is_active_inv_stock_retail").is(':checked')? 1 : 0;
		
		var itemsArr = [];
		var stockHeader = [];
		
		$('.itemRow').each(function(){
			
			retail_stock_detail_id = $(this).find('#retail_stock_detail_id').val();
			item_id = $(this).find('.item_id').val();
			full_stock_count = $(this).find('#full_stock_count').val();
			is_sub_item = $(this).find('#is_sub_item').val();
			
			console.log(retail_stock_detail_id);
			
			if(item_id != ''){
				itemsArr.push({
					retail_stock_detail_id: retail_stock_detail_id,
					item_id: item_id,
					full_stock_count: full_stock_count,
					is_sub_item: is_sub_item
				})
			}
			
			
		})
		
		
		//console.log(itemsArr);
		
		stockHeader.push(
			{
				'retail_stock_header_id':retail_stock_header_id,
				'stock_batch_id':stock_batch_id,
				'stock_purchase_date':stock_purchase_date,
				'is_approved_inv_stock_retail':is_approved_inv_stock_retail,
				'is_active_inv_stock_retail':is_active_inv_stock_retail
			}
		);
		
				
		console.log(stockHeader);
		
		
		var formData = new Object();
		formData = {
			stockHeader:stockHeader,
			itemsArr:itemsArr
		};
		
		console.log(formData);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			contentType: 'application/json',
			dataType: "json",
			processData: false,
			data: JSON.stringify(formData),	
			url: API+"stockRetail/update/",
			success: function(data, result){
				console.log(data);	
				const notyf = new Notyf();
				if(data['message'] == 'Data Updated!'){
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
						window.location = "<?php echo base_url() ?>stockRetailAllocate/view";
					}, 3000);
				}
				if(data['message'] == "Cannont approve inactive document!"){
					notyf.error({
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
		
	
	
	
})



</script>