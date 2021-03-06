<?php
require_once 'mailer.php';
require_once 'welcome_message.php';
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

$username = "";
$errors = array(); 

$db = mysqli_connect('localhost:3306', 'root', '', 'TW');

if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "E-mail address is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
  }

  if (count($errors) == 0) {
  	$password = md5($password_1);
  	$query = "INSERT INTO users (username, passcode, email) 
  			  VALUES('$username', '$password', '$email')";
  	mysqli_query($db, $query);
	$query = "UPDATE users SET 
  			  last_login=CURRENT_TIMESTAMP where username='$username'";
  	mysqli_query($db, $query);
	sendMail($email,$username,$welcome_title,$welcome_body);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND passcode='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
	  $row=$results->fetch_assoc();
	  $_SESSION['user_role']=$row["role"];
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
	  $query = "UPDATE users SET 
  			  last_login=CURRENT_TIMESTAMP where username='$username'";
  	  mysqli_query($db, $query);
  	  header('location: ../profile/profilepage.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>