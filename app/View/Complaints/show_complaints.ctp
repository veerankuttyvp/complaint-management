<table id="index-datatables" class="table table-bordered table-hover">
		<thead>
		    <tr>
		        <th class="text-center hidden-xs hidden-sm">#</th>
		        <th><i class="icon-user"></i> Consumer</th>
                <th><i class="icon-user"></i> Complaint</th>
		        <th class="hidden-xs hidden-sm">Status</th>
                <th class="hidden-xs hidden-sm">Date</th>
                <th class="hidden-xs hidden-sm"></th>
		    </tr>
		</thead>
		<tbody>
		<?php foreach ($complaints as $complaint) { ?>
			<tr>
		        <td class="text-center hidden-xs hidden-sm"><?php echo $complaint['Complaint']['id']; ?></td>
		        <td><?php echo str_replace('  ',' ',$complaint['Consumer']['first_name'].' '.$complaint['Consumer']['middle_name'].' '.$complaint['Consumer']['last_name']); ?></td>
		        <td class="hidden-xs hidden-sm"><?php echo $complaint['Category']['name'] ?></td>
		        <td class="hidden-xs hidden-sm"><span class="label label-inverse"><?php echo $complaint['ComplaintStatus']['status']; ?></span></td>
                <td class="hidden-xs hidden-sm"><span class="label label-info"><?php echo $this->Time->nice($complaint['Complaint']['created']); ?></span></td>
                <td class="hidden-xs hidden-sm"><span class="label label-info"><a target="_blank" href="<?php echo $this->Html->url("/complaints/view/".$complaint['Complaint']['id'],true); ?>" data-toggle="tooltip" title="View" class="btn btn-xs btn-success">View</a></td>
		        
		    </tr>
		<?php } ?>
		    
		</tbody>
	</table>
	
	<script>
	
		$(document).ready(function() {
			$('#index-datatables').dataTable({"aoColumnDefs": [{"bSortable": false, "aTargets": [4]}]});
		});
	
	</script>