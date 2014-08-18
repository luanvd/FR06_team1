<meta charset="UTF-8" />
<title>Order Detail</title>
<script>
    function checkPay() {
        press = confirm("Xác nhận thanh toán?")
        if(press == true)
            return true;
        else return false;
    }
</script>
<fieldset id="info-user">
    <legend><b>Thông tin khách hàng</b></legend>
    <table width='500' class="result-table">
        <?php
            foreach($infoUser as $value) {
                echo "<tr>";
                    echo "<th>Name</th>";
                    echo "<td><center>" . $value['name'] . "</center></td>";
                echo "</tr>";
                
                echo "<tr>";
                    echo "<th>Email</th>";
                    echo "<td><center>" . $value['email'] . "</center></td>";
                echo "</tr>";
                
                echo "<tr>";
                    echo "<th>Address</th>";
                    echo "<td><center>" . $value['address'] . "</center></td>";
                echo "</tr>";
                
                echo "<tr>";
                    echo "<th>Phone</th>";
                    echo "<td><center>" . $value['phone'] . "</center></td>";
                echo "</tr>";
            }
        ?>
    </table>
</fieldset>
<fieldset id="info-pro">
    <legend><b>Chi tiết hóa đơn</b></legend>
    <table class="result-table">
        <tr>
            <td><center><b>STT</b></center></td>
            <td><center><b>Product name</b></center></td>
            <td><center><b>Price (VNĐ)</b></center></td>
            <td><center><b>Quantity</b></center></td>
            <td><center><b>Total</b></center></td>
        </tr>
        
        <?php
            $stt = 1;
            $total = 0;
            foreach($infoDetail as $value) {
                echo "<tr>";
                    echo "<td><center>" . $stt . "</center></td>";
                    echo "<td><center>" . $value['pro_name'] . "</center></td>";
                    echo "<td><center>" . number_format($value['order_price'], 0, "", ".") . "</center></td>";
                    echo "<td><center>" . $value['quantity'] . "</center></td>";
                    echo "<td><center>" . number_format(($price = $value['order_price'] * $value['quantity']), 0, "", ".") . " VNĐ</center></td>";
                    $total += $price;
                echo "</tr>";
                $stt ++;
            }
            
            echo "<tr>";
                echo "<td><center><b>Total Price: </b></center></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td><center>" . number_format($total, 0, "", ".") . " VNĐ</center></td>";
            echo "</tr>";

            if($value['order_status'] == 0) {
                echo "<a href='" . base_url() . 'administrator/orders/pay/' . $value['order_id'] . "' onclick='if(checkPay() == false) return false' ><input type='submit' name='pay' value='PAY' class='insert-button' /></a>";
            }
                
        ?>
    </table>
</fieldset>


