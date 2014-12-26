<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Complaints",'/complaints');
      $this->Html->addCrumb("Thanks",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<!-- div.row -->
<div class="row row-items">
 					<div class="col-md-12">
                        <h1 class="page-header">Your Complaint id is : <?php echo $id; ?>	</h1>
                    </div>

</div>