<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="style1.css">
<head>
<title>PRESCRIPTION</title>
</head>
<body>

<div class="topnav">

  <a href="doctor_home.php">BACK TO DOCTOR HOME</a>
</div>

<div class="content">
  <img src="prescription_logo.jpg" style="width:10%">
  <h2><u>Enter the following information</u><h2>
  
  <form action="<?php $_PHP_SELF ?>" method="GET">
  
  <p><u><strong> Enter patient details here </strong></u></p>
  <label for "fname"><b>FIRST NAME</b></label>
  <input type="text" name="fname" required><br>
  
  <label for "lname"><b>LAST NAME</b></label>
  <input type="text" name="lname" required><br>
  
  <label for "street"><b>STREET</b></label>
  <input type="text" name="street" required><br>
  
   <label for "city"><b>CITY</b></label>
  <input type="text" name="city" required><br>
  
   <label for "pin"><b>PIN CODE</b></label>
  <input type="text" name="pin" required><br>
  
  <label for "contact"><b>CONTACT</b></label>
  <input type="number" name="contact" required><br>
  
  <label for "dob"><b>DATE OF BIRTH</b></label>
  <input type="date" name="dob" required><br>
  
  <label for "physician"><b>HOME PHYSICIAN</b></label>
  <input type="text" name="physician" required><br>
  
  <p><u><strong> Enter prescription details here </strong></u></p>
  <label for "pdate"><b>DATE CONSULTED</b></label>
  <input type="date" name="pdate" required><br>
  
  <label for "symptom"><b>SYMPTOMS</b></label>
  <input type="text" name="symptom" required><br>
  
  <p><u><strong> Enter drugs prescribed </strong></u></p>
  
  <h3><u>DRUG 1</u><h3>
  <label for "phname1"><b>COMPANY NAME</b></label>
  <input type="text" name="phname1"><br>
  
  <label for "tradename1"><b>TRADE NAME</b></label>
  <input type="text" name="tradename1"><br>
  
  <label for "quantity1"><b>QUANTITY</b></label>
  <input type="text" name="quantity1"><br>
  
  <h3><u>DRUG 2</u><h3>
  <label for "phname2"><b>COMPANY NAME</b></label>
  <input type="text" name="phname2"><br>
  
  <label for "tradename2"><b>TRADE NAME</b></label>
  <input type="text" name="tradename2"><br>
  
  <label for "quantity2"><b>QUANTITY</b></label>
  <input type="text" name="quantity2"><br>
  
  <h3><u>DRUG 3</u><h3>
  <label for "phname3"><b>COMPANY NAME</b></label>
  <input type="text" name="phname3"><br>
  
  <label for "tradename3"><b>TRADE NAME</b></label>
  <input type="text" name="tradename3"><br>
  
  <label for "quantity3"><b>QUANTITY</b></label>
  <input type="text" name="quantity3"><br>
  
  <h3><u>DRUG 4</u><h3>
  <label for "phname4"><b>COMPANY NAME</b></label>
  <input type="text" name="phname4"><br>
  
  <label for "tradename4"><b>TRADE NAME</b></label>
  <input type="text" name="tradename4"><br>
  
  <label for "quantity4"><b>QUANTITY</b></label>
  <input type="text" name="quantity4"><br>
  
  
  
  <input type="submit" name="submit" required><br><br>
  </form>
  <br><br><br>
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

