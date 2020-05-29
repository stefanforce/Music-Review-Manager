<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require_once '../spotify/spotify_auth_refresh.php';

$db = mysqli_connect('localhost:3306', 'root', '', 'TW');

if(isset($_POST['save_favourites'])){
$username=$_POST['username'];
$track_id=$_POST['track_id'];
$track_name=$_POST['track_name'];

$dupe_checked_query="SELECT * from favourites where username='$username' and track_id='$track_id'";
$dupe_checker_result=mysqli_query($db,$dupe_checked_query);
$result_number=mysqli_num_rows($dupe_checker_result);

if ($result_number>0){
echo 'You have already added this page to favourites';
$review_link='review.php' . '?type=' . "track" . '&id=' . $track_id;
echo '<br><br><a href=', $review_link, '> Go to reviews </a><br><br>';
}

else {
    $insert_fav_query="insert into favourites(username,track_id,track_name) values ('$username','$track_id','$track_name')";
    mysqli_query($db,$insert_fav_query);
    echo 'You have successfully added the track to favourites';
    $review_link='review.php' . '?type=' . "track" . '&id=' . $track_id;
echo '<br><br><a href=', $review_link, '> Go to reviews </a><br><br>'; 
}
header('location: ' . $review_link);

}
?>

