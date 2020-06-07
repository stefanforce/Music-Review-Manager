<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="utf-8">
<title>Music Review Manager</title>
<link rel="icon" href="icons/android-chrome-512x512.png" type="image/x-icon"/>
<meta name="description" content="Music Review Manager">
<link rel="stylesheet" href="index.css">
</head>

<body>
		<header class="main-header">
			<div class="container">
				<div class="mh-logo">
					<img src="icons/logo.png"  width="100" height="100" alt="logo">
					<div class="site-title"> Music Review Manager </div>
				</div>
				<nav class="main-nav">
					<ul class="main-nav-list">
                        <li><a href="index.php">Home</a>

						<?php 
						if (session_status() == PHP_SESSION_NONE) {
						session_start();
						}
						if (!isset($_SESSION['username'])) {
                        echo '<li><a href="login_test/index.php">Login</a>';
						echo '<li><a href="login_test/register.php">Register</a>';
						}
						else {
						echo '<li><a href="profile/profilepage.php">My Profile</a>';
						}
						?>

                        <li><a href="spotify/spotify_auth.php">Search</a>
                        <li><a href="ScholarlyHTML.html">About Us</a></li>    
					</ul>
				</nav>
			</div>
		</header>
<br>
<div class="page-content">
<h1>Our purpose</h1>
<p>We aim to provide our users with a way of browsing and sampling Spotify's library, saving favorites and publicly reviewing individual entries.</p>
<p>Current status of the website is : <b>in development (no known bugs)</b></p>
<br>
<h2>Features :</h2>
<p>☒ Minimalistic and lightweight responsive design</p>
<p>☒ Valid HTML and CSS</p>
<p>☒ Account system</p>
<p>☒ Mailer service</p>
<p>☒ No sign in required Spotify search</p>
<p>☒ Spotify result preview for easy identification</p>
<p>☒ Spotify Entity reviewing</p>
<p>☒ Favourite tracks list</p>
<p>☒ Account management</p>
<p>☒ Review and favourite management</p>
<p>☒ Security testing</p>
<p>☒ Admin database export and control panel</p>
<p>☒ ScholarlyHTML report</p>
<p>☐ Extensive metadata </p>
<p>☐ Review RSS feed </p>
<br>
</div>
<br><br>
<hr>
<div class="bottom-text">
<p>This website is an open-source project, you are free to copy and modify the source code for any purpose. It is a work in progress and we do not guarantee code quality or data security. We do not use cookies or store any personal data besides that which you directly provide us. The data is never shared with third-parties and can be deleted at your request. For any questions or requests <a href = "mailto:musicreviewmanager@gmail.com">contact us</a>.</p>
</div>

</body>

</html>