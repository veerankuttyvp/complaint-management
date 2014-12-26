<!-- Breadcrumb -->
    <?php
      $this->Html->addCrumb('<i class="gi gi-display"></i>&nbsp;','/',array('escape'=>false));
      $this->Html->addCrumb("Complaints",'/complaints');
      $this->Html->addCrumb("Subdivision",'javascript:void(0)');
    ?>
<!-- END Breadcrumb -->
<div class="row">

<div class="col-sm-12 col-xs-5" style="padding:0px;margin-top:10px;">
	<div class="col-sm-6 text-center">
	   <?php 
	   echo $this->Form->create("Complaint",array("class"=>"form-inline")); 
	    echo $this->Form->input("complaint_status_id",array("options"=>$status,"empty"=>'Select a Status','required'=>true,'style'=>'padding: 9px 10px;','class'=>'col-sm-7',"label"=>array("text"=>"Filter By Complaint Status",'class'=>'col-sm-5','style'=>'padding: 9px;')));
		?>
		</form>
	</div>
</div>

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