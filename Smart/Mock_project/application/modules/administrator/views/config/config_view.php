<title>Config items</title>
<form action="" method="post">
	<label>Number item of page</label>
	<input type="text" name="number_page" value="<?php echo $number_page['number_page']; ?>"/>
	<?php echo form_error("number_page"); ?>  
	<br/>
	
    
    <div >
        <input type="submit" name="update" value="Update" class="insert-cancel" />
        &nbsp;<input type="submit" name="cancel" value="Cancel" class="insert-cancel" />
    </div>
</form>
