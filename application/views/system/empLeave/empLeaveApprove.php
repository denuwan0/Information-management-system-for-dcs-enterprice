
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
				
			</div>
			<div class="modal-footer justify-content-right">
				<button type="button" class="btn btn-success" id="acceptBtn">Accept</button>
				<button type="button" class="btn btn-danger" id="rejectBtn">Reject</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
	</div>
</div>

</div>
<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Leave Approve Details</h3>
				<div style="text-align: right;">
					
					
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped" style="width:100%">
						<thead id="thead">
							<tr>
								<th>id</th>
								<th>Leave Type</th>
								<th>From Date</th>
								<th>To Date</th>
								<th>Amount</th>
								<th>Emplyee</th>
								<th>Approved</th>
								<th>Rejected</th>
								<th>Status</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody id="tbody">                
						</tbody>
						<tfoot>
						</tfoot>
					</table>					
				</div>				
			</form>
			<div id="" class="" >
				
			</div>
		</div>
	</div>
</section>
<script>


var country_id = 0;
function loadData() {
	
		
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"EmpLeave/fetch_all_for_approve/",
		success: function(data, result){
			console.log(data);
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);
			
			$(function () {
				var table = $('#data').DataTable({
					"scrollX": true					
				}); 
							
				
				$.each(data, function (i, item) {
					//console.log(item);
					var is_active_leave_details  ='';
					if(item.is_active_leave_details  == 1){
						is_active_leave_details  = '<span class="right badge badge-success">Active</span>';
					}
					else{
						is_active_leave_details  = '<span class="right badge badge-danger">Inactive</span>';
					}
					
					var is_approved_leave  ='';
					if(item.is_approved_leave  == 1){
						is_approved_leave  = '<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_approved_leave  = '<span class="right badge badge-danger">No</span>';
					}
					
					var is_rejected_leave  ='';
					if(item.is_rejected_leave  == 1){
						is_rejected_leave  = '<span class="right badge badge-danger">Yes</span>';
					}
					else{
						is_rejected_leave  = '<span class="right badge badge-success">No</span>';
					}
					
					
					table.row.add([item.leave_detail_id,
					item.leave_type_name,
					item.leave_from_date, 					
					item.leave_to_date,
					item.leave_amount,
					item.emp_epf +' - '+item.emp_first_name,
					is_approved_leave,
					is_rejected_leave,
					is_active_leave_details ,
					'<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							echo '<div class="btn-group margin"><a type="button" id="viewBtn" vehicleId="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							
						}
						else{
							echo '<a type="button" style="display:none" id="viewBtn" vehicleId="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							echo '<a type="button" style="display:none" id="editBtn" vehicleId="" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
						}

					?>'
					//'<a type="button" id="editBtn" href="<?php echo base_url() ?>branch/edit/'+item.company_branch_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> '
					]).columns.adjust().draw();	
					
					//table.columns.adjust().draw();

					//console.log($(".editBtn").last());
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>EmpLeave/edit/'+item.leave_detail_id);
					$(".approveBtn").last().attr('href', '<?php echo base_url() ?>EmpLeave/edit/'+item.leave_detail_id);
					$(".viewBtn").last().attr('value', item.leave_detail_id);
					//$(".editBtn").last().attr('vehicleId',item.vehicle_id);
				});
							
			});
			

				
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			console.log(textStatus);					
		}
	});
};

loadData();

var leave_detail_id = 0;

$(document).on('click','.viewBtn', function(){

	
	var Header = "";
	var HTML = "";
	
	leave_detail_id = $(this).attr('value');
	console.log(leave_detail_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"EmpLeave/fetch_single_join?id="+leave_detail_id,
		success: function(data, result){
			console.log(data);
			
			Header = 'Employee : '+data[0].emp_first_name+' - '+data[0].emp_epf;
			//console.log(Header);
			if(data[0].is_active_leave_details  == 1){
				is_active_leave_details  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_leave_details  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			if(data[0].is_approved_leave  == 1 ){
				is_approved_leave  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_approved_leave  = '<span class="right badge badge-danger">No</span>';
			}
			
			if(data[0].is_rejected_leave  == 1){
				is_rejected_leave  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_rejected_leave  = '<span class="right badge badge-danger">No</span>';
			}
			
			if(data[0].is_rejected_leave == 1 || data[0].is_approved_leave  == 1 ){
				$('#acceptBtn').css("display", "none");
				$('#rejectBtn').css("display", "none");
			}
			
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="license_plate_no">Leave Id: </label></th>'+
						  '<td>'+data[0].leave_detail_id+'</td>'+
						  '<td><label for="branch_id">Leave Type: </label></td>'+
						  '<td>'+data[0].leave_type_name+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_yom">Date From: </label></th>'+
						  '<td>'+data[0].leave_from_date+'</td>'+
						  '<td><label for="chasis_no">Date To: </label></td>'+
						  '<td>'+data[0].leave_to_date+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_type_id">Amount: </label></th>'+
						  '<td >'+data[0].amount+'</td>'+
						  '<td><label for="vehicle_category_id">Employee: </label></td>'+
						  '<td >'+data[0].emp_first_name+' - '+data[0].emp_epf+'</td>'+
						'</tr>'+						
						'<tr>'+
						  '<td><label for="max_load">Approved: </label></td>'+
						  '<td>'+is_approved_leave+'</td>'+
						  '<td><label for="max_load">Rejected: </label></td>'+
						  '<td>'+is_rejected_leave+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<td><label for="max_load">Status: </label></td>'+
						  '<td>'+is_active_leave_details+'</td>'+
						'</tr>'+
					  '</tbody>'+
					'</table>';
					
		
		$('#modalInfoHeader').html(Header);
		$('#modalInfoBody').html(HTML);
		$('#modalInfo').modal('show');
				
		}
	});
	
	
})



$(document).on("click", "#acceptBtn", function (e) {
	e.preventDefault();
			
		var Header = [];
			
		
		Header.push(
			{
				'leave_detail_id':leave_detail_id,
				'is_approved_leave':1	
			}
		);
						
		
		
		var formData = new Object();
		formData = {
			Header:Header
		};
		
		
		
		if(Header.length > 0){
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
				url: API+"EmpLeave/approve/",
				success: function(data, result){
					console.log(data);	
					const notyf = new Notyf();
					if(data['message'] == 'Leave Approved!'){
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
							window.location = "<?php echo base_url() ?>EmpLeave/approve";
						}, 3000);
					}
					if(data['message'] == 'Leave Quoata is Inactive/ Hold!'){
						notyf.error({
						  message: data['message'],
						  duration: 5000,
						  background: 'orange',
						  icon: true,
						  ripple: true,
						  dismissible: true,
						  position: {
							x: 'right',
							y: 'top',
						  }
						  
						})
						window.setTimeout(function() {
							window.location = "<?php echo base_url() ?>EmpLeave/approve";
						}, 3000);
					}
					else if(data['error'] == true){
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
		}
		
		
	
	
	
})

$(document).on("click", "#rejectBtn", function (e) {
	e.preventDefault();
	
		
	var Header = [];
			
		
	Header.push(
		{
			'leave_detail_id':leave_detail_id,
			'is_approved_leave':0	
		}
	);
					
	
	
	var formData = new Object();
	formData = {
		Header:Header
	};
	
	
	
	if(Header.length > 0){
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
			url: API+"EmpLeave/approve/",
			success: function(data, result){
				console.log(data);	
				const notyf = new Notyf();
				if(data['message'] == 'Leave Rejected!'){
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
						window.location = "<?php echo base_url() ?>EmpLeave/approve";
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
		
		
	
})
</script>