<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="style1.css">
<head>
<title>REGISTER DOCTOR</title>
</head>
<body>

<div class="topnav">

  <a href="admin_home.php">BACK TO ADMIN HOME</a>
</div>

<div class="content">
  <img src="doctor_logo.png" style="width:10%">
  <h1><u>REGISTER NEW DOCTOR</u><h1>
  
  <form action="<?php $_PHP_SELF ?>" method="GET">
  <label for "fname"><b>FIRST NAME</b></label>
  <input type="text" name="fname" required><br>
  
  <label for "lname"><b>LAST NAME</b></label>
  <input type="text" name="lname" required><br>
  
  <label for "street"><b>STREET</b></label>
  <input type="text" name="street" required><br>
  
   <label for "city"><b>CITY</b></label>
  <input type="text" name="city" required><br>
  
   <label for "pincode"><b>PIN CODE</b></label>
  <input type="text" name="pin" required><br>
  
  <label for "contact"><b>CONTACT</b></label>
  <input type="text" name="contact" required><br>
  
  <label for "years"><b>YEARS OF EXPERIENCE</b></label>
  <input type="number" name="years" required><br>
  
  <label for "spec"><b>SPECIALIZATION</b></label>
  <input type="text" name="spec" required><br>
  
   <label for "email"><b>EMAIL</b></label>
  <input type="text" name="email" required><br>
  
  <vaadin-date-picker label="DATE OF BIRTH" value="1980-08-14">
  </vaadin-date-picker>
  
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
	if($_GET['years']>'60')
	die("INVALID YEARS OF EXPERIENCE");

	$sql="insert into doctor(fname,lname,street,city,pincode,contact,years,spec,email) values('".$_GET['fname']."','".$_GET['lname']."','".$_GET['street']."','".$_GET['city']."',".$_GET['pin'].",'".$_GET['contact']."',".$_GET['years'].",'".$_GET['spec']."','".$_GET['email']."')";
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

