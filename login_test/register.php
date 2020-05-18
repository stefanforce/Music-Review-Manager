<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" pattern="[A-Za-z0-9._-]{4,32}" title="4-32 alphanumerics or (. / _ / -)">
  	</div>
	<div class="input-group">
  	  <label>E-mail</label>
  	  <input type="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Your email adress (won't be checked)">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1" pattern="[A-Za-z0-9._-]{6,32}" title="6-32 alphanumerics or (. / _ / -)">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2" title="Must match password above">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>