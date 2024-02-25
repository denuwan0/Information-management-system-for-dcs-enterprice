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
							<div class="col-md-2 mb-3">
								<label for="company_country">Request From</label>
								<select class="form-control" id="branch_id_from" name="branch_id_from">
								</select>
							</div>
							<div class="col-md-2 mb-3">
								<label for="company_country">Request To</label>
								<select class="form-control" id="branch_id_to" name="branch_id_to">
								</select>
							</div>
							<div class="col-md-2 mb-3">
								<label for="company_country">Inform to</label>
								<select class="form-control" id="inform_user_id" name="inform_user_id">
								</select>
							</div>
						</div>
					</div>
						<div class="card card-primary card-tabs">
						  <div class="card-header p-0 pt-1">
							<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
							  <li class="nav-item">
								<a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Main Items</a>
							  </li>
							  <!--li class="nav-item">
								<a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Sub Items</a>
							  </li-->
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
											  <th style="width: 30%">Main-Item</th>
											  <th style="width: 20%">No.of Items</th>
											  <th style="width: 10%">
												<button type="button" class="btn btn-block btn-success addMainBtn"><i class="nav-icon far fa-plus-square"> Add</i> </button>
											  </th>
											</tr>
										  </thead>
										  <tbody>
											<tr class="mainItemSet itemRow" id="1">
												<input type="hidden" class="form-control is_sub_item" id="is_sub_item" name="is_sub_item" value="0">
											  <td class="mainRowId" value="1">1.</td>
											  <td>
												<select class="form-control item_id main_item_id" id="main_item_id" name="main_item_id" required></select>
											  </td>
											  <td>
												<input class="form-control no_of_items" id="no_of_items" name="no_of_items" type="number" autocomplete="off">
											  </td>
											</tr>
											<tr class="mainItemSet itemRow" id="2">
												<input type="hidden" class="form-control is_sub_item" id="is_sub_item" name="is_sub_item" value="0">
											  <td class="mainRowId" value="2">2.</td>
											  <td>
												<select class="form-control item_id main_item_id" id="main_item_id" name="main_item_id" required></select>
											  </td>
											  <td>
												<input class="form-control no_of_items" id="no_of_items" name="no_of_items" type="number" autocomplete="off">
											  </td>
											  <td>
												<button type="button" class="btn btn-block btn-danger mainRemoveBtn"><i class="nav-icon far fa-minus-square"> Remove</i> </button>
											  </td>
											</tr>
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
											  <th style="width: 30%">Sub-Item</th>
											  <th style="width: 20%">No.of Items</th>
											  <th style="width: 10%">
												<button type="button" class="btn btn-block btn-success addSubBtn"><i class="nav-icon far fa-plus-square"> Add</i> </button>
											  </th>
											</tr>
										  </thead>
										  <tbody>
											<tr class="subItemSet itemRow" id="1">
												<input type="hidden" class="form-control is_sub_item" id="is_sub_item" name="is_sub_item" value="1">
											  <td class="subRowId" value="1">1.</td>
											  <td>
												<select class="form-control item_id sub_item_id" id="sub_item_id" name="sub_item_id" required></select>
											  </td>
											  <td>
												<input class="form-control no_of_items" id="no_of_items" name="no_of_items" type="number" autocomplete="off">
											  </td>
											</tr>
											<tr class="subItemSet itemRow" id="2">
												<input type="hidden" class="form-control is_sub_item" id="is_sub_item" name="is_sub_item" value="1">
											  <td class="subRowId" value="2">2.</td>
											  <td>
												<select class="form-control item_id sub_item_id" id="sub_item_id" name="sub_item_id" required></select>
											  </td>
											  <td>
												<input class="form-control no_of_items" id="no_of_items" name="no_of_items" type="number" autocomplete="off">
											  </td>
											  <td>
												<button type="button" class="btn btn-block btn-danger subRemoveBtn"><i class="nav-icon far fa-minus-square"> Remove</i> </button>
											  </td>
											</tr>
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
function loadInformPerson(){
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		url: API+"SysUser/fetch_all_active_join/",
		success: function(data, result){
			console.log(data);
			var company_drp = '<option value="">Select User</option>';
			$.each(data, function(index, item) {
				//console.log(item);
				company_drp += '<option value="'+item.user_id+'">'+item.company_branch_name+' - '+item.emp_first_name+'</option>';
			});
			$('#inform_user_id').append(company_drp);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			
			//console.log(errorThrown);
		}
	});
}

