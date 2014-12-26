<div class="col-sm-12 col-xs-5" style="float:left;width: 100%;border:1px solid #a1a1a1;background:#f1f1f1;margin-bottom: 10px;padding: 10px 0 10px 10px;">
    <div class=" text-center">
       <?php 
       echo $this->Form->create("Complaint",array('url'=>array('action'=>'complaint_map','novalidate' => true),'id'=>'filter_form',"class"=>"form-inline",)); 
        
     ?>
    
            <div class="form-group" style="float:left;margin-left: 5px">
                <label class="col-md-9" for="input-daterangepicker" style="text-align:left;">Select Category</label>
                <div class="col-md-4">
                <select class="form-control" id="category_ids" name="data[Complaint][parent_category_id]">
                        <option value=0 >Select</option>
                    <?php foreach ($categories as $key1 => $category) { ?>
                        <option value="<?php echo $key1; ?>" ><?php echo $category ?></option>
                    <?php }?>

                </select> 
                </div>
            </div>
            <br  style="clear:both;"/>
            <input type="hidden" name="data[Complaint][child_cat_id]" id="child_cat_id">

            <div id="subcategory" style="float:left;margin-left: 5px"></div>
            <div style="display:none;" id="laoder-gif" class="col-sm-5 form-group"><div class="loader-08 pull-right"></div></div><div class="clearfix"></div>
            <div style="float:right;margin-right: 20px;"> 
                <span class="input-group-btn">
                    <!-- <a id="search_form_submit" class="btn btn-default"><i class="fa fa-search"></i> Search</a> -->
                    <!-- <input class="btn btn-default" type="submit" value="submit" > -->
                    <!-- <button type="submit" value="submit">Search</button> -->
                    <button type="submit" class="btn btn-default" id="search_form_submit"><i class="fa fa-search"></i> Search</button>
                </span>
            </div>                
        </form>
    </div>
</div>    

      <!-- Map With Markers -->
                    <div class="full-width" >
                        <!-- Map with Markers Block -->
                        <div class="block block-themed">
                            <!-- Map with Markers Title -->
                            <div class="block-title">
                                <h4>Map with Markers</h4>
                            </div>
                            <!-- END Map with Markers Title -->

                            <!-- Map with Markers Content -->
                            <div class="block-content block-content-flat">
                                <div id="example-gmap-markers" class="gmap-con"></div>
                            </div>
                            <!-- END Map with Markers Content -->
                        </div>
                        <!-- END Map with Markers Block -->
                    </div>
                    <!-- END Map With Markers -->
                </div>
                <!-- END First Row -->
              
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>!window.jQuery && document.write(unescape('%3Cscript src="js/vendor/jquery-1.9.1.min.js"%3E%3C/script%3E'));</script>

        

        
        <!-- Google Maps API + Gmaps Plugin - Remove 'http:' if you have SSL -->
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        
        <!-- Javascript code only for this page -->
        <script>
       //  $(function() {

        
       //  markers = new Array();
       //  var i = 0;
       //  var lati = 0;
       //  var longi = 0;
       //  var complaintId;
       //  var url = main_path+'complaints/getchildencat_for_cmc/'; 
       //  <?php foreach ($complaints as $key => $complaint) { ?>
       //      complaintId = <?php  echo $complaint['Complaint']['id']; ?>;
       //      lati = <?php  echo $complaint['Complaint']['lat']; ?>;
       //      url = main_path+'complaints/view/'+complaintId; 
       //      longi = <?php  echo $complaint['Complaint']['longi']; ?>;;
       //      markers[i]={lat: lati, lng: longi, title: 'Marker #1', infoWindow: {content: '<a href="'+url+'">#'+complaintId+'</a>'}};
       //       i++;
       //  <?php }?>
       // });

            // $(function() {
            //     /*
            //      * With Gmaps.js, Check out examples and documentation at http://hpneo.github.io/gmaps/examples.html
            //     */

            //     // Set default height to all Google Maps Containers
            //     $('#example-gmap-markers')
            //         .css('height', '700px');              

            //     // Initialize map with markers
            //     map = new GMaps({
            //         div: '#example-gmap-markers',
            //         lat: 0,
            //         lng: 0,
            //         zoom: 3,

            //     });

            //         map.addMarkers(markers);



            // });

// new map

$(function() {
    <?php
    $jsonlink = $this->html->url('/', true);
$jsonlink =$jsonlink.'gmap/convert.json';
?>
   
var map;
$('#example-gmap-markers')
                    .css('height', '700px'); 

var infowindow = new google.maps.InfoWindow({});
  var map = new google.maps.Map(document.getElementById('example-gmap-markers'), {
      zoom: 4,
      center: new google.maps.LatLng(33.6667,73.1667),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });


  map.data.loadGeoJson("<?php echo $jsonlink ?>");

// }


// google.maps.event.addDomListener(window, 'load', initialize);

var global_markers = [];  

markers = new Array();
        var i = 0;
        var lati = 0;
        var longi = 0;
        var complaintId;
        // main_path ="ss";
        var url = main_path+'complaints/getchildencat_for_cmc/'; 
        <?php foreach ($complaints as $key => $complaint) { ?>
            complaintId = <?php  echo $complaint['Complaint']['id']; ?>;
            lati = <?php  echo $complaint['Complaint']['lat']; ?>;
            url = main_path+'complaints/view/'+complaintId; 
            longi = <?php  echo $complaint['Complaint']['longi']; ?>;
            markers[i] = new Array();
            markers[i][0]= lati;
            markers[i][1]= longi;
            markers[i][2]= '<a href="'+url+'">#'+complaintId+'</a>';
             i++;
        <?php }?>




var infowindow = new google.maps.InfoWindow({});
for (var i = 0; i < markers.length; i++) {
        // obtain the attribues of each marker
        var lat = parseFloat(markers[i][0]);
        var lng = parseFloat(markers[i][1]);
        var trailhead_name = markers[i][2];

        var myLatlng = new google.maps.LatLng(lat, lng);

        var contentString = "<html><body><div><p><h2>" + trailhead_name + "</h2></p></div></body></html>";

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            // title: "Coordinates: " + lat + " , " + lng + " | Trailhead name: " + trailhead_name
        });

        marker['infowindow'] = contentString;

        global_markers[i] = marker;

        google.maps.event.addListener(global_markers[i], 'click', function() {
            infowindow.setContent(this['infowindow']);
            infowindow.open(map, this);
        });
    }




});




    $(document).on('change','#category_ids',function(){

            if($(this).val() == '0'){

            } else {

                $('#subcategory').html('');
                $('#laoder-gif').show();

                $.get(main_path+'complaints/getchildencat_for_cmc/'+$(this).val(),function(data){
                    if(data == "fail"){
                        $('#category_ids').val($('#category_ids').val());
                    } else {
                        html = data;
                        $('#subcategory').html(html);
                        $('#subcategory select').focus();
                    }
                    $('#laoder-gif').hide();

                  });

                }

            });

    $("#search_form_submit").click(function(){

        var list  = new Array();
        $("#child_cat_id").val(0);
        $(".child_categories").each(function() {
                    if($(this).val() !=0){
                        list.push($(this).val());
                    }
        });
        length = list.length;
        if(length ==1){
                        $("#child_cat_id").val(list[0]);
        } else{
                        $("#child_cat_id").val(list[length - 1]);
        }


        
       
            
           

        // $("#filter_form").submit();
    });

        </script>