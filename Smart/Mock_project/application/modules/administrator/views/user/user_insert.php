<meta charset="UTF-8" />
<title>Insert User</title>

<form action="" method="post">
   	<label><b>Username</b></label>
   	<input type="text" name="name" value="" placeholder=".................Enter username................." size="30" />
    <span class="error"><i><?php echo form_error("name"); ?></i></span>
    <br />
    
    <label><b>Password</b></label>
   	<input type="password" name="password" value="" placeholder=".................Enter password................." size="30" />
    <span class="error"><i><?php echo form_error("password"); ?></i></span>
    <br />
    
   	<label><b>Email</b></label>
    <input type="text" name="email" value="" placeholder=".................Enter email................." size="30" />
    <span class="error"><i><?php echo form_error("email"); ?></i></span>
    <br />
    
   	<label><b>Address</b></label>
    <input type="text" name="address" value="" placeholder=".................Enter address................." size="30" />
    <span class="error"><i><?php echo form_error("address"); ?></i></span>
    <br />
    
   	<label><b>Phone</b></label>
    <input type="text" name="phone" value="" placeholder=".................Enter phone number................." size="30" />
    <span class="error"><i><?php echo form_error("phone"); ?></span></i>
    <br />  
    
    <label><b>Gender</b></label>
    <label>Male&nbsp;<input type="radio" name="gender" value="1"  /></label>
    <label>Female&nbsp;<input type="radio" name="gender" value="2"  /></label>
    <span class="error"><i><?php echo form_error("gender"); ?></span></i>  
    <br />
    
    <label><b>Level</b></label>
    <label>Admin&nbsp;<input type="radio" name="level" value="1"  /></label>
    <label>User&nbsp;<input type="radio" name="level" value="2"  /></label>
    <span class="error"><i><?php echo form_error("level"); ?></span></i>  
    <br />
    
    <div >
        <input type="submit" name="insert" value="Insert" class="insert-cancel" />
        &nbsp;<input type="submit" name="cancel" value="Cancel" class="insert-cancel" />
    </div>                                
</form>