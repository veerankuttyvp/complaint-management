<!-- Regular Modal -->
<div id="mobile_details_modal" class="modal fade">
    <!-- Modal Dialog -->
    <div class="modal-dialog">
        <!-- Modal Content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4>Mobile Detail of user <span class="label label-info mobile_user_name"><?php echo $user["user_name"] ?></span></h4>
            </div>
            <div class="modal-body">
                <h6 class="sub-header">Assign New Mobile</h6>
                <?php 
                echo $this->Form->create("MobileUserMobilePhone",array("url"=>array("action"=>"add_mobile","controller"=>"mobile_users")));
                echo $this->Form->input("mobile_phone_id",array("label"=>false,"required"=>"required","options"=>$mobiles,"class"=>"form-control")); 
//                echo $this->Form->input("details",array("label"=>false,"class"=>"form-control","placeholder"=>"Detail here..."));
//                echo $this->Form->input("status",array("style"=>"margin-left:0px"));
                echo $this->Form->input("mobile_user_id_correct",array("value"=>$mobile_user_id_actual,"type"=>"hidden","name"=>"mobile_user_id"));
                echo $this->Form->input("mobile_user_id",array("value"=>$user["id"],"type"=>"hidden","name"=>"user_id"));
                ?>
                <button type="submit" class="btn btn-primary col-md-offset-11">Add</button></form>
                <h6 class="sub-header">Following are the assigned mobile number with this user:</h6>
                <table class="table table-borderless table-condensed">
                    <tr>
                        <th class="text-center">Mobile</th>
                        <th class="text-center">Model</th>
                        <th class="text-center">IMEI</th>
                        <!-- <th  class="text-center"><i class="fa fa-bolt"></i></th> -->
                    </tr>
                    <?php foreach ($mobile_numbers as $number): ?>
                    <tr>
                        <td class="text-center"><?php echo $number["MobilePhone"]['mobile'] ?></td>
                        <td class="text-center"><?php echo $number["MobilePhone"]['model'] ?></td>
                        <td class="text-center"><?php echo $number["MobilePhone"]['imei'] ?></td>
                        <td class="text-center">
                        <!--     <?php echo $this->Form->postLink("de-allocate",$this->Html->url("/mobile_users/deleteMobilePhone/".$number['id'],true),array("class"=>"btn btn-danger btn-xs"),"Are you sure to delete this mobile phone") ?>
                        </td> -->
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <!-- END Modal Content -->
    </div>
    <!-- END Modal Dialog -->
</div>
<!-- END Regular Modal -->