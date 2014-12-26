<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Dashboards",'javascript:void(0)');
      $this->Html->addCrumb("Cmc",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<div class="row">
				<div class="col-md-4">
					<a href="javascript:void(0)" class="tile tile-width-2x tile-themed themed-background-leaf">
                        <i class="icon-gift"><?php echo $total_complaints ?></i>
                        <div class="tile-info">
                            <div class="pull-left">Total Complaints</div>
                            <div class="pull-right"><strong></strong></div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="javascript:void(0)" class="tile tile-width-2x tile-themed themed-background-army">
                        <i class="icon-gift"><?php echo $total_complaints_today ?></i>
                        <div class="tile-info">
                            <div class="pull-left">Total Complaints Today</div>
                            <div class="pull-right"><strong></strong></div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="javascript:void(0)" class="tile tile-width-2x tile-themed themed-background-default">
                        <i class="icon-gift"><?php echo $total_complaints_resolved_today ?></i>
                        <div class="tile-info">
                            <div class="pull-left">Total Complaints Resolved Today</div>
                            <div class="pull-right"><strong></strong></div>
                        </div>
                    </a>
                </div>
  </div>

<!-- Dynamic Tables in the Grid Content -->

                <!-- div.row -->
                <div class="row row-items" style="margin-top:30px">
                    <!-- Datatables Example 1 -->
                    <div class="col-md-6">
                    <h4 class="page-header">Complaints Registered through Website</h4>
                        <table id="example-datatables2" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
							        <th class="text-center hidden-xs hidden-sm">#</th>
							        <th><i class="icon-user"></i>Id</th>
							        <th><i class="icon-user"></i> Consumer</th>
					                        <th><i class="icon-user"></i> Complaint</th>
							        <th class="hidden-xs hidden-sm"> Mobile</th>
							       
					                        
							        <th class="text-center"><i class="icon-bolt"></i></th>
							    </tr>
                            </thead>
                            <tbody>
                            	<?php $cnt_web=0;?>
                                <?php foreach ($complaints_web_unapproved as $complaint) { ?>
                                     <?php $cnt_web++;?>                              <tr>
								        <td class="text-center hidden-xs hidden-sm"><?php echo $cnt_web; ?></td>
								        <td class="text-center hidden-xs hidden-sm"><?php echo $complaint['Complaint']['id']; ?></td>
								        <td><?php echo str_replace('  ',' ',$complaint['Consumer']['first_name'].' '.$complaint['Consumer']['middle_name'].' '.$complaint['Consumer']['last_name']); ?></td>
								        <td class="hidden-xs hidden-sm"><?php echo $complaint['Category']['name'] ?></td>
								       
								        
						                        <td class="hidden-xs hidden-sm"><?php echo $complaint['Consumer']['mobile'] ?></td>
								        
						                        
								        
						                        <td class="text-center">
								            <div class="btn-group">
								                <a href="<?php echo $this->Html->url("/complaints/editweb/".$complaint['Complaint']['id'],true); ?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-warning"><i class="icon-warning-sign"></i>Review</a>
								                
								            </div>
								        </td>
								    </tr>
								<?php } ?>
                            </tbody>
                        </table>
                        <a href="<?php echo $this->Html->url("/dashboards/web_unapproved/",true); ?>" class="btn btn-info" style="float:right">more</a>
                    </div>
                    <!-- END Datatables Example 1 -->

                    <!-- Datatables Example 2 -->
                   <div class="col-md-6">
                   <h4 class="page-header">Complaints with status closed by subengineer</h4>
                        <table id="example-datatables2" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
							        <th class="text-center hidden-xs hidden-sm">#</th>
							        <th><i class="icon-user"></i>Id</th>
							        <th><i class="icon-user"></i> Consumer</th>
					                        <th><i class="icon-user"></i> Complaint</th>
					                        <th><i class="icon-user"></i> SubDivision</th>
							        <th class="hidden-xs hidden-sm"> Mobile</th>
							       
					                        
							        <th class="text-center"><i class="icon-bolt"></i> Actions</th>
							    </tr>
                            </thead>
                            <tbody>
                            	<?php $cnt_cl=0;?>
                                <?php foreach ($complaints_closed as $complaint) { ?>
                                	<?php $cnt_cl++;?>
									<tr>
								        <td class="text-center hidden-xs hidden-sm"><?php echo $cnt_cl; ?></td>
								        <td class="text-center hidden-xs hidden-sm"><?php echo $complaint['Complaint']['id']; ?></td>
								        <td><?php echo str_replace('  ',' ',$complaint['Consumer']['first_name'].' '.$complaint['Consumer']['middle_name'].' '.$complaint['Consumer']['last_name']); ?></td>
								        <td class="hidden-xs hidden-sm"><?php echo $complaint['Category']['name'] ?></td>
								        <td class="hidden-xs hidden-sm"><?php echo $complaint['Subdivision']['name'] ?></td>
								        
						                        <td class="hidden-xs hidden-sm"><?php echo $complaint['Consumer']['mobile'] ?></td>
								        
						                        
								        
						                        <td class="text-center">
								            <div class="btn-group">
								                <a href="<?php echo $this->Html->url("/complaints/view/".$complaint['Complaint']['id'],true); ?>" data-toggle="tooltip" title="View" class="btn btn-xs btn-success"><i class="icon-pencil"></i>View</a>
								                <a href="<?php echo $this->Html->url("/ComplaintUpdates/view/".$complaint['Complaint']['id'],true); ?>" data-toggle="tooltip" title="View Update" class="btn btn-xs btn-success"><i class="icon-pencil"></i>View Update</a>
								                
								            </div>
								        </td>
								    </tr>
								<?php } ?>
                            </tbody>
                        </table>
                        <a href="<?php echo $this->Html->url("/dashboards/closed_subengineer/",true); ?>" class="btn btn-info" style="float:right">more</a>
                    </div>
                    <!-- END Datatables Example 1 -->

                    <!-- END Datatables Example 1 -->
                </div>
                <!-- END div.row -->
                <!-- END Dynamic Tables in the Grid -->
                <div class="row">
 					<div class="col-md-12">
 					<h4 class="page-header">Complaints that have been received today</h4>
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
							<?php foreach ($complaints_today as $complaint) { ?>
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
							                <a href="<?php echo $this->Html->url("/complaints/edit/".$complaint['Complaint']['id'],true); ?>" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><i class="icon-pencil"></i>Edit</a>
								                
								                <a href="<?php echo $this->Html->url("/complaints/view/".$complaint['Complaint']['id'],true); ?>" data-toggle="tooltip" title="View" class="btn btn-xs btn-success"><i class="icon-pencil"></i>View</a>
								                

								                <a href="<?php echo $this->Html->url("/ComplaintUpdates/view/".$complaint['Complaint']['id'],true); ?>" data-toggle="tooltip" title="View Update" class="btn btn-xs btn-success"><i class="icon-pencil"></i>View Update</a>
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