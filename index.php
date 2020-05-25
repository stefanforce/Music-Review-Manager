<!DOCTYPE html>
<html lang="ro" class="no-js">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Music Review Manager</title>
<link rel="icon" href="icons/android-chrome-512x512.png" type="image/x-icon"/>
<meta name="description" content="Music Review Manager">
<link rel="stylesheet" href="index.css">
</head>

<body>
		<header class="main-header">
			<div class="container">
				<h1 class="mh-logo">
					<img src="icons/logo.png"  width="100" height="100" alt="logo">
					<h1> Music Review Manager </h1>
				</h1>
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
                        <li><a href="https://github.com/stefanforce/Music-Review-Manager">About Us</a></li>    
					</ul>
				</nav>
			</div>
		</header>
<br>
<div class="page-content">
<h1>Our purpose</h1>
<p>We aim to provide our users with a way of browsing and sampling Spotify's library, saving favorites and publicly reviewing individual entries.</p>
<p>Current status of the website is : <b>in development (stable)</b></p>
<br>
<h2>Features :</h2>
<p>☒ Basic HTML and CSS design
<p>☒ Register and Login system
<p>☒ Simple mailer service
<p>☒ Login-free connection to Spotify API
<p>☒ Spotify search with metadata
<p>☒ Track 30 second preview
<p>☒ Review submitting and reading
<p>☒ Simple user control panel (change password/mail)
<p>☐ Review RSS feed
<p>☐ Favorites section
<p>☐ Full metadata
<p>☐ Review deletion/editing
<p>☐ Searchable/linkable public user pages
<p>☐ Security testing
<br>
</div>
<br><br>
<hr>
<div class="bottom-text">
<p>This website is an open-source project, you are free to copy and modify the source code for any purpose. It is a work in progress and we do not guarantee code quality or data security. </p>
<p>We do not use cookies or store any personal data besides that which you directly provide us. The data is never shared with third-parties and can be deleted at your request. </p>
<p>For any questions or requests <a href = "mailto: musicreviewmanager@gmail.com">contact us</a></p>
</div>

</body>

</html>