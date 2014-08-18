<meta charset="UTF-8" />
<title>Insert Products</title>
<?php echo form_open_multipart('administrator/products/insert');?>
   	<label>Product name</label>
   	<input type="text" name="pro_name" value="" placeholder="Product name" size="30" /><br />
    <?php echo form_error("pro_name"); ?>
    <br />
    
    <label>Product list price</label>
   	<input type="text" name="pro_list_price" value="" placeholder="Product list price" size="30" /><br />
    <?php echo form_error("pro_list_price"); ?>
    <br />
    
   	<label>Product sale price</label>
    <input type="text" name="pro_sale_price" value="" placeholder="Product sale price" size="30" /><br />
    <?php echo form_error("pro_sale_price"); ?>
    <br />
    
   	<label>Product description</label>
    <input type="text" name="pro_desc" value="" placeholder="Product description" size="30" /><br />
    <?php echo form_error("pro_desc"); ?>
    <br />
    
   	<label>Product Origin</label>
    <input type="text" name="pro_country" value="" placeholder="Product Origin" size="30" /><br />
    <?php echo form_error("pro_country"); ?>
    <br />  
    
    <label>Product brand</label>
    <select name="pro_brand">
    	<?php 
    		foreach ($brands as $key=>$value){
				echo "<option value='".$value['brand_id']."'>".$value['brand_name']."</option>";
			}
    	?>
    </select>
    <br />
    
    <label>Feature</label>
    Yes&nbsp;<input type="radio" name="feature" value="1"  />
    No&nbsp;<input type="radio" name="feature" value="0"  /><br />
    <?php echo form_error("feature"); ?>  
    <br />
    
    <label>Product category</label><br />
    	<?php 
    		foreach ($category as $key=>$value){
				echo "<input type='checkbox' name='pro_cate[]' value='".$value['cate_id']."' />".$value['cate_name']."<br />";
			}
    	?>
    <br />
    
    <label>Product images</label>
    <input type="file" name="images" multiple="10" />
    <br />
        
    <label>Product images Thumb</label>
    <input type='file' name='imgs[]' value='' multiple>
    <div>

    <input type="submit" name="insert" value="Insert" class="insert-cancel" /><input type="submit" name="cancel" value="Cancel" class="insert-cancel" />
    </div>                                
</form>
