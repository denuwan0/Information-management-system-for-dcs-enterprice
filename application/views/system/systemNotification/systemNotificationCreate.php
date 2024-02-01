<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Notification Details</h3>
			</div>

			<form>
				<div class="card-body ">
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label for="company">Notify Type</label>
							<select class="custom-select" id="sys_notify_type_id" name="sys_notify_type_id" required>
							<option value="">Select Type</option>
							</select>
							<div id="companyError" class="invalid-feedback">
								Please select a valid state.
							</div>
						</div>
						<div class="col-md-3 mb-3">
							<label for="name">Related Doc ID: </label>
							<select class="custom-select" id="doc_id" name="doc_id" required>
							<option value="">Select Relevant Document ID</option>
							</select>
							<div id="companyError" class="invalid-feedback">
								Please select a valid state.
							</div>
						</div>
						<div class="col-md-3 mb-3">
							
							<label class="mb-5" for="name"></label>
							<a id="addGgleBtn" class="btn btn-primary mt-2" href="" target="_blank"><i class="far fa-calendar-alt" ></i> Add to Google Calendar</a>

							
						</div>
						
						<div class="col-md-6 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_bank" name="is_active_bank" value="1">
								<label for="is_active_bank" class="custom-control-label">is active</label>
							</div>
						</div>
					</div>
				</div>			
				<div class="card-footer text-center">
					<button class="btn btn-primary" type="submit" id="submit">Submit</button>
				</div>				
			</form>
		</div>
	</div>
</section>
<script>
function loadNotifyType() {				
	$.ajax({
		type: "POST",
		cache : false,
		async: true,
		dataType: "json",
		url: API+"SysNotifyType/fetch_all_active/",
		success: function(data1, result){
			console.log(data1);
			
			var dropdown = '';
			$.each(data1, function(index, item) {
				
				dropdown += '<option value="'+item.sys_notify_type_id +'">'+item.notify_name+'</option>';

				
			});
			$('#sys_notify_type_id').append(dropdown);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {						
			
			//console.log(textStatus);
		}
	});
}

loadNotifyType();

var ggleUrl = "";

$(document).on('change', '#sys_notify_type_id', function() {
 
  var title = "";
  title = encodeURIComponent($(this).find('option:selected').text());
  
   console.log(title);
  
  ggleUrl = "https://www.google.com/calendar/render?action=TEMPLATE&text="+title+"&dates=20230101T000000Z/20230101T010000Z&details=Event%20Details&location=Event%20Location";
  $('#addGgleBtn').attr("href", ggleUrl);
  
  if($(this).val() != 'undefined' && $(this).val() != ''){
	  
	  if($(this).val() == 1){
		  $('#doc_id').empty().append('<option value="">Select Driving License No</option>');
		  $.ajax({
				type: "POST",
				cache : false,
				async: true,
				dataType: "json",
				url: API+"EmpDrivingLicense/fetch_all_active/",
				success: function(data1, result){
					console.log(data1);
					
					var dropdown = '';
					$.each(data1, function(index, item) {
						
						dropdown += '<option value="'+item.driving_license_id +'">'+item.license_number+'</option>';

						
					});
					$('#doc_id').append(dropdown);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {						
					
					//console.log(textStatus);
				}
			});
	  }
	  else if($(this).val() == 4){
		   $('#doc_id').empty().append('<option value="">Select Revenue License No</option>');
		  $.ajax({
				type: "POST",
				cache : false,
				async: true,
				dataType: "json",
				url: API+"VehicleRevenue/fetch_all_active/",
				success: function(data1, result){
					console.log(data1);
					
					var dropdown = '';
					$.each(data1, function(index, item) {
						
						dropdown += '<option value="'+item.rev_license_id +'">'+item.rev_license_no+'</option>';

						
					});
					$('#doc_id').append(dropdown);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {						
					
					//console.log(textStatus);
				}
			});
	  }
	  else{
		  $('#doc_id').empty().append('<option value="">No Data Found</option>');
	  }
  }
});

$('#submit').click(function(e){
	e.preventDefault();
	var bank_id = 0;
	var bank_name = "";
	var is_active_bank = 0;
		
	bank_name = $('#bank_name').val();
	is_active_bank = $("#is_active_bank").is(':checked')? 1 : 0;
	
	
		
	if(typeof bank_name !== 'undefined' && bank_name !== '')
	{
		
		var formData = new FormData();
        formData.append('bank_name',bank_name);
		formData.append('is_active_bank',is_active_bank);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"bank/insert/",
			success: function(data, result){
				console.log(data);	
				const notyf = new Notyf();
				if(data['message'] == 'Data Saved!'){
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
						window.location = "<?php echo base_url() ?>bank/view";
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