<?php require_once('server.php');
if (isset($_SESSION["username"])){
header("location: ../profile/profilepage.php");
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login page</title>
  <link rel="stylesheet" type="text/css" href="../index.css">
</head>
<body>
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
                        <li><a href="../ScholarlyHTML.html">About Us</a></li>    
					</ul>
				</nav>
			</div>
  </header>
  <br>
  <div class="page-content">
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php" autocomplete="on">
  	<?php require_once('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
	<br>
  	<div class="input-group">
  		<label>Password </label>
  		<input type="password" name="password">
  	</div>
	<br>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
  </div>
</body>
</html>