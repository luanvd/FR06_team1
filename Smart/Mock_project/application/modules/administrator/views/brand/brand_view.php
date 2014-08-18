<meta charset="UTF-8" />
<title>List Brands</title>
<script>
    function checkDelete() {
        press = confirm("Bạn có chắc chắn xóa?")
        if(press == true)
            return true;
        else return false;
    }
</script>

<div class="insert"><a href="<?php echo base_url();?>administrator/brands/insert" class="insert-button"><b>&nbsp;INSERT</b></a></div>
<?php

    $attributes = array (
		'class' => "",
		'id' => "search-bar" 
    );
    echo form_open('administrator/brands/index', $attributes );
?>
    <input type="text" id="search" name="search" placeholder=" <?php echo isset($no_query) ? $no_query : '............................Search...........................';?>" value="" size="30" />
    <select name="type">
        <option value="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search by name</option>
    	<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search by id</option>
    	<input type="submit" name="submit" value="Search" id="search-button" />
    </select>
</form>

<?php
if(isset($not_found)){
    echo "<p>" . $not_found . "</p>";
} else {
    $next_order = ($order == 'asc') ? 'desc' : 'asc';
	$current_url = base_url() . 'administrator/brands/index/'; 

?>
<table class="result-table" border='0'>
	<tr class="header">
		<td><b><center><a href="<?php echo $current_url . $page_number . '/brand_id/' . $next_order;?>">Brand id</a></center></b></td>
        <td><b><center><a href="<?php echo $current_url . $page_number . '/brand_name/' . $next_order;?>">Brand Name</a></center></b></td>
        <td><b><center>Edit</center></b></td>
        <td><b><center>Delete</center></b></td>

	</tr>
	<?php
		foreach($brandList as $value) {
            echo "<tr>";
                echo "<td><center>" . $value['brand_id'] . "</center></td>";
                echo "<td><center>" . $value['brand_name'] . "</center></td>";
                echo "<td><center><a href='". base_url() . "administrator/brands/update/". $value['brand_id'] ."'>Update</a></center></td>";
                echo "<td><center><a href='". base_url() . "administrator/brands/delete/". $value['brand_id'] ."' onclick='if(checkDelete() == false) return false'>Delete</a></center></td>";
            echo "</tr>";
        }
	?>
</table>
		
<div class="pagination">
<?php 
echo $pages;
} 
?>        
</div>
