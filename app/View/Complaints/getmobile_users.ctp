<div class="form-group">
<label for="ComplaintMobileUserMobilePhone" class="col-sm-2 control-label">Center Name</label> <div class="col-sm-10"><select name="data[Complaint][mobile_user_mobile_phone_id]" class="form-control" required="required" id="ComplaintMobileUserMobilePhone">
<option value="" >Select a User</option>
<?php foreach ($mobile_phone as  $each_mobile_phone){ ?>
<option value="<?php echo $each_mobile_phone['MobileUserMobilePhone']['id']; ?>" ><?php echo $each_mobile_phone['MobileUser']['center_name'].' - '.$each_mobile_phone['MobileUser']['User']['user_name']; ?></option>
<?php } ?>
</select></div></div>