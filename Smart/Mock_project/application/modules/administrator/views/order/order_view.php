<meta charset="UTF-8" />
<title>List Orders</title>
<script>
    function checkDelete() {
        press = confirm("Bạn có chắc chắn xóa?")
        if(press == true)
            return true;
        else return false;
    }
    function warning() {
        alert("Hóa đơn chưa thanh toán, không thể xóa?");
        return false;
    }
</script>

<!--<?php
    $attributes = array (
		'class' => "",
		'id' => "search-bar" 
    );
    echo form_open('administrator/orders/index', $attributes );
?>
    <input type="text" id="search" name="search" placeholder=" <?php echo isset($no_query) ? $no_query : '--Search--';?>" value="" size="30" />
    <select name="type">
        <option value="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search by Name</option>
    	<option value="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search by Address</option>
        <option value="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search by Date</option>
        
    	<input type="submit" name="submit" value="Search" id="search-button" />
    </select>-->
</form>
<table class="result-table" border='0'>
    <tr class="header">
        <td><center><b>Order id</b></center></td>
        <td><center><b>Name</b></center></td>
        <td><center><b>Date Buy</b></center></td>
        <td><center><b>Date Paid</b></center></td>
        <td><center><b>Status</b></center></td>
        <td><center><b>Detail</b></center></td>
        <td><center><b>Delete</b></center></td>
    </tr>
    <?php
        $stt = 1;
        foreach($info as $value) {
            echo "<tr>";
                echo "<td><center>" . $value['order_id'] . "</center></td>";
                echo "<td>" . $value['name'] . "</td>";
                echo "<td><center>";
                    echo $value['order_status'] == 0 ? $value['order_time'] : "";
                echo "</center></td>";
                echo "<td><center>";
                    echo $value['order_status'] == 1 ? $value['order_time'] : "";
                echo "</center></td>";
                echo "<td><center>";
                    echo $value['order_status'] == 1 ? "paid" : "<span class='error'><i>not paid</i></span>";
                echo "</center></td>";
                echo "<td><center><a href='" . base_url() . 'administrator/orders/detail/' . $value['order_id'] . "'>Detail</a></center></td>";
                echo "<td><center>";
                    if($value['order_status'] == 0){
                        echo "<a href='" . base_url() . 'administrator/orders/delete/' . $value['order_id'] ."' onclick='if(checkDelete() == false) return false '>Delete</a>";
                        //echo "<a href='" . base_url() . 'administrator/orders/delete/' . $value['order_id'] ."' onclick='if(warning() == false) return false '>Delete</a>";
                    }
                    //else{
                          
                    //}
                echo "</center></td>";
            echo "</tr>";
            $stt ++;
        }
    ?>
</table>