<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Bonus Details</h3>
			</div>
			<form>
				<div class="card-body ">
					<form>
						<div class="form-row">
							<input type="hidden" class="form-control" id="bonus_id" required>
							<div class="col-md-4 mb-3">
								<label for="allowance_name">Allowance Name</label>
								<input type="text" class="form-control" id="bonus_name" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>							
							<div class="col-md-8 mb-3">
								<label for="allowance_desc">Description</label>
								<input type="text" class="form-control" id="bonus_desc" required>
								<div class="valid-feedback">
									Looks good!
								</div>
							</div>							
						</div>
						<div class="form-row">							
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_bonus" value="1">
								<label for="is_active_bonus" class="custom-control-label">is active</label>
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
		url: API+"EmpBonus/fetch_single/?id="+last_part,
		success: function(data, result){
			//var parseData = JSON.stringify(data);
			//var parseData1 = JSON.parse(parseData);	
			console.log(data);			
			//console.log(data[0].country_id);
			
			$('#bonus_desc').val(data[0].bonus_desc);
			$('#bonus_id').val(data[0].bonus_id);
			$('#bonus_name').val(data[0].bonus_name);
						
			if(data[0].is_active_bonus == 1){
				$('#is_active_bonus').prop('checked', true);
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
	
	var bonus_id = 0;
	var bonus_name = "";
	var bonus_desc = "";
	var is_active_bonus = 0;
	
	bonus_id = $('#bonus_id').val();
	bonus_name = $('#bonus_name').val();
	bonus_desc = $('#bonus_desc').val();
	is_active_bonus = $("#is_active_bonus").is(':checked')? 1 : 0;
	
				
	if(typeof bonus_id !== 'undefined' && bonus_id !== ''
	&& typeof bonus_name !== 'undefined' && bonus_name !== ''	
	&& typeof bonus_desc !== 'undefined' && bonus_desc !== '' )
	{
		var formData = new FormData();
		formData.append('bonus_id',bonus_id);
		formData.append('bonus_name',bonus_name);
        formData.append('bonus_desc',bonus_desc);
		formData.append('is_active_bonus',is_active_bonus);
		
				
		$.ajax({
			type: "POST",
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,				
			url: API+"EmpBonus/update/",
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
						window.location = "<?php echo base_url() ?>EmpBonus/view";
					}, 3000);
					
				}
				if(data.message == "Please Fill Required Fields!" || data.message == "Bonus is being used by other modules at the moment!"){
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