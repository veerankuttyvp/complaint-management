<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Complaint History",'javascript:void(0)');
      $this->Html->addCrumb("View",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->

              <div class="row row-items">
                    <!-- Datatables Example 1 -->
                    <?php
                    $group_name = Cache::read('group_name');
                    if($group_name == 'CMC' || $group_name == 'Director' || $group_name == 'Manager' || $group_name == 'Administrator'){
                    ?>
                <div class="col-md-12">
                  <div class="block block-themed">
                        <!-- Themed Title -->
                         <div class="block-title">
                         <h4>
                            <?php echo $complaint_details['ComplaintStatus']['status']; ?>
                         </h4>
                         </div>
                        <!-- END Themed Title -->

                      <!-- Themed Content -->
                      <div class="block-content full">
                      <p>Change Status of Complaint: <a class="btn btn-xs btn-success model" href="<?php echo $this->Html->url("/ComplaintUpdates/status_edit/".$complaint_details['Complaint']['id'],true); ?>" data-toggle="tooltip" title="Change Status" rel="Change Status" ><i class="icon-pencil"></i>Change Status</a></p>
                      
                      </div>
                      <!-- END Themed Content -->
                    </div>


                </div>
              <?php } ?>
                <?php
                if(!empty($complaintupdate_before)){
                
                ?>
                <div class="col-md-6" id="before_table">
                       
                      <!-- Themed Block -->
                      <div class="block block-themed">
                        <!-- Themed Title -->
                         <div class="block-title"><h4><?php echo $complaintupdate_before['ComplaintUpdateStatus']['status'] ?>



                         </h4>
                            



                         </div>
                        <!-- END Themed Title -->

                      <!-- Themed Content -->
                      <div class="block-content full">
                      <p>Comment: <?php echo $complaintupdate_before['ComplaintUpdate']['comment'] ?></p>
                      <p>Date: <?php echo $complaintupdate_before['ComplaintUpdate']['created'] ?></p>
                      <p>Image: <img src="<?php echo $prefix_complaint_images.$complaintupdate_before['ComplaintUpdate']['image_path'] ?>" width="200" height="200"/></p>
                      
                            <div><p>Location:</p>
                                <div class="map" id="status_before">
                                  <?php if(empty($complaintupdate_before['ComplaintUpdate']['lati']) || empty($complaintupdate_before['ComplaintUpdate']['longi'])){?>
                                        No Location information available
                                  <?php }?>
                                </div>
                              
                            </div>
                      

                      </div>
                      <!-- END Themed Content -->
                    </div>
                <!-- END Themed Block -->   
                   </div>




              <?php  
                    }else {
                  ?>
                        <div class="col-md-6 ">


                                <div class="block block-themed">
                                <!-- Themed Title -->
                                 <div class="block-title"><h4>

                                    Before

                                 </h4>
                                    



                                 </div>
                                <!-- END Themed Title -->

                              <!-- Themed Content -->
                              <div class="block-content full">
                                <div class="empty_box">
                                  No Updates Available For Before
                                </div>
                              
                          
                              </div>
                              <!-- END Themed Content -->
                            </div>

                      </div>
              <?php } ?>
 

              <?php
                if(!empty($complaintupdate_resolved)){
                
                ?>
                <div class="col-md-6">
                       
                      <!-- Themed Block -->
                      <div class="block block-themed">
                        <!-- Themed Title -->
                         <div class="block-title"><h4><?php echo $complaintupdate_resolved['ComplaintUpdateStatus']['status'] ?>



                         </h4>
                            



                         </div>
                        <!-- END Themed Title -->

                      <!-- Themed Content -->
                      <div class="block-content full">
                      <p>Comment: <?php echo $complaintupdate_resolved['ComplaintUpdate']['comment'] ?></p>
                      <p>Date: <?php echo $complaintupdate_resolved['ComplaintUpdate']['created'] ?></p>
                      <p>Image: <img src="<?php echo $prefix_complaint_images.$complaintupdate_resolved['ComplaintUpdate']['image_path'] ?>" width="200" height="200"/></p>
                      
                            <div><p>Location:</p>
                                <div class="map" id="status_resoved">
                                <?php if(empty($complaintupdate_resolved['ComplaintUpdate']['lati']) || empty($complaintupdate_resolved['ComplaintUpdate']['longi'])){?>
                                        No Location information available
                                  <?php }?>
                                  
                                </div>
                              
                            </div>
                  
                      </div>
                      <!-- END Themed Content -->
                    </div>
                <!-- END Themed Block -->   
                   </div>




              <?php  
                    }else {
                  ?>
                      <div class="col-md-6 " id="resolved_table">


                                <div class="block block-themed">
                                <!-- Themed Title -->
                                 <div class="block-title"><h4>

                                    Resolved

                                 </h4>
                                    



                                 </div>
                                <!-- END Themed Title -->

                              <!-- Themed Content -->
                              <div class="block-content full">
                                <div class="empty_box">
                                  No Updates Available For Resolved
                                </div>
                              
                          
                              </div>
                              <!-- END Themed Content -->
                            </div>

                      </div>
              <?php } ?>
 




                <?php 
                if(!empty($complaintupdates)){
                foreach ($complaintupdates as $complaintupdate) { 
                  ?>
                   <div class="col-md-6">
                       
                      <!-- Themed Block -->
                      <div class="block block-themed">
                        <!-- Themed Title -->
                         <div class="block-title"><h4><?php echo $complaintupdate['ComplaintUpdateStatus']['status'] ?>



                         </h4>
                         		


                         </div>
                        <!-- END Themed Title -->

                      <!-- Themed Content -->
                      <div class="block-content full">
                    	<p>Comment: <?php echo $complaintupdate['ComplaintUpdate']['comment'] ?></p>
                    	<p>Date: <?php echo $complaintupdate['ComplaintUpdate']['created'] ?></p>
                    	<p>Image: <img src="<?php echo $prefix_complaint_images.$complaintupdate['ComplaintUpdate']['image_path'] ?>" width="200" height="200"/></p>
                      
                            <div><p>Location:</p>
                                <div class="map" id="status_update_<?php echo $complaintupdate['ComplaintUpdate']['id']?>">

                                <?php if(empty($complaintupdate['ComplaintUpdate']['lati']) || empty($complaintupdate['ComplaintUpdate']['longi'])){?>
                                        No Location information available
                                  <?php }?>
                                  
                                </div>
                              
                            </div>
                      



                      </div>
                      <!-- END Themed Content -->
                    </div>
                <!-- END Themed Block -->   
                   </div>
                 <?php } 
               }else {
                  ?>
                      <!-- <h4 class="page-header">No Updates Available</h4> -->
                 <?php } ?>
 
                 
                   
              </div>


              <div class="modal fade" id="modal_def" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h2 class="modal-title" id="defModallabel"></h2>
            </div>

            <div class="modal-body">
                <div style="margin:0 auto;display: block;" class="loader-08"></div>
                <div id="modal-body-content">

                </div>
                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>


<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
      function initialize() {
         <?php if(!empty($complaintupdate_before['ComplaintUpdate']['lati']) && !empty($complaintupdate_before['ComplaintUpdate']['longi'])){?>
                    var myLatlng = new google.maps.LatLng(<?php echo $complaintupdate_before['ComplaintUpdate']['lati'] ?>,<?php echo $complaintupdate_before['ComplaintUpdate']['longi'] ?>);
                    var mapOptions = {
                      zoom: 10,
                      center: myLatlng
                    }
                    var map = new google.maps.Map(document.getElementById('status_before'), mapOptions);


                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: 'Current place'
                    });
        <?php } ?>

        <?php if(!empty($complaintupdate_resolved['ComplaintUpdate']['lati']) && !empty($complaintupdate_resolved['ComplaintUpdate']['longi'])){?>
                    var myLatlng1 = new google.maps.LatLng(<?php echo $complaintupdate_resolved['ComplaintUpdate']['lati'] ?>,<?php echo $complaintupdate_resolved['ComplaintUpdate']['longi'] ?>);
                    var mapOptions1 = {
                      zoom: 10,
                      center: myLatlng1
                    }
                    var map1 = new google.maps.Map(document.getElementById('status_resoved'), mapOptions1);


                    var marker1 = new google.maps.Marker({
                        position: myLatlng1,
                        map: map1,
                        title: 'Current place'
                    });
        <?php } ?>
         <?php 
                if(!empty($complaintupdates)){
                    foreach ($complaintupdates as $complaintupdate) { 
                    ?>

                          <?php if(!empty($complaintupdate['ComplaintUpdate']['lati']) && !empty($complaintupdate['ComplaintUpdate']['longi'])){?>
                                    var myLatlng_<?php echo $complaintupdate['ComplaintUpdate']['id'] ?> = new google.maps.LatLng(<?php echo $complaintupdate['ComplaintUpdate']['lati'] ?>,<?php echo $complaintupdate['ComplaintUpdate']['longi'] ?>);
                                    var mapOptions_<?php echo $complaintupdate['ComplaintUpdate']['id'] ?> = {
                                      zoom: 10,
                                      center: myLatlng_<?php echo $complaintupdate['ComplaintUpdate']['id'] ?>
                                    }
                                    var map_<?php echo $complaintupdate['ComplaintUpdate']['id'] ?> = new google.maps.Map(document.getElementById("status_update_<?php echo $complaintupdate['ComplaintUpdate']['id'] ?>"), mapOptions_<?php echo $complaintupdate['ComplaintUpdate']['id'] ?>);


                                    var marker_<?php echo $complaintupdate['ComplaintUpdate']['id'] ?> = new google.maps.Marker({
                                        position: myLatlng_<?php echo $complaintupdate['ComplaintUpdate']['id'] ?>,
                                        map: map_<?php echo $complaintupdate['ComplaintUpdate']['id'] ?>,
                                        title: 'Current place'
                                    });
                        <?php } ?>


              <?php }  
              }   ?>
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>



