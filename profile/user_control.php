<?php
include_once '../login_test/mailer.php';
$db = mysqli_connect('localhost:3306', 'root', '', 'TW');
if (session_status() == PHP_SESSION_NONE) {
		session_start();
}

if($_SESSION['user_role']=='admin'){
$id=$_POST['id'];
$username=$_POST['username'];
$role=$_POST['role'];
$mail=$_POST['mail'];

if(isset($_POST["delete_user"])){

	$query = "DELETE FROM users where id='$id' and username='$username'";
	mysqli_query($db, $query);
	$query = "DELETE FROM reviews where user_id='$id' and user_name='$username'";
	mysqli_query($db, $query);
	sendMail($mail,$username,"Your account at MusicReviewManager was terminated","Your account and reviews were deleted by an admin. If you think this was a mistake please reply to this email.");
	header("location: profilepage.php?#admin-commands");
}

if(isset($_POST["delete_reviews"])){

	$query = "DELETE FROM reviews where user_id='$id' and user_name='$username'";
	mysqli_query($db, $query);
	sendMail($mail,$username,"Your reviews at MusicReviewManager were deleted","All your reviews were deleted by an admin. If you think this was a mistake please reply to this email.");
	header("location: profilepage.php?#admin-commands");
}

if(isset($_POST["promote_user"])){

	$query = "UPDATE users SET role='admin' where id='$id' and username='$username'";
	mysqli_query($db, $query);
	sendMail($mail,$username,"Your were promoted to an admin at MusicReviewManager","You are now part of the admin team. Use your power wisely.");
	header("location: profilepage.php?#admin-commands");
}

if(isset($_POST["demote_user"])){

	$query = "UPDATE users SET role='user' where id='$id' and username='$username'";
	mysqli_query($db, $query);
	sendMail($mail,$username,"Your are no longer an admin at MusicReviewManager","Another admin decided you are not worthy. You are now a normal user.");
	header("location: profilepage.php?#admin-commands");
}

}
else {header("location: ../index.html");}
?>