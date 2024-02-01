<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Holiday Details</h3>
				<div style="text-align: right;">
				</div>
			</div>
			<div class="card-body">
				<form>
					<div class="form-row">
						<input type="hidden" class="form-control typeahead" id="holiday_id" name="holiday_id"  placeholder="Enter Company Name" required>
						<div class="col-md-6 mb-3">
							<label for="name">Name</label>
							<input type="text" class="form-control typeahead" name="holiday_name"  id="holiday_name" placeholder="Enter Holiday Name" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="description">Description</label>
							<input type="text" class="form-control" name="holiday_desc"  id="holiday_desc" placeholder="Enter Description" required>
							<div id="descriptionError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="company_country">Holiday type</label>
							<select class="form-control" id="holiday_type_id" name="holiday_type_id">
							</select>
						</div>
						<div class="col-md-3 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_holiday" name="is_active_holiday" value="">
								<label for="is_active_holiday" class="custom-control-label">is active</label>
							</div>
						</div>						
					</div>					  
				</form>
				
			</div>
			<div class="card-footer text-center">
				<button class="btn btn-primary" type="submit" id="submit">Submit</button>
			</div>
			<div id="" class="" >
				
			</div>
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
		url: API+"holiday/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			//console.log(data);			
			//console.log(data[0].country_id);
			
			$('#holiday_id').val(data[0].holiday_id);
			$('#holiday_name').val(data[0].holiday_name);
			$('#holiday_desc').val(data[0].holiday_desc);
			$('#holiday_type_id').val(data[0].holiday_type_id);				
			
						
			if(data[0].is_active_holiday == 1){
				$('#is_active_holiday').prop('checked', true);
			}
			
						
			loadType();
			
			function loadType() {
				
				$.ajax({
					type: "POST",
					cache : false,
					async: true,
					dataType: "json",
					url: API+"holidayType/fetch_all_active/",
					success: function(data1, result){
						//console.log(data1);
						
						var h_type_drp = '';
						$.each(data1, function(index, item) {
							
							if(data[0].holiday_type_id == item.holiday_type_id){
								h_type_drp += '<option selected value="'+item.holiday_type_id+'">'+item.holiday_type_name+'</option>';
							}
							else{
								h_type_drp += '<option value="'+item.holiday_type_id+'">'+item.holiday_type_name+'</option>';
							}

							
						});
						$('#holiday_type_id').append(h_type_drp);
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {						
						
						//console.log(textStatus);
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
	
	var holiday_id = 0;
	var holiday_name = "";
	var holiday_desc = "";
	var holiday_type_id = "";
	var is_active_holiday = 0;
	
	holiday_id =  $('#holiday_id').val();
	holiday_name =  $('#holiday_name').val();
	holiday_desc = $('#holiday_desc').val();
	holiday_type_id = $('#holiday_type_id').val();
	is_active_holiday = $("#is_active_holiday").is(':checked')? 1 : 0;
	
	
		
	if(typeof holiday_id !== 'undefined' && holiday_id !== '' && typeof holiday_name !== 'undefined' && holiday_name !== '' && typeof holiday_desc !== 'undefined' && holiday_desc !== '' && typeof holiday_type_id !== 'undefined' && holiday_type_id !== '')
	{
		
		var formData = new FormData();
		formData.append('holiday_id',holiday_id);
        formData.append('holiday_name',holiday_name);
		formData.append('holiday_desc',holiday_desc);
		formData.append('holiday_type_id',holiday_type_id);
		formData.append('is_active_holiday',is_active_holiday);
						
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"holiday/update/",
			success: function(data, result){
				//console.log(data.message);
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
						window.location = "<?php echo base_url() ?>holiday/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Holiday is being used by other modules at the moment!"){
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