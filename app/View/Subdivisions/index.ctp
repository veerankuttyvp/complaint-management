<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Subdivisions",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<div class="row">
    <div class="col-md-12">
        <a href="<?php echo $this->Html->url("/subdivisions/add",true); ?>" class="btn btn-success btn-md"><i class="fa fa-plus"></i> Add New Subdivision</a>
        <table id="subdivisions_table" class="table table-hover table-striped">
            <thead>
               <?php echo $this->Html->tableHeaders(array("ID","Name","Address","Code","AD","Region","Phone","<i class='fa fa-bolt'></i>"), array(),array('class' => 'text-center')); ?>
            </thead>
            <tbody>
                <?php foreach ($subdivisions as $sub): ?>
                <tr>
                    <td class="text-center"><?php echo $sub['Subdivision']['id'] ?></td>
                    <td class="text-center"><?php echo $sub['Subdivision']['name'] ?></td>
                    <td class="text-center"><?php echo $sub['Subdivision']['address'] ?></td>  
                    <td class="text-center"><?php echo $sub['Subdivision']['code'] ?></td>
                    <td class="text-center"><?php echo $sub['User']['user_name'] ?></td>
                    <td class="text-center"><?php echo $sub['Subdivision']['region'] ?></td>
                    <td class="text-center"><?php echo $sub['Subdivision']['phone'] ?></td>
                    <td class="text-center">
                        <a href="<?php echo $this->Html->url("/subdivisions/view/".$sub['Subdivision']['id'],true) ?>" class="btn btn-success btn-xs">view</a>
                        <a href="<?php echo $this->Html->url("/subdivisions/edit/".$sub['Subdivision']['id'],true); ?>" class="btn btn-warning btn-xs">edit</a>
                        <?php echo $this->Form->postLink("delete", $this->Html->url("/subdivisions/delete/".$sub['Subdivision']['id'],true), array("class"=>"btn btn-danger btn-xs"), "Are you sure to delete this sub division") ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>