 <section class="content">
  <div class="container-fluid">
	<div class="row">
		<div class="col-12 col-sm-6 col-md-3">
		<div class="info-box mb-3">
		  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

		  <div class="info-box-content">
			<span class="info-box-text">System Users</span>
			<span class="info-box-number" id="user_count">2,000</span>
		  </div>
		</div>
	  </div>
	  <div class="col-12 col-sm-6 col-md-3">
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
	  <div class="col-12 col-sm-6 col-md-3">
		<div class="info-box mb-3">
		  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-id-card"></i></span>

		  <div class="info-box-content">
			<span class="info-box-text">Employees</span>
			<span class="info-box-number" id="employee_count">41,410</span>
		  </div>
		</div>
	  </div>
	  <div class="clearfix hidden-md-up"></div>

	  <div class="col-12 col-sm-6 col-md-3">
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
				  <span class="float-right"><b>160</b>/200</span>
				  <div class="progress progress-sm">
					<div class="progress-bar bg-primary" style="width: 80%"></div>
				  </div>
				</div>
				<div class="progress-group">
				  Compeleted Retail Orders
				  <span class="float-right"><b>310</b>/400</span>
				  <div class="progress progress-sm">
					<div class="progress-bar bg-danger" style="width: 75%"></div>
				  </div>
				</div>
				<div class="progress-group">
				  <span class="progress-text">Compeleted Online Orders</span>
				  <span class="float-right"><b>480</b>/800</span>
				  <div class="progress progress-sm">
					<div class="progress-bar bg-success" style="width: 60%"></div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="card-footer">
			<div class="row">
			  <div class="col-sm-3 col-6">
				<div class="description-block border-right">
				  <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
				  <h5 class="description-header">$35,210.43</h5>
				  <span class="description-text">TOTAL REVENUE</span>
				</div>
			  </div>
			  <div class="col-sm-3 col-6">
				<div class="description-block border-right">
				  <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
				  <h5 class="description-header">$10,390.90</h5>
				  <span class="description-text">TOTAL COST</span>
				</div>
			  </div>
			  <div class="col-sm-3 col-6">
				<div class="description-block border-right">
				  <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
				  <h5 class="description-header">$24,813.53</h5>
				  <span class="description-text">TOTAL PROFIT</span>
				</div>
			  </div>
			  <div class="col-sm-3 col-6">
				<div class="description-block">
				  <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
				  <h5 class="description-header">1200</h5>
				  <span class="description-text">GOAL COMPLETIONS</span>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>

	<div class="row">
	  <div class="col-md-6">
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
				  <th>Customer</th>
				  <th>Status</th>
				</tr>
				</thead>
				<tbody>
				<tr>
				  <td><a href="pages/examples/invoice.html">OR9842</a></td>
				  <td>Call of Duty IV</td>
				  <td><span class="badge badge-success">Shipped</span></td>
				</tr>
				
				</tbody>
			  </table>
			</div>
		  </div>
		  <div class="card-footer clearfix text-center">
			<a href="javascript:void(0)" class="uppercase">View All Orders</a>
		  </div>
		</div>
	  </div>

	  <div class="col-md-6"> 
		<div class="card">
		  <div class="card-header">
			<h3 class="card-title">Recently Added Main Products</h3>

			<div class="card-tools">
			  <button type="button" class="btn btn-tool" data-card-widget="collapse">
				<i class="fas fa-minus"></i>
			  </button>
			  
			</div>
		  </div>
		  <div class="card-body p-0">
			<ul class="products-list product-list-in-card pl-2 pr-2">
			  <li class="item">
				<div class="product-img">
				  <img src="<?php echo base_url() ?>assets/system/backend/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
				</div>
				<div class="product-info">
				  <a href="javascript:void(0)" class="product-title">Samsung TV
					<span class="badge badge-warning float-right">$1800</span></a>
				  <span class="product-description">
					Samsung 32" 1080p 60Hz LED Smart HDTV.
				  </span>
				</div>
			  </li>
			  <li class="item">
				<div class="product-img">
				  <img src="<?php echo base_url() ?>assets/system/backend/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
				</div>
				<div class="product-info">
				  <a href="javascript:void(0)" class="product-title">Bicycle
					<span class="badge badge-info float-right">$700</span></a>
				  <span class="product-description">
					26" Mongoose Dolomite Mens 7-speed, Navy Blue.
				  </span>
				</div>
			  </li>
			  <li class="item">
				<div class="product-img">
				  <img src="<?php echo base_url() ?>assets/system/backend/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
				</div>
				<div class="product-info">
				  <a href="javascript:void(0)" class="product-title">
					Xbox One <span class="badge badge-danger float-right">
					$350
				  </span>
				  </a>
				  <span class="product-description">
					Xbox One Console Bundle with Halo Master Chief Collection.
				  </span>
				</div>
			  </li>
			  <li class="item">
				<div class="product-img">
				  <img src="<?php echo base_url() ?>assets/system/backend/dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
				</div>
				<div class="product-info">
				  <a href="javascript:void(0)" class="product-title">PlayStation 4
					<span class="badge badge-success float-right">$399</span></a>
				  <span class="product-description">
					PlayStation 4 500GB Console (PS4)
				  </span>
				</div>
			  </li>
			</ul>
		  </div>
		  <div class="card-footer text-center">
			<a href="javascript:void(0)" class="uppercase">View All Products</a>
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
			$('#user_count').text(data.system_users);
			$('#vehicle_count').text(data.yard_vehicles);
			$('#employee_count').text(data.yard_employees);
			$('#customer_count').text(data.customers);
				
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			console.log(textStatus);					
		}
	});
};

loadData();



	var ctx = document.getElementById("salesChart").getContext("2d");


	var myChart = new Chart(ctx, {
		type: "bar",
		data: {
			labels: ["Wattala",	"Kiribathgoda"],
			datasets: [{
				label: "Branch Revenue", // Name the series
				data: [1000000,	800000], // Specify the data values array
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
</script> 
    
 

   
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->