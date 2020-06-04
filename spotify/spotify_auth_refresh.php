<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/vendor/autoload.php";
require_once($path);

if((!isset($_SESSION["spotifytoken"])) || (isset($_SESSION["spotifytoken"]) && isset($_SESSION["spotifytokenstart"]))){

if (isset($_SESSION["spotifytokenstart"])){
$now=time();
$lifetime=$now-$_SESSION["spotifytokenstart"];
}

if ((isset($lifetime) && $lifetime>3540) || (!isset($_SESSION["spotifytoken"]))){

$session = new SpotifyWebAPI\Session(
    'a7832acf9edf4544bdb4e7e86ba6a539',
    'a38bf2e8c895482596acae71e31a5013'
);

$session->requestCredentialsToken();
$accessToken = $session->getAccessToken();

$_SESSION["spotifytoken"]=$accessToken;
$_SESSION["spotifytokenstart"]=time();

}
}
?>