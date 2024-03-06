
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DCS Enterprices</title>
	<link rel="icon" href="http://localhost/dcs/assets/system/backend/dist/img/logo.jpg" type="image/gif">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="http://localhost/dcs/assets/system/backend/plugins/fontawesome-free/css/all.min.css">
	
	<!-- fullCalendar -->
	<link rel="stylesheet" href="http://localhost/dcs/assets/system/backend/plugins/fullcalendar/main.css">	
	<!-- Scrollbars -->
	
	<!-- Theme style -->
	<link rel="stylesheet" href="http://localhost/dcs/assets/system/backend/dist/css/adminlte.min.css">
	<!-- jQuery -->
	<script src="http://localhost/dcs/assets/system/backend/plugins/jquery/jquery.min.js"></script>
	<!-- notyf css -->
	<link rel="stylesheet" href="http://localhost/dcs/assets/system/backend/dist/css/notyf.min.css">
	<!-- notyf js -->
	<script src="http://localhost/dcs/assets/system/backend/dist/js/notyf.min.js"></script>
	<!-- autocomplete css -->
	<link rel="stylesheet" href="http://localhost/dcs/assets/system/backend/dist/css/autocomplete.css">
	<!-- autocomplete js -->
	<script src="http://localhost/dcs/assets/system/backend/dist/js/jquery.autocomplete.min.js"></script>
	<!-- autocomplete bs js -->
	<script src="http://localhost/dcs/assets/system/backend/dist/js/bootstrap3-typeahead.min.js"></script>
	<!-- DataTables -->
	<link rel="stylesheet" href="http://localhost/dcs/assets/system/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="http://localhost/dcs/assets/system/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="http://localhost/dcs/assets/system/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	
	<!-- daterange picker -->
	<!--link rel="stylesheet" href="http://localhost/dcs/assets/system/backend/plugins/daterangepicker/daterangepicker.css"-->
	<link rel="stylesheet" href="http://localhost/dcs/assets/system/backend/plugins/datepicker/datepicker.css">
	 <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
               -webkit-appearance: none;
                margin: 0;
        }
 
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
	<script>
	var API = "http://localhost/API/";
	var web = "http://localhost/dcs/";
	</script>
