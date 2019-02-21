<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="style1.css">
<head>
<title>REGISTER DRUGS</title>
</head>
<body>

<div class="topnav">

  <a href="pharmacy_home.php">BACK TO PHARMACY HOME</a>
</div>

<div class="content">
  <img src="drug_logo.jpg" style="width:10%">
  <h1><b><u>REGISTER PROCURRED DRUGS</u></b><h1>
  
  <form action="<?php $_PHP_SELF ?>" method="GET">
  <label for "phname"><b>COMPANY NAME</b></label>
  <input type="text" name="phname" required><br>
  
  <label for "tradename"><b>TRADENAME</b></label>
  <input type="text" name="tradename" required><br>
  
  <label for "formula"><b>FORMULA</b></label>
  <input type="text" name="formula" required><br>
  
  <label for "mrp"><b>MRP (Rs)</b></label>
  <input type="number" name="mrp" required><br>
  
  <label for "SP"><b>PRICE BOUGHT AT (Rs)</b></label>
  <input type="number" name="SP" required><br>
  
  <label for "pdate"><b>DATE</b></label>
  <input type="date" name="pdate" required><br>
  
  <label for "quantity"><b>QUANTITY</b></label>
  <input type="number" name="quantity" required><br>
    
  <input type="submit" name="submit" required><br><br>
  </form>
  <br><br><br>
<?php
session_start();
$pname=$_SESSION["pname"];
require_once 'details.php';
//making conection
$conn=new mysqli($db_hostname,$db_username,$db_password,$db_database);
if($conn->connect_error)
{
	die("CONNECTION FAILED".$conn->connect_error);
}

if(isset($_GET['submit']))
{

    if($_GET['mrp']<='0')
		die("INVALID MRP !!");
	
	if($_GET['SP']<='0')
		die("INVALID PRICE BOUGHT AT !! ");
	
	if($_GET['quantity']<='0')
		die("INVALID QUANTITY ENTERED !! ");

    //getting pid
    $sql="select pid from pharmacy where pname='".$pname."'";
    $result=$conn->query($sql);
	$row=mysqli_fetch_array($result);
	//echo "ROW : ".$row['pid']."<br>";
	
	$sql="insert into drug_procurement(pid,phname,tradename,pdate,quantity,SP) values(".$row['pid'].",'".$_GET['phname']."','".$_GET['tradename']."','".$_GET['pdate']."',".$_GET['quantity'].",".$_GET['SP'].")";
	if($conn->query($sql)==TRUE)
	echo "PROCURMENT RECORD INSERTION SUCCESSFUL!!";
    else
	echo "FAILED TO INSERT RECORD!!";

    $sql="insert into drugs(phname,tradename,formula,mrp) values('".$_GET['phname']."','".$_GET['tradename']."','".$_GET['formula']."',".$_GET['mrp'].")";
	if($conn->query($sql)==TRUE)
	echo "DRUG RECORD INSERTION SUCCESSFUL!!";
    else
	echo "DRUG ALREADY REGISTERED";

}
$conn->close();
?>
</div>

<div class="footer">
  <p>NARD</p>
</div>

</body>
</html>

