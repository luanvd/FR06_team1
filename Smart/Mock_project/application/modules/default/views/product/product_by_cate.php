    <div class="main_content">
    	<?php
    		if(!isset($products) || count($products) <= 0) {
    			echo "Không tồn tại category này";
    		} else{
    		foreach ($products as $key => $product) {

	    		echo "<li class='list_products'>                    
	 			        <div class='products-grid-row'>
	    				    <div class='grid_wrapper'>
	    					   <a href=''><img src='".base_url()."/public/images/products/".$product['pro_images']."' class='product-image' /></a>
	    				    </div>
	                        
	    				    <div class='product-shop'>
	    					   <h3 class='product-name'>
	                                <a href=''>".$product['pro_name']."</a>
	    					   </h3>
	    					   <div class='desc-grid'>".$product['pro_desc']."</div>
	    					   <div class='price-box'>
	                                <span class='price'>".number_format($product['pro_list_price'],0,".",".")." VNĐ</span>
	    							
						       </div>
	                           
	    					   <div class='actions'>
	                                <button type='button' class='btn-cart'>
	    							<span> Add to Cart</span>
	                                </button>
	                                <button class='btn-details'>
	    							<span><a href='" . base_url() . 'default/product/details/' . $product['pro_id'] . "'>Details</a></span>
	                                </button>
	    					   </div>
	    					
	    				    </div>
	    			     </div>
	    		      </li>";
	    	   }
	    
	    	echo "<div class='pagination'>".$pages."</div>";
	    	echo "<br/>";
    		}
        ?>
    </div>
</div>