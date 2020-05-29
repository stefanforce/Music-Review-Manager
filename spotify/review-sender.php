<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require_once '../spotify/spotify_auth_refresh.php';

$db = mysqli_connect('localhost:3306', 'root', '', 'TW');

if(isset($_POST['submit_review'])){
$username=$_POST['username'];

$current_user_query="SELECT ID FROM USERS WHERE username='$username'";
$current_user_result=mysqli_query($db, $current_user_query);
$current_user=$current_user_result->fetch_row();
$current_user=$current_user[0];
$search_type=$_POST['type'];
$search_id=$_POST['id'];
$entity_name=$_POST['entity_name'];
$review_text=mysqli_real_escape_string($db,$_POST['write_review']);
$review_text=strip_tags($review_text);
$review_text=htmlspecialchars($review_text);
$final_length=strlen($review_text);

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
						

                        echo '<li><a href="spotify_auth.php">Search</a>
                        <li><a href="https://github.com/stefanforce/Music-Review-Manager">About Us</a></li>    
					</ul>
				</nav>
			</div>
		</header>';
echo '<br>';
echo '<div class="page-content">';
echo '<br>';


$check_query="SELECT * FROM REVIEWS WHERE USER_ID='$current_user' AND TYPE='$search_type' AND ENTITY_ID='$search_id'";
$check_result=mysqli_query($db, $check_query);
$result_number=mysqli_num_rows($check_result);

if ($result_number>0){
echo 'Sorry, you cannot review the same thing twice.';
$review_link='review.php' . '?type=' . $search_type . '&id=' . $search_id;
echo '<br><br><a href=', $review_link, '> Go back </a><br><br>';
}

else {

if ($final_length>9) {

$review_query="INSERT INTO REVIEWS (USER_ID,USER_NAME,TYPE,ENTITY_ID,ENTITY_NAME,TEXT) VALUES ('$current_user','$username','$search_type','$search_id','$entity_name','$review_text')";
mysqli_query($db, $review_query);

echo 'Thank you for your review, ' , $username, '! It will go live immediately.';
$review_link='review.php' . '?type=' . $search_type . '&id=' . $search_id;
echo '<br><br><a href=', $review_link, '> Go back </a><br><br>';
}

else {
echo 'Oops ! After processing, your review became too short. Avoid using tags as they will get removed.';
$review_link='review.php' . '?type=' . $search_type . '&id=' . $search_id;
echo '<br><br><a href=', $review_link, '> Go back </a><br><br>';
}

}

echo '</div></body>';
echo '</html>';
}
?>