<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="utf-8">
<title>Music Review Manager</title>
<link rel="icon" href="icons/android-chrome-512x512.png" type="image/x-icon"/>
<meta name="description" content="MRM Account Management">
<link rel="stylesheet" type="text/css" href="../index.css">
</head>

<body>

    <?php 

	require_once '../spotify/spotify_auth_refresh.php';	

    if (session_status() == PHP_SESSION_NONE) {
		session_start();
	} 
    $errors = array(); 
  
    if (!isset($_SESSION['username'])) {
        header('location: ../login_test/login.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: ../index.php");
    }
  ?>

<header class="main-header">
			<div class="container">
				<div class="mh-logo">
					<img src="../icons/logo.png"  width="100" height="100" alt="logo">
					<div class="site-title"> Music Review Manager </div>
				</div>
				<nav class="main-nav">
					<ul class="main-nav-list">
                        <li><a href="../index.php">Home</a>
                        
						<?php 
						if (session_status() == PHP_SESSION_NONE) {
						session_start();
						}
						if (!isset($_SESSION['username'])) {
                        echo '<li><a href="../login_test/index.php">Login</a>';
						echo '<li><a href="../login_test/register.php">Register</a>';
						}
						else {
						echo '<li><a href="profilepage.php">My Profile</a>';
						}
						?>

                        <li><a href="../spotify/spotify_auth.php">Search</a>
                        <li><a href="../ScholarlyHTML.html">About Us</a></li>    
					</ul>
				</nav>
			</div>
 </header>

<br>

<div class="page-content">
<div class="welcome">
<?php  if (isset($_SESSION['username'])) : ?>
    	<h1>Welcome <strong><?php echo $_SESSION['username']; ?></strong></h1>
    	<h3><a href="../login_test/index.php?logout='1'" style="color: red;">logout</a></h3>
		<hr><br>
    <?php endif ?>
</div>

<div class="account-controls" id="account-controls">
<h2>Account settings</h2>
<br>
<h3>Change password</h3>
<form method="post" action="ProfilePage.php">
<?php
require_once '../login_test/mailer.php';
$errors = array(); 
$db = mysqli_connect('localhost:3306', 'root', '', 'tw');
if (isset($_POST['change_pass'])) {
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $current_password = mysqli_real_escape_string($db, $_POST['current_password']);
   
    if (empty($password_1)) {
	array_push($errors, "Password is required");
	echo '<span style="color:red">A new password is required !';
    echo '</span><br><br>'; 
	}
    if ($password_1 != $password_2) {
	array_push($errors, "Passwords do not match");
    echo '<span style="color:red">The passwords do not match !';
    echo '</span><br><br>';
	}
   
   if (count($errors) == 0) {
    $cp=md5($current_password);
    $user=$_SESSION['username'];
	$query= "SELECT email FROM users WHERE username='$user'";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($result);
    $email=$row["email"];
    $query = "SELECT * FROM users WHERE username='$user' AND passcode='$cp'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
    $password = md5($password_1);
    $query = "UPDATE users SET passcode='$password' WHERE username = '$user'";
    mysqli_query($db, $query);}
    $change_password_title = "Hey '$user', your password at MusicReviewManager has been changed!";
    $change_password_body = "Your password has been changed! If it wasn't you who did it, contact us at musicreviewmanager@gmail.com!";
    sendMail($email,$user,$change_password_title,$change_password_body);
}
}
?>
<?php 
$errors = array();
require_once('../login_test/errors.php'); 
 ?>
<div class="input-group">
  	  <label>Current Password</label>
  	  <input type="password" name="current_password" pattern="[A-Za-z0-9._-]{6,32}" title="6-32 alphanumerics or (. / _ / -)">
  	</div>
	<br>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1" pattern="[A-Za-z0-9._-]{6,32}" title="6-32 alphanumerics or (. / _ / -)">
  	</div>
	<br>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2" title="Must match password above">
  	</div>
	<br>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="change_pass">Change password</button>
  	</div>


