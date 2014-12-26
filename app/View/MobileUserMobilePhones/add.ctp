<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Mobile User Mobile Phones",'/mobile_user_mobile_phones');
      $this->Html->addCrumb("Add",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<div class="row">
    <div class="col-md-8">
        <?php echo $this->Form->create("MobileUserMobilePhone",array("action"=>"add","class"=>"form-horizontal","id" =>"form-validation")); 
        ?>    

          

                                  


              <div class="form-group">
                <label for="#" class="col-sm-2 control-label">Subdivision
                </label> 
                <div class="col-sm-10">
                  <select  class="form-control" name ="subdivision" id="subdivision">
                  <?php
                    foreach ($subdivisions as $value) {
                  ?>
                      <option value="<?php echo $value['Subdivision']['id'] ?>"><?php echo $value['Subdivision']['name'] ?></option>
                  <?php
                    }
                    
                  ?>
                  </select>
                </div>
              </div>
              

              <div class="form-group">
                <label for="mobile_user_id" class="col-sm-2 control-label">Mobile User
                </label> 
                <div class="col-sm-10">
                  <select  class="form-control" name ="data[MobileUserMobilePhone][mobile_user_id]" id="mobile_user">
                  <?php
                    foreach ($subdivisions as $value) {
                      foreach ($value['MobileUser'] as $mobile_user) {
                        # code...
                      
                  ?>
                        <option value="<?php echo $mobile_user['id'] ?>"><?php echo $mobile_user['id'] ?></option>
                  <?php
                      }
                    }
                    
                  ?>
                  </select>
                </div>
              </div>


         <?php

          echo $this->Form->input(
              'mobile_phone_id',
              array('options' => $mobile_phones)
            );

          $options = array('1' => 'Yes', '0' => 'No');
          $attributes = array('legend' => false);
          ?>
          <div class="form-group">
            <label for="#" class="col-sm-2 control-label">Status
            </label> 
            <div class="col-sm-10">
              <?php
              echo $this->Form->radio('status', $options, $attributes);
              ?>
            </div>
          </div>
          <?php


              echo $this->Form->input("details",array("placeholder"=>"details..."));
              
        ?>
        <div class="col-sm-10 col-sm-offset-2"><input value="Submit" class="btn btn-primary" type="submit"></div>
        </form>
    </div>
</div>
<script>
window.onload = function() {
$(function() {
                /* For advanced usage and examples please check out
                 *  Jquery Validation   -> https://github.com/jzaefferer/jquery-validation
                 */

                /* Initialize Form Validation */
                $('#form-validation').validate({
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
                        
                        'data[MobileUserMobilePhone][status]': {
                            required: true
                        },
                        'data[MobileUserMobilePhone][details]': {
                            required: true
                        },
                        'data[MobileUserMobilePhone][mobile_user_id]': {
                            required: true
                        },
                        'data[MobileUserMobilePhone][mobile_phone_id]': {
                            required: true
                        },
                        subdivision : {
                            required: true
                        },
                        
                    },
                    messages: {
                        
                        'data[MobileUserMobilePhone][status]': 'Please select a status',
                        'data[MobileUserMobilePhone][details]': 'Please enter details',
                        'data[MobileUserMobilePhone][mobile_user_id]': 'Please select a mobile user id',
                        'data[MobileUserMobilePhone][mobile_phone_id]': 'Please select mobile phone',
                        subdivision: 'Please select subdivision'

                    }
                });

            });



                $("#subdivision").change(function() {
                    var x = $("#subdivision").val();
                    var url = $("#subdivision").attr('url');
                    var url = "<?php echo $this->Html->url('/Subdivisions/get_mobile_users',true); ?>";
                    // alert(url);
                    $.get(url+'/'+x,function(html){

                        $('#mobile_user').html(html);
                        
                    });

               // first dropdown value is stored              
                    // fire_ajax(x);
                });
  }




</script>