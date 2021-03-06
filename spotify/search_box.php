<?php require_once('spotify_search.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Spotify Search</title>
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
                        echo '<li><a href="../login_test/index.php">Login</a>';
						echo '<li><a href="../login_test/register.php">Register</a>';
						}
						else {
						echo '<li><a href="../profile/profilepage.php">My Profile</a>';
						}
						?>

                        <li><a href="spotify_auth.php">Search</a>
                        <li><a href="../ScholarlyHTML.html">About Us</a></li>    
					</ul>
				</nav>
			</div>
</header>
<br>

<div class="page-content">
<h2>Search</h2>
<form method="post" action="spotify_search.php">
	<label for="search_type">Artist/Album/Track</label>
	<select name="search_type" id="search_type">
		<option value="artist">Artist</option>
		<option value="album">Album</option>
		<option value="track">Track</option>
	</select>
	<br><br>
  	<div class="input-group">
  	  <label>Query</label>
  	  <input type="text" name="query" pattern="[A-Za-z0-9._-/ ]{1,64}" required title="Maximum 64 alphanumerics or (. , _ , - , /)">
  	</div>
	<br>
	<div class="input-group">
  	  <button type="submit" class="btn" name="spotify_search">Search</button>
  	</div>
</form>
<br>
</div>
<br>
<div class="bottom-text"><a href="https://www.spotify.com/"><img src="../icons/Spotify_Logo_RGB_Black.png" alt="Spotify Logo"></a></div><br>
</body>
</html>