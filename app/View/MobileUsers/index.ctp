<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
	  $this->Html->addCrumb("Mobile Users",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<div class="row">

 <a href="<?php echo $this->Html->url("/mobile_users/add",true); ?>" class="btn btn-success btn-md"><i class="fa fa-plus"></i> Add Mobile User</a>

    <table id="index-datatables" class="table table-bordered table-hover">
		<thead>
		    <tr>
		        <th class="text-center hidden-xs hidden-sm">#</th>
		        <th><i class="icon-user"></i> Username</th>
                <th><i class="icon-user"></i> Subdivision</th>
                <th><i class="icon-user"></i> Created</th>
		        <th class="text-center"><i class="icon-bolt"></i></th>
		    </tr>
		</thead>
		<tbody>
		<?php foreach ($Users as $user) {?>
			<tr>
		        <td class="text-center hidden-xs hidden-sm"><?php echo $user['MobileUser']['id']; ?></td>
		        <td><?php echo $user['User']['user_name']; ?></td>
		        <td class="hidden-xs hidden-sm"><?php echo $user['Subdivision']['name'] ?></td>
		        <td class="hidden-xs hidden-sm"><span class="label label-inverse"><?php echo $user['MobileUser']['created']; ?></span></td>
		        
                <td class="text-center">
	            <div class="btn-group">
	                <?php echo $this->Form->postLink("delete", $this->Html->url("/mobile_users/userdelete/".$user['MobileUser']['id'],true), array("class"=>"btn btn-danger btn-xs"), "Are you sure to delete this User") ?>
	            </div>
		        </td>
		        
		    </tr>
		<?php } ?>
		    
		</tbody>
	</table>
</div>

<script>

window.onload = function() {
	$('#index-datatables').dataTable({"aoColumnDefs": [{"bSortable": false, "aTargets": [4]}]});
	
};

</script>