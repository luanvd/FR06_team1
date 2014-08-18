<title>Report categories</title>

<?php 
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $current_date = date('Y/m/d', time());
 ?>			

<div id="center">
    <div class="insert">
        <a href="<?php echo base_url();?>administrator/report/product" class="insert-button"><b>&nbsp;&nbsp;Products&nbsp;&nbsp;</b></a><br />
        <a href="<?php echo base_url();?>administrator/report/category" class="insert-button"><b>Categories</b></a>
    </div>
	<form action="" method="post">
		<label for="fromDate">From: </label>
		<input type="text" readonly class= "datepicker" id="fromDate" name="fromDate" value="<?php echo $this->session->userdata('fromDate') ? $this->session->userdata('fromDate') : $current_date ?>" />
        <br />
        
		<label for="toDate">To: </label>
		<input type="text" readonly class= "datepicker" id="toDate" name="toDate" value="<?php echo $this->session->userdata('toDate') ? $this->session->userdata('toDate') : $current_date ?>" />
        <br />
        
		<input type="submit" name="submit" value="Report" class="insert-cancel"/>
	</form>
				
<script src="<?php echo base_url(); ?>public/javascript/jquery.js"></script>
<script src="<?php echo base_url(); ?>public/javascript/jquery-ui.js"></script>
<script>
	$(function() {

	    $( ".datepicker" ).datepicker({
	    	dateFormat: "yy-mm-dd"
	    });

	});
</script>


<!-- in ket qua -->
<br />
<?php 
if(isset($not_found) && $not_found == false) {
	$thu_tu = $this->session->userdata("thu_tu") ? $this->session->userdata("thu_tu") : 0;
?>

<table class="result-table">
	<tr class="header">
		<td>Order</td>
		<td>Id</td>
		<td>Category name</td>
		<td>Number of Purchase</td>
	</tr>

<?php
	foreach ($cates as $cate) {
		$thu_tu++;
		echo "<tr>";
		echo "<td><center>{$thu_tu}</center></td>";
		echo "<td><center>{$cate['cate_id']}</center></td>";
		echo "<td>{$cate['cate_name']}</td>";
		echo "<td><center>{$cate['count']}</center></td>";
		echo "</tr>";		
	}
 ?>
 </table>
<br/>
 <div class="pagination"><?php echo isset($pages) ? $pages : ""; ?></div>
			</div> <!-- end div #center-->
		</div>
	</div>
</div>


<?php 
} else {
	if(isset($press_report) && $press_report == true){
		echo "<br /><br />";
		echo "<p style='margin-left: 200px;'><i>Không có sản phẩm nào được bán trong khoảng thời gian này !</i></p>";
	}
}
?>