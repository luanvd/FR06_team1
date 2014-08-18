<meta charset="UTF-8" />
<title>List Categories</title>
<script>
    function checkDelete() {
        press = confirm("Bạn có chắc chắn xóa?")
        if(press == true)
            return true;
        else return false;
    }
</script>

<div class="insert"><a href="<?php echo base_url();?>administrator/category/insert" class="insert-button"><b>&nbsp;INSERT</b></a><br />
<a href="<?php echo base_url();?>administrator/category/move" class="insert-button"><b>&nbsp;&nbsp;MOVE&nbsp;</b></a></div>
<?php
    echo "<table class='result-table'>";
        echo "<tr class='header'>";
            echo "<td><center><a href=''><b>LIST CATEGORIES</b></a></center></td>";
        echo "</tr>";
        
        echo "<tr>";
          echo "<td>";
              echo $info;
          echo "</td>";
        echo "</tr>";
    echo "</table>";
?> 