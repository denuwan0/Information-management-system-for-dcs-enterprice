<div class="modal fade" id="modalInfo"  aria-hidden="true" style="">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalInfoHeader"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body" id="modalInfoBody" >	
				<div class="row">
					<div class="col-md-4">
						<div class="info-box bg-gradient-danger" style="cursor: pointer;">
							<span class="info-box-icon"><i class="fa fa-trash"></i></span>
							<div class="info-box-content">
							<span class="info-box-text">Cancel</span>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="info-box bg-gradient-danger" style="cursor: pointer;">
							<span class="info-box-icon"><i class="fa fa-trash"></i></span>
							<div class="info-box-content">
							<span class="info-box-text">Cancel</span>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="info-box bg-gradient-danger" style="cursor: pointer;">
							<span class="info-box-icon"><i class="fa fa-trash"></i></span>
							<div class="info-box-content">
							<span class="info-box-text">Cancel</span>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="info-box bg-gradient-danger" style="cursor: pointer;">
							<span class="info-box-icon"><i class="fa fa-trash"></i></span>
							<div class="info-box-content">
							<span class="info-box-text">Cancel</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-right">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">        
		<div class="row" id="categoryDiv">
		  
		</div>

        <!-- Main row -->
        <div class="row" >
          <!-- Left col -->
          <div class="col-md-7">
            <!-- MAP & BOX PANE -->
            <div class="card" style="height:350px">
              <div class="card-header">
                <h3 class="card-title">Products</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="max-height: 350px; overflow-y: auto;">
				<div class="row" id="productDiv">
					
				</div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-5" >
            <!-- PRODUCT LIST -->
            <div class="card" style="height:350px;">
              <div class="card-header">
                <h3 class="card-title">Checkout</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
			  <table class="table">
			  <thead>
				<tr>
					<th scope="col" width="10%">#</th>
					<th scope="col" width="40%" style="text-align:left">Name</th>
					<th scope="col" width="10%" style="text-align:left">Qty</th>
					<th scope="col" width="30%" style="text-align:center">Price</th>						
					<th scope="col" width="10%" style="text-align:left"></th>
				</tr>
			  </thead>
			  </table>
			  <div style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
			  <table class="table">				  
				  <tbody id="checkoutDiv">
					
					
				  </tbody>
				</table>
              </div>
			  </div>
              <!-- /.card-body -->
              <div class="bg-info">
				<div class="row">
					<table class="table">
					  <tbody>
						<tr style="border-style : hidden!important;">
							<td scope="col" width="10%"></th>
							<th scope="col" width="40%">Total</th>
							<th scope="col" width="10%"></th>
							<th scope="col" width="30%" style="text-align:center">0.00</th>						
							<th scope="col" width="10%"></th>
						</tr>
					  </tbody>
					</table>
				</div>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
		<div class="row" style="justify-content: right;">
			<div class="col-md-4 col-sm-4 col-12">
				<div class="info-box bg-gradient-danger" style="cursor: pointer;">
					<span class="info-box-icon"><i class="fa fa-trash"></i></span>
					<div class="info-box-content">
					<span class="info-box-text">Cancel</span>
					</div>
				</div>
			</div>	
			<div class="col-md-4 col-sm-4 col-12">
				<div class="info-box bg-gradient-success" style="cursor: pointer;" id="payBtn">
					<span class="info-box-icon"><i class="fa fa-check-circle"></i></span>
					<div class="info-box-content">
					<span class="info-box-text">Pay</span>
					</div>
				</div>
			</div>
		</div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>

 
  <script>
  
function loadData() {
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"ItemCategory/fetch_all_active",
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {

				var catHtml = '';
			
				var color = ["bg-gradient-info",
				"bg-gradient-danger",
				"bg-gradient-success",
				"bg-gradient-warning",
				"bg-gradient-primary",
				"bg-gradient-light",
				"bg-gradient-dark",
				"bg-gradient-secondary"]
				$.each(data, function (i, item) {
					
					catHtml = '<div class="col-12 col-sm-6 col-md-3" style="max-width:12%; cursor: pointer;">'+		
								'<div class="info-box '+color[i]+' catDiv" value="'+item.item_category_id+'" style="min-width:100%;">'+
								  '<div class="info-box-content">'+
									'<span class="info-box-text text-wrap"><h6>'+item.category_name+'</h6></span>'+
								  '</div>'+
								'</div>'+
							  '</div>';
					
					
					$('#categoryDiv').append(catHtml);		
				});
				
				
							
			});
			

		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			console.log(textStatus);					
		}
	});
};

loadData();
  
  
$(document).on('click', '.catDiv', function(){
 //$('#modalInfo').modal('show');
	//console.log($(this).attr('value'));
	var catId = 0;
	catId = $(this).attr('value');
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"Item/fetch_all_main_sub_item_by_category_id/?id="+catId,
		success: function(data, result){
			console.log(data);
			
			$(function () {

				var prdHtml = '';
			
				$.each(data, function (i, item) {
												  
					prdHtml += '<div class="col-md-3">'+
									'<div class="card bg-gradient-white" style="cursor: pointer;">'+
										'<div class="card-header">'+
											'<font class="">'+item.item_name+'</font>'+
											'<div class="card-tools">'+
												'<button type="button" class="btn btn-tool" data-card-widget="collapse">'+
													'<i class="fas fa-minus"></i>'+
												'</button>'+
											'</div>'+
										'</div>'+
										'<div class="card-body">'+
											'<img src="'+item.image_url+'" class="rounded float-left" alt="..." style="width: -webkit-fill-available;">'+
										'</div>'+
										'<div class="card-footer">'+
											'<button type="button" class="btn btn-block btn-outline-dark btn-sm addItem">Add</button>'+
										'</div>'+
									'</div>'+
								'</div>';
					
					
						
				});
				
				$('#productDiv').html(prdHtml);	
							
			});
				
		}
	});
})

$(document).on('click', '.addItem', function(){
	
	var checkoutHtml = "";
	
	checkoutHtml += '<tr>'+
					  '<th scope="row">1</th>'+
					  '<th scope="row">frame</th>'+
					  '<td width="10%">'+
						'<div class="btn-group">'+
							'<a class="btn"><i class="fa fa-minus-circle minBtn" style="color:red"></i></a>'+
							'<a class="btn" id="qty">1</a>'+
							'<a class="btn"><i class="fas fa-plus-circle plusBtn" style="color:green"></i></a>'+
						'</div>'+
						'</td>'+
					  '<td width="10%" align="right">500</td>	'+				  
					  '<td width="10%"><a class="btn"><i class="fa fa-trash"></i></a></td>'+
					'</tr>';
	
	$('#checkoutDiv').append(checkoutHtml);
});

$(document).on('click', '.minBtn', function(){
	
	console.log($(this).find('#qty').last());
	
	/* var qtyHtml = "";
	
		qtyHtml += '<tr>'+
		  '<th scope="row">1</th>'+
		  '<th scope="row">frame</th>'+
		  '<td width="10%">'+
			'<div class="btn-group">'+
				'<a class="btn"><i class="fa fa-minus-circle" style="color:red"></i></a>'+
				'<a class="btn">1</a>'+
				'<a class="btn"><i class="fas fa-plus-circle" style="color:green"></i></a>'+
			'</div>'+
			'</td>'+
		  '<td width="10%" align="right">500</td>	'+				  
		  '<td width="10%"><a class="btn"><i class="fa fa-trash"></i></a></td>'+
		'</tr>';
	
	$('#qty').html(qtyHtml); */
});

  </script>