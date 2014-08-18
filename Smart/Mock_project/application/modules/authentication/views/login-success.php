<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.header.css" />
</head>
<body>
	<?php 
		if ($this->session->userdata('logged_in')){
			$username = $this->session->userdata('logged_in');
		}
		else {
			redirect(base_url("index.php/authentication/login"),"refresh");
		}
	?>
	<div id="main">
		<div id="top">
			<div id="header">
				<div id="logo"><a href="">Admin</a></div>
				<div id="right-nav">
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
					<li><a href="">User</a></li>
					<li><a href="">Product</a></li>
					<li><a href="">Brand</a></li>
					<li><a href="">Category</a></li>
				</ul>
			</div>
			
			<div id="main-content">
				<!-- code here -->
									
				<?php 
					$attributes = array('class' => "" , 'id' => "search-bar");
					echo form_open('administrator/brand/search',$attributes); 
				?>

					<input type="text" id="search" name="search" placeholder="Search" value="" size="30">	
					<select name="type">
						<option value="0">Search by id</option>
						<option value="1" selected>Search by name</option>
					</select>
					<input type="submit" name="submit" value="Search" id="button">
					<br>	
				</form>	
				
				<table class="result-table">
					<tr class="header">
						<td>Cell1</td>
						<td>Cell2</td>
						<td>Cell3</td>
						<td>Cell4</td>
						<td>Cell5</td>
					</tr>
					<tr>
						<td>Cell1asdfasdfsadfasdf</td>
						<td>Cell2asdfasdfasd</td>
						<td>Cell3</td>
						<td>Cell4fsadfsadf</td>
						<td>Cellasdfsadfasdf5</td>
					</tr>
				</table>
				
			</div>
		</div>
	</div>
</body>
</html>
