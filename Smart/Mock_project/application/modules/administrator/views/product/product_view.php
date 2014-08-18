<title>List Products</title>
<script>
    function checkDelete() {
        press = confirm("Bạn có chắc chắn xóa?")
        if(press == true)
            return true;
        else return false;
    }
</script>
<div class="insert"><a href="<?php echo base_url();?>administrator/products/insert" class="insert-button"><b>&nbsp;INSERT</b></a></div>

<form action="" method="post" id="search-bar">
    <input type="text" name="txtKeyword" id="txtKeyword" value="<?php echo $this->session->userdata("pro_keyword") ? $this->session->userdata("pro_keyword") : "" ?>" placeholder="...........................Search..........................." />
	<select name="selField" id="selField">
		<option value="pro_name" <?php echo ($this->session->userdata("pro_field") && $this->session->userdata("pro_field") == "pro_name") ? "selected" : "" ?>>&nbsp;&nbsp;Search by name</option>
		<option value="pro_id"<?php echo ($this->session->userdata("pro_field") && $this->session->userdata("pro_field") == "pro_id") ? "selected" : "" ?>>&nbsp;&nbsp;Search by id</option>				
		<option value="brand" <?php echo ($this->session->userdata("pro_field") && $this->session->userdata("pro_field") == "brand") ? "selected" : "" ?>>&nbsp;&nbsp;Search by brand</option>
		<option value="pro_country" <?php echo ($this->session->userdata("pro_field") && $this->session->userdata("pro_field") == "pro_country") ? "selected" : "" ?>>&nbsp;&nbsp;Search by country</option>
	</select>
	
    <input id="search-button" type="submit" name="btnSearch" value="Search" /> 				
</form>
<span><a href="<?php echo base_url();?>administrator/products/search" class="insert-button"><b>&nbsp;Advanced search</b></a></span>

<!-- In ket qua -->

<table class="result-table" border='0'>
	<tr class="header">
		<td><center>Id</center></td>
		<td><center>Slider</center></td>
        <td><center>Product image</center></td>
		<td><center>Product name</center></td>
		<td><center>Product list price</center></td>
		<td><center>Product sale price</center></td>
		<td><center>Product description</center></td>
		<td><center>Product origin</center></td>
		<td><center>Product brand</center></td>
		<td><center>Feature</center></td>
		<td><center>Update</center></td>
		<td><center>Delete</center></td>
	</tr>

<?php 
$folder = "public/images/products/";

    if(isset($products) && count($products) > 0){
        
    	foreach ($products as $product) {
    		$feature = $product['feature']==1?'YES':'NO';
    		echo "<tr>";
    		echo "<td><center>{$product['pro_id']}</center></td>";
    		
    		echo "<td><center><input type='checkbox'";
    		
    		foreach ($order as $key=>$value){
    			if ($product['pro_id'] == $value['pro_id']){
    				echo "checked='checked'";
    				echo " order='".$value['img_order']."' ";
    				break;
    			}
    		}
    		echo " img='".$product['pro_images']."' pro='".$product['pro_id']."' proname='".$product['pro_name']."' ";
    		echo "class='slider-select' name='slider' value='".$product['pro_id']."'>";
    		
    		echo "<td><center><img alt='IMAGE' src='";
    		echo $product['pro_images'] && isset($product['pro_images']) ? base_url($folder.$product['pro_images']) : '';
    		echo "' height='50' width='50'></center></td>";
            
    		echo "<td><center>{$product['pro_name']}</center></td>";
    		echo "<td><center>" . number_format($product['pro_list_price'], "0", "", ".") . "</center></td>";
    		echo "<td><center>" . number_format($product['pro_sale_price'], "0", "", ".") . "</center></td>";
    		echo "<td><center>{$product['pro_desc']}</center></td>";
    		echo "<td><center>{$product['pro_country']}</center></td>";
    		echo "<td><center>{$product['brand_name']}</center></td>";
    		echo "<td><center>{$feature}</td>";
    		echo "<td><center><a href='" . base_url() . 'administrator/products/update/' . $product['pro_id']. "'>Update</a></center></td>";
    		echo "<td><center><a href='" . base_url() . 'administrator/products/delete/' . $product['pro_id'] . "' onclick='if(checkDelete() == false) return false'>Delete</a></center></td>";
    		echo "</tr>";
    	}
    }
?>				
</table>
<div class="pagination"><?php echo $pages; ?></div>