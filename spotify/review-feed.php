<?php

$db = mysqli_connect('localhost:3306', 'root', '', 'TW');
 
if (mysqli_connect_errno($db)) {
 echo "Database connection failed! : " . mysqli_connect_error();
}
 
$sql = "SELECT * FROM reviews ORDER BY id DESC LIMIT 10";
$query = mysqli_query($db,$sql);
  
header("Content-type: text/xml");
 
echo "<?xml version='1.0' encoding='UTF-8'?>
<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>
<channel>
<title>MusicReviewManager Review Feed</title>
<link>http://cubiclemon.go.ro/tw/MrM/spotify/review-feed.php</link>
<atom:link href='http://cubiclemon.go.ro/tw/MrM/spotify/review-feed.php' rel='self' type='application/rss+xml'/>
<description>See the latest reviews published at MrM</description>
<language>en-us</language>";
 
while($row = $query->fetch_assoc()){
$username=$row["user_name"];
$type=$row["type"];
$entity_id=$row["entity_id"];
$entity_name=$row["entity_name"];
$text=$row["text"];
$date=$row["written_at"];
$id=$row["id"];

$review_title=$username . ' reviewed ' . $type . ' ' . $entity_name; 
$review_link='http://cubiclemon.go.ro/tw/MrM/spotify/review.php' . '?type=' . $type . '&id=' . $entity_id;
$review_link=htmlspecialchars($review_link);

$date=date_create("$date");
$date=date_format($date,"D, d M Y H:i:s O");

echo '<item>
<title>',$review_title,'</title>
<link>',$review_link,'</link>
<pubDate>',$date,'</pubDate>
<description>',$text,'</description>
<guid isPermaLink="false">',$id,'</guid>
</item>';
}
echo "</channel></rss>";
?>