<script>

window.onload = function() {

	$('#index-datatables').dataTable({"aoColumnDefs": [{"bSortable": false, "aTargets": [4]}]});
	$('#ComplaintComplaintStatusId').change(function(){
		
		$('#ComplaintIndexForm').submit();
		
	});
	
	 $(document).on('click','a.model',function(e){

        e.preventDefault();

        var url = $(this).attr('href');

        // Set header.
        var title = $(this).attr('rel');
        $('#defModallabel').html(title);
        $('#modal_def').modal('show');
        $('.loader-08').show();
        $('#modal-body-content').html('');

        $.get(url+'/'+event.timeStamp,function(html){

            $('#modal-body-content').html(html);
            $('.loader-08').hide();
            $('.modal-footer').html($('#for_footer').html());
            $('#for_footer').html('')

            $('.modal-content').slideDown('fast');
        });

    });
	
  
};

</script>
<style>
  .map{
        width: 250px;
        height: 250px;
        left: 42px;
        background-color: #c0c0c0;
        position: relative;
        display: table-cell;    
        text-align: center;
        vertical-align: middle;
      }
  .empty_box{
    height: 570px;
    font-size: 24px;
    display: table-cell;    
    text-align: center;
    vertical-align: middle;
    padding-left: 10px;

  }
</style>