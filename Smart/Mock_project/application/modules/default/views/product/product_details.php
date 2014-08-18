
    <script type="text/javascript">
        $(function(){
        
            $("#star-rating").jRating({
            rateMax : 100,
            onClick : function(element, rate){
                $('#rating').val(rate);
            }
            });
               
            $(".rate").jRating({
            rateMax : 100,
            isDisabled : true
            });           
        });
    </script>
    
    <?php
        $i = 2;
        if(isset($product)) {
        	echo "<div id='wrapper'>
        		<div id='body'>
        			<div id='bigPic'>
        				<img src='" . base_url() . 'public/images/products/' . $product[0]['pro_images'] . "' style='width: 200px; height: 200px;' />";
                        
                        foreach($product as $value){
                            if(isset($value['img_link'])){
                                echo "<img src='" . base_url() . 'public/images/products/' . $value['img_link'] . "' style='width: 200px; height: 200px;' />";
                            }
        			     }
                    echo "</div>
                    
        			<ul id='thumbs'>
        				<li class='active' rel='1'><img src='" . base_url() . 'public/images/thumb/' . $product[0]['pro_images'] . "'/></li>";
        				
                        foreach($product as $value){
                            if(isset($value['img_link'])){
                                echo "<li rel='$i'><img src='" . base_url() . 'public/images/thumb/' . $value['img_link'] . "'/></li>";
                                $i++;
                            }
                        }
                    echo "</ul>
        		</div>
        		<div class='clearfix'></div>
        	</div>";
        }
        else echo "not found !";
     ?>
    
    <div id="content">
        <h1 style="text-align: center; text-height: 32px;"><?php echo $value['pro_name'] ?></h1>
        <h2 style="color: #ff3333; text-align: center;"><b><?php echo number_format($value['pro_list_price'], "0", "", ".") ?> VNĐ</b></h2>
        <p style="text-align: center;">(included 10% VAT)</p>
        
        <div class="rate" data-average="<?php echo isset($avg_rate) ? $avg_rate : 0;?>" data-id="1"></div><br />
        <?php echo isset($avg_rate) ? ceil($avg_rate) : 0;?>/100
        <span><i>(<?php echo isset($count_rate) ? $count_rate : 0 ?> lượt đánh giá)</i></span>
        <br/>        
        <br />
        - Availability: <span style="color: blue;">In stock</span><br />
        - Get promotion about <b style="color: #ff3333;">30.000.000₫</b>.<br />
        - Warranty about 12 months.
        
        <form action='' method='POST'>
            <input type='hidden' value="<?php echo $value['pro_id'];?>" name='pro_id'/>
            <input type='hidden' value='1' name='qty'/>
            <input type='hidden' value="<?php echo $value['pro_list_price'];?>" name='pro_price'/>
            <input type='hidden' value="<?php echo $value['pro_name'];?>" name='pro_name'/>
            <input type='hidden' value="<?php echo $value['pro_images'];?>" name='pro_images'/>
            <input type='submit' name='addCart' value='Add to Cart' class='btn-cart' />
        </form>
    </div>

	<div id="detail">
        <table border='1' class="detail_table">
            <tr>
                <td style="width: 80px; text-align: center;"><b>Made by</b></td>
                <td style="color: blue;"><?php echo $value['pro_country'] ?></td>
            </tr>
                        
            <tr>
                <td style="width: 80px; text-align: center;"><b>Model</b></td>
                <td style="color: blue;"><?php echo $value['brand_name'] ?></td>
            </tr>
            
            <tr>
                <td style="width: 80px; text-align: center;"><b>Description</b></td>
                <td><?php echo $value['pro_desc'] ?></td>
            </tr>
            
        </table>
        <br /><br />
    </div>
    
    <div id="comment">
        Please leave your comment or question about product &nbsp;<b style="font-size: 20px;"><?php echo $value['pro_name'] ?></b><br /><br />

        <!-- feedback -->
        
        <form action="" method="POST">
            <label><b>Name</b></label>
            <input type="text" name="name" placeholder="please enter name.." value="<?php echo isset($name)? $name : ""; ?>" />
            <?php echo form_error("name"); ?>
            <br />
            
            <label><b>Email</b></label>
            <input type="text" name="email" placeholder="please enter email.." value="<?php echo isset($email) ? $email : ""; ?>"/>
            <?php echo form_error("email"); ?>
            <br />
        
            <label for="rating"><b>Rating</b></label>  
            <input type="hidden" name="rating" id="rating" value="" />
            <div id="star-rating" data-average="<?php echo isset($rating) ? $rating : "100"; ?>" data-id="1" style="margin-top: 10px; color: #e6edf7;"></div>
            <br />
            
            <label><b>Title</b></label>
            <input type="text" name="title" placeholder="please enter title.." value="<?php echo isset($title) ? $title : ""; ?>"/>
            <?php echo form_error("title"); ?>
            <br />
            
            <div id="post_cmt">
                <div class="avatar"><img src="<?php echo base_url(); ?>public/images/icon/noname.jpg" style="width: 50px; height: 50px;" /></div>
                <div id="cmt">
                    <textarea class="boxcmt" placeholder="comment here.." name="content"><?php echo isset($content) ? $content : ""; ?></textarea>
                    <br />
                    <?php echo form_error("content"); ?>
                </div>
                <span><a href="">Log in</a> to get points</span><input type="submit" name="submit" value="Send" id="send" />
            </div>
        </form>
                
        <?php if(isset($feedback) && count($feedback) > 0) {  ?>
        
        <div id="display">
            <hr />
            Other comment..
        <?php foreach($feedback as $content) {?>
            <div class="display_cmt">
                <div class="avatar"><img src="<?php echo base_url(); ?>public/images/icon/noname.jpg" style="width: 50px; height: 50px;" /></div>
                <div class="comment_content">
                    <div class="name"><b style="color: blue;"><?php echo $content['feed_name']; ?></b> : <?php echo $content['feed_title']; ?></div>
                    <div class="rate" data-average="<?php echo $content['feed_rate'];?>" data-id="1" style="margin-top: 10px; background: #e6edf7;"></div><br />
                    <div class="vote"><?php echo $content['feed_rate'] . "/100"; ?></div>
                    <div class="time"><?php echo $content['feed_time']; ?></div>
                    <div class="content_cmt"><?php echo $content['feed_content'];?></div>
                    <div><span class="fa fa-thumbs-o-up"></span>&nbsp;&nbsp;&nbsp;<span class="fa fa-thumbs-o-down"></span></div>
                </div>
            </div>
            
        <?php } } else { echo "<br>No comment.. Let the first person comment for this product !";} ?>    
        </div>
    </div>
            


            
</div>