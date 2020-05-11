<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/vendor/autoload.php";
require($path);

$session = new SpotifyWebAPI\Session(
    'a7832acf9edf4544bdb4e7e86ba6a539',
    'a38bf2e8c895482596acae71e31a5013'
);

$session->requestCredentialsToken();
$accessToken = $session->getAccessToken();

// Store the access token somewhere. In a database for example.
$_SESSION["spotifytoken"]=$accessToken;

// Send the user along and fetch some data!
header('Location: search_box.php');
die();
?>