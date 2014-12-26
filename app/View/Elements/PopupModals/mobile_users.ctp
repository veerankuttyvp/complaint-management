<!-- Regular Modal -->
<div id="mobile_user_add_modal" class="modal fade">
    <!-- Modal Dialog -->
    <div class="modal-dialog">
        <!-- Modal Content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4>Add Center</h4>
            </div>
            <div class="modal-body">
                <div class="form-group required">
                    <label for="SubdivisionName" class="col-sm-4 control-label">Center Name</label>
                    <div class="col-sm-8">
                        <input name="data[center_name]" class="form-control" placeholder="Name..." maxlength="100" type="text" id="center_name" required="required">
                    </div>
                </div>
                <br> 
                <?php echo $this->Form->input("mobile_users",array("options"=>$mobile_users,"class"=>"form-control","multiple")); ?>
                <br>
                
            </div>
            <br>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">Close</button>
                <button class="btn btn-success add_mobile_user_button">Add</button>
                <i class="loader-03 hide"></i>
            </div>
        </div>
        <!-- END Modal Content -->
    </div>
    <!-- END Modal Dialog -->
</div>
<!-- END Regular Modal -->