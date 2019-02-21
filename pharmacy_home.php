<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="style1.css">
<head>
<title>PHARMACY HOME</title>
</head>
<body>

<div class="topnav">
  <a href="pharmacy_login.php">SIGN OUT</a>
</div>

<div class="content">
<br><br>
<img src="plogo1.png" style="width:15%">
   <h1><b>WELCOME</b><h1>
   <?php
   session_start();
   echo "PHARMACY NAME : " .$_SESSION["pname"]. "<br>";
   $pname=$_SESSION["pname"];
   require_once 'details.php';
   //making conection
   $conn=new mysqli($db_hostname,$db_username,$db_password,$db_database);
   if($conn->connect_error)
   {
	die("CONNECTION FAILED".$conn->connect_error);
   }
    $sql="select * from pharmacy where pname='".$pname."'";
	$result=$conn->query($sql);
	while($row = mysqli_fetch_assoc($result))
	{
		echo "STREET : ".$row['street']."<br>";
		echo "CITY   : ".$row['city']."<br>";
		echo "PINCODE: ".$row['pincode']."<br><br><br><br>";
	}
   ?>
   <a href="contract_register.php" class="button">REGISTER CONTRACT WITH PHARMACEUTICAL COMPANY</a><br>
   <a href="drug_register.php" class="button">REGISTER DRUGS PROCCURED</a><br>
</div>

<div class="footer">
  <p>NARD</p>
</div>

</body>
</html>

