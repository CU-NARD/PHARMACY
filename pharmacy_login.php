<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="style1.css">
<head>
<title>PHARMACY SIGN IN</title>
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
 <img src="pharmacy_signin.png" style="width:10%">
  <h1><u>PHARMACY SIGN IN</u><h1>
  
  <form action="<?php $_PHP_SELF ?>" method="GET">
  <label for "pname"><b>PHARMACY NAME</b></label>
  <input type="text" name="pname" required><br>
  
  <label for "password"><b>PASSWORD</b></label>
  <input type="password" name="password" required><br>
  
  <input type="submit" name="submit" required><br><br>
  </form>
 <?php
session_start();
//$_SESSION["pid"]=$_GET['pname'];
require_once 'details.php';

//making conection
$conn=new mysqli($db_hostname,$db_username,$db_password,$db_database);
if($conn->connect_error)
{
	die("CONNECTION FAILED".$conn->connect_error);
}

if(isset($_GET['submit']))
{
	$_SESSION["pname"]=$_GET['pname'];
	$sql="select * from pharmacy where pname='".$_GET['pname']."' and password='".$_GET['password']."'";
	$result=$conn->query($sql);
	if(mysqli_num_rows($result)>0)
	header('location: pharmacy_home.php');
    else
		echo "X LOGIN DENIED !! X";
}
$conn->close();
?>
</div>

<div class="footer">
  <p>NARD</p>
</div>

</body>
</html>

