<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Mobile User",'/mobile_users');
      $this->Html->addCrumb("Add",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<div class="row">
    <div class="col-md-8">
        <?php echo $this->Form->create("MobileUser",array("action"=>"add","class"=>"form-horizontal")); 
              echo $this->Form->input("user_id",array("options"=>$users,"empty"=>"Select Username","label"=>array("text"=>"Username")));
              echo $this->Form->input("subdivision_id",array("options"=>$subdivisions,"empty"=>"Select Subdivision","label"=>array("text"=>"Subdivision")));
        ?>
        <div class="col-sm-10 col-sm-offset-2"><input value="Submit" class="btn btn-primary" type="submit"></div>
        </form>
    </div>
</div>

<script>

window.onload = function() {
	/* Initialize Form Validation */
    $('#MobileUserAddForm').validate({
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
            "data[MobileUser][user_id]": {
                required: true
     
            },
            'data[MobileUser][subdvision_id]': {
                required: true
            
            }
        },
        messages: {
             'data[MobileUser][user_id]': 'Please select a user',
             'data[MobileUser][subdvision_id]': 'Please enter a Subdivision'
        }
    });
}

</script>