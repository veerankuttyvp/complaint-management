<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Complaints",'/complaints');
      $this->Html->addCrumb("Cmc Operator",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<script>


</script>
<div class="row">

<div class="col-sm-12 col-xs-5" style="padding:0px;margin-top:10px;">
	<div class=" text-center">
	   <?php 
	   echo $this->Form->create("Complaint",array('url'=>array('action'=>'cmc_operator'),'onsubmit'=>"checkForm()",'id'=>'filter_form',"class"=>"form-inline",)); 
	    echo $this->Form->input("complaint_status_id",array("options"=>$status,"empty"=>'Select a Status','required'=>true,'style'=>'padding: 9px 10px;','class'=>'col-sm-7',"label"=>array("text"=>"Filter By Complaint Status",'class'=>'col-sm-8','id'=>'comp_status_input','style'=>'padding: 9px;text-align:left;')));
	    echo $this->Form->input("subdivision_id",array("options"=>$subdivisions,"empty"=>'Select a Subdivision','required'=>true,'style'=>'padding: 9px 10px;','class'=>'col-sm-7',"label"=>array("text"=>"Filter By Subdivision",'class'=>'col-sm-7','id'=>'comp_subdivision_input','style'=>'padding: 9px;text-align:left;')));
		?>
            <input type="hidden" name="data[Complaint][date_range]" id="range">
            <input type="hidden" name="data[Complaint][raw_date_range]" id="raw_range">
            <div class="form-group">
                <label class=" col-md-5" style="padding: 9px;text-align:left;">Date Range</label>
                <div class="col-md-9" style="padding-left: 0px;">
                    <div id="advanced-daterangepicker" class="btn btn-info">
                        <i class="icon-calendar"></i>
                        <span id="date_range_span"></span>
                        <b class="caret"></b>
                    </div>
                                    
                </div>
            </div>
            <br style="clear:both;"/>
            <br style="clear:both;"/>
           
            <div class="form-group " style="float:left;">
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
            <br  style="clear:both;">

            <div id="subcategory" style="float:left;" class="form-group"></div>
            <div style="display:none;" id="laoder-gif" class="col-sm-5 form-group"><div class="loader-08 pull-right"></div></div><div class="clearfix"></div>
                            
		</form>
	</div>
</div>
    <div id="complaints_table">
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
    </div>

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

<style>
#ComplaintIndexForm .form-group{
		float:right;
		width:100%;
}		
</style>

<script>
function checkForm(){
                    
//    $("#range").val($( "#example-advanced-daterangepicker" ).find( "span" ).text());


}

window.onload = function() {
	$('#index-datatables').dataTable({"aoColumnDefs": [{"bSortable": false, "aTargets": [4]}]});
//	$('#ComplaintComplaintStatusId').change(function(){
//		
//		$('#ComplaintIndexForm').submit();
//		
//	});
	
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
//    alert('asd');
    $("#ComplaintComplaintStatusId").change(function(){
        
//        $('.loader-08').show();
        $("#filter_form").submit();
//        $.load('<?php echo $this->webroot;?>complaints/cmc_operator_ajax',$("#filter_form").serialize(),function(html){
//
//             $('#complaints_table').html(html);
////            $('.loader-08').hide();
////            $('.modal-footer').html($('#for_footer').html());
////            $('#for_footer').html('')
////
////            $('.modal-content').slideDown('fast');
//        });
        
    });
    $("#ComplaintSubdivisionId").change(function(){
//        $('.loader-08').show();
        $("#filter_form").submit();
//        $.post('<?php echo $this->webroot;?>complaints/cmc_operator_ajax',$("#filter_form").serialize(),function(html){
//alert(html);
//             $('#complaints_table').html(html);
////            $('.loader-08').hide();
////            $('.modal-footer').html($('#for_footer').html());
////            $('#for_footer').html('')
////
////            $('.modal-content').slideDown('fast');
//        });
        
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
//            $('.ranges ul li').mouseup(function(){
//            $('#example-advanced-daterangepicker').daterangepicker().on('changeDateRange',function(){
//                alert($( "#example-advanced-daterangepicker" ).find( "span" ).text());
//                $("#range").val($( "#example-advanced-daterangepicker" ).find( "span" ).text());
//            });
            // Initialize DateRangePicker Advanced Demo Example
        var exampleAdvancedDateRange = $('#advanced-daterangepicker');
        var exampleAdvancedDateRangeSpan = $('#advanced-daterangepicker span');

        exampleAdvancedDateRange.daterangepicker({
            ranges: {
                'Today': ['today', 'today'],
                'Yesterday': ['yesterday', 'yesterday'],
                'Last 7 Days': [Date.today().add({days: -6}), 'today'],
                'Last 30 Days': [Date.today().add({days: -29}), 'today'],
                'This Month': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
                'Last Month': [Date.today().moveToFirstDayOfMonth().add({months: -1}), Date.today().moveToFirstDayOfMonth().add({days: -1})]
            }
        },
        function(start, end) {
//            
            $("#range").val(start+ ' - ' + end);
            $("#raw_range").val(start.toString('MMMM d, yy') + ' - ' + end.toString('MMMM d, yy'));
            exampleAdvancedDateRangeSpan.html(start.toString('MMMM d, yy') + ' - ' + end.toString('MMMM d, yy'));
            $("#filter_form").submit();
        });

        // Set the default content when page loads
        <?php if(isset($this->request->data['Complaint']['raw_date_range']) and $this->request->data['Complaint']['raw_date_range']!=''){
          ?>
        exampleAdvancedDateRangeSpan.html("<?php echo $this->request->data['Complaint']['raw_date_range'];?>");
        <?php }else{ ?>
        exampleAdvancedDateRangeSpan.html(Date.today().toString('MMMM d, yy') + ' - ' + Date.today().toString('MMMM d, yy'));
        <?php } ?>
//        $("#range").change(function(){
//            $("#filter_form").submit();
//        });
};
function subcat_select(){
        $("#filter_form").submit();
}
</script>