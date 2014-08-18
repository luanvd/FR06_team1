<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/jquery.nestable.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/js.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/cookies.js"></script>
     <script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
    
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/fancybox/source/jquery.fancybox.css" />	
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.header.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.list.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css"/>    
</head>
<body>
    <div id="welcome" style="display: none;">
        <h2>Welcome admin page !</h2>
    </div>
    <a href="#welcome" id="fancyLink"></a>
    
	<?php 
		if ($this->session->userdata('logged_in')){
			$username = $this->session->userdata('logged_in');
		}
		else {
			redirect(base_url("authentication/login"),"refresh");
		}
	?>
	<div id="main">
		<div id="top">
			<div id="header">
				<div id="logo"><a href="<?php echo base_url()?>administrator/users">Admin</a></div>
				
				<div id="right-nav">
					<div id="title-nav">
						<h2><?php echo $title; ?></h2>
					</div>
					<ul id="right-ctrl">
						<li id="welcome-mess"><?php echo "<p>Welcome, $username</p>"; ?></li>
						<li id="logout"><?php echo anchor("authentication/login/logout","Logout");?></li>
					</ul>
				</div>
			</div>
		</div>
		
		<div id="content">
			<div id="left-nav-container">
				<ul id="left-nav">
					<li><a href="<?php echo base_url()?>administrator/users">Users</a></li>
					<li><a href="<?php echo base_url()?>administrator/products">Products</a></li>
					<li><a href="<?php echo base_url()?>administrator/brands">Brands</a></li>
					<li><a href="<?php echo base_url()?>administrator/category">Categories</a></li>
                    <li><a href="<?php echo base_url()?>administrator/orders">Orders manager</a></li>
                    <li><a href="<?php echo base_url()?>administrator/slider">Slider manager</a></li>
                    <li><a href="<?php echo base_url()?>administrator/config">Config items</a></li>
                    <li><a href="<?php echo base_url()?>administrator/report/product">Reports</a></li>
				</ul>
			</div>
			
			<div id="main-content">
				<!-- code here -->
