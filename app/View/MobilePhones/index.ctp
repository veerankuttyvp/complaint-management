<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Mobile Phones",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<div class="row">
    <div class="col-md-12">
        <a href="<?php echo $this->Html->url("/mobile_phones/add",true); ?>" class="btn btn-success btn-md"><i class="fa fa-plus"></i> Add New Phone</a>
        <table id="phones_table" class="table table-hover table-striped">
            <thead>
               <?php echo $this->Html->tableHeaders(array("ID","Mobile Number","IMEI","Description","Model","Created","Modified","<i class='fa fa-bolt'></i>"), array(),array('class' => 'text-center')); ?>
            </thead>
            <tbody>
                <?php foreach ($phones as $phone): ?>
                <tr>
                    <td class="text-center"><?php echo $phone['MobilePhone']['id'] ?></td>
                    <td class="text-center"><?php echo $phone['MobilePhone']['mobile'] ?></td>
                    <td class="text-center"><?php echo $phone['MobilePhone']['imei'] ?></td>  
                    <td class="text-center"><?php echo $phone['MobilePhone']['description'] ?></td>
                    <td class="text-center"><?php echo $phone['MobilePhone']['model'] ?></td>
                    <td class="text-center"><?php echo $this->Time->niceShort($phone['MobilePhone']['created']) ?></td>
                    <td class="text-center"><?php echo $this->Time->niceShort($phone['MobilePhone']['modified']) ?></td>
                    <td class="text-center">
                        <a href="<?php echo $this->Html->url("/mobile_phones/edit/".$phone['MobilePhone']['id'],true); ?>" class="btn btn-warning btn-xs">edit</a>
                        <?php echo $this->Form->postLink("delete", $this->Html->url("/mobile_phones/delete/".$phone['MobilePhone']['id'],true), array("class"=>"btn btn-danger btn-xs"), "Are you sure to delete this phone") ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>