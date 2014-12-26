<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Complaints",'/complaints');
      $this->Html->addCrumb("Add",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<div class="row">
    <div class="col-md-8">
        <?php echo $this->Form->create("Complaint",array("class"=>"form-horizontal"));  ?>

        <h2 class="sub-header">Customer Details</h2>
        
        	<?php
        
              echo $this->Form->input("Consumer.first_name",array('required' => true,"placeholder"=>"First Name","label"=>array("text"=>"First Name")));
              echo $this->Form->input("Consumer.middle_name",array("placeholder"=>"Middle Name","label"=>array("text"=>"Middle Name")));
              echo $this->Form->input("Consumer.last_name",array('required' => true,"placeholder"=>"Last Name","label"=>array("text"=>"Last Name")));
              echo $this->Form->input("Consumer.address",array('required' => true,"placeholder"=>"Address","type"=>"textarea","label"=>array("text"=>"Address")));
              echo $this->Form->input("Consumer.cnic",array("placeholder"=>"CNIC","type"=>"text","label"=>array("text"=>"CNIC")));
              echo $this->Form->input("Consumer.mobile",array('required' => true,"placeholder"=>"Mobile Number","type"=>"text","label"=>array("text"=>"Mobile Number")));
              echo $this->Form->input("Consumer.email",array('required' => true,"type"=>"text","placeholder"=>"Email","label"=>array("text"=>"Email")));
        ?>
        
         <h2 class="sub-header">Complaint Details</h2>
         
         <?php
        
              echo $this->Form->input("bill_no",array("placeholder"=>"Bill No"));
              echo $this->Form->input("category_ids",array("options"=>$categories,"empty"=>'Select a Category','required'=>true,"label"=>array("text"=>"Categories")));
              echo '<div id="subcategory"></div>';
              echo '<div style="display:none;" id="laoder-gif" class="col-sm-5 form-group"><div class="loader-08 pull-right"></div></div><div class="clearfix"></div>';
              echo $this->Form->input("complaint_status_id",array("options"=>$complaint_status,"empty"=>'Select a Status','required'=>true,"label"=>array("text"=>"Complaint Status")));
              echo $this->Form->input("complaint_priority_id",array("options"=>$complaint_priorities,"empty"=>'Select a Priority','required'=>true,"label"=>array("text"=>"Complaint Priority")));
              echo $this->Form->input("subdivision_id",array("options"=>$subdivisions,"empty"=>"Select a Subdivision","label"=>array("text"=>"Subdivisions")));
              echo '<div id="subdivision"></div>';
              echo '<div style="display:none;" id="laoder-gif-sub" class="col-sm-5 form-group"><div class="loader-08 pull-right"></div></div><div class="clearfix"></div>';
              echo $this->Form->input("complaint_address",array("placeholder"=>"Address","type"=>"textarea","label"=>array("text"=>"Complaint Address")));
              echo $this->Form->input("description",array("placeholder"=>"Description","type"=>"textarea","label"=>array("text"=>"Description")));
              echo $this->Form->input("user_id",array("type"=>"hidden","value"=>"1"));
              echo $this->Form->input("category_id",array("type"=>"hidden"));
              echo $this->Form->input("lat",array("type"=>"hidden","value"=>"0"));
              echo $this->Form->input("longi",array("type"=>"hidden","value"=>"0"));
              echo $this->Form->input("source",array("type"=>"hidden","value"=>"cmcoperator"));
        ?>
        
        <div class="col-sm-10 col-sm-offset-2"><input value="Submit" class="btn btn-primary" type="submit"></div>
        </form>
    </div>
</div>

<script>

window.onload = function() {
	jQuery.validator.addMethod("mynumber", function (value, element) {
	    return this.optional(element) || /^[0-9.-]+$/.test(value);
	}, "Please specify the correct number format");
	
	/* Initialize Form Validation */
    $('#ComplaintRegisterForm').validate({
        errorClass: 'help-block',
        errorElement: 'span',
        errorPlacement: function(error, e) {
            e.parents('.form-group > div').append(error);
        },
        highlight: function(e) {
            $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
            $(e).closest('.help-block').remove();
        },
        success: function(e) {
            // You can remove the .addClass('has-success') part if you don't want the inputs to get green after success!
            e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
            e.closest('.help-block').remove();
        },
        rules: {
            "data[Consumer][first_name]": {
                required: true,
                minlength: 2
            },
            'data[Consumer][last_name]': {
                required: true,
                minlength: 2
            },
            'data[Consumer][address]': {
                required: true,
            },
            'data[Consumer][email]': {
                required: true,
                email: true
            },
            'data[Consumer][cnic]': {
                required: true,
                mynumber: true
            },
            'data[Consumer][mobile]': {
                required: true,
                number: true,
                minlength: 12,
                maxlength: 12
            },
            'data[Complaint][bill_no]': {
                required: true,
            },
            'data[Complaint][category_ids]': {
                required: true
            },
            'data[Complaint][complaint_status_id]': {
                required: true,
            },
            'data[Complaint][complaint_priority_id]': {
                required: true
            },
            'data[Complaint][subdivision_id]': {
                required: true,
            },
            'data[Complaint][complaint_address]': {
                required: true
            },
            'data[Complaint][description]': {
                required: true
            },
            'data[Complaint][category_other]': {
                required: true
            }
        },
        messages: {
           'data[Consumer][first_name]': {
               required:'Please enter your first name',
                minlength: 'Firstname must be at least 2 characters long'
            },
            'data[Consumer][last_name]': {
                required: 'Please enter your last name',
                minlength: 'Last Name must be at least 5 characters long'
            },
            'data[Consumer][address]': {
                required: 'Please enter address',
            },
            'data[Consumer][email]': {
	            required:'Please enter a valid email address',
	            email:' Invalid Email Address'
            },
            'data[Consumer][cnic]': {
                required: 'CNIC required'
               
            },
            'data[Consumer][mobile]': {
                required: 'Mobile Number Required',
                minlength: 'Mobile number must cantain 12 digits',
                maxlength: 'Mobile number must cantain 12 digits'
               
            },
             'data[Complaint][bill_no]': 'Please enter Bill Number',
            'data[Complaint][category_ids]': 'Select a Category',
            'data[Complaint][complaint_status_id]': 'Select a Status',
            'data[Complaint][complaint_priority_id]': 'Select Complaint Priority',
            'data[Complaint][subdivision_id]': 'Select a subdivision',
             'data[Complaint][complaint_address]': 'Select Complaint Address',
             'data[Complaint][description]': 'Please enter a description',
             'data[Complaint][category_other]': 'Please enter a Category'
        }
    });
	
	$(document).on('change','#ComplaintCategoryIds',function(){
		
		if($(this).val() == '0'){
			$('#ComplaintCategoryId').val('0');
			$('#subcategory').html('<?php  echo $this->Form->input("category_other",array("placeholder"=>"Other Category")); ?>');
		} else {
		
			$('#subcategory').html('');
			$('#laoder-gif').show();
			
			$.get(main_path+'complaints/getchildencat/'+$(this).val(),function(data){
				if(data == "fail"){
					$('#ComplaintCategoryId').val($('#ComplaintCategoryIds').val());
				} else {
					html = data;
					$('#subcategory').html(html);
					$('#subcategory select').focus();
					
				}
				$('#laoder-gif').hide();
				
			  });
			  
			}
			
		});
		
		
		
		$(document).on('change','#ComplaintSubdivisionId',function(){
		
			$('#subdivision').html('');
			$('#laoder-gif-sub').show();
				
			$.get(main_path+'complaints/getmobile_users/'+$(this).val(),function(data){
			
				html = data;
				$('#subdivision').html(html);
				$('#subdivision select').focus();
	
				$('#laoder-gif-sub').hide();
				
			});
			
		});
		
	
};



</script>