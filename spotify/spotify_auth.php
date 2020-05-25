<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/vendor/autoload.php";
require($path);

$session = new SpotifyWebAPI\Session(
    'a7832acf9edf4544bdb4e7e86ba6a539',
    'a38bf2e8c895482596acae71e31a5013'
);

$session->requestCredentialsToken();
$accessToken = $session->getAccessToken();

$_SESSION["spotifytoken"]=$accessToken;

header('Location: search_box.php');
die();
?>