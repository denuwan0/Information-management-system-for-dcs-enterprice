<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DCS Enterprices</title>
	<link rel="icon" href="<?php echo base_url() ?>assets/system/backend/dist/img/logo.jpg" type="image/gif">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/system/backend/plugins/fontawesome-free/css/all.min.css">
	
	<!-- fullCalendar -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/system/backend/plugins/fullcalendar/main.css">	
	<!-- Scrollbars -->
	
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/system/backend/dist/css/adminlte.min.css">
	<!-- jQuery -->
	<script src="<?php echo base_url() ?>assets/system/backend/plugins/jquery/jquery.min.js"></script>
	<!-- notyf css -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/system/backend/dist/css/notyf.min.css">
	<!-- notyf js -->
	<script src="<?php echo base_url() ?>assets/system/backend/dist/js/notyf.min.js"></script>
	<!-- autocomplete css -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/system/backend/dist/css/autocomplete.css">
	<!-- autocomplete js -->
	<script src="<?php echo base_url() ?>assets/system/backend/dist/js/jquery.autocomplete.min.js"></script>
	<!-- autocomplete bs js -->
	<script src="<?php echo base_url() ?>assets/system/backend/dist/js/bootstrap3-typeahead.min.js"></script>
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/system/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/system/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/system/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	
	<!-- daterange picker -->
	<!--link rel="stylesheet" href="<?php echo base_url() ?>assets/system/backend/plugins/daterangepicker/daterangepicker.css"-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/system/backend/plugins/datepicker/datepicker.css">
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
    <img class="animation__wobble" src="<?php echo base_url() ?>assets/system/backend/dist/img/logo.jpg" alt="AdminLTELogo" height="60" width="60">
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
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-bell" aria-hidden="true"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="<?php echo base_url() ?>userProfile/view" class="dropdown-item">
            notification 1
          </a>
          <div class="dropdown-divider"></div>
          <a id="logout" class="dropdown-item">
            notification 2
          </a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user" aria-hidden="true"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="<?php echo base_url() ?>userProfile/view" class="dropdown-item">
            <i class="far fa-edit mr-2"></i> Edit User Info
          </a>
          <div class="dropdown-divider"></div>
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
    <a href="<?php echo base_url() ?>" class="brand-link">
      <img src="<?php echo base_url() ?>assets/system/backend/dist/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">DCS Enterprices</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url() ?>assets/system/backend/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo !empty($this->session->userdata('emp_first_name'))?$this->session->userdata('emp_first_name'):$this->session->userdata('customer_name'); ?></a>
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
                    <a href="<?php echo base_url() ?>Employee/view" class="nav-link">
                      <i class="fas fa-address-card nav-icon text-red"></i>
                      <p>Personal details</p>
                    </a>
                  </li>	
                  <li class="nav-item">
					<a href="<?php echo base_url() ?>EmpAllowance/view" class="nav-link">
					  <i class="fas fa-money-check-alt nav-icon text-red"></i>
					  <p>Allowance</p>
					</a>
				  </li>
                  <li class="nav-item">
					<a href="<?php echo base_url() ?>EmpDesignation/view" class="nav-link">
					  <i class="fas fa-puzzle-piece nav-icon text-red"></i>
					  <p>Designation</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="<?php echo base_url() ?>EmpGrade/view" class="nav-link">
					  <i class="fas fa-rocket nav-icon text-red"></i>
					  <p>Grade</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="<?php echo base_url() ?>EmpGroup/view" class="nav-link">
					  <i class="fas fa-users nav-icon text-red"></i>
					  <p>Group</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="<?php echo base_url() ?>EmpDrivingLicense/view" class="nav-link">
					  <i class="fas fa-id-badge nav-icon text-red"></i>
					  <p>Driving License</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="<?php echo base_url() ?>EmpWorkSchedule/view" class="nav-link">
					  <i class="fas fa-sync nav-icon text-red"></i>
					  <p>Work Schedule</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="<?php echo base_url() ?>EmpWorkContract/view" class="nav-link">
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
				  <li class="nav-item">
                    <a href="<?php echo base_url() ?>EmpLeaveType/view" class="nav-link">
                      <i class="fas fa-mug-hot nav-icon text-red"></i>
                      <p>Leave Type</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>EmpLeaveQuota/view" class="nav-link">
                      <i class="fas fa-toggle-on nav-icon text-red"></i>
                      <p>Leave Quota</p>
                    </a>
                  </li>
				   <li class="nav-item">
                    <a href="<?php echo base_url() ?>EmpWiseLeaveQuota/view" class="nav-link">
                      <i class="fas fa-toggle-on nav-icon text-red"></i>
                      <p>Employee wise Leave Quota</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>EmpLeave/view" class="nav-link">
                      <i class="fas fa-bed nav-icon text-red"></i>
                      <p>Leave</p>
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
                    <a href="<?php echo base_url() ?>EmpMedicalLoc/view" class="nav-link">
                      <i class="fas fa-h-square nav-icon text-red"></i>
                      <p>Medical Center Location</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>EmpMedicalRecord/view" class="nav-link">
                      <i class="fas fa-heartbeat nav-icon text-red"></i>
                      <p>Medical Records</p>
                    </a>
                  </li>                  
                </ul>
              </li>
			   <li class="nav-item">
				<a href="<?php echo base_url() ?>empAttendance/view" class="nav-link">
				  <i class="far fa-circle nav-icon text-red"></i>
				  <p>Employee Attendance</p>
				</a>
			  </li>
			  <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon text-red"></i>
                  <p>
                    Employee Overtime
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>EmpOvertime/view" class="nav-link">
                      <i class="fas fa-business-time nav-icon text-red"></i>
                      <p>Overtime details</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>EmpOvertimeRate/view" class="nav-link">
                      <i class="fas fa-chart-line nav-icon text-red"></i>
                      <p>Overtime rate</p>
                    </a>
                  </li>
                </ul>
              </li>
			  <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon text-red"></i>
                  <p>
                    Employee Salary
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>EmpSalaryAdvance/view" class="nav-link">
                      <i class="fas fa-donate nav-icon text-red"></i>
                      <p>salary Advance</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>EmpSalaryAllowance/view" class="nav-link">
                      <i class="fas fa-hand-holding-usd nav-icon text-red"></i>
                      <p>Salary Allowance</p>
                    </a>
                  </li>
				  <li class="nav-item">
                    <a href="<?php echo base_url() ?>EmpSalaryBonus/view" class="nav-link">
                      <i class="fas fa-piggy-bank nav-icon text-red"></i>
                      <p>Salary Bonus</p>
                    </a>
                  </li>
				  <li class="nav-item">
                    <a href="<?php echo base_url() ?>EmpSalaryIncrement/view" class="nav-link">
                      <i class="fas fa-comment-dollar nav-icon text-red"></i>
                      <p>Salary Increment</p>
                    </a>
                  </li>
				  <li class="nav-item">
                    <a href="<?php echo base_url() ?>EmpSalaryScale/view" class="nav-link">
                      <i class="fas fa-balance-scale nav-icon text-red"></i>
                      <p>Salary Scale</p>
                    </a>
                  </li>
                </ul>
              </li>
			  <li class="nav-item">
				<a href="<?php echo base_url() ?>EmpSpecialTask/view" class="nav-link">
				  <i class="far fa-circle nav-icon text-red"></i>
				  <p>Employee Special Task</p>
				</a>
			  </li>
            </ul>
          </li>
         <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle text-warning"></i>
              <p>
                Vehicle
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
			  <li class="nav-item">
                <a href="<?php echo base_url() ?>vehicleType/view" class="nav-link">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p>Vehicle Type</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?php echo base_url() ?>vehicleCategory/view" class="nav-link">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p>Vehicle Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>vehicle/view" class="nav-link">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p>Vehicle Details</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?php echo base_url() ?>vehicleEcoTest/view" class="nav-link">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p>Vehicle Eco-Test</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?php echo base_url() ?>vehicleRevenue/view" class="nav-link">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p>Revenue License</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p>
                    Vehicle Repair
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="<?php echo base_url() ?>vehicleRepairLoc/view" class="nav-link">
						  <i class="fas fa-car-battery nav-icon text-warning"></i>
						  <p>Repair Location</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url() ?>vehicleRepair/view" class="nav-link">
						  <i class="fas fa-wrench nav-icon text-warning"></i>
						  <p>Repair Details</p>
						</a>
					</li>                  
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p>
                    Vehicle Insuarance
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="<?php echo base_url() ?>vehicleInsuranceCompany/view" class="nav-link">
						  <i class="fas fa-building nav-icon text-warning"></i>
						  <p>Insuarance Company</p>
						</a>
					  </li>
					<li class="nav-item">
                    <a href="<?php echo base_url() ?>vehicleInsurance/view" class="nav-link">
                      <i class="fas fa-ambulance nav-icon text-warning"></i>
                      <p>Insuarance Details</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>vehicleInsuranceClaim/view" class="nav-link">
                      <i class="fas fa-file-medical nav-icon text-warning"></i>
                      <p>Claim</p>
                    </a>
                  </li>
                </ul>
              </li>
			  <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p>
                    Vehicle Service
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
					<li class="nav-item">
                    <a href="<?php echo base_url() ?>vehicleServiceCenter/view" class="nav-link">
                      <i class="fas fa-air-freshener nav-icon text-warning"></i>
                      <p>Service Center</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>vehicleService/view" class="nav-link">
                      <i class="fas fa-oil-can nav-icon text-warning"></i>
                      <p>Service Details</p>
                    </a>
                  </li>
                  
                </ul>
              </li>
            </ul>
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
                    Item
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>item/view" class="nav-link">
                      <i class="fas fa-box nav-icon text-info"></i>
                      <p>Item Details</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>subItem/view" class="nav-link">
                      <i class="fas fa-clipboard-list nav-icon text-info"></i>
                      <p>Sub-Item Details</p>
                    </a>
                  </li>
				  <li class="nav-item">
                    <a href="<?php echo base_url() ?>itemSubItem/view" class="nav-link">
                      <i class="fas fa-box nav-icon text-info"></i>
                      <p>Item with Sub-Items</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>itemCategory/view" class="nav-link">
                      <i class="fas fa-dolly nav-icon text-info"></i>
                      <p>Item Category</p>
                    </a>
                  </li>
				  <li class="nav-item">
                    <a href="<?php echo base_url() ?>itemSubCategory/view" class="nav-link">
                      <i class="fas fa-clipboard nav-icon text-info"></i>
                      <p>Item Sub Category</p>
                    </a>
                  </li>
                </ul>
              </li>
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
                    <a href="<?php echo base_url() ?>stock/view" class="nav-link">
                      <i class="fas fa-store nav-icon text-info"></i>
                      <p>Stock Purchase</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-people-arrows nav-icon text-info"></i>
                      <p>Rental Stock</p>
					  <i class="right fas fa-angle-left"></i>
                    </a>
					<ul class="nav nav-treeview">
					  <li class="nav-item">
						<a href="<?php echo base_url() ?>stockRentalAllocate/view" class="nav-link">
						  <i class="fas fa-boxes nav-icon text-yellow"></i>
						  <p>Stock Allocation</p>
						</a>
					  </li>
					  <li class="nav-item">
						<a href="<?php echo base_url() ?>stockRental/view" class="nav-link">
						  <i class="fas fa-cube nav-icon text-yellow"></i>
						  <p>Stock Details</p>
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
						<a href="<?php echo base_url() ?>stockRetailAllocate/view" class="nav-link">
						  <i class="fas fa-boxes nav-icon text-white"></i>
						  <p>Stock Allocation</p>
						</a>
					  </li>
					  <li class="nav-item">
						<a href="<?php echo base_url() ?>stockRetail/view" class="nav-link">
						  <i class="fas fa-cube nav-icon text-white"></i>
						  <p>Stock Details</p>
						</a>
					  </li>
					</ul>
                  </li>
				  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-cube nav-icon text-info"></i>
                      <p>Stock Transfer</p>
					  <i class="right fas fa-angle-left"></i>
                    </a>
					<ul class="nav nav-treeview">
					  <li class="nav-item">
						<a href="<?php echo base_url() ?>stockTransfer/view" class="nav-link">
						  <i class="fas fa-edit nav-icon text-white"></i>
						  <p>Create</p>
						</a>
					  </li>
					  <li class="nav-item">
						<a href="<?php echo base_url() ?>stockTransfer/accept" class="nav-link">
						  <i class="fas fa-handshake nav-icon text-white"></i>
						  <p>Accept</p>
						</a>
					  </li>
					</ul>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
		  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle text-indigo"></i>
              <p>
                Leave
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle text-indigo"></i>
              <p>
                Salary Advance
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle text-indigo"></i>
              <p>
                Task List
              </p>
            </a>
          </li>
		  <?php 
		  
			if($this->session->userdata('sys_user_group_name') == "Admin" || $this->session->userdata('sys_user_group_name') == "Manager" ){
			echo '<li class="nav-item">
				<a href="#" class="nav-link">
				  <i class="nav-icon fas fa-circle text-success"></i>
				  <p>
					Online Store
					<i class="right fas fa-angle-left"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="fas fa-search-dollar nav-icon text-success"></i>
					  <p>Online Orders</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="fas fa-bullhorn nav-icon text-success"></i>
					  <p>Promo Code</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="fas fa-funnel-dollar nav-icon text-success"></i>
					  <p>Special Offer</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="fas fa-random nav-icon text-success"></i>
					  <p>Delivery method</p>
					</a>
			</li>';}
			if($this->session->userdata('sys_user_group_name') == "Admin"){
			echo '<li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="fas fa-city nav-icon text-success"></i>
					  <p>Delivery Company</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="fas fa-truck nav-icon text-success"></i>
					  <p>Order Delivery</p>
					</a>
				  </li>
				</ul>
			  </li>
			  <li class="nav-item">
				<a href="#" class="nav-link">
				  <i class="nav-icon fas fa-circle text-primary"></i>
				  <p>
					POS
					<i class="right fas fa-angle-left"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">
				  <li class="nav-item">
					<a href="'.base_url().'PointOfSale/view" class="nav-link">
					  <i class="fas fa-money-bill-alt nav-icon text-primary"></i>
					  <p>Rental Invoice</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="'.base_url().'PosRetail/view" class="nav-link">
					  <i class="fas fa-money-bill-wave nav-icon text-primary"></i>
					  <p>Retail Invoice</p>
					</a>
				  </li>
				</ul>
			  </li>
			  
				<li class="nav-item">
				<a href="#" class="nav-link">
				  <i class="nav-icon fas fa-circle text-pink"></i>
				  <p>
					Company
					<i class="right fas fa-angle-left"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="'.base_url().'country/view" class="nav-link">
							<i class="far fa-circle nav-icon text-pink"></i>
							<p>Country</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="'.base_url().'company/view" class="nav-link">
							<i class="far fa-circle nav-icon text-pink"></i>
							<p>Company</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="'.base_url().'location/view" class="nav-link">
							<i class="far fa-circle nav-icon text-pink"></i>
							<p>Location</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="'.base_url().'branch/view" class="nav-link">
							<i class="far fa-circle nav-icon text-pink"></i>
							<p>Branch</p>
						</a>
					</li>              
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="far fa-circle nav-icon text-pink"></i>
					  <p>
						Company Calendar
						<i class="right fas fa-angle-left"></i>
					  </p>
					</a>
					<ul class="nav nav-treeview">
					  <li class="nav-item">
						<a href="'.base_url().'holidayTypes/view" class="nav-link">
						  <i class="far fa-grin-hearts nav-icon text-pink"></i>
						  <p>Holiday Types</p>
						</a>
					  </li>	
					  <li class="nav-item">
						<a href="'.base_url().'holiday/view" class="nav-link">
						  <i class="far fas fa-swimmer nav-icon text-pink"></i>
						  <p>Holidays</p>
						</a>
					  </li>
					  <li class="nav-item">
						<a href="'.base_url().'calendar/view" class="nav-link">
						  <i class="far fa-calendar-alt nav-icon text-pink"></i>
						  <p>Holiday Calender</p>
						</a>
					  </li>                  
					</ul>
				  </li>
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="far fa-circle nav-icon text-pink"></i>
					  <p>
						Company Bank
						<i class="right fas fa-angle-left"></i>
					  </p>
					</a>
					<ul class="nav nav-treeview">
					  <li class="nav-item">
						<a href="'.base_url().'bank/view" class="nav-link">
						  <i class="fab fa-btc nav-icon text-pink"></i>
						  <p>Bank</p>
						</a>
					  </li>
					  <li class="nav-item">
						<a href="'.base_url().'bankBranch/view" class="nav-link">
						  <i class="fas fa-route nav-icon text-pink"></i>
						  <p>Branch</p>
						</a>
					  </li>
					  <li class="nav-item">
						<a href="'.base_url().'bankAcc/view" class="nav-link">
						  <i class="fas fa-shield-alt nav-icon text-pink"></i>
						  <p>Account</p>
						</a>
					  </li>
					</ul>
				  </li>	
				  <li class="nav-item">
						<a href="'.base_url().'customer/view" class="nav-link">
							<i class="far fa-circle nav-icon text-pink"></i>
							<p>Customer</p>
						</a>
					</li> 
				</ul>
			  </li>
			  <li class="nav-item">
				<a href="#" class="nav-link">
				  <i class="nav-icon fas fa-tools text-orange"></i>
				  <p>
					System Setting
					<i class="right fas fa-angle-left"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="far far fa-bell nav-icon text-white"></i>
					  <p>
						System Notifications
						<i class="right fas fa-angle-left"></i>
					  </p>
					</a>
					<ul class="nav nav-treeview">
					  <li class="nav-item">
						<a href="'.base_url().'SystemNotifyType/view" class="nav-link">
						  <i class="fab fas fa-info-circle nav-icon text-white"></i>
						  <p>Notification type</p>
						</a>
					  </li>
					  <li class="nav-item">
						<a href="'.base_url().'SystemNotification/view" class="nav-link">
						  <i class="fas fas fa-bullhorn nav-icon text-white"></i>
						  <p>Notification</p>
						</a>
					  </li>					  
					</ul>
				  </li>
				  <li class="nav-item">
					<a href="'.base_url().'userGroup/view" class="nav-link">
					  <i class="fas fa-user-friends nav-icon text-orange"></i>
					  <p>User Groups</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="'.base_url().'user/view" class="nav-link">
					  <i class="fas fa-user-cog nav-icon text-orange"></i>
					  <p>User Detail</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="'.base_url().'userRole/view" class="nav-link">
					  <i class="fas fa-user-lock nav-icon text-orange"></i>
					  <p>User Permission</p>
					</a>
				  </li>
				</ul>
			  </li>';
		}
		  ?>
		  
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


