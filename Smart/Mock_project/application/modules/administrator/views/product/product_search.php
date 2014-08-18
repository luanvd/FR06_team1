<title>Advanced Search</title>
<script>
    function checkDelete() {
        press = confirm("Bạn có chắc chắn xóa?")
        if(press == true)
            return true;
        else return false;
    }
</script>
<div class="insert"><a href="<?php echo base_url();?>administrator/products/insert" class="insert-button"><b>&nbsp;INSERT</b></a></div>

<form action="" method="post">
	<label for="txtName">Product name: </label>
	<input type="text" name="txtName" id="txtName" value="<?php echo $this->session->userdata("srch_name") ? $this->session->userdata("srch_name") : "" ?>" />
	<br>
	<label for="txtBrand">Brand name: </label>
	<input type="text" name="txtBrand" id="txtBrand" value="<?php echo $this->session->userdata("srch_brand") ? $this->session->userdata("srch_brand") : "" ?>" />
	<br>
	<label for="txtCountry">Country name: </label>
	<input type="text" name="txtCountry" id="txtCountry" value="<?php echo $this->session->userdata("srch_country") ? $this->session->userdata("srch_country") : "" ?>" />
	<br>
	<p>
	  <label>List price range: </label>
	  <span id="amount"></span>
	  <input type="hidden" readonly name="prcMin" id="prcMin">
	  <input type="hidden" readonly name="prcMax" id="prcMax">
	</p>
	<br>
	<div id="slider-range"></div>
	<br>			
    <input id="search-button" type="submit" name="btnSearch" value="Search" /> 				
</form>

<script>
$(function() {
	$("#slider-range").slider({
		range: true,
		min: 0,
		max: <?php echo isset($max_price) ? $max_price : "20000000"?>,
		step: 500000,
		//values: [0, 9000000],
		values: [<?php echo $this->session->userdata("srch_prcMin") ? $this->session->userdata("srch_prcMin") : "0" ?>, 
				 <?php echo $this->session->userdata("srch_prcMax") ? $this->session->userdata("srch_prcMax") : "10000000" ?>],
		slide: function(event, ui) {
			console.log(ui.values[0]);
			console.log(ui.values[1]);
			$("#amount").html(ui.values[0] + " VND - " + ui.values[1] + " VND");
			$("#prcMin").val(ui.values[0]);
			$("#prcMax").val(ui.values[1]);
		}
		
	});


	$("#amount").html( $("#slider-range").slider("values", 0) + " VND - " + $('#slider-range').slider("values", 1) + " VND");
	$("#prcMin").val($("#slider-range").slider("values", 0));
	$("#prcMax").val($("#slider-range").slider("values", 1));

});
</script>

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