<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require_once '../spotify/spotify_auth_refresh.php';

if(isset($_POST['username'])){
$db = mysqli_connect('localhost:3306', 'root', '', 'TW');

if(isset($_POST['delete_favourite'])){
$username=$_POST['username'];
$track_id=$_POST['track_id'];

$delete_query="DELETE FROM favourites WHERE username='$username' AND track_id='$track_id'";

if (mysqli_query($db, $delete_query)){
	header("location: ../profile/ProfilePage.php");
}
}
}
?>