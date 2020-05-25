<?php
session_start();

$db = mysqli_connect('localhost:3306', 'root', '', 'TW');

if(isset($_POST['submit_review'])){
$username=$_POST['username'];

$current_user_query="SELECT ID FROM USERS WHERE username='$username'";
$current_user_result=mysqli_query($db, $current_user_query);
$current_user=$current_user_result->fetch_row();
$current_user=$current_user[0];
$search_type=$_POST['type'];
$search_id=$_POST['id'];
$review_text=$_POST['write_review'];
$review_text=strip_tags($review_text);

$review_query="INSERT INTO REVIEWS (USER_ID,TYPE,ENTITY_ID,TEXT) VALUES ('$current_user','$search_type','$search_id','$review_text')";
mysqli_query($db, $review_query);

echo 'Thank you for your review, ' , $username;
$review_link='review.php' . '?type=' . $search_type . '&id=' . $search_id;
echo '<br><br><a href=', $review_link, '> Go back </a>';
}