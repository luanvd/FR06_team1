<html>
<head>
	<style type="text/css">
		label{
			width:100px;
			float:left;
		}
		.error{
			color:red;
		}
		td{
			padding:15px;
		}
	</style>
	</head>
<body>

	<h3>Search</h3>
	
	<?php echo form_open('administrator/brand/search'); ?>
	
	<label>Search</label>
	<input type="text" id="search" name="search" placeholder="Search" value="" size="30">	
	<select name="type">
		<option value="0">Search by id</option>
		<option value="1" selected>Search by name</option>
	</select>
	<br>
	
	<input type="submit" name="submit" value="Search" id="button">
	<br>	
	</form>
		
	<?php 
		if (isset($brand)){
			echo "<table border='1' cellpadding='0' cellspacing='0'>";
			echo "<tr>";
			echo "<td>Brand ID</td>";
			echo "<td>Brand Name</td>";
			echo "<td>Delete</td>";
			echo "</tr>";
			foreach ($brand as $key=>$value){
				echo "<tr>";
				echo "<td>".$value['brand_id']."</td>";
				echo "<td>".$value['brand_name']."</td>";
				echo "<td><a href='delete/" . $value['brand_id'] . "'>Delete</a></td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "</div>";
		}
		else if (isset($not_found)){
			echo "<h4>$not_found</h4>";
		}
		else if (isset($no_query)){
			echo "<h4>$no_query</h4>";
		}
	?>
	
</body>
</html>