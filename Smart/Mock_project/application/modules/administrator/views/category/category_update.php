<meta charset="UTF-8" />
<title>Update Categories</title>
<form action="" method="post">	
<div id="categories">
        <!--<label><b>Parent Category</b></label>
        <select>
    		<option value="0">Menu Cha</option>
                <?php
                    /**
 * $current_id = array();                                        
 *                     foreach($cateAll as $key=>$value) {
 *                         if($value['parent_id'] == 0) {
 *                                        
 *                         echo "<option value='".$value['cate_id']."'> + ". $value['cate_name']."</option>";  
 *                             $spacing = 5;
 *                                 
 *                             if(getChildren($cateAll,$value)){
 *                             printChildren($cateAll,$value, $spacing);
 *                             }
 *                         }
 *                     } 
 *                     
 *                     function getChildren($cateList, $cate) {
 *                         $children = array();
 *                         foreach($cateList as $child) {
 *                             if($child['parent_id'] == $cate['cate_id']) {
 *                                 $children[] = $child;  
 *                             }
 *                         }             
 *                         if(count($children)==0) {
 *                             return false;
 *                         } else {
 *                             return $children;
 *                         }
 *                     }
 *                     
 *                     function printChildren($cateList, $cate, $spacing) {
 *                         $children = getChildren($cateList, $cate);
 *                         for($i=0;$i<count($children) ; $i++) {
 *                                     for ($j = 0 ; $j <= $spacing; $j++) {
 *                                         $mar.="&nbsp";
 *                                     }
 *                                      echo "<option value='".$children[$i]['cate_id']."'>" . $mar . "---".$children[$i]['cate_name']."</option>"; 
 *                                
 *                                     if(getChildren($cateList,$children[$i])){
 *                                         printChildren($cateList,$children[$i], $spacing + 5);
 *                                     }
 *                         }
 *                         
 *                     }
 */
                ?>        
    					
    	</select>
    </div>-->

	<label><b>Category name</b></label>
	<input type="text" name="cate_name" value="<?php echo $cateInfor['cate_name']; ?>" size="20">
	<span class="error"><i><?php echo form_error("cate_name"); ?></i></span>
	<br />

	<div><input type="submit" name="update" value="Update" class="insert-cancel" />&nbsp;<input type="submit" name="cancel" value="Cancel" class="insert-cancel" /></div>
</form>