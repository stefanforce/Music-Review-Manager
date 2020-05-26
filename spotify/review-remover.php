<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(isset($_POST['username'])){
$db = mysqli_connect('localhost:3306', 'root', '', 'TW');

if(isset($_POST['delete_review'])){
$username=$_POST['username'];
$type=mysqli_real_escape_string($db,$_POST['type']);
$id=mysqli_real_escape_string($db,$_POST['id']);

$delete_query="DELETE FROM REVIEWS WHERE USER_NAME='$username' AND TYPE='$type' AND ENTITY_ID='$id'";

echo '<html><head>';
echo '<link rel="stylesheet" type="text/css" href="../index.css">';
echo '</head><body>';
echo '<header class="main-header">
			<div class="container">
				<h1 class="mh-logo">
					<img src="../icons/logo.png" width="100" height="100" alt="logo">
					<h1> Music Review Manager </h1>
				</h1>
				<nav class="main-nav">
					<ul class="main-nav-list">
                        <li><a href="../index.php">Home</a>';

						if (!isset($_SESSION['username'])) {
                        echo '<li><a href="../login_test/index.php">Login</a>';
						echo '<li><a href="../login_test/register.php">Register</a>';
						}
						else {
						echo '<li><a href="../profile/profilepage.php">My Profile</a>';
						}
						
                        echo '<li><a href="spotify_auth.php">Search</a>
                        <li><a href="https://github.com/stefanforce/Music-Review-Manager">About Us</a></li>    
					</ul>
				</nav>
			</div>
		</header>';
echo '<br>';
echo '<div class="page-content">';
echo '<br>';

if (mysqli_query($db, $delete_query)){
	echo 'Your review was succesfully removed !';
}
else {
	echo 'There was a problem removing your review...';
}

echo '<br><br></div><br>';
echo '</body></html>';
}
}
?>