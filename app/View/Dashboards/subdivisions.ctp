<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Complaints",'/complaints');
    ?>
<!-- END Breadcrumb -->
<div class="row">
				<div class="col-md-4">
					<a href="javascript:void(0)" class="tile tile-width-2x tile-themed themed-background-leaf">
                        <i class="icon-gift"><?php echo $total_complaints ?></i>
                        <div class="tile-info">
                            <div class="pull-left">Total Complaints Of User's Subdivision</div>
                            <div class="pull-right"><strong></strong></div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="javascript:void(0)" class="tile tile-width-2x tile-themed themed-background-army">
                        <i class="icon-gift"><?php echo $total_complaints_today ?></i>
                        <div class="tile-info">
                            <div class="pull-left">Total Complaints Of User's Subdivision Today</div>
                            <div class="pull-right"><strong></strong></div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="javascript:void(0)" class="tile tile-width-2x tile-themed themed-background-default">
                        <i class="icon-gift"><?php echo $total_complaints_pending ?></i>
                        <div class="tile-info">
                            <div class="pull-left">Total Complaints User's Subdivision Pending</div>
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
                    <h4 class="page-header">Complaints registred today for user's subdivision</h4>
                        <table id="example-datatables2" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
							        <th class="text-center hidden-xs hidden-sm">#</th>
							        <th><i class="icon-user"></i> Consumer</th>
					                        <th><i class="icon-user"></i> Complaint</th>
					                        <th><i class="icon-user"></i> SubDivision</th>
							        <th class="hidden-xs hidden-sm"> Mobile</th>
							       
					                        
							        <th class="text-center"><i class="icon-bolt"></i></th>
							    </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($complaints_today_list as $complaint) { ?>
									<tr>
								        <td class="text-center hidden-xs hidden-sm"><?php echo $complaint['Complaint']['id']; ?></td>
								        <td><?php echo str_replace('  ',' ',$complaint['Consumer']['first_name'].' '.$complaint['Consumer']['middle_name'].' '.$complaint['Consumer']['last_name']); ?></td>
								        <td class="hidden-xs hidden-sm"><?php echo $complaint['Category']['name'] ?></td>
								        <td class="hidden-xs hidden-sm"><?php echo $complaint['Subdivision']['name'] ?></td>
								        
						                        <td class="hidden-xs hidden-sm"><?php echo $complaint['Consumer']['mobile'] ?></td>
								        
						                        
								        
						                        <td class="text-center">
								            <div class="btn-group">
								               
								                <a href="<?php echo $this->Html->url("/complaints/view/".$complaint['Complaint']['id'],true); ?>" data-toggle="tooltip" title="View" class="btn btn-xs btn-success"><i class="icon-pencil"></i>View</a>
								                

								                
								            </div>
								        </td>
								    </tr>
								<?php } ?>
                            </tbody>
                        </table>
                        <a href="<?php echo $this->Html->url("/dashboards/sub_today/",true); ?>" class="btn btn-info" style="float:right">more</a>
                    </div>
                    <!-- END Datatables Example 1 -->

                    <!-- Datatables Example 2 -->
                   <div class="col-md-6">
                   <h4 class="page-header">Complaints of user's subdivision with status pending</h4>
                        <table id="example-datatables2" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
							        <th class="text-center hidden-xs hidden-sm">#</th>
							        <th><i class="icon-user"></i> Consumer</th>
					                        <th><i class="icon-user"></i> Complaint</th>
					                        <th><i class="icon-user"></i> SubDivision</th>
							        <th class="hidden-xs hidden-sm"> Mobile</th>
							       
					                        
							        <th class="text-center"><i class="icon-bolt"></i></th>
							    </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($complaints_pending_list as $complaint) { ?>
									<tr>
								        <td class="text-center hidden-xs hidden-sm"><?php echo $complaint['Complaint']['id']; ?></td>
								        <td><?php echo str_replace('  ',' ',$complaint['Consumer']['first_name'].' '.$complaint['Consumer']['middle_name'].' '.$complaint['Consumer']['last_name']); ?></td>
								        <td class="hidden-xs hidden-sm"><?php echo $complaint['Category']['name'] ?></td>
								        <td class="hidden-xs hidden-sm"><?php echo $complaint['Subdivision']['name'] ?></td>
								        
						                        <td class="hidden-xs hidden-sm"><?php echo $complaint['Consumer']['mobile'] ?></td>
								        
						                        
								        
						                        <td class="text-center">
								            <div class="btn-group">
								                
								                <a href="<?php echo $this->Html->url("/complaints/view/".$complaint['Complaint']['id'],true); ?>" data-toggle="tooltip" title="View" class="btn btn-xs btn-success"><i class="icon-pencil"></i>View</a>
								               
								            </div>
								        </td>
								    </tr>
								<?php } ?>
                            </tbody>
                        </table>
                        <a href="<?php echo $this->Html->url("/dashboards/sub_pending/",true); ?>" class="btn btn-info" style="float:right">more</a>
                    </div>
                    <!-- END Datatables Example 1 -->

                    <!-- END Datatables Example 1 -->
                </div>
                <!-- END div.row -->
                <!-- END Dynamic Tables in the Grid -->
                <div class="row">
 					<div class="col-md-12">
 					<h4 class="page-header">All complaints of user's subdivision</h4>
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
							<?php foreach ($complaints_list as $complaint) { ?>
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
							                     
								                <a href="<?php echo $this->Html->url("/complaints/view/".$complaint['Complaint']['id'],true); ?>" data-toggle="tooltip" title="View" class="btn btn-xs btn-success"><i class="icon-pencil"></i>View</a>
								                
							            </div>
							        </td>
							    </tr>
							<?php } ?>
							    
							</tbody>
						</table>

							<a href="<?php echo $this->Html->url("/dashboards/sub_complaints/",true); ?>" class="btn btn-info" style="float:right">more</a>
                    </div>
                </div>

 <script>

window.onload = function() {
	$('#index-datatables').dataTable({"aoColumnDefs": [{"bSortable": false, "aTargets": [4]}]});
}
	</script>