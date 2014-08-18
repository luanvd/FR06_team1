<div class="banner">
    <div class="page-title">New products</div>
    <ul>
    <?php
        foreach($new_products as $new_pro){
            echo "
            	<li class='box'>                 
            		<img class='ban_label' src='" . base_url() . 'public/images/icon/new.png' . "'/>
            		<div class='ban_holder'>
            			<h2>" . $new_pro['pro_name'] . "</h2>
            			<p>" . $new_pro['pro_desc'] . "</p>
            			<a href='" . base_url() . 'default/product/details/' . $new_pro['pro_id'] . "' class='btn-end-2' >Shop now!</a>
                        <a href='" . base_url() . 'default/product/details/' . $new_pro['pro_id'] . "'><img id='new_pro' src='" . base_url() . 'public/images/products/' . $new_pro['pro_images'] . "' style='max-width: 120px; height: 100px;'/></a>
            		</div>
            	</li>";
        }
    ?>
    </ul>
</div>