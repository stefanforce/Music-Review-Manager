<!DOCTYPE html>
<html lang="ro" class="no-js">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Music Review Manager</title>
<link rel="icon" href="icons/android-chrome-512x512.png" type="image/x-icon"/>
<meta name="description" content="Music Review Manager Account Management">
<link rel="stylesheet" href="ProfilePage.css">
<script src="script.js"></script>
</head>

<body>

    <?php 
    session_start(); 
    $errors = array(); 
  
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: ../login_test/login.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: ../index.html");
    }
  ?>

<header>
    <div class="logo"><img src="../icons/logo.png" alt="logo"></div>
    <nav>
        <ul class="top_links">
            <li><a href="ProfilePage.php">Account Preferences</a>
            <li><a href="../login_test/index.php">Login/MyAcc</a>
            
        </ul>
    </nav>
    

</header>

<div class="first-column">
<h1>Music-Review-Manager</h1>
<?php  if (isset($_SESSION['username'])) : ?>
    	<h1>Welcome <strong><?php echo $_SESSION['username']; ?></strong></h1>
    	<h3> <a href="../login_test/index.php?logout='1'" style="color: red;">logout</a> </h3>
    <?php endif ?>
</div>



<p><b>Change password</b>   </p>
<form method="post" action="ProfilePage.php">
<?php
$errors = array(); 
$db = mysqli_connect('localhost:3306', 'root', '', 'tw');
if (isset($_POST['reg_user'])) {
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $current_password = mysqli_real_escape_string($db, $_POST['current_password']);
   
    if (empty($password_1)) { echo("Password is required\n");echo "<br>"; }
   if ($password_1 != $password_2) {
    echo("The passwords don't match\n");
    echo "<br>";
   }
   
   if (count($errors) == 0) {
    $cp=md5($current_password);
    $user=$_SESSION['username'];
    $query = "SELECT * FROM users WHERE username='$user' AND passcode='$cp'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
    $password = md5($password_1);
    $query = "UPDATE users SET passcode='$password' WHERE username = '$user'";
    mysqli_query($db, $query);}
}
}
?>
<?php 
$errors = array();
include('../login_test/errors.php'); 
 ?>
<div class="input-group">
  	  <label>Current Password</label>
  	  <input type="password" name="current_password" pattern="[A-Za-z0-9._-]{6,32}" title="6-32 alphanumerics or (. / _ / -)">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1" pattern="[A-Za-z0-9._-]{6,32}" title="6-32 alphanumerics or (. / _ / -)">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2" title="Must match password above">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Change password</button>
  	</div>


</form>


<div>
<section id="comments">
<br>
<p>We will have user's posts here</p>
</section>
</div>

</body>

</html>