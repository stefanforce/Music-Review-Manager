<?php
require_once '../spotify/spotify_auth_refresh.php';
$db = mysqli_connect('localhost:3306', 'root', '', 'TW');

    $accessToken=$_SESSION['spotifytoken'];
    $api = new SpotifyWebAPI\SpotifyWebAPI();
    $api->setAccessToken($accessToken);
    
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 
if (mysqli_connect_errno($db)) {
 echo "Database connection failed! : " . mysqli_connect_error();
}
$username=$_SESSION['username'];
$sql = "SELECT * FROM favourites where username='$username'";
$query1 = mysqli_query($db,$sql);
  
header("Content-type: text/xml");
header('Content-Disposition: attachment; filename=my-favs.xspf'); 
 
echo "<?xml version='1.0' encoding='UTF-8'?>
<playlist version='1' xmlns='http://xspf.org/ns/0/'>
<title>", $username, "`s favourites at MrM</title>
<creator>MusicReviewManager</creator>
<info>http://cubiclemon.go.ro/tw/MrM/</info>
<trackList>"; 

    while($row = $query1->fetch_assoc()){
        $username=$row["username"];
        $id=$row["id"];
        $track_id=$row["track_id"];
        $track_name=$row["track_name"];
        $query=$track_name;
        $query_type="track";
        $result = $api->getTrack($track_id);
        $mp3 = $result->preview_url;
		$artists_names = '';
		$album_title=$result->album->name;
		$album_art=$result->album->images[0]->url;

		foreach($result->artists as $artist) {$artists_names = $artists_names . ' ' . $artist->name;}
		$artists_names=trim($artists_names);
       
        if (!is_null($mp3))
        {
        echo '<track><location>',
        $mp3,
        '</location>
        <title>',
        $track_name,
        '</title>
		<creator>', $artists_names,'</creator>
		<album>', $album_title,'</album>';
		if (!is_null ($album_art)){
		echo '<image>', $album_art, '</image>';
		}
		echo '</track>';
        }
    }
    
echo"</trackList></playlist>";
?>
