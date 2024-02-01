<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">System User Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row"> 
							<input type="hidden" class="form-control" id="user_id" required>
							<div class="col-md-3 mb-3">
								<label for="sys_user_group_id">Sytem User Group</label>
								<select class="custom-select" id="sys_user_group_id" aria-describedby="" required>
								</select>
							</div>
							<div class="col-md-4 mb-3">
								<label for="emp_cust_id">Employee/ Customer Id</label>
								<select class="custom-select" id="emp_cust_id" aria-describedby="" required>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" required>
								<div id="validationServer05Feedback" class="invalid-feedback">
									Please provide a valid zip.
								</div>
							</div>							
						</div>
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_customer" value="1">
									<label for="is_customer" class="custom-control-label">is customer</label>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="is_active_sys_user" value="1">
									<label for="is_active_sys_user" class="custom-control-label">is active</label>
								</div>
							</div>	
						</div>
					  
					</form>
				</div>			

				<div class="card-footer text-center">
					<button class="btn btn-primary" id="submit" type="submit">Submit</button>
				</div>				
			</form>
		</div>
	</div>
</section>
<script>



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
		url: API+"sysuser/fetch_single_join/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#user_id').val(data[0].user_id);
			$('#emp_cust_id').val(data[0].emp_cust_id);
			$('#sys_user_group_id').val(data[0].sys_user_group_id);
			$('#username').val(data[0].username);			
			
			if(data[0].is_customer == 1){
				$('#is_customer').prop('checked', true);
				loadCustomer();	
			}
			else{
				loadEmployee();
			}
			
			if(data[0].is_active_sys_user == 1){
				$('#is_active_sys_user').prop('checked', true);
			}
			
			$(document).on('change', '#sys_user_group_id', function (){
				//console.log($('#sys_user_group_id option:selected').text());
				var userGrp = $('#sys_user_group_id option:selected').text();
				$('#emp_cust_id').html('');
				if(userGrp == 'Customer'){
					loadCustomer();
				}
				else{
					loadEmployee();
				}
				
			})
			
			loadUserGroup();		
			
			function loadUserGroup(){
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"SysUserGroup/fetch_all_active/",
					success: function(data1, result){
						//console.log(data);	
						var location_drp = '<option value="">Select User Group</option>';
						$.each(data1, function(index, item) {
							if(data[0].sys_user_group_id == item.sys_user_group_id){
								location_drp += '<option selected value="'+item.sys_user_group_id+'">'+item.sys_user_group_name+'</option>';
							}
							else{
								location_drp += '<option value="'+item.sys_user_group_id+'">'+item.sys_user_group_name+'</option>';
							}
						});
						$('#sys_user_group_id').append(location_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(errorThrown);
					}
				});
				}
				
				function loadCustomer(){
					$.ajax({
						type: "POST",
						cache : false,
						async: true,
						dataType: "json",
						url: API+"customer/fetch_all_active/",
						success: function(data2, result){
							console.log(data[0].emp_cust_id);	
							var company_drp = '<option value="">Select Customer</option>';
							$.each(data2, function(index, item) {
								if(data[0].emp_cust_id == item.customer_id){
									company_drp += '<option selected value="'+item.customer_id+'">'+(item.customer_old_nic_no ? item.customer_old_nic_no : item.customer_new_nic_no)+' - '+item.customer_name+'</option>';
								}
								else{
									company_drp += '<option value="'+item.customer_id+'">'+(item.customer_old_nic_no ? item.customer_old_nic_no : item.customer_new_nic_no)+' - '+item.customer_name+'</option>';
								}
								//console.log(item);
								
							});
							$('#emp_cust_id').append(company_drp);
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							//console.log(errorThrown);
						}
					});
				}


				function loadEmployee(){
					$.ajax({
						type: "POST",
						cache : false,
						async: true,
						dataType: "json",
						url: API+"Employee/fetch_all_active/",
						success: function(data3, result){
							//console.log(data);	
							var company_drp = '<option value="">Select Employee</option>';
							$.each(data3, function(index, item) {
								if(data[0].emp_cust_id == item.emp_id){
									company_drp += '<option selected value="'+item.emp_id+'">'+item.emp_epf+' - '+item.emp_first_name+'</option>';
								}
								else{
									company_drp += '<option value="'+item.emp_id+'">'+item.emp_epf+' - '+item.emp_first_name+'</option>';
								}
								//console.log(item);
								
							});
							$('#emp_cust_id').append(company_drp);
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {						
							
							//console.log(errorThrown);
						}
					});
				}
			
			
				
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			//console.log(errorThrown);					
		}
	});
};

$(document).ready(function() {
	loadData();
});

$('#submit').click(function(e){
	e.preventDefault();
	
	var user_id = 0;
	var emp_cust_id = 0;
	var sys_user_group_id = 0;
	var username = 0;
	var is_customer = 0;
	var is_active_sys_user = 0;
	
	user_id =  $('#user_id').val();
	emp_cust_id =  $('#emp_cust_id').val();
	sys_user_group_id = $('#sys_user_group_id').val();
	username =  $('#username').val();
	is_customer = $("#is_customer").is(':checked')? 1 : 0;
	is_active_sys_user = $("#is_active_sys_user").is(':checked')? 1 : 0;
		
	if(typeof user_id !== 'undefined' && user_id !== '' 
	&& typeof emp_cust_id !== 'undefined' && emp_cust_id !== '' 
	&& typeof sys_user_group_id !== 'undefined' && sys_user_group_id !== '' 
	&& typeof username !== 'undefined' && username !== '' )
	{
		var formData = new FormData();
		formData.append('user_id',user_id);
        formData.append('emp_cust_id',emp_cust_id);
		formData.append('sys_user_group_id',sys_user_group_id);
		formData.append('username',username);
		formData.append('is_customer',is_customer);
		formData.append('is_active_sys_user',is_active_sys_user);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"sysuser/update/",
			success: function(data, result){

				if(data.message == "Changes Updated!"){	
					const notyf = new Notyf();
				
					notyf.success({
					  message: 'Changes Updated!',
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
						window.location = "<?php echo base_url() ?>user/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "System User is being used by other modules at the moment!"){
					const notyf = new Notyf();
					
					notyf.error({
					  message: ''+data.message+'',
					  duration: 3000,
					  icon: true,
					  ripple: true,
					  dismissible: true,
					  position: {
						x: 'right',
						y: 'top',
					  }
					  
					})
					window.setTimeout(function() {
						loadData();
					}, 3000);
					
				}

			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {						
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
	else{
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
		/* $(document).Toasts('create', {
			icon: 'fas fa-exclamation-triangle',
			class: 'bg-danger m-1',
			autohide: true,
			delay: 5000,
			title: 'An error has occured',
			body: 'Something went wrong'
		});	 */
	}
	
	
})



</script>