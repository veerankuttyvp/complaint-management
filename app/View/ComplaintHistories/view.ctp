<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Complaint History",'javascript:void(0)');
      $this->Html->addCrumb("View",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->

			<?php foreach ($complainthistories as $complainthistory) { ?>
			<!-- Themed Block -->
                <div class="block block-themed">
                    <!-- Themed Title -->
                    <div class="block-title"><h4><?php echo $complainthistory['ComplaintHistory']['action'] ?></h4></div>
                    <!-- END Themed Title -->

                    <!-- Themed Content -->
                    <div class="block-content full">
                    	<p>Username: <?php echo $complainthistory['User']['user_name'] ?></p>
                    	<p>Complaint Status: <?php echo $complainthistory['ComplaintStatus']['status'] ?></p>
                    	<p>Action Date: <?php echo $complainthistory['ComplaintHistory']['created'] ?></p>

                    </div>
                    <!-- END Themed Content -->
                </div>
                <!-- END Themed Block -->
                <?php } ?>
