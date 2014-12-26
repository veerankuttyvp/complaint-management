<div class="form-group">
<label for="ComplaintCategoryIds" class="col-sm-2 control-label">Sub Category</label> <div class="col-sm-10"><select name="data[Complaint][subcategory]" class="form-control" required="required" id="ComplaintCategoryId_<?php echo $id ?>">
<option value="" >Select a Sub Category</option>
<?php foreach ($categories as $key => $category){ ?>
<option value="<?php echo $key; ?>" ><?php echo $category; ?></option>
<?php } ?>
</select></div></div>

<div id="subcategory_<?php echo $id ?>"></div>

<script>
	
	$(document).ready(function(){
	
		$(document).on('change','#ComplaintCategoryId_<?php echo $id ?>',function(){
			
			$('#subcategory_<?php echo $id ?>').html('');
			$('#laoder-gif').show();
			
			$.get(main_path+'complaints/getchildencat/'+$(this).val(),function(data){
				if(data == "fail"){
					$('#ComplaintCategoryId').val($('#ComplaintCategoryId_<?php echo $id ?>').val());
				} else {
					html = data;
					$('#subcategory_<?php echo $id ?>').html(html);
					$('#subcategory_<?php echo $id ?> select').focus();
					
				}
				$('#laoder-gif').hide();
				
			});
			
		});
	
	});

</script>

