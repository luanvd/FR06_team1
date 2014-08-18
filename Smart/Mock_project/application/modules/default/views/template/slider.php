<div class="slider">
    <div class="slide-stage">
        <?php
            foreach($img_slider as $value){
                echo "<div class='slide-image'>";
                    echo "<img src='" . base_url() . '/public/images/products/' . $value['img_link'] . "'/>";
                    echo "<div id='pro_info'>";
                        echo "<h1>" . $value['pro_name'] . "</h1><br />";
                        echo $value['pro_desc'];
                        
                    echo "</div>";
                echo "</div>";
            }
        ?>
        
        <div id="promotion">
            <img src="<?php echo base_url() . '/public/images/icon/sale_label.png';?>" style="height: 100px; width: 100px;" />
        </div>
    </div>
    
    <div class='slide-pager'>
        <ul></ul>
        <div class='slide-control-prev'><span class='fa fa-backward'></span></div>
        <div class='slide-control-next'><span class='fa fa-forward'></span></div>
    </div>
</div>

