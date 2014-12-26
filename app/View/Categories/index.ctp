<?php
echo $this->Html->css(array("js-tree/style.min"));
?>
<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Categories",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<div class="row">
    <div class="col-md-8">
        <button class="btn btn-success" id="create_category">Create</button>
        <button class="btn btn-info" id="rename_category">Rename</button>
        <button class="btn btn-danger" id="delete_category">Delete</button>
        <h4 class="sub-header">All Categories</h4>
        <div id="category_tree" class="col-md-offset-1">
            
            <?php
            echo $this->Tree->generate($data, array('element' => 'category_item')); ?>
        </div>
    </div>
</div>