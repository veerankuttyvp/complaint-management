<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Subdivisions",'/subdivisions');
      $this->Html->addCrumb($subdivision['Subdivision']['name'],'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<div class="row">
    <div class="col-md-3">
        <label>Name: <b class="text-info"><?php echo $subdivision['Subdivision']['name'] ?></b></label>
    </div>
    <div class="col-md-3">
        <label>Code: <b class="text-info"><?php echo $subdivision['Subdivision']['code'] ?></b></label>
    </div>
     <div class="col-md-3">
        <label>AD: <b class="text-info"><?php echo $subdivision['User']['user_name'] ?></b></label>
    </div>
     <div class="col-md-3">
        <label>Phone: <b class="text-info"><?php echo $subdivision['Subdivision']['phone'] ?></b></label>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label>Address: <b class="text-info"><?php echo $subdivision['Subdivision']['address'] ?></b></label>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4 class="sub-header">Centers</h4>
        <a href="javascript:void(0)" id="<?php echo $subdivision["Subdivision"]["id"] ?>" class="btn btn-success btn-sm add_mobile_user"><i class="fa fa-plus"></i> Add New Center</a>
        <i class="loader-03 hide"></i>
        <table class="table  table-hover table-striped" id="mobile_user_table">
            <thead>
                <?php echo $this->Html->tableHeaders(array("ID","Center Name","Assigned User","Assign Mobiles","<i class='fa fa-bolt'></i>"),array(),array("class"=>"text-center")) ?>
            </thead>
            <tbody>
                <?php foreach ($subdivision["MobileUser"] as $user): ?>
                <tr>
                    <td class="text-center"><?php echo $user['id']; ?></td>
                    <td class="text-center"><?php echo $user['center_name']; ?></td>
                    <td class="text-center"><?php echo $user['User']['user_name']; ?></td>
                    <td class="text-center"><span class="badge badge-danger"><?php echo count($user['MobileUserMobilePhone']) ?></span></td>
                    <td class="text-center">
                        <i class="loader-03 hide"></i>
                        <button class="btn btn-success btn-xs view_mobile_detail">Mobile Detail</button>
                        <?php // echo $this->Form->postLink("Remove",$this->Html->url("/mobile_users/delete/".$user['User']['id'],true),array("class"=>"btn btn-danger btn-xs"),"Are you sure to de-allocate this mobile user") ?>
                        <?php if(count($user['MobileUserMobilePhone']) >0){?>
                        <button class="btn btn-warning btn-xs change_mobile_detail">Change Mobile</button>
                        <?php } ?>
                        <button class="btn btn-warning btn-xs change_user" user_id ="<?php echo $user['user_id'];?>" center_id ="<?php echo $user['id']; ?>" suid="<?php echo $subdivision["Subdivision"]["id"] ?>">Change User</button>     
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<span id="mobile_user_modal_span"></span>
<span id="mobile_phones_detail_span"></span>
<span id="mobilephone_detail_span"></span>

