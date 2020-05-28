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

if (isset($_POST['spotify_search'])){
$query=$_POST['query'];
$query_type=$_POST['search_type'];
echo '<html><head>';
echo '<link rel="stylesheet" type="text/css" href="../index.css">';
echo '<style> #hidden {
  display: none;
  height: auto;
  width: auto;
  color: white;
}
#hidden span {
  background: black;
}
:checked + #hidden {
  display: block;
}
textarea {
  resize: none
}
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
.searched_for {
text-align:center;
}
hr {
width:95%;
}
</style>';
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
echo '<div class="searched_for"><h2>', 'Searched for ', $query_type, ' : ', $query, '</h2></div>';
echo '<div class="page-content">';
$results = $api->search($query, $query_type);


if ($query_type=='artist'){
foreach ($results->artists->items as $resitem) {
	echo '<div class="result">';

	echo '<hr>';

	echo '<a href=', $resitem->uri, '>', $resitem->name, '</a>';

	echo '<br><br>';

	if (empty($resitem->images)){
	$image="artist.png";
	}
	else {
	$image = $resitem->images[0]->url;
	}

	echo '<img src="', $image, '" alt="Artist image">';

	echo '<br><br>';

	$review_link='review.php' . '?type=' . $query_type . '&id=' . $resitem->id;

	echo '<br><p><a href=', $review_link ,'>', 'See reviews and write your own', '</a></p>';

	echo '</div><br>';
}
}

else if ($query_type=='album') {
foreach ($results->albums->items as $resitem) {
	echo '<div class="result">';

	echo '<hr>';

    echo '<a href=', $resitem->uri, '>', $resitem->name, '</a>', ' by ';
	foreach($resitem->artists as $author) {echo '<a href=', $author->uri, '>', $author->name, '</a>', '  ';}

	echo '<br><br>';

	if (empty($resitem->images)){
	$image="album.png";
	}
	else {
	$image = $resitem->images[0]->url;
	}

	echo '<img src="', $image, '" alt="Album image">';

	echo '<br><br>';
	
	$review_link='review.php' . '?type=' . $query_type . '&id=' . $resitem->id;

	echo '<br><p><a href=', $review_link ,'>', 'See reviews and write your own', '</a></p>';
	
	echo '</div><br>';
}
}

else if ($query_type=='track') {
foreach ($results->tracks->items as $resitem) {
	echo '<div class="result">';

	echo '<hr>';

	echo '<a href=', $resitem->uri, '>', $resitem->name, '</a>', ' by ';
	foreach($resitem->artists as $author) {echo '<a href=', $author->uri, '>', $author->name, '</a>', '  ';}
	echo 'on <a href=', $resitem->album->uri, '>', $resitem->album->name, '</a>';
	echo '<br><br>';

	if (!empty($resitem->preview_url)){
	$mp3 = $resitem->preview_url;
	echo '<audio controls controlsList="nodownload"> <source src="';
	echo $mp3, '" type="audio/mpeg">';
	echo 'Your browser does not support the audio element. </audio>';
	}
	else {
	echo 'Sorry, no audio preview available :(';
	}

	echo '<br><br>';
	
	$review_link='review.php' . '?type=' . $query_type . '&id=' . $resitem->id;

	echo '<br><p><a href=', $review_link ,'>', 'See reviews and write your own', '</a></p>';
	
	echo '</div><br>';
}
}

echo '</div><br>';
}
}
else {
	header('Location: spotify_auth.php');
}

echo '</body></html>';
?>