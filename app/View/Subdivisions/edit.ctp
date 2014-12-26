<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Subdivisions",'/subdivisions');
      $this->Html->addCrumb("Edit",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<div class="row">
    <div class="col-md-8">
        <?php echo $this->Form->create("Subdivision",array("action"=>"edit","class"=>"form-horizontal")); 
              echo $this->Form->input("name",array("placeholder"=>"Name..."));
              echo $this->Form->input("address",array("placeholder"=>"Address..."));
              echo $this->Form->input("user_id",array("options"=>$group_users,"label"=>array("text"=>"AD")));
              echo $this->Form->input("code",array("placeholder"=>"Code..."));
              echo $this->Form->input("region",array("placeholder"=>"Region..."));
              echo $this->Form->input("phone",array("placeholder"=>"Phone..."));
        ?>
        <div class="col-sm-10 col-sm-offset-2"><input value="Submit" class="btn btn-primary" type="submit"></div>
        </form>
    </div>
</div>