</head>
<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="http://localhost/dcs/assets/system/backend/dist/img/logo.jpg" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" id="pushmenu" href="#" role="button""><i class="fas fa-bars"></i></a>
      </li>      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      
      <!-- Notifications Dropdown Menu -->
      <!--li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-bell" aria-hidden="true"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="http://localhost/dcs/userProfile/view" class="dropdown-item">
            notification 1
          </a>
          <div class="dropdown-divider"></div>
          <a id="logout" class="dropdown-item">
            notification 2
          </a>
        </div>
      </li-->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user" aria-hidden="true"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!--a href="http://localhost/dcs/userProfile/view" class="dropdown-item">
            <i class="far fa-edit mr-2"></i> Edit User Info
          </a-->
          <!--div class="dropdown-divider"></div-->
          <a id="logout" class="dropdown-item">
            <i class="fas fa-power-off mr-2"></i> Log Out
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://localhost/dcs/" class="brand-link">
      <img src="http://localhost/dcs/assets/system/backend/dist/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">DCS Enterprices</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="http://localhost/dcs/assets/system/backend/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Sachith</a>
        </div>
      </div>

      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle text-red"></i>
              <p>
                Employee
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
				<li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon text-red"></i>
                  <p>
                    Employee Details
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
					<li class="nav-item">
                    <a href="http://localhost/dcs/Employee/view" class="nav-link">
                      <i class="fas fa-address-card nav-icon text-red"></i>
                      <p>Personal details</p>
                    </a>
                  </li>	
                  <!--li class="nav-item">
					<a href="http://localhost/dcs/EmpAdvance/view" class="nav-link">
					  <i class="fas fa fa-retweet nav-icon text-red"></i>
					  <p>Advance</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="http://localhost/dcs/EmpAllowance/view" class="nav-link">
					  <i class="fas fa-money-check-alt nav-icon text-red"></i>
					  <p>Allowance</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="http://localhost/dcs/EmpBonus/view" class="nav-link">
					  <i class="fas fa fa-bolt nav-icon text-red"></i>
					  <p>Bonus</p>
					</a>
				  </li-->
				                    
				  <li class="nav-item">
					<a href="http://localhost/dcs/EmpDrivingLicense/view" class="nav-link">
					  <i class="fas fa-id-badge nav-icon text-red"></i>
					  <p>Driving License</p>
					</a>
				  </li>
				   				  
				  <li class="nav-item">
					<a href="http://localhost/dcs/EmpWorkContract/view" class="nav-link">
					  <i class="fas fa-calendar-check nav-icon text-red"></i>
					  <p>Work Contract</p>
					</a>
				  </li>				  
                </ul>
              </li>
			  
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon text-red"></i>
                  <p>
                    Employee Leave
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
									 
                  <!--li class="nav-item">
                    <a href="http://localhost/dcs/EmpLeaveQuota/view" class="nav-link">
                      <i class="fas fa-toggle-on nav-icon text-red"></i>
                      <p>Leave Quota</p>
                    </a>
                  </li>
				   <li class="nav-item">
                    <a href="http://localhost/dcs/EmpWiseLeaveQuota/view" class="nav-link">
                      <i class="fas fa-toggle-on nav-icon text-red"></i>
                      <p>Employee wise Leave Quota</p>
                    </a>
                  </li-->
                  <li class="nav-item">
                    <a href="http://localhost/dcs/EmpLeave/view" class="nav-link">
                      <i class="fas fa-bed nav-icon text-red"></i>
                      <p>My Leave</p>
                    </a>
                  </li> 
										
                </ul>
              </li>
			  <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon text-red"></i>
                  <p>
                    Medical
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
					                   <li class="nav-item">
                    <a href="http://localhost/dcs/EmpMedicalRecord/view" class="nav-link">
                      <i class="fas fa-heartbeat nav-icon text-red"></i>
                      <p>Medical Records</p>
                    </a>
                  </li>                  
                </ul>
              </li>
			   <li class="nav-item">
				<a href="http://localhost/dcs/empAttendance/view" class="nav-link">
				  <i class="far fa-circle nav-icon text-red"></i>
				  <p>Employee Attendance</p>
				</a>
			  </li>
			  <!--li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon text-red"></i>
                  <p>
                    Employee Overtime
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="http://localhost/dcs/EmpOvertime/view" class="nav-link">
                      <i class="fas fa-business-time nav-icon text-red"></i>
                      <p>Overtime details</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="http://localhost/dcs/EmpOvertimeRate/view" class="nav-link">
                      <i class="fas fa-chart-line nav-icon text-red"></i>
                      <p>Overtime rate</p>
                    </a>
                  </li>
                </ul>
              </li-->
			  <!--li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon text-red"></i>
                  <p>
                    Employee Salary
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="http://localhost/dcs/EmpSalaryAdvance/view" class="nav-link">
                      <i class="fas fa-donate nav-icon text-red"></i>
                      <p>salary Advance</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="http://localhost/dcs/EmpSalaryAllowance/view" class="nav-link">
                      <i class="fas fa-hand-holding-usd nav-icon text-red"></i>
                      <p>Salary Allowance</p>
                    </a>
                  </li>
				  <li class="nav-item">
                    <a href="http://localhost/dcs/EmpSalaryBonus/view" class="nav-link">
                      <i class="fas fa-piggy-bank nav-icon text-red"></i>
                      <p>Salary Bonus</p>
                    </a>
                  </li>
				  <li class="nav-item">
                    <a href="http://localhost/dcs/EmpSalaryIncrement/view" class="nav-link">
                      <i class="fas fa-comment-dollar nav-icon text-red"></i>
                      <p>Salary Increment</p>
                    </a>
                  </li>
				  <li class="nav-item">
                    <a href="http://localhost/dcs/EmpSalaryScale/view" class="nav-link">
                      <i class="fas fa-balance-scale nav-icon text-red"></i>
                      <p>Salary Scale</p>
                    </a>
                  </li>
                </ul>
              </li-->
				 <li class="nav-item">
						<a href="#" class="nav-link">
						  <i class="far fa-circle nav-icon text-red"></i>
						  <p>
							Employee Task List
							<i class="right fas fa-angle-left"></i>
						  </p>
						</a>
						<ul class="nav nav-treeview"> <li class="nav-item">
									<a href="http://localhost/dcs/empTaskAssign/myTaskView" class="nav-link">
									  <i class="fa fa-history nav-icon text-red"></i>
									  <p>My Task List</p>
									</a>
								  </li></ul>
					  </li>            </ul>
          </li>
         		  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle text-info"></i>
              <p>
                Inventory
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
				              
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon text-info"></i>
                  <p>
                    Stock
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
									
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-people-arrows nav-icon text-info"></i>
                      <p>Rental Stock</p>
					  <i class="right fas fa-angle-left"></i>
                    </a>
					<ul class="nav nav-treeview">
											  
					  <li class="nav-item">
						<a href="http://localhost/dcs/stockRental/view" class="nav-link">
						  <i class="fas fa-cube nav-icon text-yellow"></i>
						  <p>Rental Stock Details</p>
						</a>
					  </li>
					</ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-cube nav-icon text-info"></i>
                      <p>Retail Stock</p>
					  <i class="right fas fa-angle-left"></i>
                    </a>
					<ul class="nav nav-treeview">
											 
					  <li class="nav-item">
						<a href="http://localhost/dcs/stockRetail/view" class="nav-link">
						  <i class="fas fa-cube nav-icon text-white"></i>
						  <p>Retail Stock Details</p>
						</a>
					  </li>
					</ul>
                  </li>
				  				  
                </ul>
              </li>
            </ul>
          </li>
		  <!--li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle text-indigo"></i>
              <p>
                Salary Advance
              </p>
            </a>
          </li-->
		  		  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
	
  </aside>
  
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


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
					  '<td><a class="btn btn-primary btn-sm" href="pages/examples/invoice.html"><i class="fa fa-eye"></i></a></td>'+					  
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
  <!-- /.control-sidebar --><script>
