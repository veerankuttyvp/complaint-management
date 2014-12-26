<div class="form-group">
<label for="ComplaintCategoryIds" class="col-sm-2 control-label">Centers</label> <div class="col-sm-4"><select class="form-control" id="centers_ids">
<option value="0" >Select a Center</option>
<?php foreach ($centers as $key => $center){ ?>
<option value="<?php echo $key; ?>" ><?php echo $center; ?></option>
<?php } ?>
</select></div></div>

<div id="subcategory_<?php echo $id ?>"></div>

<script>
	
	$(document).ready(function(){
	
	});

</script>