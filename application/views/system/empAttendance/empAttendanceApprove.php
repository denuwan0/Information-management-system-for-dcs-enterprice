<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Attendance Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<label for="branch_id">Branch</label>
								<select class="custom-select" id="branch_id" aria-describedby="" required>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="day">Date</label>
								<select class="custom-select" id="day" aria-describedby="" required>
								</select>
							</div>
							<div class="col-md-3 mb-3">
								<label for="month">Month</label>
								<select class="custom-select" id="month" aria-describedby="" required>
								</select>
							</div>
						</div>
					</form>
				</div>			

				<div class="card-footer text-center">
					<button class="btn btn-success" id="submit" type="submit">Approve</button>
				</div>				
			</form>
		</div>
	</div>
</section>
<script>

var pageUrl = $(location).attr('href');
parts = pageUrl.split("/"),
last_part = parts[parts.length-1];

function loadBranch(){
	
$.ajax({
	type: "GET",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"branch/fetch_all_active/",
	success: function(data1, result){
		var company_drp1 = '<option value="">Select Branch</option>';
		$.each(data1, function(index, item1) {
			//console.log(item);
			company_drp1 += '<option value="'+item1.company_branch_id+'">'+item1.company_branch_name+'</option>';
        });
		$('#branch_id').append(company_drp1);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});
}

loadBranch();

function loadAttendanceDays(branch_id){
	$('#day').html('');
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		url: API+"EmpAttendance/fetch_all_days/?branch_id="+branch_id,
		success: function(data2, result){
			var company_drp2 = '<option value="">Select Date</option>';
			$.each(data2, function(index, item2) {
				//console.log(item);
				company_drp2 += '<option value="'+item2.date+'">'+item2.date+'</option>';
			});
			$('#day').append(company_drp2);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			
			//console.log(errorThrown);
		}
	});
}


$(document).on('change', '#branch_id', function() {
  loadAttendanceDays($(this).val());
  loadAttendanceMonth($(this).val());
});

$(document).on('change', '#day', function() {
	if($(this).val() != ''){
		$('#month').prop('disabled', true);
	}
	else{
		$('#month').prop('disabled', false);
	}
	
});

$(document).on('change', '#month', function() {
	if($(this).val() != ''){
		$('#day').prop('disabled', true);
	}
	else{
		$('#day').prop('disabled', false);
	}
	
});


function loadAttendanceMonth(branch_id){
	$('#month').html('');
	$.ajax({
		type: "GET",
		cache : false,
		async: true,
		dataType: "json",
		url: API+"EmpAttendance/fetch_all_months/?branch_id="+branch_id,
		success: function(data3, result){
			console.log(data3);
			var company_drp3 = '<option value="">Select Month</option>';
			$.each(data3, function(index, item3) {
				
				company_drp3 += '<option value="'+item3.month+'">'+item3.month_name+'</option>';
			});
			$('#month').append(company_drp3);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			
			//console.log(errorThrown);
		}
	});
}




$('#submit').click(function(e){
	e.preventDefault();
	
	var branch_id = 0;
	var day = 0;
	var month = 0;
	
	branch_id = $('#branch_id').val();
	day = $('#day').val();
	month = $('#month').val();	
	
	if(typeof branch_id !== 'undefined' && branch_id !== '')
	{
		var formData = new FormData();
		formData.append('branch_id',branch_id);
		formData.append('day',day);
        formData.append('month',month);
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"EmpAttendance/approve/",
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
						window.location = "<?php echo base_url() ?>EmpAttendance/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Vehicle is being used by other modules at the moment!"){
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
	}
	
	
})



</script>