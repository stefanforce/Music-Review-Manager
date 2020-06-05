<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require_once '../spotify/spotify_auth_refresh.php';

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/vendor/autoload.php";
require($path);

if(isset($_SESSION['spotifytoken'])){
$accessToken=$_SESSION['spotifytoken'];

$api = new SpotifyWebAPI\SpotifyWebAPI();
$api->setAccessToken($accessToken);

if(isset($_SESSION['username'])){
$username=$_SESSION['username'];
}

$search_type=$_GET['type'];
$search_id=$_GET['id'];

echo '<!DOCTYPE html>';
echo '<html lang="en"><head>';
echo '<title>Spotify Entity Review Page</title>';
echo '<link rel="stylesheet" type="text/css" href="../index.css">';
echo '<style>
img {
  width:100%;
  max-width:250px;
}
a {
  color:red;
  text-decoration:none;
  font-size:large;
}
a:visited {
  color:red;
}
result {
margin:auto;
}
.result {
text-align:center;
}
textarea {
resize:none;
width:98%;
margin-left:1%;
margin-right:1%;
}
.writer {
font-size:large;
color:white;
background-color:black;
}
input[type=submit] {
cursor:pointer;
color:white;
background-color:black;
border:3px solid white;
margin-left:1%;
}
</style>';
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

if ($search_type=='artist'){
$result=$api->getArtist($search_id);
}
else if ($search_type=='album'){
$result=$api->getAlbum($search_id);
}
else if ($search_type=='track'){
$result=$api->getTrack($search_id);
}
else {
echo 'Wrong parameters - how did you get here?';
die();
}

$db = mysqli_connect('localhost:3306', 'root', '', 'TW');

if ($search_type=='artist'){
echo '<div class="result">';
echo '<br>';
echo '<p>You are viewing reviews for </p>';
echo '<a href=', $result->uri, '>', $result->name, '</a>';
echo '<br><br>';
if (empty($result->images)){
$image="artist.png";
}
else {
$image = $result->images[0]->url;
}
echo '<img src="', $image, '" alt="Artist image">';
echo '<br><br>';
echo '</div><br>';
}


else if ($search_type=='album'){
echo '<div class="result">';
echo '<br>';
echo '<p>You are viewing reviews for </p>';
echo '<a href=', $result->uri, '>', $result->name, '</a>', ' by ';
foreach($result->artists as $author) {echo '<a href=', $author->uri, '>', $author->name, '</a>', '  ';}
echo '<br><br>';
if (empty($result->images)){
$image="album.png";
}
else {
$image = $result->images[0]->url;
}
echo '<img src="', $image, '" alt="Album image">';
echo '<br><br>';
echo '</div><br>';
}


else if ($search_type=='track'){
echo '<div class="result">';
echo '<br>';
echo '<p>You are viewing reviews for </p>';
echo '<a href=', $result->uri, '>', $result->name, '</a>', ' by ';
foreach($result->artists as $author) {echo '<a href=', $author->uri, '>', $author->name, '</a>', '  ';}
echo 'on <a href=', $result->album->uri, '>', $result->album->name, '</a>';
echo '<br><br>';
if (!empty($result->preview_url)){
$mp3 = $result->preview_url;
echo '<audio controls controlsList="nodownload"> <source src="';
echo $mp3, '" type="audio/mpeg">';
echo 'Your browser does not support the audio element. </audio>';
}
else {
echo 'Sorry, no audio preview available :(';
}
echo '<br><br>';
echo '</div><br>';
}

echo '<hr>';

$query = "SELECT * FROM REVIEWS WHERE TYPE='$search_type' AND ENTITY_ID='$search_id' ORDER BY ID DESC";
$results = mysqli_query($db, $query);
if ($results->num_rows > 0) {
  while($row = $results->fetch_assoc()) {
	$user_id=$row["user_id"];
	$review_text=$row["text"];
    $user_query="SELECT USERNAME FROM USERS WHERE ID='$user_id'";
	$user_result = mysqli_query($db, $user_query);
	$user_name = $user_result->fetch_row();
	$user_name = $user_name[0];

	
	echo '<div class="review">';
	echo '<p>', '<h3>', $user_name, ' wrote : ', '</h3>', $review_text, '</p>';
	echo '<hr></div>';
  }
} else {
  echo '<div class="no-reviews">';
  echo '<h3>', 'There are no reviews yet', '</h3>';
  echo '<hr><br></div>';
}

echo '<br><div class="writer">';

if (isset($_SESSION['username'])){

	$check_query="SELECT * FROM REVIEWS WHERE USER_NAME='$username' AND TYPE='$search_type' AND ENTITY_ID='$search_id'";
	$check_result=mysqli_query($db, $check_query);
	$result_number=mysqli_num_rows($check_result);

	if ($result_number>0){
	echo '<h4>You already reviewed this !</h4>';
	}
	
	else {
		echo '<h3>Write a review for ', $result->name, '</h3>';
		echo '<p>(max 5000 characters, tags will be removed)', '</p><br>';
		echo '<form method="POST" action="review-sender.php">';
		echo '<input type="hidden" name="username" value="', $username, '">';
		echo '<input type="hidden" name="type" value="', $search_type, '">';
		echo '<input type="hidden" name="id" value="', $search_id, '">';
		$entity_name=$result->name;
		$entity_name=mysqli_real_escape_string($db,$entity_name);
		echo '<input type="hidden" name="entity_name" value="', $entity_name, '">';
		echo '<textarea name="write_review" rows="20" cols="60" minlength="10" maxlength="5000" required></textarea>';
		echo '<br><br>';
		echo '<input type="submit" name="submit_review"></form>';
		echo '<br>';
	}
}

else {
echo '<h3>You need to be ';
echo '<a href="../login_test/login.php"> logged in </a>';
echo ' to write reviews</h3>';
}

echo '</div><br>';


echo '<br><br></div><br>';

}

else {
	header('Location: spotify_auth.php');
}

?>