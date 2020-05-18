<?php
session_start();
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
  font-size:large;
}
</style>';
echo '</head><body>';
echo 'Searched for ', $query_type, ' : ', $query, '<br><br>';
$results = $api->search($query, $query_type);


if ($query_type=='artist'){
foreach ($results->artists->items as $resitem) {
	echo '<div class="results">';

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

	echo '<label for="my_checkbox"> Write a review </label>';

	echo '<input type="checkbox" id="my_checkbox">';

	echo '<div id="hidden"><br>';

	if (isset($_SESSION['username'])){
    echo '<span>Writing a review for ', $resitem->name, ' (please limit yourself to 1000 characters)', '</span><br><br>';
	echo '<textarea id="write_review" rows="20" cols="60" maxlength="1000">Share your opinion !</textarea>';
	echo '<br><br><button type="button">Send review !</button>';
	}
	else {
	echo '<span>You need to be logged in to write reviews</span><br>';
	}
	echo '</div></div><br>';
}
}

else if ($query_type=='album') {
foreach ($results->albums->items as $resitem) {
	echo '<div class="results">';

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

	echo '<label for="my_checkbox"> Write a review </label>';
	
	echo '<input type="checkbox" id="my_checkbox">';

	echo '<div id="hidden"><br>';

	if (isset($_SESSION['username'])){
    echo '<span>Writing a review for ', $resitem->name, ' (please limit yourself to 1000 characters)', '</span><br><br>';
	echo '<textarea id="write_review" rows="20" cols="60" maxlength="1000">Share your opinion !</textarea>';
	echo '<br><br><button type="button">Send review !</button>';
	}
	else {
	echo '<span>You need to be logged in to write reviews</span><br>';
	}
	echo '</div></div><br>';
}
}

else if ($query_type=='track') {
foreach ($results->tracks->items as $resitem) {
	echo '<div class="results">';

	echo '<hr>';

	echo '<a href=', $resitem->uri, '>', $resitem->name, '</a>', ' by ';
	foreach($resitem->artists as $author) {echo '<a href=', $author->uri, '>', $author->name, '</a>', '  ';}

	echo '<br><br>';

	if (!empty($resitem->preview_url)){
	$mp3 = $resitem->preview_url;
	echo '<audio controls controlsList="nodownload"> <source src="';
	echo $mp3, '" type="audio/mpeg">';
	echo 'Your browser does not support the audio element. </audio>';
	}
	else {
	echo 'Sorry, no audio preview available 😞';
	}
	echo '<br><br>';

	echo '<label for="my_checkbox"> Write a review </label>';
	
	echo '<input type="checkbox" id="my_checkbox">';

	echo '<div id="hidden"><br>';

	if (isset($_SESSION['username'])){
    echo '<span>Writing a review for ', $resitem->name, ' (please limit yourself to 1000 characters)', '</span><br><br>';
	echo '<textarea id="write_review" rows="20" cols="60" maxlength="1000">Share your opinion !</textarea>';
	echo '<br><br><button type="button">Send review !</button>';
	}
	else {
	echo '<span>You need to be logged in to write reviews</span><br>';
	}
	echo '</div></div><br>';
}
}

}
}
else {
	header('Location: spotify_auth.php');
}

echo '</body></html>';
?>