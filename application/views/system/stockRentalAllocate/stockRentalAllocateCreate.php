<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Rental Stock Allocation Details</h3>
			</div>

			<form>
				<div class="card-body itemBody">
					<div class="row">
						<div class="col-lg-12 row">
							<div class="col-lg-3 mb-3" >
								<div class="form-group"> <!-- Date input 1-->
									<label class="control-label" for="date">Date: </label>
									<input class="form-control" id="stock_purchase_date" name="stock_purchase_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" disabled/>
								</div>
							</div>	
							<div class="col-md-5 mb-3">
								<label class="control-label" for="date">Stock Batch No: </label>
								<div class="form-group"> <!-- Date input 1-->
									<select class="form-control stock_batch_id" id="stock_batch_id" name="stock_batch_id" required></select>
								</div>								
							</div>
							<div class="col-md-4 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_inv_stock_rental" name="is_active_inv_stock_rental" value="1">
									<label for="is_active_inv_stock_rental" class="custom-control-label">is active</label>
								</div>
							</div>
						</div>
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
	var date_input=$('input[name="stock_purchase_date"]'); 
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		orientation: 'bottom',
		useCurrent: true 
	};
	date_input.datepicker(options);
	
	date_input.datepicker('setDate', new Date());
	
	
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
})

function loadStockBatch(){
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		url: API+"Stock/fetch_all_active/",
		success: function(data, result){
			console.log(data);
			var batch_drp = '<option value="">Select Stock Batch</option>';
			$.each(data, function(index, item) {
				//console.log(item);
				batch_drp += '<option value="'+item.stock_batch_id+'">'+item.stock_batch_id+' / '+item.stock_purchase_date+'</option>';
			});
			$('.stock_batch_id').append(batch_drp);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			
			//console.log(errorThrown);
		}
	});
}

loadStockBatch();


$('#mainItemBody').html("<tr><td colspan='6'><center>Please Select Batch</center></td></tr>");
$('#subItemBody').html("<tr><td colspan='6'><center>Please Select Batch</center></td></tr>");

function loadStockBatchItems(id){
	$('#mainItemBody').html("");
	$('#subItemBody').html("");
	var count1 = 1;
	var count2 = 1;
	var mainItemRowHtml="";
	var subItemRowHtml="";
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		data: {
			"id": id
		  },
		dataType: "json",
		url: API+"Stock/fetch_all_active_details_by_batch_id",
		success: function(data, result){
			//var data = JSON.parse(data);
			console.log(data);
			$.each(data, function(index, item) {
				console.log(item);
				
				
				if(item.is_sub_item == 0){
					mainItemRowHtml += '<tr class="mainItemSet itemRow" id="'+(count1)+'">'+
					  '<td class="mainRowId" value="'+(count1)+'">'+(count1)+'.</td>'+
					  '<td>'+
						'<input type="hidden" class="form-control item_id" id="item_id" name="item_id" value="'+item.item_id+'">'+
						'<input type="hidden" class="form-control is_sub_item" id="is_sub_item" name="is_sub_item" value="'+item.is_sub_item+'">'+
						'<input type="text" class="form-control sub_item_name" id="sub_item_name" name="sub_item_name" value="'+item.item_name+'" disabled>'+
					  '</td>'+
					  '<td>'+
						'<input class="form-control full_stock_count" id="full_stock_count" name="full_stock_count" max="'+item.available_no_of_items+'" value="'+item.available_no_of_items+'" type="number" min="0" autocomplete="off" oninput="this.value = Math.round(this.value);">'+
					  '</td>'+
					'<td>'+
						'<button type="button" class="btn btn-block btn-danger mainRemoveBtn"><i class="nav-icon far fa-minus-square"> </i> </button>'+
					 '</td>'+
					  
					'</tr>';
					count1++;
					
					/* '<td>'+
						'<button type="button" class="btn btn-block btn-danger mainRemoveBtn"><i class="nav-icon far fa-minus-square"> </i> </button>'+
					  '</td>'+ */
				}
				if(item.is_sub_item == 1){
					subItemRowHtml += '<tr class="subItemSet itemRow" id="'+(count2)+'">'+
					  '<td class="subRowId" value="'+(count2)+'">'+(count2)+'.</td>'+
					  '<td>'+
						'<input type="hidden" class="form-control item_id" id="item_id" name="item_id" value="'+item.sub_item_id+'">'+
						'<input type="hidden" class="form-control is_sub_item" id="is_sub_item" name="is_sub_item" value="'+item.is_sub_item+'">'+
						'<input type="text" class="form-control sub_item_name" id="sub_item_name" name="sub_item_name" value="'+item.sub_item_name+'" disabled>'+
					  '</td>'+
					  '<td>'+
						'<input class="form-control full_stock_count" id="full_stock_count" name="full_stock_count" max="'+item.available_no_of_items+'" value="'+item.available_no_of_items+'" type="number" min="0" autocomplete="off" oninput="this.value = Math.round(this.value);">'+
					  '</td>'+				  
					  '<td>'+
						'<button type="button" class="btn btn-block btn-danger subRemoveBtn"><i class="nav-icon far fa-minus-square"> </i> </button>'+
					 '</td>'+
					'</tr>';
					count2++;
					
				}
				
				
			});
			
			
			
			if(mainItemRowHtml != '' && subItemRowHtml == ''){
				$('#mainItemBody').html(mainItemRowHtml);
				$('#subItemBody').html("<tr><td colspan='6'><center>No Sub items Found!</center></td></tr>");
				$('.nav-tabs a[href="="#custom-tabs-one-home]').tab('show');
			}
			if(subItemRowHtml != '' && mainItemRowHtml == ''){
				$('#mainItemBody').html("<tr><td colspan='6'><center>No Main items Found!</center></td></tr>");
				$('#subItemBody').html(subItemRowHtml);
				$('.nav-tabs a[href="#custom-tabs-one-profile"]').tab('show');
			}
			if(mainItemRowHtml != '' && subItemRowHtml != ''){
				$('#mainItemBody').html(mainItemRowHtml);
				$('#subItemBody').html(subItemRowHtml);
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			
			console.log(errorThrown);
		}
	});
}

