
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
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
	</div>
</div>

</div>
<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Employee Salary Allowance</h3>
				<div style="text-align: right;">
					<?php 
						if($this->session->userdata('sys_user_group_name') == "Admin" || 
						$this->session->userdata('sys_user_group_name') == "Manager"){
							//var_dump($this->session->userdata('sys_user_group_name')); 
							echo '<a type="button" href="'.base_url().'EmpSalaryAllowance/create" class="btn text-dark btn-default btn-sm">
									<i class="nav-icon far fa-plus-square"></i> Assign Employee Allowance
								</a>';
						}
						
					?>
					
				</div>
			</div>
			
			<form>
				<div class="card-body">
					<table id="data" class="table table-bordered table-striped" style="width:100%">
						<thead id="thead">
							<tr>
								<th>id</th>
								<th>Allowance Name</th>
								<th>Employee</th>
								<th>From Date</th>
								<th>To Date</th>
								<th>Approved</th>
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
		url: API+"EmpSalaryAllowance/fetch_all_join",
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
					
					var is_active_sal_allow  ='';
					if(item.is_active_sal_allow  == 1){
						is_active_sal_allow  = '<span class="right badge badge-success">Yes</span>';
					}
					else{
						is_active_sal_allow  = '<span class="right badge badge-danger">No</span>';
					}
					
					var is_approve_sal_allow  ='';										
					var option_html ='';
					
					if(item.is_approve_sal_allow == 1){
						is_approve_sal_allow = '<span class="right badge badge-success">Yes</span>';
						option_html = '<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
							$this->session->userdata('sys_user_group_name') == "Manager"){
								echo '<div class="btn-group margin"><a type="button" id="viewBtn" retail_stock_header_id="" class="btn btn-primary btn-sm viewBtn" value=""><i class="fa fa-eye"></i></a>';
								
								echo '<a style="display:none" type="button" id="editBtn" retail_stock_header_id="" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
							}
							else{
								echo '<a type="button" id="viewBtn" retail_stock_header_id="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							}

						?>';
					}
					else{
						is_approve_sal_allow = '<span class="right badge badge-danger">No</span>';
						option_html = '<?php if($this->session->userdata('sys_user_group_name') == "Admin" || 
							$this->session->userdata('sys_user_group_name') == "Manager"){
								echo '<div class="btn-group margin"><a type="button" id="viewBtn" retail_stock_header_id="" class="btn btn-primary btn-sm viewBtn" value=""><i class="fa fa-eye"></i></a>';
								echo '<a type="button" id="editBtn" retail_stock_header_id="" href="" class="btn btn-warning btn-sm editBtn"><i class="far fa-edit"></i></a></div>';
							}
							else{
								echo '<a type="button" id="viewBtn" retail_stock_header_id="" class="btn btn-primary btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
							}

						?>';
						//'<a type="button" id="editBtn" href="<?php echo base_url() ?>stockRetail/edit/'+item.retail_stock_header_id+'" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a> ';
					}
					
					
					table.row.add([item.emp_salary_allowance_id,
					item.allowance_name,
					item.emp_first_name+' - '+item.emp_epf,
					item.valid_from_date,
					item.valid_to_date,
					is_approve_sal_allow,
					is_active_sal_allow ,
					option_html,
					]).columns.adjust().draw();	
					
					//table.columns.adjust().draw();

					//console.log($(".editBtn").last());
					$(".editBtn").last().attr('href', '<?php echo base_url() ?>EmpSalaryAllowance/edit/'+item.emp_salary_allowance_id);
					$(".viewBtn").last().attr('value', item.emp_salary_allowance_id);
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



$(document).on('click','.viewBtn', function(){

	var emp_salary_allowance_id = "";
	var Header = "";
	var HTML = "";
	
	emp_salary_allowance_id = $(this).attr('value');
	console.log(emp_salary_allowance_id);
	
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"EmpSalaryAllowance/fetch_single_join?id="+emp_salary_allowance_id,
		success: function(data, result){
			console.log(data);
			
			Header = 'Salary Allowance Id: '+data[0].emp_salary_allowance_id;
			console.log(Header);
			if(data[0].is_active_sal_allow  == 1){
				is_active_sal_allow  = '<span class="right badge badge-success">Active</span>';
			}
			else{
				is_active_sal_allow  = '<span class="right badge badge-danger">Inactive</span>';
			}
			
			if(data[0].is_approve_sal_allow  == 1){
				is_approve_sal_allow  = '<span class="right badge badge-success">Yes</span>';
			}
			else{
				is_approve_sal_allow  = '<span class="right badge badge-danger">No</span>';
			}
			
			HTML ='<table class="table table-borderless">'+					  
					  '<tbody>'+
						'<tr>'+
						  '<th><label for="license_plate_no">Allowance Id: </label></th>'+
						  '<td>'+data[0].emp_salary_allowance_id +'</td>'+
						  '<td><label for="branch_id">Name: </label></td>'+
						  '<td>'+data[0].allowance_name+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="license_plate_no">Employee: </label></th>'+
						  '<td>'+data[0].emp_epf +' - '+data[0].emp_first_name +'</td>'+
						  '<td><label for="branch_id">Amount: </label></td>'+
						  '<td>'+data[0].amount+'</td>'+
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_yom">From Date: </label></th>'+
						  '<td>'+data[0].valid_from_date+'</td>'+	
						   '<th><label for="vehicle_yom">To Date: </label></th>'+
						  '<td>'+data[0].valid_to_date+'</td>'+							  
						'</tr>'+
						'<tr>'+
						  '<th><label for="vehicle_yom">Approved: </label></th>'+
						  '<td>'+is_approve_sal_allow+'</td>'+
						  '<th><label for="vehicle_yom">Active: </label></th>'+
						  '<td>'+is_active_sal_allow+'</td>'+
						'</tr>'+
					  '</tbody>'+
					'</table>';
					
		
		$('#modalInfoHeader').html(Header);
		$('#modalInfoBody').html(HTML);
		$('#modalInfo').modal('show');
				
		}
	});
	
	
})

</script>