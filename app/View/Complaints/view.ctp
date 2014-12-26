<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Complaints",'/complaints');
      $this->Html->addCrumb("View",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<!-- div.row -->
                <div class="row row-items">
                    <!-- Datatables Example 1 -->
                    <div class="col-md-12">
                        <h3 class="page-header">Current status of complaint : <?php echo $complaint['ComplaintStatus']['status'] ?></h3>
                    </div>
                    <div class="col-md-12">
                        <h4 class="page-header" style="margin-top: -26px;">Complaint Id : <?php echo $complaint['Complaint']['id'] ?></h4>
                    </div>
                    <?php if($complaint['ComplaintStatus']['id'] == 2){ ?>
                        <div class="col-md-12">
                            <h5 class="page-header" style="margin-top: -26px;">Time Taken to resolve this complaint : 
                            <?php
                                
                                if($interval->format('%y') >0){
                                    echo $interval->format('%y')." years, ";
                                }
                                if($interval->format('%m') >0){
                                    echo $interval->format('%m')." months, ";
                                }
                                if($interval->format('%d') >0){
                                    echo $interval->format('%d')." days, ";
                                }
                                if($interval->format('%h') >0){
                                    echo $interval->format('%h')." hours, ";
                                }
                                if($interval->format('%s') >0){
                                    echo $interval->format('%s')." seconds, ";
                                }
                                

                            ?>
                            </h5>
                        </div>
                    <?php } ?>
                    <div class="col-md-6">
                        <table id="example-datatables3" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    
                                    <th colspan="2"><i class="icon-user"></i> Complaint Details</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                    <td>Bill No</td>
                                    <td><?php echo $complaint['Complaint']['bill_no'] ?></td>

                                </tr>

                               <tr>
                                    
                                    <td>Category Name</td>
                                    <td><?php echo $complaint['Category']['name'] ?></td>

                                </tr>
                                <tr>
                                    
                                    <td>Complaint Status</td>
                                    <td><?php echo $complaint['ComplaintStatus']['status'] ?></td>

                                </tr>
                                <tr>
                                    
                                    <td>Complaint Address</td>
                                    <td><?php echo $complaint['Complaint']['complaint_address'] ?></td>

                                </tr>
                                <tr>
                                    
                                    <td>Complaint Description</td>
                                    <td><?php echo $complaint['Complaint']['description'] ?></td>

                                </tr>
                                <tr>
                                    
                                    <td>Complaint Source</td>
                                    <td><?php echo $complaint['Complaint']['source'] ?></td>

                                </tr>
                                <tr>
                                    
                                    <td>Complaint Priority</td>
                                    <td><?php echo $complaint['ComplaintPriority']['priority'] ?></td>

                                </tr>
                                <tr>
                                    
                                    <td>User Name</td>
                                    <td><?php echo $complaint['User']['user_name'] ?></td>

                                </tr>
                                <tr>
                                    
                                    <td>Subdivision</td>
                                    <td><?php echo $complaint['Subdivision']['name'] ?></td>

                                </tr>
                                <tr>
                                    
                                    <td>Center Name</td>
                                    <td>
                                    <?php if(!empty($mobile_user_mobile_phone['MobileUser']['center_name'])){
                                     echo $mobile_user_mobile_phone['MobileUser']['center_name']; 
                                        } ?>
                                     </td>

                                </tr>
                                <?php if(!empty($complaint['Complaint']['is_seen_time'])){?>
                                  <tr>
                                    
                                    <td>Complaint Last seen By Subengineer</td>
                                    <td><span class="label label-success"><?php echo $complaint['Complaint']['is_seen_time']; ?></span></td>

                                </tr>

                                <?php } ?>
                                <tr>
                                    
                                    <td>Date registered</td>
                                    <td><span class="label label-success"><?php echo $datetime2_created->format('M , d - Y h:i:s A'); ?></span></td>

                                </tr>
                                <tr>
                                    
                                    <td>Last Modified</td>
                                    <td><span class="label label-success"><?php echo $datetime2_modified->format('M , d - Y h:i:s A') ?></span></td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- END Datatables Example 1 -->

                    <!-- Datatables Example 2 -->
                    <div class="col-md-6">
                        <table id="example-datatables3" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    
                                    <th colspan="2"><i class="icon-user"></i> Consumer Details</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                    <td>First Name</td>
                                    <td><?php echo $complaint['Consumer']['first_name'] ?></td>

                                </tr>

								<tr>
                                    
                                    <td>Middle Name</td>
                                    <td><?php echo $complaint['Consumer']['middle_name'] ?></td>
                                    
                                </tr>
                                <tr>
                                    
                                    <td>Last Name</td>
                                    <td><?php echo $complaint['Consumer']['last_name'] ?></td>
                                    
                                </tr>
                                <tr>
                                    
                                    <td>Address</td>
                                    <td><?php echo $complaint['Consumer']['address'] ?></td>
                                    
                                </tr>
								<tr>
                                    
                                    <td>Cnic</td>
                                    <td><?php echo $complaint['Consumer']['cnic'] ?></td>
                                    
                                </tr>
                                <tr>
                                    
                                    <td>Mobile</td>
                                    <td><?php echo $complaint['Consumer']['mobile'] ?></td>
                                    
                                </tr>
                                <tr>
                                    
                                    <td>Email</a></td>
                                    <td><?php echo $complaint['Consumer']['email'] ?></td>
                                    
                                </tr>
                                
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- END Datatables Example 1 -->
                </div>

                <!-- END div.row -->
                <button class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg">Complaint History</button>
                <button class="btn btn-info" data-toggle="modal" data-target=".notification-modal">Complaint Reminders</button>
                <?php if($this->Acl->check('ComplaintUpdates','view') == true){ ?>
                <a class="btn btn-info" href="<?php echo $this->Html->url("/complaint_updates/view/".$complaint['Complaint']['id'],true); ?>" >View Updates</a>
                <?php } ?>
                <button class="btn btn-info" data-toggle="modal" data-target="#add_reminder">Add Reminder</button>
                <?php if($this->Acl->check('Complaints','delete_complaint') == true){ ?>
                <button class="btn btn-info" data-toggle="modal" data-target="#delete_complaint">DELETE</button>
                <?php } ?>
                <a href="<?php echo $this->Html->url("/complaints/edit/".$complaint['Complaint']['id'],true); ?>" class="btn btn-info">Edit</a>

                <!-- COMPLAINT HISTORY -->
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  					<div class="modal-dialog modal-lg">
    					<div class="modal-content">
    						<div class="modal-header">
          						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          						<h4 class="modal-title" id="myLargeModalLabel">Complaint History</h4>
        					</div>
        					<div class="modal-body">
        					
        					<?php foreach ($complainthistories as $complainthistory) { ?>
									<!-- Themed Block -->
						                <div class="block block-themed">
						                    <!-- Themed Title -->
						                    <div class="block-title"><h4><?php echo $complainthistory['ComplaintHistory']['action'] ?></h4></div>
						                    <!-- END Themed Title -->

						                    <!-- Themed Content -->
						                    <div class="block-content full">
                                                                        <p>Username: <span class="label label-default"><?php echo $complainthistory['User']['user_name'] ?> </span></p>
                                                                        <p>Current Status: <span class="label label-warning"> <?php echo $complainthistory['CurrentComplaintStatus']['status'] ?> </span></p>
                                                                        <p>Previous Complaint Status: <span class="label label-warning"> <?php echo $complainthistory['ComplaintStatus']['status'] ?> </span></p>
                                                                        <p>Action Date: <span class="label label-default"> <?php echo $complainthistory['ComplaintHistory']['created'] ?></span></p>
						                    </div>
						                    <!-- END Themed Content -->
						                </div>
						                <!-- END Themed Block -->
                			<?php } ?>





        					</div>



      						
    					</div>
  					</div>
				</div>
	<!-- COMPLAINT HISTORY -->
	
	
	<!-- COMPLAINT Notification -->
                <div class="modal fade notification-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  					<div class="modal-dialog modal-lg">
    					<div class="modal-content">
    						<div class="modal-header">
          						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          						<h4 class="modal-title" id="myLargeModalLabel">Complaint History</h4>
        					</div>
        					<div class="modal-body">
        					
        					<?php
							if(count($complaintnotification) > 0){
								
	        					foreach ($complaintnotification as $complaintnotification) { ?>
									<!-- Themed Block -->
						                <div class="block block-themed">
						                    <!-- Themed Title -->
						                    <div class="block-title"><h4>Reminder Created By: <?php echo $complaintnotification['User']['user_name'] ?> </h4></div>
						                    <!-- END Themed Title -->
	
						                    <!-- Themed Content -->
						                    <div class="block-content full">
						                    	<p><?php echo nl2br($complaintnotification['ComplaintNotification']['notification_comment']) ?></p>
						                    	<p>Created On: <?php echo $complaintnotification['ComplaintNotification']['created'] ?></p>
	
						                    </div>
						                    <!-- END Themed Content -->
						                </div>
						                <!-- END Themed Block -->
	                			<?php }
                			 
							} else { ?>
                			
                				<p> No Reminders Found</p>
                			
                			<?php } ?>





        					</div>



      						
    					</div>
  					</div>
				</div>
	<!-- COMPLAINT Notification -->
	
	
	<!-- Modal -->
	
	<div id="add_reminder" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
			
				<div class="modal-header">
				
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myLargeModalLabel">Add Reminder</h4>
					
				</div>
				
				<div class="modal-body">
				
					  <?php echo $this->Form->create("ComplaintNotification",array("class"=>"form-horizontal",'url'=>'/complaints/complaint_reminder/'.$complaint['Complaint']['id']));  
					   echo $this->Form->input("notification_comment",array("placeholder"=>"Message","type"=>"textarea","label"=>array("text"=>"Message")));
					   ?>
					  <div class="col-sm-10 col-sm-offset-2"><input value="Submit" class="btn btn-primary" type="submit"></div>
        			  </form>
        			  
        			  <div class="clearfix"></div>

				</div>
					
			</div>
		</div>
	</div>
	
	<!-- End Modal -->

        <!-- Modal -->
    
    <div id="delete_complaint" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
                <div class="modal-header">
                
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myLargeModalLabel">Delete Complaint</h4>
                    
                </div>
                
                <div class="modal-body">
                
                      <?php echo $this->Form->create("ComplaintNotification",array("class"=>"form-horizontal",'url'=>'/complaints/delete_complaint/'.$complaint['Complaint']['id']));  
                       
                       ?>
                      
                          <div class="col-sm-6" style="font-weight:bolder">
                            You realy want to delete the complaint?
                          </div>
                          <div class="col-sm-1">
                            <input class="btn btn-primary" type="submit" value="Yes">
                          </div>
                          <div class="col-sm-1">
                            <input  class="btn btn-primary" type="reset" value="No" data-dismiss="modal">
                          </div>
                      
                      </form>
                      
                      <div class="clearfix"></div>

                </div>
                    
            </div>
        </div>
    </div>
    
    <!-- End Modal -->
