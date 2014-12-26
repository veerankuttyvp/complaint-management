               <!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Complaints",'/complaints');
      $this->Html->addCrumb("Report",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->


                <div class="block block-themed">
                    <!-- Time and Date Pickers Title -->
                    <div class="block-title">
                        <h4><i class="icon-time"></i> Generate Pdf</h4>
                    </div>
                    <!-- END Time and Date Pickers Title -->

                    <!-- Time and Date Pickers Content -->
                    <div class="block-content block-content-flat">
                        <form action="<?php echo $this->Html->url(array('controller'=>'Complaints','action'=>'view_pdf'));?>" method="post" class="form-horizontal form-bordered" onsubmit="return checkForm()">
                            


                            <div class="form-group">
                                <label class="control-label col-md-2" for="input-daterangepicker">Select Subdivision</label>
                                <div class="col-md-4">
                                <select class="form-control " name="subdivision" id="subdivision_ids">
                                        <option value=0 >Select</option>
                                    <?php foreach ($subdivisions as $key0 => $subdivision) { ?>
                                        <option value="<?php echo $key0; ?>" ><?php echo $subdivision ?></option>
                                    <?php }?>
                                    
                                </select> 
                                </div>
                            </div>

                            <div id="center"></div>
                              <div style="display:none;" id="laoder-gif1" class="col-sm-5 form-group"><div class="loader-08 pull-right"></div></div><div class="clearfix"></div>


                            <input type="hidden" name="date_range" id="range">
                            <div class="form-group">
                                <label class="control-label col-md-2">Advanced Date Range</label>
                                <div class="col-md-10">
                                    <div id="advanced-daterangepicker" class="btn btn-info">
                                        <i class="icon-calendar"></i>
                                        <span></span>
                                        <b class="caret"></b>
                                    </div>
                                </div>
                            </div>
                            

                            
                            <div class="form-group">
                                <label class="control-label col-md-2" for="input-daterangepicker">Select Status of Complaint</label>
                                <div class="col-md-4">
                                <select class="form-control " name="status">
                                        <option value=0 >Select</option>
                                    <?php foreach ($status as $key => $stat) { ?>
                                        <option value="<?php echo $key; ?>" ><?php echo $stat ?></option>
                                    <?php }?>
                                    
                                </select> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="input-daterangepicker">Select Category</label>
                                <div class="col-md-4">
                                <select class="form-control subcatagory_list" id="category_ids">
                                        <option value=0 >Select</option>
                                    <?php foreach ($categories as $key1 => $category) { ?>
                                        <option value="<?php echo $key1; ?>" ><?php echo $category ?></option>
                                    <?php }?>
                                    
                                </select> 
                                </div>
                            </div>


                            <div id="subcategory"></div>
                              <div style="display:none;" id="laoder-gif" class="col-sm-5 form-group"><div class="loader-08 pull-right"></div></div><div class="clearfix"></div>
                                            
                            
                            <div class="form-group form-actions">
                                <div class="col-md-10 col-md-offset-2">
                                    <button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
                                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Submit</button>
                                </div>
                            </div>
                            <input type="hidden" name="category" id="category_sent">
                            <input type="hidden" name="subcategory" id="subcatagory_sent">
                            <input type="hidden" name="center" id="center_sent">
                        </form>
                    </div>
                    <!-- END Time and Date Pickers Content -->
                </div>
                <!-- END Time and Date Pickers Block -->
                <script type="text/javascript">
                function checkForm(){
                    // option = $( "#example-advanced-daterangepicker" ).) );
                    var list  = new Array();
                    $("#range").val($( "#advanced-daterangepicker" ).find( "span" ).text());
                    $("#category_sent").val(0);
                    $("#subcatagory_sent").val(0);
                    $("#center_sent").val(0);


                    $(".subcatagory_list").each(function() {
                        list.push($(this).val());
                    });
                    length = list.length;
                    if(length ==1){
                        $("#category_sent").val(list[0]);
                    } else if(length ==2){
                        $("#category_sent").val(list[0]);
                        $("#subcatagory_sent").val(list[1]);
                    } else{
                        $("#category_sent").val(list[length - 2]);
                        $("#subcatagory_sent").val(list[length - 1]);

                    }

                    if ($('#centers_ids').length > 0) {
                        $("#center_sent").val($('#centers_ids').val());
                    }

                }
            // When the document is ready
            window.onload = function() {
            

                $(document).on('change','#category_ids',function(){
        
                    if($(this).val() == '0'){
                       
                    } else {
                    
                        $('#subcategory').html('');
                        $('#laoder-gif').show();
                        
                        $.get(main_path+'complaints/getchildencat_for_pdf/'+$(this).val(),function(data){
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
                $(document).on('change','#subdivision_ids',function(){
        
                    if($(this).val() == '0'){
                       
                    } else {
                    
                        $('#center').html('');
                        $('#laoder-gif1').show();
                        // console.log(main_path);
                        $.get(main_path+'complaints/getcenter/'+$(this).val(),function(data){
                            if(data == "fail"){
                                $('#subdivision_ids').val($('#subdivision_ids').val());
                            } else {
                                html = data;
                                $('#center').html(html);
                                $('#center select').focus();
                                
                            }
                            $('#laoder-gif1').hide();
                            
                          });
                          
                        }
                        
                    });



            }
        </script>