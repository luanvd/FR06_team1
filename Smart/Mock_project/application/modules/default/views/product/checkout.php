

<form action="" method="post">

   	<label><b>Username</b></label>
   	<input type="text" name="name" value="" placeholder=".................Enter your name................" size="30" />
    <span class="error"><i><?php echo form_error("name"); ?></i></span>
    <br />
    
   	<label><b>Email</b></label>
    <input type="text" name="email" value="" placeholder=".................Enter your email................." size="30" />
    <span class="error"><i><?php echo form_error("email"); ?></i></span>
    <br />
    
   	<label><b>Address</b></label>
    <input type="text" name="address" value="" placeholder=".................Enter your address................." size="30" />
    <span class="error"><i><?php echo form_error("address"); ?></i></span>
    <br />
    
   	<label><b>Phone</b></label>
    <input type="text" name="phone" value="" placeholder=".................Enter your phone number................." size="30" />
    <span class="error"><i><?php echo form_error("phone"); ?></span></i>
    <br />  
    <input type="submit" name="checkout" value="checkout" class="btn-cart" />
    <input type="submit" name="cancel" value="Cancel" class="btn-cart" />                                
</form>

<table border="0" class="shopping_cart">
		<tr class="tr-cart-first">
			<th></th>
			<th>Product Name</th>
			<th>Unit price</th>
			<th width="100px">Quantity</th>
			<th>Subtotal</th>
		</tr>
		<?php
			$total_price=0;
			foreach ($products as $value) {
			  	echo "<tr>
						<td><img src='".base_url()."public/images/products/".$value['option']['pro_images']."' width='100px' height='100px'></td>
						<td><a href='#'>".$value['name']."</a></td>
						<td>".number_format($value['price'],"0","",".")." VND </td>
						<td>".$value['qty']."</td>
						<td>".number_format($value['subtotal'])." VND</td>
						<input type='hidden' name='idCart' value='".$value['rowid']."'>				
					</tr>";
			$total_price+=$value['price']*$value['qty'];
			}
		?>
		
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th>Total price</th>
			<td><?php echo number_format($total_price,"0","",".")."VND";?></td>
		</tr>
</table>
</div>