<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.admin.css" />
</head>
<body>
	<div id="login_view">
		<div id="container">
			<?php echo form_open('authentication/login/verify'); ?>
			
			<label>Username</label>
			<input type="text" name="username" id="username-login" placeholder="<?php echo strip_tags(form_error('username')); ?>" value="<?php echo set_value('username'); ?>" size="30">
			<br>
			
			<label>Password</label>
			<input type="password" name="password" id="password-login" placeholder="<?php echo strip_tags(form_error('password')); ?>" value="<?php echo set_value('password'); ?>" size="30">
			<br>
			
			<div id="lower">
				<label>&nbsp;</label>
				<input type="submit" name="submit" class="button" value="Login" />
				<span class='error' id="login-error"><?php echo isset($login_failed) ? $login_failed : ""; ?></span>
			</div>
			
			</form>
		</div>
	</div>
</body>
</html>
	