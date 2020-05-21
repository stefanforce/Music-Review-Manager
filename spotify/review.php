<?php
session_start();
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

echo '<html><head>';
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
width:100%;
}
</style>';
echo '</head><body>';

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
echo '<a href=', $result->uri, '>', 'You are viewing reviews for ', $result->name, '</a>', ' by ';
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
echo '<a href=', $result->uri, '>', 'You are viewing reviews for ', $result->name, '</a>', ' by ';
foreach($result->artists as $author) {echo '<a href=', $author->uri, '>', $author->name, '</a>', '  ';}
echo '<br><br>';
if (!empty($result->preview_url)){
$mp3 = $result->preview_url;
echo '<audio controls controlsList="nodownload"> <source src="';
echo $mp3, '" type="audio/mpeg">';
echo 'Your browser does not support the audio element. </audio>';
}
else {
echo 'Sorry, no audio preview available đźž';
}
echo '<br><br>';
echo '</div><br>';
}

echo '<hr>';

$query = "SELECT * FROM REVIEWS WHERE TYPE='$search_type' AND ENTITY_ID='$search_id'";
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
  echo '<hr></div>';
}

echo '<div class="writer">';

if (isset($_SESSION['username'])){
    echo '<p><h3>Write a review for ', $result->name, '</h3> (please limit yourself to 5000 characters)', '</p><br>';
	echo '<form method="POST" action="review-sender.php">';
	echo '<input type="hidden" name="username" value=', $username, '>';
	echo '<input type="hidden" name="type" value=', $search_type, '>';
	echo '<input type="hidden" name="id" value=', $search_id, '>';
	echo '<textarea name="write_review" rows="20" cols="60" minlength="25" maxlength="5000" required></textarea>';
	echo '<br><br>';
	echo  '<input type="submit" name="submit_review"></form>';
	}
	else {
	echo '<h3>You need to be ';
	echo '<a href="../login_test/login.php"> logged in </a>';
	echo ' to write reviews</h3><br>';
	}

echo '</div><br>';

}

else {
	header('Location: spotify_auth.php');
}

?>