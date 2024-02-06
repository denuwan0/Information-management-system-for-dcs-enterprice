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
						<input type="hidden" class="form-control" id="attendance_id" required>							
							<div class="col-md-3 mb-3">
								<label for="branch_id">Employee Epf:</label>
								<input type="text" class="form-control" id="emp_epf" readonly>
							</div>
							<div class="col-md-3 mb-3">
								<label for="branch_id">Date:</label>
								<input type="text" class="form-control" id="date" readonly>
							</div>
							<div class="col-md-3 mb-3">
								<label for="branch_id">Time In:</label>
								<input type="text" class="form-control" id="time_in" required>
							</div>
							<div class="col-md-3 mb-3">
								<label for="branch_id">Time Out:</label>
								<input type="text" class="form-control" id="time_out" required>
							</div>				
							
						</div>
						<div class="form-row">
							<div class="col-md-3 mb-3">
								<label for="branch_id">Upload By:</label>
								<input type="text" class="form-control" id="uploaded_by" readonly>
							</div>	
							<div class="col-md-3 mb-3">
								<label for="branch_id">Approved By:</label>
								<input type="text" class="form-control" id="approved_by" readonly>
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


function loadData() {
	
		
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		contentType: 'application/json',
		url: API+"EmpAttendance/fetch_single_join/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#attendance_id').val(data[0].attendance_id);
			$('#emp_epf').val(data[0].emp_epf);
			$('#date').val(data[0].date);
			$('#time_in').val(data[0].time_in);
			$('#time_out').val(data[0].time_out);
			$('#uploaded_by').val(data[0].uploaded_by);
			$('#approved_by').val(data[0].approved_by);
						
						
			
				
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
	
	var attendance_id = 0;
	var emp_epf = 0;
	var date = "";
	var time_in = 0;
	var time_out = 0;
	var uploaded_by = "";
	var approved_by = "";
	
	attendance_id = $('#attendance_id').val();
	emp_epf = $('#emp_epf').val();
	date = $('#date').val();
	time_in = $('#time_in').val();
	time_out = $('#time_out').val();
	uploaded_by = $('#uploaded_by').val();
	approved_by = $('#approved_by').val();
		
	if(typeof attendance_id !== 'undefined' && attendance_id !== ''
	&& typeof emp_epf !== 'undefined' && emp_epf !== ''	
	&& typeof date !== 'undefined' && date !== '' 
	&& typeof time_in !== 'undefined' && time_in !== '' 
	&& typeof time_out !== 'undefined' && time_out !== '' 
	&& typeof uploaded_by !== 'undefined' && uploaded_by !== '' 
	&& typeof approved_by !== 'undefined' && approved_by !== '')
	{
		var formData = new FormData();
		formData.append('attendance_id',attendance_id);
		formData.append('emp_epf',emp_epf);
        formData.append('date',date);
		formData.append('time_in',time_in);
		formData.append('time_out',time_out);
        formData.append('uploaded_by',uploaded_by);
		formData.append('approved_by',approved_by);	
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"EmpAttendance/update/",
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