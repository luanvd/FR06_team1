<meta charset="UTF-8" />
<title>List Users</title>
<script>
    function checkDelete() {
        press = confirm("Bạn có chắc chắn xóa?")
        if(press == true)
            return true;
        else return false;
    }
</script>

<?php 
	$next_order = ($order == 'asc') ? 'desc' : 'asc';
	$current_url = base_url() . 'administrator/users/index/'; 
?>


<div class="insert"><a href="<?php echo base_url();?>administrator/users/insert" class="insert-button"><b>&nbsp;INSERT</b></a></div>

<form action="" method="POST">
    <table class="result-table" border='0'>
    	<tr class="header">
    		<td><b><a href="<?php echo $current_url . $page_number . '/id/' . $next_order; ?>">id</a></b></td>
    		<td><b><a href="<?php echo $current_url . $page_number . '/username/' . $next_order; ?>">Username</a></b></td>
    		<td><b><a href="<?php echo $current_url . $page_number . '/email/' . $next_order; ?>">Email</a></b></td>
    		<td><b><a href="<?php echo $current_url . $page_number . '/address/' . $next_order; ?>">Address</a></b></td>
    		<td><b><a href="<?php echo $current_url . $page_number . '/phone/' . $next_order; ?>">Phone</a></b></td>
    		<td><b><a href="<?php echo $current_url . $page_number . '/gender/' . $next_order; ?>">Gender</a></b></td>
    		<td><b><a href="<?php echo $current_url . $page_number . '/level/' . $next_order; ?>">Level</a></b></td>
    		<td><b>Update</b></td>
    		<td><b>Delete</b></td>
    	</tr>
    	<?php 
    		foreach ($users as $user) {
    			echo "<tr>";
        			echo "<td><center>{$user['id']}</td>";
        			echo "<td><center>{$user['username']}</center></td>";
        			echo "<td><center>{$user['email']}</center></td>";
        			echo "<td><center>{$user['address']}</center></td>";
        			echo "<td><center>{$user['phone']}</center></td>";
        			echo "<td><center>";
        			echo $user['gender'] == 1 ? "Nam" : "Nữ";
        			echo "</center></td>";
        			echo "<td><center>";
        			echo $user['level'] == 1 ? "Admin" : "Normal User";
        			echo "</center></td>";		
        			echo '<td><center><a href="' . base_url(). 'administrator/users/update/' . $user['id'] . '">Update</a></center></td>';
        			echo "<td><center><a href='" . base_url(). 'administrator/users/delete/' . $user['id'] . "' onclick='if(checkDelete() == false) return false' />Delete</a></td>";
    			echo "</tr>";
    		}
    	?>
    </table>
</form>
<div class="pagination">
<?php echo $pages; ?>        
</div>