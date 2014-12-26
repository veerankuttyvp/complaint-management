<!-- Regular Modal -->
<div id="mobile_user_add_modal" class="modal fade">
    <!-- Modal Dialog -->
    <div class="modal-dialog">
        <!-- Modal Content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4>Change User</h4>
            </div>
            <div class="modal-body">
            <form id="MobileUserMobilePhone_change" action="<?php echo $this->html->url('/', true);?>mobile_users/change_user" method="post">
           
                <br> 
                <?php echo $this->Form->input("mobile_users",array('value'=>$mobile_user_id_actual,"options"=>$mobile_users,"class"=>"form-control","multiple")); ?>
                <br>
                <input type="hidden" name="center_id" value="<?php echo $center_id?>">
                <input type="hidden" name="subdivision_id"  value="<?php echo $subdivision_id?>">
            </div>
            <br>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success add_mobile_user_button" value="change">
                <i class="loader-03 hide"></i>
            </div>
           </form>
        </div>
        <!-- END Modal Content -->
    </div>
    <!-- END Modal Dialog -->
</div>
<!-- END Regular Modal -->