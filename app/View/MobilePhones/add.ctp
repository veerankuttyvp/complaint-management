<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Mobile Phones",'/mobile_phones');
      $this->Html->addCrumb("Add",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<div class="row">
    <div class="col-md-8">
        <?php echo $this->Form->create("MobilePhone",array("action"=>"add","class"=>"form-horizontal")); 
              echo $this->Form->input("mobile",array("placeholder"=>"Mobile Number..."));
              echo $this->Form->input("imei",array("placeholder"=>"IMEI...","label"=>array("text"=>"IMEI")));
              echo $this->Form->input("description",array("placeholder"=>"Description..."));
              echo $this->Form->input("model",array("placeholder"=>"Model Number..."));
        ?>
        <div class="col-sm-10 col-sm-offset-2"><input value="Submit" class="btn btn-primary" type="submit"></div>
        </form>
    </div>
</div>