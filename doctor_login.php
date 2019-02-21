<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="style1.css">
<head>
<title>DOCTOR SIGN IN</title>
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
 <img src="doctor_login_logo.jpg" style="width:10%">
  <h1><u>DOCTOR SIGN IN</u><h1>
  
  <form action="<?php $_PHP_SELF ?>" method="GET">
  <label for "dname"><b>DOCTOR NAME</b></label>
  <input type="text" name="dname" required><br>
  
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
	$_SESSION["dname"]=$_GET['dname'];
	$sql="select * from doctor where CONCAT(fname,' ',lname)='".$_GET['dname']."' and password='".$_GET['password']."'";
	$result=$conn->query($sql);
	if(mysqli_num_rows($result)>0)
	header('location: doctor_home.php');
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

