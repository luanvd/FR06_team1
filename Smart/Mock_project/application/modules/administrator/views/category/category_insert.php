<meta charset="UTF-8" />
<title>Insert Categories</title>
			
<div id="center">
<form action="" method="post">
    <label><b>Category Name</b></label>
    <input type="text" name="cate_name" id="cate_name" value="<?php echo $name ? $name : '' ?>" />
    <span class="error"><i><?php echo form_error("cate_name"); ?></i></span>
    <br/>
    <div id="categories">
        <label><b>Parent category</b></label>
        <select name="parent_id" id="parent_id">
        	<option value="0">Choose parent category</option>
    
            <?php 
            
            $traveled = array();
            foreach ($parent_cates as $cate) {
            	if($cate['parent_id'] == 0) {
            
            		echo '<option value="' . $cate['cate_id'] . '">' . $cate['cate_name'] . ' </option>';
            		//echo $cate['cate_name'];
            		global $traveled;
            		$traveled[] = $cate['cate_id'];
            		$current_id = $cate['cate_id'];
            		echo "</br>";
            		has_child($current_id, $parent_cates, 1);
            	}
            }
            
            function has_child($cate_id, $parent_cates, $level){
            	global $traveled;
            	foreach ($parent_cates as $cate) {
            		if($cate['parent_id'] == $cate_id && !in_array($cate['cate_id'], $traveled)) {
            			$levelDisplay = "";
            			for($i = 0; $i < $level; $i++ ){
            				$levelDisplay .= " - - ";
            			}
            
            			echo '<option value="' . $cate['cate_id'] . '">' . $levelDisplay .$cate['cate_name'] . ' </option>';
            			//echo $cate['cate_name'];
            			$traveled[] = $cate['cate_id'];
            			has_child($cate['cate_id'], $parent_cates, $level+1);
            		}
            	}
            }
            ?>	
        </select>
    </div><br /><br />
<div><input type="submit" name="insert" value="Insert" class="insert-cancel" />&nbsp;<input type="submit" name="cancel" value="Cancel" class="insert-cancel" /></div>                           
</form>