$(document).on("change", ".stock_batch_id", function () {
	var id = $(this).val();
	loadStockBatchItems(id);
})

$(document).on("click", ".mainRemoveBtn", function () {
	$(this).parent().parent().remove();
	
	$('.mainItemSet').each( function(i){		
		$(this).find('.mainRowId').text((i+1)+'.');
	})
})

$(document).on("click", ".subRemoveBtn", function () {
	$(this).parent().parent().remove();
	
	$('.subItemSet').each( function(i){		
		$(this).find('.subRowId').text((i+1)+'.');
	})
})

$(document).on("change", ".full_stock_count", function () {
	if($(this).val() != ''){
		var max = parseInt($(this).attr('max'));
		var min = parseInt($(this).attr('min'));
		var val = parseInt($(this).val());
		
		console.log('val: '+val+' min: '+min+' max: '+max);
		
		if(val > min && val < max){
			$(this).val(val);
		}
		else if(val < min){
			$(this).val(min);
		}
		else if(val > max){
			$(this).val(max);
		}
		
	}
	
})

$(document).on("change", ".element", function () {
	if($(this).val() < 0){
		$(this).val(0);		
	}
	else{
		var min = parseFloat($(this).attr('min'));
		var val = parseFloat($(this).val());
		
		if(val<min){
			$(this).val(min);
		}
	}
})

$(document).on("keypress", ".element", function () {
	return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57));	
})



$(".full_stock_count").each(function () {	
	$(this).change(function (){
		if($(this).val() == ''){
			$(this).parent().parent().find('.main_item_id').prop('disabled', false)
			//console.log($(this).parent().parent().find('.main_item_id').prop('disabled', false));
		}
		else{
			$(this).parent().parent().find('.main_item_id').prop('disabled', true)
			//console.log($(this).parent().parent().find('.main_item_id').prop('disabled', true));
		}
	})	
})


$('#submit').click(function(e){
	e.preventDefault();
	
				
	/* if(typeof stock_purchase_date !== 'undefined' && stock_purchase_date !== ''
	&& typeof item_cost !== 'undefined' && item_cost !== ''
	&& typeof no_of_items !== 'undefined' && no_of_items !== '')
	{ */
		
		
		
		var item_id = 0;
		var full_stock_count = 0;
		var is_sub_item = 0;
		var stock_batch_id = 0;
		var is_active_inv_stock_rental = 0;
		var stock_purchase_date = "";
			
		stock_purchase_date = $('#stock_purchase_date').val();
		stock_batch_id = $('#stock_batch_id').val();
		is_active_inv_stock_rental = $("#is_active_inv_stock_rental").is(':checked')? 1 : 0;
		
		
		var stockHeader = [];
		var itemsArr = [];
		
		var item_id_ok = 0;
		var full_stock_count_ok = 0;
		
		$('.item_id').each(function(){
			if($(this).val() == ''){
				item_id_ok += 1;
			}
		})
				
		$('.full_stock_count').each(function(){
			if($(this).val() == ''){
				full_stock_count_ok += 1;
			}
		})
				
		$('.itemRow').each(function(){
			
			item_id = $(this).find('.item_id').val();
			full_stock_count = $(this).find('#full_stock_count').val();
			is_sub_item = $(this).find('#is_sub_item').val();
					
			
			if(item_id_ok == 0 && full_stock_count_ok == 0 ){
				itemsArr.push({
					item_id: item_id,
					stock_batch_id: stock_batch_id,
					full_stock_count: full_stock_count,
					is_sub_item: is_sub_item
				})
			}
			
		})
		
		stock_batch_id = $('#stock_batch_id').val();
		
		if(stock_batch_id != 0){
			stockHeader.push(
				{	
					'stock_batch_id':stock_batch_id,
					'is_active_inv_stock_rental':is_active_inv_stock_rental
				}
			);	
		}
		
		
		var formData = new Object();
		formData = {
			stockHeader:stockHeader,
			itemsArr:itemsArr
		};
		
		console.log(itemsArr.length);
				
		if(item_id_ok == 0 && stock_batch_id != 0 && itemsArr.length > 0){
			submitData();
		}
		else{
			const notyf = new Notyf();
			notyf.error({
			  message: 'Please fill all fields!',
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
			
		function submitData(){
			$.ajax({
				type: "POST",
				//enctype: 'multipart/form-data',
				cache : false,
				async: true,
				contentType: 'application/json',
				dataType: "json",
				processData: false,
				data: JSON.stringify(formData),	
				url: API+"stockRental/insert/",
				success: function(data, result){
					//console.log(data);	
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
							window.location = "<?php echo base_url() ?>stockRentalAllocate/view";
						}, 3000);
					}	
					else{
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
		
		
	//}
	/* else{
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
	} */
	
	
})



</script>