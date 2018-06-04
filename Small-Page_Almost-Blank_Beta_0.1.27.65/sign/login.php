<?php
if(isset($_POST['submit']))
{
session_start();	
include('../lib/connection.php');



$success="";
$error="";

if(empty($_POST['username']) || empty($_POST['password']))
{
	$error="Please enter all the details first";
}
else{
$username=$_POST['username'];
$password=$_POST['password'];	
$username=mysqli_escape_string($conn,filter_var(strip_tags($username),FILTER_SANITIZE_STRIPPED));
$password=mysqli_escape_string($conn,filter_var(strip_tags($password),FILTER_SANITIZE_STRIPPED));

$hash_password = hash('sha256', $password);

$sql="SELECT * FROM users WHERE UserName='$username' AND Password='$hash_password'";

$result=mysqli_query($conn,$sql) or die("Your query is not right");

$row=mysqli_fetch_array($result);

$count=mysqli_num_rows($result);

if($count==1)
{
	if($row['Active']==0)
	{
		$error = "Please activate your Account first";
	}
	else{
		$_SESSION['username']=$username;
			if(isset($_POST["rememberme"])) {
				setcookie ("username",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
				header('Location:profile.php');
			} else {
				header('Location:profile.php');
				if(isset($_COOKIE["username"])) {
					setcookie ("username","");}
				if(isset($_COOKIE["password"])) {
					setcookie ("password","");}
			}
	}
}
if($count==0)
{
	$error = "You have entered wrong username and password";
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="../menu bar.css">
<link rel="stylesheet" type="text/css" href="style.css"/>
<title>Bang Critic | Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen and (max-width: 360px)" href="../stylesheets/portrait.css">
<link rel="stylesheet" type="text/css" media="screen and (min-width: 361px) and (max-width: 480px)" href="../stylesheets/landscape.css">
<link rel="stylesheet" type="text/css" media="screen and (min-width: 481px)" href="../stylesheets/desktop.css">
</head>
<body>
		<div class="navbar navbar-fixed-top">
			<a class="navbar-brand" href="../index.php">Bang Critic</a>
            <a href="../index.php">Home</a>
            	<div class="dropdown">
		<button class="dropbtn">Pics/Gifs 
				<i class="fa fa-caret-down"></i>
		</button>
				<div class="dropdown-content">
					<a href="../page's/Gifs/Gifs.php">Gifs</a>
					<a href="../page's/Pictures/Pictures.php">Pictures</a>
					<a href="../page's/Categories/All Categories.php">All Categories...</a>
				</div>
		</div>
			<div class="dropdown">
		<button class="dropbtn">Movies
			<i class="fa fa-caret-down"></i>
		</button>
			<div class="dropdown-content">
				<a href="../page's/Movies/Ebony/Ebony.php">Ebony</a>
				<a href="../page's/Movies/Hentai/Hentai.php">Hentai</a>
				<a href="../page's/Movies/Milf/Milf.php">Milf</a>
				<a href="../page's/Movies/Teen/Teen.php">Teen</a>
				<a href="../page's/Movies/Categories/All Categories.php">All Categories...</a>
			</div>
		</div>
			<a href="login.php">Login</a>
			<a href="register.php">Register</a>
			<a href="../page's/about_us.html">About us</a>
			<a href="profile.php">Account</a>
		</div>
	<div id="section_2">
		<h1>Login.</h1>
		<form method="post" action="login.php">
		<input type="text" name="username" value="<?php if(isset($_COOKIE['username'])) {echo $_COOKIE['username'];}?>" placeholder="username"/>
		<input type="password" name="password" value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password'];}?>" placeholder="password" />
		<input type="checkbox" name="rememberme">
		<span class="checkboxtext">Remember me</span><br>
		<button type="submit" name="submit">Login</button>
		<a style="display:block;color:white;margin-top:10px;" href="forgotpassword.php">Forgot Password?</a>
		<span style="color:white;position:relative;top:20px;"><?php if(isset($error))
		{
			echo $error;
		}
		?>
		</span>
	</div>
</body>
</html>