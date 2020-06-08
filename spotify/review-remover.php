<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require_once '../spotify/spotify_auth_refresh.php';

if(isset($_POST['username'])){
$db = mysqli_connect('localhost:3306', 'root', '', 'TW');
$username=$_POST['username'];
$type=mysqli_real_escape_string($db,$_POST['type']);
$id=mysqli_real_escape_string($db,$_POST['id']);

$delete_query="DELETE FROM REVIEWS WHERE USER_NAME='$username' AND TYPE='$type' AND ENTITY_ID='$id'";

if(isset($_POST['delete_review'])){

$delete_query="DELETE FROM REVIEWS WHERE USER_NAME='$username' AND TYPE='$type' AND ENTITY_ID='$id'";

echo '<html lang="en"><head>';
echo '<link rel="stylesheet" type="text/css" href="../index.css">';
echo '</head><body>';
echo '<header class="main-header">
			<div class="container">
				<div class="mh-logo">
					<img src="../icons/logo.png"  width="100" height="100" alt="logo">
					<div class="site-title"> Music Review Manager </div>
				</div>
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
                        <li><a href="../ScholarlyHTML.html">About Us</a></li>    
					</ul>
				</nav>
			</div>
		</header>';
echo '<br>';
echo '<div class="page-content">';
echo '<br>';

if (mysqli_query($db, $delete_query)){
	echo 'Your review was succesfully removed !';
	header("location: ../profile/profilepage.php?#my-reviews");
}
else {
	echo 'There was a problem removing your review...';
}

echo '<br><br></div><br>';
echo '</body></html>';
}

if(isset($_POST['delete_review_direct'])){

$delete_query="DELETE FROM REVIEWS WHERE USER_NAME='$username' AND TYPE='$type' AND ENTITY_ID='$id'";
mysqli_query($db, $delete_query);
$review_link='review.php' . '?type=' . $type . '&id=' . $id;
header("location: $review_link");
}
}
?>