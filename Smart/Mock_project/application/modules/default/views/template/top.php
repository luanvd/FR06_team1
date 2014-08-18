<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8" />
    <script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/jquery.nestable.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/fancybox/source/jquery.fancybox.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/jquery.cslider.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/modernizr.custom.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/details.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/cookies.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/slider.js"></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>public/javascript/jquery.hoverIntent.minified.js'></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/jRating.jquery.js"></script>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/fancybox/source/jquery.fancybox.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/jquery-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.details.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.front-end.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.productAll.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/jRating.jquery.css" media="screen" />      
    
    <title>Group 04 - Furniture</title>
    
</head>

<body>
    <div id="lightbox" style="display: none;">
            <img src="<?php echo base_url();?>/public/images/icon/welcome.png" />
    </div>
    <a href="#lightbox" id="fancyLink"> </a>
    
    <!--Header-->
	<div class="header-container">
		<div class="header-left"><a href="<?php echo base_url();?>default/product/"><img src="<?php echo base_url(); ?>public/images/front-end/logo.gif" alt="" /></a></div>
		<div class="header-center">
			<div class="header_phone fa fa-phone">&nbsp;&nbsp;Call us now toll free: (+84) 12345-6789</div>
			<ul class="link">
				<li class="fa fa-home">&nbsp;<a href="<?php echo base_url() . 'default/product/' ?>">Home</a></li>
                
				<li>
                    <a href="<?php echo base_url(); ?>default/product/cart" class="tooltip fa fa-shopping-cart">&nbsp;My Cart(<?php echo $this->cart->total_items()?>)
                        <span>
                            <table border="1px" id="tbl_cart">
                                <tr>
                                    <td><b><center>Name</center></b></td>
                                    <td><b><center>Price</center></b></td>
                                </tr>
                                <?php $data = $this->cart->contents();
                                    $total_price=0;
                                    foreach ($data as $key => $value) {
                                        echo "<tr>"; 
                                        echo "<td><center>".$value['name']."</center></td>";
                                        echo "<td><center>".number_format($value['price'])." VND</center></td>"; 
                                        echo "</tr>";
                                        $total_price+=$value['price']*$value['qty'];
                                    }
                                ?>
                                <tr>
                                    <td><b> Total price</b></td>
                                    <td><center><b><?php echo number_format($total_price, "0", "", ".")." VND";?></b></center></td>
                                </tr>
                            </table>
                        </span>
                    </a>
                </li>
                <li><a href="<?php echo base_url() . 'default/product/contact' ?>">Contact us</a></li>
			</ul>
		</div>
		<div class="header-right">
            <a href="https://plus.google.com/" class="fa fa-google-plus" style="font-size: 20px;" target="_blank"></a>
            &nbsp;<a href="https://facebook.com/" class="fa fa-facebook" style="font-size: 20px;" target="_blank"></a>
            &nbsp;<a href="https://twitter.com/" class="fa fa-twitter" style="font-size: 20px;" target="_blank"></a>
            &nbsp;<a href="https://hn.24h.com.vn/" class="fa fa-rss-square" style="font-size: 20px;" target="_blank"></a>
		</div>
	</div>
    <!--End header-->
    
    
    <!--Main content-->
    <div>