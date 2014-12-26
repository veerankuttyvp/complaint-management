	<table id="index-datatables" class="table table-bordered table-hover">
		<thead>
		    <tr>
		        <th class="text-center hidden-xs hidden-sm">#</th>
		        <th><i class="icon-user"></i> Consumer</th>
                        <th><i class="icon-user"></i> Complaint</th>
                        <th><i class="icon-user"></i> SubDivision</th>
		        <th class="hidden-xs hidden-sm"> Mobile</th>
		        <th class="hidden-xs hidden-sm">Status</th>
                        <th class="hidden-xs hidden-sm">Date</th>
		        <th class="text-center"><i class="icon-bolt"></i></th>
		    </tr>
		</thead>
		<tbody>
		<?php foreach ($complaints as $complaint) { ?>
			<tr>
		        <td class="text-center hidden-xs hidden-sm"><?php echo $complaint['Complaint']['id']; ?></td>
		        <td><?php echo str_replace('  ',' ',$complaint['Consumer']['first_name'].' '.$complaint['Consumer']['middle_name'].' '.$complaint['Consumer']['last_name']); ?></td>
		        <td class="hidden-xs hidden-sm"><?php echo $complaint['Category']['name'] ?></td>
		        <td class="hidden-xs hidden-sm"><?php echo $complaint['Subdivision']['name'] ?></td>
		        
                        <td class="hidden-xs hidden-sm"><?php echo $complaint['Consumer']['mobile'] ?></td>
		        <td class="hidden-xs hidden-sm"><span class="label label-inverse"><?php echo $complaint['ComplaintStatus']['status']; ?></span></td>
                        <td class="hidden-xs hidden-sm"><span class="label label-info"><?php echo $this->Time->nice($complaint['Complaint']['created']); ?></span></td>
		        
                        <td class="text-center">
		            <div class="btn-group">
		                <a href="<?php echo $this->Html->url("/complaints/edit/".$complaint['Complaint']['id'],true); ?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><i class="icon-pencil"></i>Edit</a>
		                <a class="btn btn-xs btn-success model" href="<?php echo $this->Html->url("/complaints/status_edit/".$complaint['Complaint']['id'],true); ?>" data-toggle="tooltip" title="Change Status" rel="Change Status" ><i class="icon-pencil"></i>Change Status</a>
		            </div>
		        </td>
		    </tr>
		<?php } ?>
		    
		</tbody>
	</table>
