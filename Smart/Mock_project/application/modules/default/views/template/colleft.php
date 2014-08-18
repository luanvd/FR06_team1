<!--Col-left-->
<div class="colleft">
    <div class="category">
        <div class="title">Categories</div>
        <div class="menu_left" id='menu-left-dropdown'>
            	<?php 
            		echo $category;
            	?>
        </div>
    </div>
    
    <div id="filter">
        <div class="title">Price</div>
        <div class="menu_left">
            <div id="slider">
                <p>
    			  <label for="amount">Price range:</label>
    			  <input type="text" id="amount" readonly style="border:0; color:#ff3333; font-weight:bold;">
    			</p>
    			 
    			<div id="slider-range"></div>
            </div>
        </div>
        
        <div id="brand">
            <div class="title">Brands</div>
            <div class="menu_left">
                <ul>
                	<?php 
                		foreach ($brands as $key=>$value){
    						echo "<li><input type='checkbox' name='brand' brandID='".$value['brand_id']."' class='brands-select' value='".$value['brand_id']."' >".$value['brand_name']."</li>";
    					}
                	?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--End col-left-->