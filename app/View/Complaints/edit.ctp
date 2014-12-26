<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Complaints",'/complaints');
      $this->Html->addCrumb("Edit",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<div class="row">
    <div class="col-md-8">
        <?php echo $this->Form->create("Complaint",array("class"=>"form-horizontal"));  ?>

        <h2 class="sub-header">Customer Details</h2>
        
        	<?php
	        	  echo $this->Form->input("bill_no",array("placeholder"=>"Bill No"));
	        	  echo '<div style="display:none;" id="laoder-gif-bill" class="col-sm-5 form-group"><div class="loader-08 pull-right"></div></div><div class="clearfix"></div>';
	              echo $this->Form->input("Consumer.first_name",array('required' => true,"placeholder"=>"Name","label"=>array("text"=>"Name*")));
                  echo $this->Form->input("Consumer.mobile",array("placeholder"=>"Mobile Number","type"=>"text","label"=>array("text"=>"Mobile Number"),'help'=>'Must be in format 92321XXXXXXX'));
	              echo $this->Form->input("Consumer.cnic",array("placeholder"=>"CNIC","type"=>"text","label"=>array("text"=>"CNIC"),'help'=>'Must be in format xxxxx-xxxxxxx-x'));
	              echo $this->Form->input("Consumer.email",array("type"=>"text","placeholder"=>"Email","label"=>array("text"=>"Email")));
	              echo $this->Form->input("Consumer.address",array('id' => 'consumer_address',"placeholder"=>"Address","type"=>"textarea","label"=>array("text"=>"Address")));
	        ?>
        
         <h2 class="sub-header">Complaint Details</h2>
         
         <?php
        
              echo $this->Form->input("bill_no",array("placeholder"=>"Bill No"));
              echo $this->Form->input("category_id",array("options"=>$categories,'disabled' => TRUE,"empty"=>'Select a Category','required'=>true,"label"=>array("text"=>"Categories")));
              echo '<div id="subcategory"></div>';
              echo '<div style="display:none;" id="laoder-gif" class="col-sm-5 form-group"><div class="loader-08 pull-right"></div></div><div class="clearfix"></div>';
              echo $this->Form->input("complaint_status_id",array("options"=>$complaint_status,"empty"=>'Select a Status','required'=>true,"label"=>array("text"=>"Complaint Status")));
              echo $this->Form->input("complaint_priority_id",array("options"=>$complaint_priorities,"empty"=>'Select a Priority','required'=>true,"label"=>array("text"=>"Complaint Priority")));
              echo $this->Form->input("subdivision_id",array("options"=>$subdivisions,"empty"=>"Select a Subdivision","label"=>array("text"=>"Subdivisions")));
              echo '<div id="subdivision"></div>';
              echo '<div style="display:none;" id="laoder-gif-sub" class="col-sm-5 form-group"><div class="loader-08 pull-right"></div></div><div class="clearfix"></div>';
              echo $this->Form->input("colony_name_id",array("options"=>$colonies,"empty"=>'Select a Colony','required'=>true,'class'=>'chosen',"label"=>array("text"=>"Colony Name")));
              echo $this->Form->input("complaint_address",array("placeholder"=>"Address","type"=>"textarea","label"=>array("text"=>"Complaint Address")));
              echo $this->Form->input("description",array("placeholder"=>"Description","type"=>"textarea","label"=>array("text"=>"Description")));
              echo $this->Form->input("category_id",array("type"=>"hidden"));
              echo $this->Form->input("lat",array("type"=>"hidden","value"=>"0"));
              echo $this->Form->input("longi",array("type"=>"hidden","value"=>"0"));
              echo $this->Form->input("Consumer.id",array("type"=>"hidden"));
              
        ?>
        
        <div class="col-sm-10 col-sm-offset-2"><input value="Submit" class="btn btn-primary" type="submit"></div>
        </form>
    </div>
    
     <!-- Bi;; Box-->
           <div class="col-md-4" style="margin-top:85px;">
	    
	    	<div class="block block-themed block-last" id="bill_table" style="display:none" >
	    	
	    		<div class="block-title"><h5>Bill Info</h5></div>
	    		
	    		<div class="block-content block-content-flat">
	    		
	    			<div class="col-sm-12">
	    			
	    				<table class="table table-stripped">
	    				
	    					<tr>
	    					
		    					<td width="40%">Bill No</td>
		    					<td>:</td>
		    					<td id="bill_val">12345678</td>
	    					
	    					</tr>
	    					
	    					<tr>
	    					
		    					<td>Consumer Name</td>
		    					<td>:</td>
		    					<td id="consumer_name"></td>
	    					
	    					</tr>
	    					
	    					<tr>
	    					
		    					<td>Address</td>
		    					<td>:</td>
		    					<td id="address"></td>
	    					
	    					</tr>
	    					
	    					<tr>
	    					
		    					<td>Total Amout</td>
		    					<td>:</td>
		    					<td id="total_amount"></td>
	    					
	    					</tr>
	    					
	    					<tr>
	    					
		    					<td>Pay</td>
		    					<td>:</td>
		    					<td id="pay"></td>
	    					
	    					</tr>
	    				
	    				</table>
	    			
	    			</div>
	    			
	    			<div class="clearfix"></div>
	    		
	    		</div>
	    	
	    	</div>
	    
	    </div>
         <!-- Bi;; Box-->
    
</div>

<script>

window.onload = function() {
	
	jQuery.validator.addMethod("mynumber", function (value, element) {
	    return this.optional(element) || /^(\s*\d{5}\s*)(-\s*\d{7}\s*)(-\s*\d{1}\s*)$/.test(value);
	}, "Please specify the correct number format");
	
	/* Initialize Form Validation */
    var validator = $('#ComplaintEditForm').validate({
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
            'data[Consumer][email]': {
                email: true
            },
            'data[Consumer][cnic]': {
                mynumber: true
            },
            'data[Consumer][mobile]': {
                number: true,
                minlength: 12,
                maxlength: 12
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
            'data[Complaint][category_other]': {
                required: true
            }
        },
        messages: {
           'data[Consumer][first_name]': {
               required:'Please enter your first name',
                minlength: 'Firstname must be at least 2 characters long'
            },
            'data[Consumer][email]': {
	            email:' Invalid Email Address'
            },
            'data[Consumer][mobile]': {
                minlength: 'Mobile number must cantain 12 digits',
                maxlength: 'Mobile number must cantain 12 digits'
               
            },
            'data[Complaint][complaint_status_id]': 'Select a Status',
            'data[Complaint][complaint_priority_id]': 'Select Complaint Priority',
            'data[Complaint][subdivision_id]': 'Select a subdivision',
             'data[Complaint][complaint_address]': 'Select Complaint Address',
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
		
		$('#ComplaintBillNo').focusout(function(){
			
			if( $(this).val() != ''){
				
				$('#laoder-gif-bill').show();
				
				$.get('<?php echo $this->Html->url("/complaints/check_consumer_bill",true); ?>/'+$(this).val(), function(data){
					
					var result = $.parseJSON(data);
					if( result.result == 'success' ){
						$('#ConsumerFirstName').val(result.Consumer.first_name);
						$('#ConsumerMobile').val(result.Consumer.mobile);
						$('#ConsumerCnic').val(result.Consumer.cnic);
						$('#ConsumerEmail').val(result.Consumer.email);
						$('#consumer_address').val(result.Consumer.address);
					}
					
					$.get('<?php echo $this->Html->url("/complaints/check_bill",true); ?>/'+$('#ComplaintBillNo').val(), function(data){
					
					$('#check_bill_error').remove();
						var result = $.parseJSON(data);
						if(result.result == 'success'){
							values = result.data;
							$( "#bill_val" ).html( values.account );
							$( "#consumer_name" ).html( values.name );
							$( "#total_amount" ).html( values.total );
							$( "#pay" ).html( values.pay_amount );
							$( "#address" ).html( values.house+'<br>'+values.street+'<br>'+values.street+'<br>'+values.block+'<br>'+values.colony_name );
							$( "#bill_table" ).slideDown();
						} else {
							$( "#bill_val" ).html( 'Invalid Bill No' );
							$( "#consumer_name" ).html( '' );
							$( "#total_amount" ).html( '' );
							$( "#pay" ).html( '' );
							$( "#address" ).html( '' );
							$( "#bill_table" ).slideDown();
						}
					
					});
					
					$('#laoder-gif-bill').hide();
					
				});
				
			}
			
		});
		
		 $("#ConsumerCnic, #ConsumerMobile, #ConsumerEmail, #ComplaintBillNo").bind("keyup focusout",function() {

		 	var count = 0;
		 	var cnic = '';
		 	var mobile = '';
		 	var email = '';
		 	var billno = '';
		 	
		 	if($("#ConsumerCnic").val() != '' ){
	 			cnic = $("#ConsumerCnic").val();
	 			count = 1;
		 	}
		 	
		 	if($("#ConsumerMobile").val() != '' ){
	 			mobile = $("#ConsumerMobile").val();
	 			count = 1;
		 	}
		 	
		 	if($("#ConsumerEmail").val() != '' ){
	 			email = $("#ConsumerEmail").val();
	 			count = 1;
		 	}
		 	
		 	if($("#ComplaintBillNo").val() != '' ){
	 			billno = $("#ComplaintBillNo").val();
	 			count = 1;
		 	}
		 	
		 	if(count == 1){ 

		 		$.get('<?php echo $this->Html->url("/complaints/check_cnic",true); ?>/cnic:'+cnic+'/mobile:'+mobile+'/email:'+email+'/billno:'+billno,function(data){
		 			
		 			if( data == "success" ){
		 				$('#complaint_history').remove();
		 				$('#ComplaintBillNo').parent().append('<a style="margin-top:8px;float:left;" rel="Complaint History" id="complaint_history" class="model" href="<?php echo $this->Html->url("/complaints/show_complaints",true); ?>/cnic:'+cnic+'/mobile:'+mobile+'/email:'+email+'/billno:'+billno+'">Show Complaint History</a>');
		 				
		 			} else {
		 				$('#complaint_history').remove();
		 			}
		 			
		 		});
		 		
		 	} else {
		 		$('#complaint_history').remove();
		 	}
		 	
		 });
		 
		 $(document).on('click','a.model',function(e){

	        e.preventDefault();
	
	        var url = $(this).attr('href');
	
	        // Set header.
	        var title = $(this).attr('rel');
	        $('#defModallabel').html(title);
	        $('#modal_def').modal('show');
	        $('#loader-08').show();
	        $('#modal-body-content').html('');
	
	        $.get(url+'/'+event.timeStamp,function(html){
	
	            $('#modal-body-content').html(html);
	            $('#loader-08').hide();
	            $('.modal-footer').html($('#for_footer').html());
	            $('#for_footer').html('')
	
	            $('.modal-content').slideDown('fast');
	        });
	
	    });
		 $('#copy_address').click(function () {
		 	if($("#copy_address").is(':checked'))
			    $("#complaint_address").val($("#consumer_address").val());  // checked
			else
			    $("#complaint_address").val('');
		 });
		 
		 $(".chosen").data("placeholder","Select Colony...").chosen();
	
};



</script>

<div class="modal fade" id="modal_def" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h2 class="modal-title" id="defModallabel"></h2>
            </div>

            <div class="modal-body">
                <div id="loader-08" style="margin:0 auto;display: block;" class="loader-08"></div>
                <div id="modal-body-content">

                </div>
                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>