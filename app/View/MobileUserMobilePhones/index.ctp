<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Mobile User Mobile Phones",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<div class="row">
    <div class="col-md-12">
        <a href="<?php echo $this->Html->url("/mobile_user_mobile_phones/add",true); ?>" class="btn btn-success btn-md"><i class="fa fa-plus"></i> Add New Phone</a>
        <table id="phones_table" class="table table-hover table-striped">
            <thead>
               <?php echo $this->Html->tableHeaders(array("ID","Mobile User Name","Mobile Phone","Status","Details","Created","Modified","<i class='fa fa-bolt'></i>"), array(),array('class' => 'text-center')); ?>
            </thead>
            <tbody>
                <?php foreach ($mobileusermobilephones as $mobileusermobilephone): ?>
                <tr>
                    <td class="text-center"><?php echo $mobileusermobilephone['MobileUserMobilePhone']['id'] ?></td>
                    <td class="text-center"><?php echo $mobileusermobilephone['User']['user_name'] ?></td>
                    <td class="text-center"><?php echo $mobileusermobilephone['MobilePhone']['mobile'] ?></td>  
                    <td class="text-center"><?php  if($mobileusermobilephone['MobileUserMobilePhone']['status']){ echo '<span class="label label-success">Active</span>'; }else { echo '<span class="label label-danger">InActive</span>'; } ?></td>
                    <td class="text-center"><?php echo $mobileusermobilephone['MobileUserMobilePhone']['details'] ?></td>
                    <td class="text-center"><?php echo $this->Time->niceShort($mobileusermobilephone['MobileUserMobilePhone']['created']) ?></td>
                    <td class="text-center"><?php echo $this->Time->niceShort($mobileusermobilephone['MobileUserMobilePhone']['modified']) ?></td>
                    
                    <td class="text-center">
                        
                        <?php echo $this->Form->postLink("delete", $this->Html->url("/mobile_user_mobile_phones/delete/".$mobileusermobilephone['MobileUserMobilePhone']['id'],true), array("class"=>"btn btn-danger btn-xs"), "Are you sure to delete this phone") ?>
                    </td>
                        
                        
                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>