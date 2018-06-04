<?php
session_start();
$error="";
if(isset($_POST['submit']))
{
include('../lib/connection.php');
if(empty($_POST['name']) || empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']))
{
	$error="Please enter all the details first";
}

$name=mysqli_escape_string($conn,filter_var(strip_tags($_POST['name']),FILTER_SANITIZE_STRIPPED));
$username=mysqli_escape_string($conn,filter_var(strip_tags($_POST['username']),FILTER_SANITIZE_STRIPPED));
$password=mysqli_escape_string($conn,filter_var(strip_tags($_POST['password']),FILTER_SANITIZE_STRIPPED));
$email=mysqli_escape_string($conn,filter_var(strip_tags($_POST['email']),FILTER_VALIDATE_EMAIL));


$hash_password = hash('sha256', $password);

$activation_code = hash('sha256',rand(0,1000));

    $sql="SELECT UserName FROM users WHERE UserName='$username'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0)
	{
		$error="UserName already Exists";
	}
	$sql="SELECT Email FROM users WHERE Email='$email'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0)
	{
		$error.="And Email already exists";
	}
    if(empty($error))
	{
	$sql="INSERT INTO users (Name,UserName,Email,Activation_Code,Password) VALUES('$name','$username','$email','$activation_code','$hash_password')";
	$result=mysqli_query($conn,$sql);
	if($result)
	{
	$_SESSION['email']=$email;	
	$_SESSION['username']=$username;
	$_SESSION['password']=$password;
	$_SESSION['hash_password']=$hash_password;
	$_SESSION['activation_code']=$activation_code;
	include('activateemail.php');
	$message="Please check your email to activate your account";
	}
	
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="../menu bar.css">
<link rel="stylesheet" type="text/css" href="style.css"/>
<title>Bang Critic | Register</title>

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
		<div id="section">
			<h1>Register Form For Bang Critic.</h1>
			<form method="post" action="register.php">
			<input type="text" name="name" placeholder="Name"/>
			<input type="text" name="username" placeholder="Username"/>
			<input type="email" name="email" placeholder="E-mail"/>
			<input type="password" name="password" placeholder="Password" />
			<button type="submit" name="submit">Sign Up</button><br>
			<span class="text"><?php if(isset($message)) {echo $message;}?></span>
			<span class="text"><?php if(isset($error)){ echo $error ;}?></span>
		</div>
	</body>
</html>