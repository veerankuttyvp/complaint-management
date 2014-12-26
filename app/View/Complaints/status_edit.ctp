<div class="col-sm-12" style="padding-bottom: 15px;">
	<label for="ComplaintComplaintStatusId2" class="col-sm-4 control-label">Current Status :</label>
	<div class="col-sm-8 control-label">
		<span class="label label-success" style="font-size: 18px;"><?php echo $data['ComplaintStatus']['status'];?></span>
	</div>
</div>
<div class="col-sm-12">	
<?php 
 echo $this->Form->create("Complaint",array("class"=>"form-horizontal",'id'=>'status_form')); 
if($data['ComplaintStatus']['id'] == 2) { 

    echo $this->Form->input("complaint_status_id",array("options"=>$complaint_status,"empty"=>'Select a Status','disabled'=>'disabled','required'=>true,'id'=>'ComplaintComplaintStatusId2',"label"=>array("text"=>"Complaint Status")));
            ?>
            </form>
<?php } else { 


    echo $this->Form->input("complaint_status_id",array("options"=>$complaint_status,"empty"=>'Select a Status','required'=>true,'id'=>'ComplaintComplaintStatusId2',"label"=>array("text"=>"Complaint Status")));
            ?>
            </form>

<?php } ?>
        
    <div id="for_footer">
    <?php if($data['ComplaintStatus']['id'] != 2) {      ?>
        <button onclick="return checkForm()" type="button" id="submit" class="btn btn-primary">Save</button>
    <?php } ?>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

    </div>
</div>
<?php if($data['ComplaintStatus']['id'] == 2) {      ?>
    <div class="col-sm-12">
        <div class="col-sm-4 control-label">
        </div>
        <div class="col-sm-8 control-label">
         Complaint is closed
        </div>
    </div>
<?php } ?>
<div class="clearfix"></div>
 <script type="text/javascript">
                function checkForm(){
                	if($("#ComplaintComplaintStatusId2").val() == <?php echo $data['ComplaintStatus']['id'];?> || $("#ComplaintComplaintStatusId2").val() == ''){
                		return false;
                	} else{
                		
                		document.getElementById('status_form').submit();
                	}
             	}
 </script>