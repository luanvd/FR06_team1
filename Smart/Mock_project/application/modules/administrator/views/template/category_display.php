<h1>List Category</h1>
<script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/jquery.nestable.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/javascript/js.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.header.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.list.css" />

<style>
    a{
        text-decoration: none;
        color: blue;
    }
    a:hover{
        color: red;
    }
    
</style>
<?php
    echo "<table border='1' cellspacing='0' cellpadding='0' width='800'>";
        echo "<tr>";
            echo "<td><center><a href=''><b<Category id</b></a></center></td>";
            echo "<td><center><a href=''><b>Category name</b></a></center></td>";
            echo "<td><center><a href=''><b>Parent id</b></a></center></td>";
            echo "<td><center><a href=''><b>Category level</b></a></center></td>";
            echo "<td><center><a href=''><b>Category order by</b></a></center></td>";
            echo "<td><center><b>Update<b></center></td>";
            echo "<td><center><b>Delete<b></center></td>";
        echo "</tr>";
        foreach($info as $key=>$value) {
            echo "<tr>";
                echo "<td><center>" . $value['cate_id'] . "</center></td>";
                echo "<td><center>" . $value['cate_name'] . "</center></td>";
                echo "<td><center>" . $value['cate_parent'] . "</center></td>";
                echo "<td><center>" . $value['cate_level'] . "</center></td>";
                echo "<td><center>" . $value['cate_orderby'] . "</center></td>";
                echo "<td><center><a href='".base_url("administrator/category/move"). "/" . $value['cate_id']."'>Edit</a></center></td>";
                echo "<td><center><a href=''>Delete</a></center></td>";
            echo "<tr>";
        }
    echo "</table>";
        
    echo "<div class='dd' id='catetree'>";
    echo $listitem;
    echo "</div>";
    
    echo "<input type='submit' id='submit' name='submit' value='finish'></input>";
    
?>
