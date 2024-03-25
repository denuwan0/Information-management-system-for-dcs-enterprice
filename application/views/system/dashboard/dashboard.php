 <section class="content">
  <div class="container-fluid">
	<div class="row">
		<div class="col-12 col-sm-6 col-md-3 user_box">
		<div class="info-box mb-3">
		  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

		  <div class="info-box-content ">
			<span class="info-box-text">System Users</span>
			<span class="info-box-number" id="user_count">2,000</span>
		  </div>
		</div>
	  </div>
	  <div class="col-12 col-sm-6 col-md-3 yard_box">
		<div class="info-box">
		  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-truck"></i></span>

		  <div class="info-box-content">
			<span class="info-box-text">Yard Vehicles</span>
			<span class="info-box-number" id="vehicle_count">
			  10
			</span>
		  </div>
		</div>
	  </div>
	  <div class="col-12 col-sm-6 col-md-3 employee_box">
		<div class="info-box mb-3">
		  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-id-card"></i></span>

		  <div class="info-box-content">
			<span class="info-box-text">Employees</span>
			<span class="info-box-number" id="employee_count">41,410</span>
		  </div>
		</div>
	  </div>
	  <div class="clearfix hidden-md-up"></div>

	  <div class="col-12 col-sm-6 col-md-3 customer_box">
		<div class="info-box mb-3">
		  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-smile"></i></span>

		  <div class="info-box-content">
			<span class="info-box-text">Customers</span>
			<span class="info-box-number" id="customer_count">760</span>
		  </div>
		</div>
	  </div>
	  
	</div>

	<div class="row">
	  <div class="col-md-12">
		<div class="card">
		  <div class="card-header">
			<h5 class="card-title">Monthly Recap Report</h5>

			<div class="card-tools">
			  <button type="button" class="btn btn-tool" data-card-widget="collapse">
				<i class="fas fa-minus"></i>
			  </button>
			  
			</div>
		  </div>
		  <div class="card-body">
			<div class="row">
			  <div class="col-md-8">
				<p class="text-center">
				  <strong></strong>
				</p>

				<div class="chart">
				  <canvas id="salesChart" style="max-height: 300px;"></canvas>
				</div>
			  </div>
			  <div class="col-md-4">
				<p class="text-center">
				  <strong>Goal Completion</strong>
				</p>

				<div class="progress-group">
				  Compeleted Rental Orders
				  <span class="float-right"><b id="complete_rental_orders">0</b>/100</span>
				  <div class="progress progress-sm">
					<div class="progress-bar bg-primary" id="complete_rental_orders_width"  ></div>
				  </div>
				</div>
				<div class="progress-group">
				  Compeleted Retail Orders
				  <span class="float-right"><b id="complete_retail_orders">0</b>/100</span>
				  <div class="progress progress-sm">
					<div class="progress-bar bg-danger" id="complete_retail_orders_width" ></div>
				  </div>
				</div>
				<div class="progress-group">
				  <span class="progress-text">Compeleted Online Orders</span>
				  <span class="float-right"><b id="complete_online_orders">0</b>/100</span>
				  <div class="progress progress-sm">
					<div class="progress-bar bg-success" id="complete_online_orders_width"></div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="card-footer">
			
		  </div>
		</div>
	  </div>
	</div>

	<div class="row">
	  <div class="col-md-8">
		<div class="card">
		  <div class="card-header border-transparent">
			<h3 class="card-title">Latest Orders</h3>

			<div class="card-tools">
			  <button type="button" class="btn btn-tool" data-card-widget="collapse">
				<i class="fas fa-minus"></i>
			  </button>
			  
			</div>
		  </div>
		  <div class="card-body p-0">
			<div class="table-responsive">
			  <table class="table m-0">
				<thead>
				<tr>
				  <th>Order ID</th>
				  <th>Ordet Date</th>
				  <th>Ordet Type</th>
				  <th>Status</th>
				  <th></th>
				</tr>
				</thead>
				<tbody id="orders_list">
				
				
				</tbody>
			  </table>
			</div>
		  </div>
		  <div class="card-footer clearfix text-center">
			
		  </div>
		</div>
	  </div>

	  <div class="col-md-4"> 
		<div class="card">
		  <div class="card-header">
			<h3 class="card-title">Recently Added Products</h3>

			<div class="card-tools">
			  <button type="button" class="btn btn-tool" data-card-widget="collapse">
				<i class="fas fa-minus"></i>
			  </button>
			  
			</div>
		  </div>
		  <div class="card-body p-0">
			<ul class="products-list product-list-in-card pl-2 pr-2" id="item_list">
			
			  
			  
			</ul>
		  </div>
		  <div class="card-footer text-center">
			<a href="http://localhost/dcs/item/view" class="uppercase">View All Products</a>
		  </div>
		</div>
	  </div>
	  
	  
	</div>
  </div>
  <div class="col-md-6 col-lg-4">
	 
  </div>

