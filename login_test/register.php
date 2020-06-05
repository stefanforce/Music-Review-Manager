<?php require_once('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration page</title>
  <link rel="stylesheet" type="text/css" href="../index.css">
</head>
<body>
  
  <?php
  if (isset($_SESSION['username'])) {
        header('location: ../profile/profilepage.php');
    }
  ?>

  <header class="main-header">
			<div class="container">
				<div class="mh-logo">
					<img src="../icons/logo.png"  width="100" height="100" alt="logo">
					<div class="site-title"> Music Review Manager </div>
				</div>
				<nav class="main-nav">
					<ul class="main-nav-list">
                        <li><a href="../index.php">Home</a>
                        
						<?php 
						if (session_status() == PHP_SESSION_NONE) {
						session_start();
						}
						if (!isset($_SESSION['username'])) {
                        echo '<li><a href="index.php">Login</a>';
						echo '<li><a href="register.php">Register</a>';
						}
						else {
						echo '<li><a href="../profile/profilepage.php">My Profile</a>';
						}
						?>

                        <li><a href="../spotify/spotify_auth.php">Search</a>
                        <li><a href="https://github.com/stefanforce/Music-Review-Manager">About Us</a></li>    
					</ul>
				</nav>
			</div>
  </header>
  <br>
  <div class="page-content">
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php require_once('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" pattern="[A-Za-z0-9._-]{4,32}" title="4-32 alphanumerics or (. / _ / -)">
  	</div>
	<br>
	<div class="input-group">
  	  <label>E-mail</label>
  	  <input type="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Your email adress (won't be checked)">
  	</div>
	<br>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1" pattern="[A-Za-z0-9._-]{6,32}" title="6-32 alphanumerics or (. / _ / -)">
  	</div>
	<br>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2" title="Must match password above">
  	</div>
	<br>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
  </div>
</body>
</html>