<!--<form action="http://localhost/f-wasa/complaints_update/enter_update" enctype="multipart/form-data" method="post">
    <?php
    $op = array("1"=>"1");
    echo $this->Form->input("complaint_id",array("options"=>$op,"name"=>"complaint_id"));
    echo $this->Form->input("image_path",array("type"=>"file","name"=>"image_path")); 
    echo $this->Form->input("comment",array("name"=>"comment"));
    echo $this->Form->input("complaint_update_status",array("type"=>"text","name"=>"complaint_update_status"));
    ?>
    <input type="submit" value="submit"/>
</form>-->

<form id="data" method="post" action="http://localhost/cake_odesk/f-wasa-repo/ComplaintUpdates/enter_update"
      enctype="multipart/form-data">
    <input type="text" name="complaint_id" value="1" />
    <input type="text" name="comment" value="comment" />
    <input type="text" name="complaint_update_status" value="Resolved" />
    <input name="image_path" type="file" />
    <button>Submit</button>
</form>
