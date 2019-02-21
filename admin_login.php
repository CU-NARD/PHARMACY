<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="style1.css">
<head>
<title>ADMIN LOGIN</title>
<style>
h1
{
	color: navy;
	font-style: verdana;
}
</style>
</head>
<body>

<div class="topnav">

  <a href="homepage1.php">HOME</a>
</div>

<div class="content">
 <img src="admin_logo.png" style="width:10%">
  <h1><u>ADMIN SIGN IN</u><h1>
  
  <form action="<?php $_PHP_SELF ?>" method="GET">
  <label for "username"><b>USER NAME</b></label>
  <input type="text" name="username" required><br>
  
  <label for "password"><b>PASSWORD</b></label>
  <input type="password" name="password" required><br>
  
  <input type="submit" name="submit" required><br><br>
  </form>
  <?php
require_once 'details.php';
//require_once 'sample.php';
//making conection
$conn=new mysqli($db_hostname,$db_username,$db_password,$db_database);
if($conn->connect_error)
{
	die("CONNECTION FAILED".$conn->connect_error);
}

if(isset($_GET['submit']))
{
	$sql="select * from login where username='".$_GET['username']."' and password='".$_GET['password']."'";
	$result=$conn->query($sql);
	if(mysqli_num_rows($result)>0)
	header('location: admin_home.php');
    else
		echo "LOGIN DENIED !!";
}
$conn->close();
?>
</div>

<div class="footer">
  <p>NARD</p>
</div>

</body>
</html>

