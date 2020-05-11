<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/vendor/autoload.php";
require($path);

$accessToken=$_SESSION["spotifytoken"];

$api = new SpotifyWebAPI\SpotifyWebAPI();
$api->setAccessToken($accessToken);

if (isset($_POST['spotify_search'])){
$query=$_POST['query'];
$query_type=$_POST['search_type'];
echo 'Searched for ', $query_type, ' : ', $query, '<br><br>';
$results = $api->search($query, $query_type);


if ($query_type=='artist'){
foreach ($results->artists->items as $resitem) {
    echo '<a href=', $resitem->uri, '>', $resitem->name, '</a>', '<br>';
}
}

else if ($query_type=='album') {
foreach ($results->albums->items as $resitem) {
    echo '<a href=', $resitem->uri, '>', $resitem->name, '</a>', ' by ';
	foreach($resitem->artists as $author) {echo '<a href=', $author->uri, '>', $author->name, '</a>', ' ';}
	echo '<br>';
}
}

else if ($query_type=='track') {
foreach ($results->tracks->items as $resitem) {
	echo '<a href=', $resitem->uri, '>', $resitem->name, '</a>', ' by ';
	foreach($resitem->artists as $author) {echo '<a href=', $author->uri, '>', $author->name, '</a>', ' ';}
	echo '<br>';
}
}
}
?>