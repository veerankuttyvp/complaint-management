<div class="col-sm-12">

<?php echo $this->Form->create("Complaint",array("class"=>"form-horizontal",'id'=>'status_form')); 

echo $this->Form->input("complaint_status_id",array("options"=>$complaint_status,"empty"=>'Select a Status','required'=>true,'class' => 'form-control','id'=>'ComplaintComplaintStatusId2',"label"=>array("text"=>"Complaint Status")));
        ?>
        </form>
        
    <div id="for_footer">
        <button onclick="document.getElementById('status_form').submit()" type="button" id="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

    </div>
</div>

<div class="clearfix"></div>