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
  
header("Content-type: text/xspf");
 
echo "<?xml version='1.0' encoding='UTF-8'?>
<playlist version='1' xmlns='http://xspf.org/ns/0/'>
    <trackList> 
    "; 

    while($row = $query1->fetch_assoc()){
        $username=$row["username"];
        $id=$row["id"];
        $track_id=$row["track_id"];
        $track_name=$row["track_name"];
        $query=$track_name;
        $query_type="track";
        $results = $api->search($query, $query_type);
        foreach ($results->tracks->items as $resitem) {
         $mp3 = $resitem->preview_url;
        break;
        }
       
        if (!is_null($mp3))
        {
        echo '<track><location>',
        $mp3,
        '</location>
        <title>',
        $track_name,
        '</title></track>
        ';
        
        }
    }
    
 echo"</trackList>
</playlist>";
?>