loadInformPerson();

function loadBranchFrom(){
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		url: API+"branch/fetch_all_active/",
		success: function(data, result){
			var company_drp = '';
			$.each(data, function(index, item) {
				//console.log(item);
				company_drp += '<option value="'+item.company_branch_id+'">'+item.company_branch_name+'</option>';
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
		success: function(data, result){
			var company_drp = '<option value="">Select Branch</option>';
			$.each(data, function(index, item) {
				//console.log(item);
				company_drp += '<option value="'+item.company_branch_id+'">'+item.company_branch_name+'</option>';
			});
			$('#branch_id_to').append(company_drp);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			
			//console.log(errorThrown);
		}
	});
}

loadBranchTo();

$(document).ready(function(){
	var date_input=$('input[name="create_date"]'); 
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		orientation: 'bottom'
	};
	date_input.datepicker(options);
	
	
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

function loadMainItem(){
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
			$('.main_item_id').append(item_drp);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			
			//console.log(errorThrown);
		}
	});
}

loadMainItem();

function loadSubItem(){
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
			$('.sub_item_id').append(sub_item_drp);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			
			//console.log(errorThrown);
		}
	});
}

loadSubItem();

$(document).on("click", ".addMainBtn", function () {
	
	var numItems = $('.mainItemSet').length;
	//console.log(numItems);
	var this_ = $(this);
	
	var selectedItemsArr = [];
	
	$('.main_item_id').each(function(){
		selectedItemsArr.push({
			item_id: $(".main_item_id option:selected").val()
		})
	});

	var rowHtml = '<tr class="mainItemSet itemRow" id="'+(numItems+1)+'">'+
				  '<td class="mainRowId" value="'+(numItems+1)+'">'+(numItems+1)+'.</td>'+
				  '<input type="hidden" class="form-control is_sub_item" id="is_sub_item" name="is_sub_item" value="0">'+
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
							if(jQuery.inArray(item.item_id, selectedItemsArr) != -1) {
								item_drp += '<option value="'+item.item_id+'">'+item.item_name+'</option>';
							}
							
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
				  '<input type="hidden" class="form-control is_sub_item" id="is_sub_item" name="is_sub_item" value="1">'+
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

/* $(document).on("change", ".main_item_id", function () {	
	if($(this).val() != ''){
		var value = $(this).val();
		alert(value);
		$('.main_item_id').not(this).each(function(){
			$(this).find('option[value='+value+']').remove();
		});
	}
	 
}) */



$('#submit').click(function(e){
	e.preventDefault();
	
	
	var create_date = "";
	var branch_id_from = 0;
	var branch_id_to = 0;
	var transfer_type = 0;
	var stock_type = 0;
	var inform_user_id = 0;
	
	var item_id = 0;
	var is_sub_item = 0;
	var no_of_items = 0;
	
	branch_id_from = $('#branch_id_from').val();
	branch_id_to = $('#branch_id_to').val();
	create_date = $('#create_date').val();
	transfer_type = $('#transfer_type').val();
	stock_type = $('#stock_type').val();
	inform_user_id = $('#inform_user_id').val();
	
	var itemsArr = [];
	var stockHeader = [];
	
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
		
	$('.itemRow').each(function(){
		
		item_id = $(this).find('.item_id').val();
		no_of_items = $(this).find('#no_of_items').val();
		is_sub_item = $(this).find('#is_sub_item').val();
		
		if(item_id != ''){
			itemsArr.push({
				item_id: item_id,
				no_of_items: no_of_items,
				is_sub_item: is_sub_item
			})
		}
		
		
	})
	
		
	stockHeader.push(
		{
			'branch_id_from':branch_id_from,
			'branch_id_to':branch_id_to,
			'create_date':create_date,
			'transfer_type':transfer_type,
			'stock_type':stock_type,
			'inform_user_id':inform_user_id
		}
	);
	
	
	var formData = new Object();
	formData = {
		stockHeader:stockHeader,
		itemsArr:itemsArr
	};
	
	console.log(formData);
	
	if(itemsArr.length > 0 && stockHeader.length > 0){
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
			url: API+"stockTransfer/insert/",
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
						window.location = "<?php echo base_url() ?>stockTransfer/view";
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