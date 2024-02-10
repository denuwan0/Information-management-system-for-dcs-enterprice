<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Stock Transfer Details</h3>
			</div>

			<form>
				<div class="card-body itemBody">
					<div class="row">
						<div class="col-md-12 row">
							<input type="hidden" id="inventory_stock_transfer_header_id" name="inventory_stock_transfer_header_id" value="0">
							<div class="col-md-2 mb-3" >
								<div class="form-group"> <!-- Date input 1-->
									<label class="control-label" for="date">Date</label>
									<input class="form-control" id="create_date" name="create_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off"/>
								</div>
							</div>	
							<div class="col-md-2 mb-3">
								<label for="company_country">Transfer Type</label>
								<select class="form-control" id="transfer_type" name="transfer_type">
									<option value="IN">IN</option>
									<option value="OUT">OUT</option>
								</select>
							</div>
							<div class="col-md-2 mb-3">
								<label for="company_country">Stock Type</label>
								<select class="form-control" id="stock_type" name="stock_type">
									<option value="Retail">Retail</option>
									<option value="Rental">Rental</option>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="company_country">Request From</label>
								<select class="form-control" id="branch_id_from" name="branch_id_from">
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="company_country">Request To</label>
								<select class="form-control" id="branch_id_to" name="branch_id_to">
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-2 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_inv_stock_trans" value="1">
								<label for="is_active_inv_stock_trans" class="custom-control-label">is active</label>
							</div>
						</div>	
						<div class="col-md-2 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_approved" value="1" >
								<label for="is_approved" class="custom-control-label">is approve</label>
							</div>
						</div>
						<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" ){
							echo '<div class="col-md-3 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_accepted" value="1">
									<label for="is_accepted" class="custom-control-label">is accept</label>
								</div>
							</div>';
						}
						
						?>
						
												
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
										<table class="table table-bordered" id="mainItemTable">
										  <thead>
											<tr>
											  <th style="width: 5%">#</th>
											  <th style="width: 30%">Main-Item</th>
											  <th style="width: 20%">No.of Items</th>
											  <th style="width: 10%">
												<button type="button" class="btn btn-block btn-success addMainBtn"><i class="nav-icon far fa-plus-square"> Add</i> </button>
											  </th>
											</tr>
										  </thead>
										  <tbody>
											
										  </tbody>
										</table>
									</div>
								</div>
							  </div>
							  <div class="tab-pane fade" id="custom-tabs-one-profile"  role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
								 <div class="form-row">
									<div class="col-sm-12 mb-3">
										<table class="table table-bordered" id="subItemTable">
										  <thead>
											<tr>
											  <th style="width: 5%">#</th>
											  <th style="width: 30%">Sub-Item</th>
											  <th style="width: 20%">No.of Items</th>
											  <th style="width: 10%">
												<button type="button" class="btn btn-block btn-success addSubBtn"><i class="nav-icon far fa-plus-square"> Add</i> </button>
											  </th>
											</tr>
										  </thead>
										  <tbody>
											
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
		url: API+"stockTransfer/fetch_single_join/?id="+last_part,
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			
			
			var date_input=$('input[name="create_date"]'); 
			var options={
				format: 'yyyy-mm-dd',
				todayHighlight: true,
				autoclose: true,
				orientation: 'bottom',
				"defaultDate":new Date(data.header[0].create_date)
			};
			
			date_input.datepicker(options);
			
			$('#create_date').datepicker('setDate', data.header[0].create_date);
			$('#transfer_type').val(data.header[0].transfer_type);
			$('#stock_type').val(data.header[0].stock_type);
			$('#branch_id_from').val(data.header[0].branch_id_from);
			$('#branch_id_to').val(data.header[0].branch_id_to);
						
			if(data.header[0].is_approved == 1){
				$('#is_approved').prop('checked', true);
			}
			
			if(data.header[0].is_active_inv_stock_trans == 1){
				$('#is_active_inv_stock_trans').prop('checked', true);
			}
			
			function loadBranchFrom(){
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"branch/fetch_all_active/",
					success: function(data1, result){
						var company_drp = '<option value="">Select Branch</option>';
						$.each(data1, function(index, item) {
							//console.log(data.header[0].branch_id_from );
							if(data.header[0].branch_id_from == item.company_branch_id){
								company_drp += '<option selected value="'+item.company_branch_id+'">'+item.company_branch_name+'</option>';
							}
							else{
								company_drp += '<option value="'+item.company_branch_id+'">'+item.company_branch_name+'</option>';
							}
							
						});
						$('#branch_id_from').append(company_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(errorThrown);
					}
				});
			}

			loadBranchFrom();

			function loadBranchTo(){
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"branch/fetch_all_active_other_branches/",
					success: function(data2, result){
						var company_drp = '<option value="">Select Branch</option>';
						$.each(data2, function(index, item) {
							//console.log(item);
							if(data.header[0].branch_id_to == item.company_branch_id){
								company_drp += '<option selected value="'+item.company_branch_id+'">'+item.company_branch_name+'</option>';
							}
							else{
								company_drp += '<option value="'+item.company_branch_id+'">'+item.company_branch_name+'</option>';
							}
							
						});
						$('#branch_id_to').append(company_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(errorThrown);
					}
				});
			}

			loadBranchTo();
			
			$.each(data.detail, function (i, item) {
				console.log(item.is_sub_item);
				if(item.is_sub_item == 0){
					var numItems = $('.mainItemSet').length;
					//console.log(numItems);
					

					var rowHtml = '<tr class="mainItemSet itemRow" id="'+(numItems+1)+'">'+
								  '<td class="mainRowId" value="'+(numItems+1)+'">'+(numItems+1)+'.</td>'+
								  '<td>'+
									'<select class="form-control item_id main_item_id" id="main_item_id" name="main_item_id" required></select>'+
								  '</td>'+
								  '<td>'+
									'<input class="form-control no_of_items" id="no_of_items" name="no_of_items" type="number" value="'+item.no_of_items+'" autocomplete="off">'+
								  '</td>'+
								  '<td>'+
									'<button type="button" class="btn btn-block btn-danger mainRemoveBtn"><i class="nav-icon far fa-minus-square"> Remove</i> </button>'+
								  '</td>'+
								'</tr>';
					
								$('#mainItemTable').append(rowHtml);
								
								
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

					var rowHtml = '<tr class="subItemSet itemRow" id="'+(numItems+1)+'">'+
								  '<td class="subRowId" value="'+(numItems+1)+'">'+(numItems+1)+'.</td>'+
								   '<td>'+
									'<select class="form-control item_id sub_item_id" id="sub_item_id" name="sub_item_id" required></select>'+
								  '</td>'+
								  '<td>'+
									'<input class="form-control no_of_items" id="no_of_items" name="no_of_items" type="number" value="'+item.no_of_items+'" autocomplete="off">'+
								  '</td>'+
								  '<td>'+
									'<button type="button" class="btn btn-block btn-danger subRemoveBtn"><i class="nav-icon far fa-minus-square"> Remove</i> </button>'+
								  '</td>'+
								'</tr>';
					
								$('#subItemTable').append(rowHtml);
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
							console.log(id);
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
					'<input class="form-control no_of_items" id="no_of_items" name="no_of_items" type="number" autocomplete="off">'+
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
					'<input class="form-control no_of_items" id="no_of_items" name="no_of_items" type="number" autocomplete="off">'+
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


$(document).on("click", "#submit", function (e) {
	e.preventDefault();
	
	
	var inventory_stock_transfer_header_id = last_part;
	var create_date = "";
	var branch_id_from = 0;
	var branch_id_to = 0;
	var transfer_type = 0;
	var stock_type = 0;
	var is_approved = 0;
	var is_accepted = 0;
	var is_active_inv_stock_trans = 0;
	
	
					
		create_date = $('#create_date').val();
		branch_id_from = $('#branch_id_from').val();
		branch_id_to = $('#branch_id_to').val();
		transfer_type = $('#transfer_type').val();
		stock_type = $('#stock_type').val();
		is_approved = $("#is_approved").is(':checked')? 1 : 0;
		is_accepted = $("#is_accepted").is(':checked')? 1 : 0;
		is_active_inv_stock_trans = $("#is_active_inv_stock_trans").is(':checked')? 1 : 0;
		
		var itemsArr = [];
		var stockHeader = [];
		
		$('.itemRow').each(function(){
			
			item_id = $(this).find('.item_id').val();
			item_type = $(this).find('.item_id')[0].id;
			no_of_items = $(this).find('#no_of_items').val();
			
			
			if(item_id != ''){
				itemsArr.push({
					item_id: item_id,
					item_type: item_type,
					no_of_items: no_of_items
				})
			}
			
			
		})
		
		
		console.log(itemsArr);
		
		stockHeader.push(
			{
				'inventory_stock_transfer_header_id':inventory_stock_transfer_header_id,
				'create_date':create_date,
				'branch_id_from':branch_id_from,
				'branch_id_to':branch_id_to,
				'transfer_type':transfer_type,
				'stock_type':stock_type,
				'is_approved':is_approved,
				'is_accepted':is_accepted,
				'is_active_inv_stock_trans':is_active_inv_stock_trans
				
			}
		);
						
		console.log(stockHeader);
		
		
		var formData = new Object();
		formData = {
			stockHeader:stockHeader,
			itemsArr:itemsArr
		};
		
		console.log(formData);
		
		var main_item_id_ok = 0;
		var no_of_items_ok = 0;
		
		$('.main_item_id').each(function(){
			if($(this).val() == ''){
				main_item_id_ok += 1;
			}
		})
		
		$('.no_of_items').each(function(){
			if($(this).val() == ''){
				no_of_items_ok += 1;
			}
		})
	
		
		if(main_item_id_ok == 0 && no_of_items_ok == 0){
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
				url: API+"stockTransfer/update/",
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
							window.location = "<?php echo base_url() ?>stockTransfer/view";
						}, 3000);
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