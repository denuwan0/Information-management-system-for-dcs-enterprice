<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Advance Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<input type="hidden" class="form-control" id="advance_id" required>
							<div class="col-md-4 mb-3">
								<label for="advance_name">Advance Name</label>
								<input type="text" class="form-control" id="advance_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>							
							<div class="col-md-8 mb-3">
								<label for="advance_desc">Description</label>
								<input type="text" class="form-control" id="advance_desc" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>							
						</div>
						<div class="form-row">							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_advance" value="1">
								<label for="is_active_advance" class="custom-control-label">is active</label>
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

//$('#form')[0].reset(); 

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
		url: API+"EmpAdvance/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			$('#advance_id').val(data[0].advance_id);
			$('#advance_desc').val(data[0].advance_desc);
			$('#advance_name').val(data[0].advance_name);
						
			if(data[0].is_active_advance == 1){
				$('#is_active_advance').prop('checked', true);
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
	
	var advance_id  = 0;
	var advance_desc = "";
	var advance_name = "";
	var allowance_name = 0;
	
	advance_id = $('#advance_id').val();
	advance_desc = $('#advance_desc').val();
	advance_name = $('#advance_name').val();
	is_active_advance = $("#is_active_advance").is(':checked')? 1 : 0;
	
				
	if(typeof advance_id !== 'undefined' && advance_id !== ''
	&& typeof advance_desc !== 'undefined' && advance_desc !== ''	
	&& typeof advance_name !== 'undefined' && advance_name !== '' )
	{
		var formData = new FormData();
		formData.append('advance_id',advance_id);
		formData.append('advance_desc',advance_desc);
        formData.append('advance_name',advance_name);
		formData.append('is_active_advance',is_active_advance);
		
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"EmpAdvance/update/",
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
						window.location = "<?php echo base_url() ?>EmpAdvance/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Allowance is being used by other modules at the moment!"){
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