<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="style1.css">
<head>
<title>DOCTOR HOME</title>
</head>
<body>

<div class="topnav">
   <a href="doctor_login.php">SIGN OUT</a>
   <a href="">PATIENT HISTORY</a>
   <a href="prescription.php">PRESCRIPTION</a>
</div>

<div class="content">
<br><br>
<img src="doctor_home_logo.jpg" style="width:15%">
   <h1><b>WELCOME</b><h1>
   <?php
   session_start();
   echo "DOCTOR NAME : " .$_SESSION["dname"]. "<br>";
   $dname=$_SESSION["dname"];
   require_once 'details.php';
   //making conection
   $conn=new mysqli($db_hostname,$db_username,$db_password,$db_database);
   if($conn->connect_error)
   {
	die("CONNECTION FAILED".$conn->connect_error);
   }
    $sql="select * from doctor where CONCAT(fname,' ',lname)='".$_SESSION["dname"]."'";
	$result=$conn->query($sql);
	while($row = mysqli_fetch_assoc($result))
	{
		echo "SPECIALIZATION : ".$row['spec']."<br>";
		echo "STREET : ".$row['street']."<br>";
		echo "CITY   : ".$row['city']."<br>";
		echo "PINCODE: ".$row['pincode']."<br><br><br><br>";
	}
   ?>
</div>

<div class="footer">
  <p>NARD</p>
</div>

</body>
</html>