</form>
<br>
<h3>Change email</h3>
<form method="post" action="ProfilePage.php">
<?php
require_once '../login_test/mailer.php';
$errors = array(); 
$db = mysqli_connect('localhost:3306', 'root', '', 'tw');
if (isset($_POST['change_mail'])) {
    $email_1 = mysqli_real_escape_string($db, $_POST['email_1']);
    $email_2 = mysqli_real_escape_string($db, $_POST['email_2']);
    $current_email = mysqli_real_escape_string($db, $_POST['current_email']);
   
    if (empty($email_1)) {
	array_push($errors, "Email is required");
	echo '<span style="color:red">An email is required !';
    echo '</span><br><br>'; 
	}
    if ($email_1 != $email_2) {
	array_push($errors, "Emails do not match");
    echo '<span style="color:red">The emails do not match !';
    echo '</span><br><br>';
   }
   
   if (count($errors) == 0) {
    $user=$_SESSION['username'];
    $query = "SELECT * FROM users WHERE username='$user' AND email='$current_email'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
    $query = "UPDATE users SET email='$email_1' WHERE username = '$user'";
    mysqli_query($db, $query);}
    
    $change_email_title = "Hey '$user', your email at MusicReviewManager has been changed!";
    $change_email_body = "Your email has been changed to '$email_1'! If it wasn't you who did it, contact us at musicreviewmanager@gmail.com!";
    sendMail($current_email,$user,$change_email_title,$change_email_body);
}
}
?>
<?php 
$errors = array();
require_once('../login_test/errors.php');
 ?>
<div class="input-group">
  	  <label>Current Email</label>
      <input type="email" name="current_email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Your email adress (won't be checked)">
  	</div>
	<br>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email_1" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Post new email adress here">
  	</div>
	<br>
  	<div class="input-group">
  	  <label>Confirm Email</label>
  	  <input type="email" name="email_2" title="Must match email above">
  	</div>
	<br>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="change_mail">Change email</button>
  	</div>

</form>
</div>
<br><br><hr>

<section id="my-reviews">
<br>
<h2>Your reviews</h2>
<br>

<?php
$db = mysqli_connect('localhost:3306', 'root', '', 'tw');
$my_name=$_SESSION['username'];
$reviews_query="SELECT * FROM REVIEWS WHERE USER_NAME='$my_name' ORDER BY ID ASC";
$my_reviews = mysqli_query($db,$reviews_query);

if ($my_reviews->num_rows > 0) {
  while($row = $my_reviews->fetch_assoc()) {
	$entity_type=$row["type"];
	$entity_id=$row["entity_id"];
	$entity_name=$row["entity_name"];
	$review_text=$row["text"];
	$review_text=nl2br($review_text);

	echo '<div class="review">';
	echo '<h3>On ';
	$review_link='../spotify/review.php' . '?type=' . $entity_type . '&id=' . $entity_id;
	echo '<a href=', $review_link, '><span style="color: grey">', $entity_type, ':</span><span style="color: red"> ', $entity_name, '</span></a> you wrote : </h3>', $review_text;
	echo '<br>';


	echo '<form method="POST" action="../spotify/review-remover.php">';
	echo '<input type="hidden" name="username" value="', $my_name, '">';
	echo '<input type="hidden" name="type" value="', $entity_type, '">';
	echo '<input type="hidden" name="id" value="', $entity_id, '">';
	echo '<br>';
	echo '<input type="submit" name="delete_review" value="Delete this review"></form>';

	echo '<br>';
	echo '</div>';
  }
} else {
  echo '<div class="no-reviews">';
  echo '<h3>', 'You have not reviewed anything yet.', '</h3>';
  echo '<br></div>';
}
?>

</section>
<hr>

<section id="my-favourites">
<br>
<h2>Your favourite tracks</h2>
<br>

<?php
$db = mysqli_connect('localhost:3306', 'root', '', 'tw');
$my_name=$_SESSION['username'];
$fav_query="SELECT * FROM favourites WHERE username='$my_name' ORDER BY track_name ASC";
$my_favs = mysqli_query($db,$fav_query);

if ($my_favs->num_rows > 0) {
	while($row = $my_favs->fetch_assoc()) {
		$track_id=$row["track_id"];
		$track_name=$row["track_name"];
	
		echo '<div class="fav">';
		$review_link='../spotify/review.php' . '?type=' . "track" . '&id=' . $track_id;
		echo '<form method="POST" action="../spotify/favourite_remover.php">';
		echo '<a href=', $review_link, '>', $track_name,'</a>';
		echo '<input type="hidden" name="username" value="', $my_name, '">';
		echo '<input type="hidden" name="track_id" value="', $track_id, '">';
     	echo '<input type="submit" name="delete_favourite" value="Remove"></form>';
		echo '<br>';
		echo '<br>';
	

		echo '</div>';
	}

	echo '<div class="fav">';
	echo '<form method="POST" action="../spotify/XSPF_export.php">';
	echo '<input type="submit" name="XSPF_export" value="Export as XSPF"></form>';
	echo '</div>';
	
  } else {
	echo '<div class="no-favs">';
	echo '<h3>', 'You have no favourites yet.', '</h3>';
	echo '<br></div><br>';
  }

	