//disable right click 
/* document.addEventListener('contextmenu', (e) => e.preventDefault());

function ctrlShiftKey(e, keyCode) {
  return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
}

document.onkeydown = (e) => {
  // Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
  if (
    event.keyCode === 123 ||
    ctrlShiftKey(e, 'I') ||
    ctrlShiftKey(e, 'J') ||
    ctrlShiftKey(e, 'C') ||
    (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
  )
    return false;
}; */

/*** add active class and stay opened when selected ***/
var url = window.location;

// for sidebar menu entirely but not cover treeview
$('ul.nav-sidebar a').filter(function() {
    if (this.href) {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }
}).addClass('active');

// for the treeview
$('ul.nav-treeview a').filter(function() {
    if (this.href) {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }
}).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
$(document).on('click', '#logout', function(e){
    e.preventDefault();
   
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",	
		url: web+"ApiRequest/logout/",
		success: function(data, result){
			//var count = Object.keys(data).length;
			console.log(data);	
			if(data.error == false){
				$(location).prop('href', web+'logout/')				
			}
			else{
				//console.log('error');
			}				
			
			
		},
		
	});
});

$(document).on('click', '#logout', function(){
	
	
})
</script>
  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="#">DCS Enterprices</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- Jquery -->
<script src="http://localhost/dcs/assets/system/backend/plugins/jquery-ui/jquery-ui.js"></script>
<!-- Bootstrap -->
<script src="http://localhost/dcs/assets/system/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="http://localhost/dcs/assets/system/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/jszip/jszip.min.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/pdfmake/pdfmake.min.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/pdfmake/vfs_fonts.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="http://localhost/dcs/assets/system/backend/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="http://localhost/dcs/assets/system/backend/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/raphael/raphael.min.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="http://localhost/dcs/assets/system/backend/plugins/chart.js/Chart.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="http://localhost/dcs/assets/system/backend/plugins/moment/moment.min.js"></script>
<!-- date-range-picker -->
<!--script src="http://localhost/dcs/assets/system/backend/plugins/daterangepicker/daterangepicker.js"></script-->
<script src="http://localhost/dcs/assets/system/backend/plugins/datepicker/datepicker.js"></script>
<script src="http://localhost/dcs/assets/system/backend/plugins/fullcalendar/main.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="http://localhost/dcs/assets/system/backend/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--script src="http://localhost/dcs/assets/system/backend/dist/js/pages/dashboard2.js"></script-->


</body>
</html>