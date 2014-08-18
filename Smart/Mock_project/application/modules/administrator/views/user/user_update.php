<meta charset="UTF-8" />
<title>Update User</title>

<form action="" method="post">    		            
   	<label><b>Email</b></label>
    <input type="text" name="email" value="<?php echo $userInfo[0]['email']; ?>" size="30" />
    <span class="error"><i><?php echo form_error("email"); ?></i></span>
    <br />
    
   	<label><b>Address</b></label>
    <input type="text" name="address" value="<?php echo $userInfo[0]['address']; ?>" size="30" />
    <span class="error"><i><?php echo form_error("address"); ?></i></span>
    <br />
    
   	<label><b>Phone</b></label>
    <input type="text" name="phone" value="<?php echo $userInfo[0]['phone']; ?>" size="30" />
    <span class="error"><i><?php echo form_error("phone"); ?></span></i>
    <br />  
    
    <label><b>Gender</b></label>
    <label>Male&nbsp;<input type="radio" name="gender" value="0" <?php  echo (isset($userInfo[0]['gender']) || $userInfo[0]['gender'] == 1) ? "checked" : ""; ?>  /></label>
    <label>Female&nbsp;<input type="radio" name="gender" value="1" <?php  echo (isset($userInfo[0]['gender']) || $userInfo[0]['gender'] == 2) ? "checked" : ""; ?>  /></label>
    <span class="error"><i><?php echo form_error("gender"); ?></span></i>  
    <br />
    
    <label><b>Level</b></label>
    <label>Admin&nbsp;<input type="radio" name="level" value="1" <?php   echo $userInfo[0]['level'] == 1 ? "checked='checked'" : ""; ?> /></label>
    <label>User&nbsp;<input type="radio" name="level" value="2" <?php   echo $userInfo[0]['level'] == 2 ? "checked='checked'" : ""; ?> /></label>
    <span class="error"><i><?php echo form_error("level"); ?></span></i>  
    <br />
    
    <label>&nbsp;</label> 
    <div >
        <input type="submit" name="update" value="Update" class="insert-cancel" />
        &nbsp;<input type="submit" name="cancel" value="Cancel" class="insert-cancel" />
    </div>                             
</form>