<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="style1.css">
<head>
<title>REGISTER PHARMACY</title>
</head>
<body>

<div class="topnav">

  <a href="admin_home.php">BACK TO ADMIN HOME</a>
</div>

<div class="content">
  <img src="pharmacy_logo.jpg" style="width:10%">
  <h1><u>REGISTER NEW PHARMACY</u><h1>
  
  <form action="<?php $_PHP_SELF ?>" method="GET">
  <label for "pname"><b>PHARMACY NAME</b></label>
  <input type="text" name="pname" required><br>

  <label for "street"><b>STREET</b></label>
  <input type="text" name="street" required><br>
  
   <label for "city"><b>CITY</b></label>
  <input type="text" name="city" required><br>
  
   <label for "pincode"><b>PIN CODE</b></label>
  <input type="text" name="pin" required><br>
  
  <input type="submit" name="submit" required><br><br>
  </form>
  <br><br><br>
<?php
require_once 'details.php';
//making conection
$conn=new mysqli($db_hostname,$db_username,$db_password,$db_database);
if($conn->connect_error)
{
	die("CONNECTION FAILED".$conn->connect_error);
}

if(isset($_GET['submit']))
{

	$sql="insert into pharmacy(pname,street,city,pincode) values('".$_GET['pname']."','".$_GET['street']."','".$_GET['city']."',".$_GET['pin'].")";
	if($conn->query($sql)==TRUE)
	echo "RECORD INSERTION SUCCESSFUL!!";
    else
	echo "FAILED TO INSERT RECORD!!";

}
$conn->close();
?>
</div>

<div class="footer">
  <p>NARD</p>
</div>

</body>
</html>


