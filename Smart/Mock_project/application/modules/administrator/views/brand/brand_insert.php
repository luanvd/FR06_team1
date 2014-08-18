<meta charset="UTF-8" />
<title>Insert Brands</title>

<form action="" method="post">
	<label><b>Brand name</b></label>
	<input type="text" name="brand_name" value="" placeholder="..................Enter brand name................." size="30" />
	<span class="error"><i><?php echo form_error("brand_name"); ?></i></span>
	<br /><br />
    
	<div><input type="submit" name="insert" value="Insert" class="insert-cancel" />&nbsp;<input type="submit" name="cancel" value="Cancel" class="insert-cancel" /></div>
</form>