?>
</section>


<?php
if (isset($_SESSION['user_role'])){
	if ($_SESSION['user_role']=='admin'){
		echo '<hr><br>';
		echo '<section id="admin-commands">
				<br>
				<h2 style="color:red;">Admin menu</h2>
				<br>
				<h3>Data export</h3>';
		echo '<form class="form-horizontal" action="download1.php" method="post" name="exportrev" enctype="multipart/form-data">
				<div class="form-group">
					<div class="col-md-4 col-md-offset-4">
						<input type="submit" name="ExportRev" class="btn btn-success" value="Export reviews"/>
					</div>
				</div>                    
			</form>';
		echo '<br>';
		echo '<form class="form-horizontal" action="download2.php" method="post" name="exportfav" enctype="multipart/form-data">
				<div class="form-group">
					<div class="col-md-4 col-md-offset-4">
						<input type="submit" name="ExportFav" class="btn btn-success" value="Export favourites"/>
					</div>
				</div>                    
			</form>';
		echo '<br>';
		echo '<form class="form-horizontal" action="download3.php" method="post" name="exportusr" enctype="multipart/form-data">
				<div class="form-group">
					<div class="col-md-4 col-md-offset-4">
						<input type="submit" name="ExportUsr" class="btn btn-success" value="Export users"/>
					</div>
				</div>                    
			</form>';
		echo '<br><hr>';
		echo '<br><h3>Alter users</h3>';
		echo '<div class="users">';

		$all_users_query="SELECT * FROM users ORDER BY username ASC";
		$all_users = mysqli_query($db,$all_users_query);

		if ($all_users->num_rows > 0) {
			while($row = $all_users->fetch_assoc()) {
				$user_id=$row["id"];
				$user_name=$row["username"];
				$user_role=$row["role"];
				$user_mail=$row["email"];
				
				if($user_name != $my_name){
				echo '<div class="user"><p>', $user_name, ' - <span style="color:red">', strtoupper($user_role), '</span> - <a href="mailto:', $user_mail, '">', $user_mail, '</a></p>';
				
				echo '<form method="POST" action="user_control.php">';
				echo '<input type="hidden" name="username" value="', $user_name, '">';
				echo '<input type="hidden" name="role" value="', $user_role, '">';
				echo '<input type="hidden" name="id" value="', $user_id, '">';
				echo '<input type="hidden" name="mail" value="', $user_mail, '">';
				echo '<br>';
				echo '<input type="submit" class="btn btn-success" name="delete_user" value="Delete user and reviews">  ';
				echo '<input type="submit" class="btn btn-success" name="delete_reviews" value="Delete reviews">  ';
				
				if($user_role=='user'){
				echo '<input type="submit" class="btn btn-success" name="promote_user" value="Promote to admin">  ';
				}
				if($user_role=='admin'){
				echo '<input type="submit" class="btn btn-success" name="demote_user" value="Demote admin">  ';
				}
				echo '<br><hr>';
				echo '</form>';
				echo '</div><br>';
				}
			}
		echo '</div><br></section>';
	}
}
}
?>

<div class="jump-links">
<form action="http://cubiclemon.go.ro/tw/MrM/profile/profilepage.php#account-controls">
    <input type="submit" value="Settings" />
</form>
<form action="http://cubiclemon.go.ro/tw/MrM/profile/profilepage.php#my-reviews">
    <input type="submit" value="Reviews" />
</form>
<form action="http://cubiclemon.go.ro/tw/MrM/profile/profilepage.php#my-favourites">
    <input type="submit" value="Favourites" />
</form>

<?php
if (isset($_SESSION['user_role'])){
	if ($_SESSION['user_role']=='admin'){
		echo '<form action="http://cubiclemon.go.ro/tw/MrM/profile/profilepage.php#admin-commands">
				<input type="submit" value="Admin" />
			</form>';
	}
}
?>

</div>
<br>
</div>
<br>
</body>

</html>