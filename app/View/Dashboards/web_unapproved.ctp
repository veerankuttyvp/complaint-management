<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Complaints",'/complaints');
    ?>
<!-- END Breadcrumb -->
			<div class="row">
				<div class="col-md-12">
                        <table id="index-datatables" class="table table-bordered table-hover">
							<thead>
							    <tr>
							        <th class="text-center hidden-xs hidden-sm">#</th>
							        <th><i class="icon-user"></i>Id</th>
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
							<?php $cnt=0;?>
							<?php foreach ($complaints_web_unapproved as $complaint) { ?>
								<?php $cnt++;?>
								<tr>
							        <td class="text-center hidden-xs hidden-sm"><?php echo $cnt; ?></td>
							        <td class="text-center hidden-xs hidden-sm"><?php echo $complaint['Complaint']['id']; ?></td>
							        <td><?php echo str_replace('  ',' ',$complaint['Consumer']['first_name'].' '.$complaint['Consumer']['middle_name'].' '.$complaint['Consumer']['last_name']); ?></td>
							        <td class="hidden-xs hidden-sm"><?php echo $complaint['Category']['name'] ?></td>
							        <td class="hidden-xs hidden-sm"><?php echo $complaint['Subdivision']['name'] ?></td>
							        
					                        <td class="hidden-xs hidden-sm"><?php echo $complaint['Consumer']['mobile'] ?></td>
							        <td class="hidden-xs hidden-sm"><span class="label label-inverse"><?php echo $complaint['ComplaintStatus']['status']; ?></span></td>
					                        <td class="hidden-xs hidden-sm"><span class="label label-info"><?php echo $this->Time->nice($complaint['Complaint']['created']); ?></span></td>
							        
					                        <td class="text-center">
							            <div class="btn-group">
							            <a href="<?php echo $this->Html->url("/complaints/editweb/".$complaint['Complaint']['id'],true); ?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-warning"><i class="icon-warning-sign"></i>Review</a>
								                
                                                                    </div>
							        </td>
							    </tr>
							<?php } ?>
							    
							</tbody>
						</table>

                    </div>
                </div>

 <script>

window.onload = function() {
	$('#index-datatables').dataTable({"aoColumnDefs": [{"bSortable": false, "aTargets": [4]}]});
}
	</script>