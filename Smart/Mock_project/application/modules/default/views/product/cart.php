<?php
    if(isset($notice)){
        echo $notice;
    }
?>
<script>
    function check(){
        alert("Bạn chưa mua sản phẩm nào !");
        return false;
    }
    
    function checkDelete() {
        press = confirm("Bạn có thực sự muốn xóa ?")
        if(press == true)
            return true;
        else return false;
    }
</script>

<form action='' method='post'>
	<table border="0" class="shopping_cart">
		<tr class="tr-cart-first">
			<th></th>
			<th>Product Name</th>
			<th>Unit price</th>
			<th width="100px">Quantity</th>
			<th>Subtotal</th>
			<th>Delete</th>
		</tr>
		<?php
            $total_product = $this->cart->total_items();
			$total_price=0;
            
            if(isset($products) && count($products) > 0){
    			foreach ($products as $value) {
    			  	echo "<tr>
    						<td><img src='".base_url()."public/images/products/".$value['option']['pro_images']."' width='100px' height='100px'></td>
    						<td><a href='" . base_url() . 'default/product/details/' . $value['id'] . "'>".$value['name']."</a></td>
    						<td>".number_format($value['price'],"0","",".")." VND </td>
    						<td><center><input type='text'name='quantity[]' value=".$value['qty']." width='50'></center></td>
    						<td>".number_format($value['subtotal'])." VND</td>
    						<input type='hidden' name='idCart' value='".$value['rowid']."'>
    			
    						<td><a href='".base_url()."default/product/delete/".$value['id']."' onclick='if(checkDelete() == false) return false'>Delete</a></td>
    				
    					</tr>";
    			$total_price+=$value['price']*$value['qty'];
    			}
            }
            else {
                echo "<tr>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td><b>No item in cart !</b></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                echo "</tr>";
            }
		?>
		
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th>Total price</th>
			<td><?php echo number_format($total_price,"0","",".")."VND";?></td>
			<th></th>
		</tr>
		
	</table>
    <div class="end_table">
		<a href=" <?php echo base_url();?>default/product/index" class="btn-end-2">Continue Shopping</a>
		<input type="submit" name="update-cart" value="Update Cart" class="btn-cart"/>
		<a href="<?php echo base_url();?>default/product/deleteAll" class="btn-end-2" onclick='if(checkDelete() == false) return false'>Clear Cart</a>
	</div>
    
    <div class="end_table">
        <a class="btn-checkout" <?php if($total_product == 0){ echo "onclick='if(check() == false) return false'";} ?>href='<?php echo base_url();?>default/product/checkout' >Check-out</a>
    </div>

</form>

</div>
