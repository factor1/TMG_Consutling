<?php
/* Template Name: Test Login */
get_header();?>
<form name="loginform" id="loginform" action="http://tmgconsulting.com/wp-login.php" method="post">
	<p>
		<label for="user_login">Username or Email<br />
		<input type="text" name="log" id="user_login" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_pass">Password<br />
		<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" /></label>
	</p>
		<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"  /> Remember Me</label></p>
	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In" />
		<input type="hidden" name="redirect_to" value="http://tmgconsulting.com/wp-admin/" />
		<input type="hidden" name="testcookie" value="1" />
	</p>
</form>
<?php get_footer();?>