</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

<script>
function loadData() {		
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"Dashboard/data",
		success: function(data, result){
			console.log(data);
			if(data.system_users != ''){
				$('#user_count').text(data.system_users);
			}
			else{
				$('.user_box').remove();
			}
			
			if(data.yard_vehicles != ''){
				$('#vehicle_count').text(data.yard_vehicles);
			}
			else{
				$('.yard_box').remove();
			}
			
			if(data.yard_employees != ''){
				$('#employee_count').text(data.yard_employees);
			}
			else{
				$('.employee_box').remove();
			}
			
			if(data.customers != ''){
				$('#customer_count').text(data.customers);
			}
			else{
				$('.customer_box').remove();
			}
			
			
			
			$('#complete_online_orders').text(data.complete_online_orders);
			$('#complete_rental_orders').text(data.complete_rental_orders);
			$('#complete_retail_orders').text(data.complete_retail_orders);
			
			var complete_online_orders_width = ((data.complete_online_orders)/100)*100;
			var complete_rental_orders_width = ((data.complete_rental_orders)/100)*100;
			var complete_retail_orders_width = ((data.complete_retail_orders)/100)*100;
			
			$('#complete_online_orders_width').css('width',complete_online_orders_width+'%');
			$('#complete_rental_orders_width').css('width',complete_rental_orders_width+'%');
			$('#complete_retail_orders_width').css('width',complete_retail_orders_width+'%');
			
			
			$.each(data.latest_orders, function (i, item) {
				
				var url = '';
				if(item.order_type == 'Retail'){
					url = "http://localhost/dcs/RetailOrder/view";
				}
				else if(item.order_type == 'Rental'){
					url = "http://localhost/dcs/RentalOrder/view";
				}
				else if(item.order_type == 'Online'){
					url = "http://localhost/dcs/OnlineOrder/view";
				} 
				
				var status = '';
				if(item.is_complete == 1){
					status = '<span class="badge badge-success">Complete</span>';
				}
				else{
					status = '<span class="badge badge-danger">Not Complete</span>';
				}
				
				//console.log(item);
				var listHtml = '<tr>'+					 
					  '<td>'+item.order_id+'</td>'+
					  '<td>'+item.created_date+'</td>'+
					   '<td>'+item.order_type+'</td>'+
					  '<td>'+status+'</td>'+
					  '<td><a class="btn btn-primary btn-sm" href="'+url+'"><i class="fa fa-eye"></i></a></td>'+					  
					'</tr>';
					
				$('#orders_list').append(listHtml);
			})
			
			$.each(data.latest_items, function (i, item) {
				
								
				//console.log(item);
				var listHtml = '<li class="item">'+
								'<div class="product-img">'+
								  '<img src="'+item.item_image_url+'" alt="Product Image" class="img-size-50">'+
								'</div>'+
								'<div class="product-info">'+
								  '<a href="javascript:void(0)" class="product-title">'+item.item_name+
								  '<span class="product-description">'+item.item_desc+
									
								  '</span>'+
								'</div>'+
							  '</li>';
					
				$('#item_list').append(listHtml);
			})
			
			console.log(data.branch_wise_sale);
			
			var labels = [];
			var total = [];
			
			$.each(data.branch_wise_sale, function (i, item) {
				labels.push(item.company_branch_name);
				total.push(item.total);
			})
			
			console.log(data.branch_wise_sale);
			var ctx = document.getElementById("salesChart").getContext("2d");
			

			var myChart = new Chart(ctx, {
				type: "bar",
				data: {
					labels: labels,
					datasets: [{
						label: "Branch Revenue Rs.", // Name the series
						data: total, // Specify the data values array
						fill: false,
						borderColor: "#2196f3", // Add custom color border (Line)
						backgroundColor: "#2196f3", // Add custom color background (Points and Fill)
						borderWidth: 1 // Specify bar border width
					}]},
				options: {
				  responsive: true, // Instruct chart js to respond nicely.
				  maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
				}
			});
			
			
				
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			console.log(textStatus);					
		}
	});
};

loadData();



	
</script> 
    
 

   
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->