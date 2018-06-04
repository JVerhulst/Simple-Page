<?php
session_start();
include('../lib/connection.php');
	if(!isset($_SESSION['username'])){
		$_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];
		header('location:login.php');
	}
$username=$_SESSION['username'];

$sql="SELECT * FROM users WHERE Username='$username'";

$result=mysqli_query($conn,$sql) or die("Your query is not correct");

$row=mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="style.css"/>
<title>Bang Critic | User Profile</title>

<link rel="stylesheet" type="text/css" href="../menu bar.css">

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
		</div>
	<div class="container">
		<div id="section_4">
		<h1>Profile Details</h1>
		<input type="text" readonly value="<?php echo $row['Name'];?>"/>
		<input type="text" readonly name="username" value="<?php echo $row['UserName'];?>"/>
		<input type="email" readonly name="email" value="<?php echo $row['Email'];?>"/>
		</div>
			
		<aside id="left_menu">
			<a href="#"><button class="upload left_menu_btn">Upload</button></a>
			<a href="changepassword.php"><button class="chpasswd left_menu_btn" type="submit">Change Password</button></a>
			<a href="deleteaccount.php"><button class="dlacc left_menu_btn" type="submit">Delete Account</button></a>
			
			<a href="logout.php"><button class="logoutbutton left_menu_btn" type="submit">Logout</button></a>
		</aside>
	</div>
</body>
</html>