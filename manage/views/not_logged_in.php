<?php
// include html header and display php-login message/error
include('header.php');

// login form box
?> 

<div class="row">   
<br />  
<div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel  panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">      
			<form method="post" action="index.php" name="loginform" role="form">
				<fieldset>
			<div class="form-group">
				<!--<label for="user_name"><?php echo $phplogin_lang['Username']; ?></label>-->
				<input id="user_name" placeholder="User name" class="form-control" type="text" name="user_name" required />
			</div>
			<div class="form-group">
				<!--<label for="user_password"><?php echo $phplogin_lang['Password']; ?></label>-->
				<input id="user_password" placeholder="Password" class="form-control" type="password" name="user_password" autocomplete="off" required />
			</div>
			<div class="checkbox">
				<input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" />
				<label for="user_rememberme"><?php echo $phplogin_lang['Remember me']; ?></label>
			</div>
				<input type="submit" class="btn" name="login" value="<?php echo $phplogin_lang['Log in']; ?>" />
			</fieldset>
			</form>
			<!--<a href="register.php"><?php echo $phplogin_lang['Register new account']; ?></a>-->
			<a href="password_reset.php"><?php echo $phplogin_lang['I forgot my password']; ?></a>
		</div>
      </div>
   </div>	
</div>

<?php
// include html footer
include('footer.php');
