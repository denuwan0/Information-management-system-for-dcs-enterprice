<section class="content">
	<div class="container-fluid">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Bank Account Details</h3>
			</div>

			<form>
				<div class="card-body ">
					<div class="form-row">
						<div class="col-md-6 mb-3">
							<label for="name">Account No.</label>
							<input type="text" class="form-control" id="account_no" name="account_no" required>
							<div id="nameError" class="invalid-feedback">
								Please provide a valid zip.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="location">Account Name</label>
							<input type="text" class="form-control" id="account_name" name="account_name" required>
							<div id="locationError" class="invalid-feedback">
								Please select a valid state.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="company">Bank Branch</label>
							<select class="custom-select" id="b_branch_id" name="b_branch_id" required>
							</select>
							<div id="companyError" class="invalid-feedback">
								Please select a valid state.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="manager">Contact</label>
							<input type="text" class="form-control" id="contact_no" name="contact_no" required>
							<div id="addressError" class="invalid-feedback">
								Please provide a valid state.
							</div>
						</div>						
						<div class="col-md-6 mb-3">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="is_active_bank_acc" name="is_active_bank_acc" value="1">
								<label for="is_active_bank_acc" class="custom-control-label">is active</label>
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

$.ajax({
	type: "POST",
	cache : false,
	async: true,
	dataType: "json",
	url: API+"bankBranch/fetch_all_active/",
	success: function(data, result){
		var b_branch_drp = '<option value="">Select Bank Branch</option>';
		$.each(data, function(index, item) {
			console.log(item);
			b_branch_drp += '<option value="'+item.b_branch_id+'">'+item.b_branch_code+'</option>';
        });
		$('#b_branch_id').append(b_branch_drp);
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {						
		
		//console.log(errorThrown);
	}
});

$('#submit').click(function(e){
	e.preventDefault();
	var b_branch_id = 0;
	var account_no = "";
	var account_name = "";
	var contact_no = "";
	var is_active_bank_acc = 0;
	
	b_branch_id = $('#b_branch_id').val();
	account_no = $('#account_no').val();
	account_name = $('#account_name').val();
	contact_no = $('#contact_no').val();
	is_active_bank_acc = $("#is_active_bank_acc").is(':checked')? 1 : 0;
	
	
		
	if(typeof b_branch_id !== 'undefined' && b_branch_id !== '' && typeof account_no !== 'undefined' && account_no !== ''
	&& typeof account_name !== 'undefined' && account_name !== '' && typeof contact_no !== 'undefined' && contact_no !== '')
	{
		
		var formData = new FormData();
        formData.append('b_branch_id',b_branch_id);
		formData.append('account_no',account_no);
		formData.append('account_name',account_name);
		formData.append('contact_no',contact_no);
		formData.append('is_active_bank_acc',is_active_bank_acc);
				
		$.ajax({
			type: "POST",
			//enctype: 'multipart/form-data',
			cache : false,
			async: true,
			dataType: "json",
			processData: false,
			contentType: false,
			data: formData,	
			url: API+"bankacc/insert/",
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
					window.location = "<?php echo base_url() ?>bankacc/view";
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