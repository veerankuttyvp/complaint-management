<div class="form-group"  style="float: left;">
    <label for="ComplaintCategoryIds" class="col-sm-9 " style="text-align:left;">Sub Category</label> <div class="col-sm-4"><select name="data[Complaint][category_id]" class="form-control child_categories" id="ComplaintCategoryId_<?php echo $id ?>" >
<option value="0" >Select a Sub Category</option>
<?php foreach ($categories as $key => $category){ ?>
<option value="<?php echo $key; ?>" ><?php echo $category; ?></option>
<?php } ?>
</select></div></div>
<br  style="clear:both;"/>
<div id="subcategory_<?php echo $id ?>" style="float: left;"></div>

<script>
	
	$(document).ready(function(){
		
		$(document).on('change','#ComplaintCategoryId_<?php echo $id ?>',function(){
			
			$('#subcategory_<?php echo $id ?>').html('');
			$('#laoder-gif').show();
			
			$.get(main_path+'complaints/getchildencat_for_cmc/'+$(this).val(),function(data){
				if(data == "fail"){
					$('#ComplaintCategoryId').val($('#ComplaintCategoryId_<?php echo $id ?>').val());
//                                        $("#filter_form").submit();
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

