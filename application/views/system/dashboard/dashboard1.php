 <section class="content">
  <div class="container-fluid">
	<div class="row">
		<div class="col-12 col-sm-6 col-md-3 user_box">
		<div class="info-box mb-3">
		  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-trophy"></i></span>

		  <div class="info-box-content ">
			<span class="info-box-text">Monthly Rank</span>
			<span class="info-box-number" id="monthly_rank">2</span>
		  </div>
		</div>
	  </div>
	  <div class="col-12 col-sm-6 col-md-3 yard_box">
		<div class="info-box">
		  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-business-time"></i></span>

		  <div class="info-box-content">
			<span class="info-box-text">Monthly task completion</span>
			<span class="info-box-number" id="task_complete">
			  10
			</span>
		  </div>
		</div>
	  </div>
	  <div class="col-12 col-sm-6 col-md-3 employee_box">
		<div class="info-box mb-3">
		  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-share"></i></span>

		  <div class="info-box-content">
			<span class="info-box-text">Monthly task skipped</span>
			<span class="info-box-number" id="task_skipped">0</span>
		  </div>
		</div>
	  </div>
	  <div class="clearfix hidden-md-up"></div>

	  <div class="col-12 col-sm-6 col-md-3 customer_box">
		<div class="info-box mb-3">
		  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-chart-line"></i></span>

		  <div class="info-box-content">
			<span class="info-box-text">Monthly task completion rate</span>
			<span class="info-box-number" id="task_completion_rate">0%</span>
		  </div>
		</div>
	  </div>
	  
	</div>

	

	<div class="row">
	  <div class="col-md-6">
		<div class="card">
		  <div class="card-header border-transparent">
			<h3 class="card-title">Daily Task List</h3>

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
				  <th>Task</th>
				  <th>Order Id</th>
				  <th>Order Type</th>
				  <th>Status</th>
				</tr>
				</thead>
				<tbody id="daily_task_list">
				
				
				</tbody>
			  </table>
			</div>
		  </div>
		  <div class="card-footer text-center">
			<a href="http://localhost/dcs/empTaskAssign/myTaskView" class="uppercase">View task list details</a>
		  </div>
		</div>
	  </div>

	  <div class="col-md-6"> 
		<div class="card">
		  <div class="card-header">
			<h3 class="card-title">My Leave Quota</h3>
				
			<div class="card-tools">
			  <button type="button" class="btn btn-tool" data-card-widget="collapse">
				<i class="fas fa-minus"></i>
			  </button>
			  
			</div>
		  </div>
		  <div class="card-body p-0">
			<ul class="products-list product-list-in-card pl-2 pr-2" id="item_list">
			<table class="table m-0">
				<thead>
				<tr>
				  <th>Year</th>	
				  <th>Leave type</th>
				  <th>Occupied Leaves</th>
				  <th>Available Leaves</th>
				</tr>
				</thead>
				<tbody id="leave_quota_list">
				
				
				</tbody>
			  </table>
			  
			  
			</ul>
		  </div>
		  <div class="card-footer text-center">
			<a href="http://localhost/dcs/EmpWiseLeaveQuota/view" class="uppercase">View Leave quota details</a>
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
			if(data.monthly_rank != ''){
				$('#monthly_rank').text(data.monthly_rank);
			}
			
			
			if(data.monthly_task_completed != ''){
				$('#task_complete').text(data.monthly_task_completed);
			}
			
			
			if(data.monthly_task_skipped != ''){
				$('#task_skipped').text(data.monthly_task_skipped);
			}
			
			
			if(data.monthly_task_completion_rate != ''){
				$('#task_completion_rate').text(data.monthly_task_completion_rate+'%');
			}
			
			
			
			
			
			$.each(data.daily_task_list, function (i, item) {
				
				var status = '';
				if(item.is_complete == 1){
					status = '<span class="badge badge-success">Complete</span>';
				}
				else{
					status = '<span class="badge badge-danger">Not Complete</span>';
				}
				
				//console.log(item);
				var listHtml = '<tr>'+					 
					  '<td>'+item.task_name+'</td>'+
					  '<td>'+item.invoice_id+'</td>'+
					  '<td>'+item.order_type+'</td>'+
					  '<td>'+status+'</td>'+					  
					'</tr>';
					
				$('#daily_task_list').append(listHtml);
			})
			
			$.each(data.leave_quota_list, function (i, item) {
				
								
				var status = '';
				if(item.is_complete == 1){
					status = '<span class="badge badge-success">Complete</span>';
				}
				else{
					status = '<span class="badge badge-danger">Not Complete</span>';
				}
				
				//console.log(item);
				var listHtml = '<tr>'+					 
					  '<td>'+item.year+'</td>'+
					  '<td>'+item.leave_type_name+'</td>'+
					  '<td>'+(item.amount - item.balance_leave_quota) +'</td>'+
					  '<td>'+item.balance_leave_quota+'</td>'+
					'</tr>';
					
				$('#leave_quota_list').append(listHtml);
			})
			
			console.log(data.branch_wise_sale);
			
			
			
				
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