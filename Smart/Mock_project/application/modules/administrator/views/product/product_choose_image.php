<?php echo form_open("administrator/products/setMainImage");?>
	<label>Choose main image</label>
    	<?php 
    		foreach ($new_insert_image as $key=>$value){
				echo "<input type='radio' name='main_img' value='".$value['img_id']."' /><img height='50' width='50' src='".base_url($value['img_link'])."'></img><br />";
			}
    	?>
    <br />
    <input type="submit" name="selected_img" value="Go back to List Product" id="i-button"/>
</form>