if(isset($_GET['submit']))
{
	if($_GET['quantity1']=='0')
	die("INVALID QUANTITY");

    //getting did of doctor
    $sql="select did from doctor where where CONCAT(fname,' ',lname)='".$dname."'";
    $result=$conn->query($sql);
	$row=mysqli_fetch_array($result);
	$did=$row['did'];
	echo "DOCTOR ID : ".$did." ";
	
	//check if patiend record already exists
	$sql="select patient_id from patient where fname='".$_GET['fname']."' and lname='".$_GET['lname']."' and street='".$_GET['street']."' and pincode=".$_GET['pin'];
	$result=$conn->query($sql);
	if(mysqli_num_rows($result)>0){
		echo "PATIENT RECORD EXISTS !!";
		$row=mysqli_fetch_array($result);
	$patient_id=$row['patient_id'];}
	else{
	//inserting patient record
	$sql="insert into patient(fname,lname,street,city,pincode,dob,contact,physician) values('".$_GET['fname']."','".$_GET['lname']."','".$_GET['street']."','".$_GET['city']."',".$_GET['pin'].",'".$_GET['dob']."',".$_GET['contact'].",'".$_GET['physician']."')";
	if($conn->query($sql)==TRUE)
	echo " PATIENT RECORD INSERTION SUCCESSFUL!!";
    else
	echo "FAILED TO INSERT PATIENT RECORD!!";

    //getting patient_id of patient
    //$sql="select patient_id from patient where fname='".$_GET['fname']."' and lname='".$_GET['lname']."' and contact=".$_GET['contact']." and dob='".$_GET['dob']."'";
    $sql="SELECT patient_id FROM patient ORDER BY patient_id DESC LIMIT 1";
	$result=$conn->query($sql);
	$row=mysqli_fetch_array($result);
	$patient_id=$row['patient_id'];
    echo "PATIENT ID : ".$patient_id." ";}

	//inserting prescription record
    $sql="insert into prescription(pdate,did,patient_id,symptom) values('".$_GET['pdate']."',".$did.",".$patient_id.",'".$_GET['symptom']."')";
	if($conn->query($sql)==TRUE)
	echo " PRESCRIPTION RECORD INSERTION SUCCESSFUL!!";
    else
	echo "FAILED TO INSERT PRESCRIPTION RECORD!!";
    
	//getting prescription number
	$sql="select pres_no from prescription where pdate='".$_GET['pdate']."' and did=".$did." and patient_id=".$patient_id;
	$result=$conn->query($sql);
	$row=mysqli_fetch_assoc($result);
	$pres_no=$row['pres_no'];

	//if drug1 is entered
	if(isset($_GET['phname1']) && isset($_GET['tradename1']))
	{
    $sql="insert into drugs_prescribed(pres_no,phname,tradename,quantity) values(".$pres_no.",'".$_GET['phname1']."','".$_GET['tradename1']."',".$_GET['quantity1'].")";
	if($conn->query($sql)==TRUE)
	echo " DRUG 1 RECORD INSERTION SUCCESSFUL!!";
    else
	echo "FAILED TO INSERT DRUG 1 RECORD!!";
	}
	
	//if drug2 is entered
	if(isset($_GET['phname2']) && isset($_GET['tradename2']))
	{
    $sql="insert into drugs_prescribed(pres_no,phname,tradename,quantity) values(".$pres_no.",'".$_GET['phname2']."','".$_GET['tradename2']."',".$_GET['quantity2'].")";
	if($conn->query($sql)==TRUE)
	echo " DRUG 2 RECORD INSERTION SUCCESSFUL!!";
    else
	echo "FAILED TO INSERT DRUG 2 RECORD!!";
	}
	
	//if drug3 is entered
	if(isset($_GET['phname3']) && isset($_GET['tradename3']))
	{
    $sql="insert into drugs_prescribed(pres_no,phname,tradename,quantity) values(".$pres_no.",'".$_GET['phname3']."','".$_GET['tradename3']."',".$_GET['quantity3'].")";
	if($conn->query($sql)==TRUE)
	echo " DRUG 3 RECORD INSERTION SUCCESSFUL!!";
    else
	echo "FAILED TO INSERT DRUG 3 RECORD!!";
	}
	
	//if drug 4 is entered
	if(isset($_GET['phname4']) && isset($_GET['tradename4']))
	{
    $sql="insert into drugs_prescribed(pres_no,phname,tradename,quantity) values(".$pres_no.",'".$_GET['phname4']."','".$_GET['tradename4']."',".$_GET['quantity4'].")";
	if($conn->query($sql)==TRUE)
	echo " DRUG 4 RECORD INSERTION SUCCESSFUL!!";
    else
	echo "FAILED TO INSERT DRUG 4 RECORD!!";
	}

}
$conn->close();
?>


</body>
</html>

