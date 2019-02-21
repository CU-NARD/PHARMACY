<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="style1.css">
<head>
<title>ADMIN HOME</title>
</head>
<body>

<div class="topnav">
  <a href="admin_login.php">SIGN OUT</a>
</div>

<div class="content">
<br><br>
<img src="admin_logo.png" style="width:8%">
   <h1>WELCOME ADMIN<h1>
   <a href="doctor_register.php" class="button">REGISTER DOCTOR</a>
   <a href="pharmacy_register.php" class="button">REGISTER PHARMACY</a>
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

