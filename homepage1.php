<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
.topnav
{
	overflow: hidden;
	background-color: Navy;
}
.topnav a
{
	float: right;
	background-color: Navy;
	color: silver;
	text-decoration: none;
	padding: 15px 15px;
}
.topnav a:hover
{
	background-color: white;
}
.content
{
	background-color: white;
	padding: 100px 100px;
	color: navy;
	height: 300px;
}
.footer
{
	padding: 10px;
	color: white;
	background-color: navy;
}
</style>
</head>
<body>
<div class="topnav">
  <a href="pharmacy_login.php">Pharmacy login</a>
  <a href="doctor_login.php">Doctor login</a>
  <a href="admin_login.php">Admin login</a>
</div>
<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="pic6.jpg" style="width:130% height: 15%">
  <div class="text">PHARMACIES</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="pic5.jpg" style="width:75%">
  <div class="text">DOCTORS AT YOUR SERVICE</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="pic7.jpg" style="width:65%">
  <div class="text">24 x 7 SERVICE</div>
</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>
<div class="footer">
  <p>NARD</p>
</div>
</body>
</html> 

<?php
require_once 'details.php';
//making conection
$conn=new mysqli($db_hostname,$db_username,$db_password);
if($conn->connect_error)
{
	die("CONNECTION FAILED".$conn->connect_error);
}

$sql="create database pharmacydb";
if($conn->query($sql)==FALSE)
	//echo "FAILED TO CREATE DATABASE";

$sql="use pharmacydb";
if($conn->query($sql)==FALSE)
	echo "FAILED TO SELECT DATABASE";

$sql="create table login
(
username varchar(10) primary key,
password varchar(10)
)";
if($conn->query($sql)==FALSE)
	//echo "FAILED TO CREATE TABLE LOGIN";

$sql="insert into login(username,password) values ('admin','nard')";
if($conn->query($sql)==FALSE)
	//echo "FAILED TO INSERT RECORD IN TABLE LOGIN";

$sql="create table doctor
(
did int auto_increment primary key,
fname varchar(20),
lname varchar(10),
street varchar(20),
city varchar(20),
pincode int(6),
contact varchar(20),
years int(2),
spec varchar(20),
email varchar(20),
password varchar(25) GENERATED ALWAYS AS (CONCAT(fname,substring(spec, 1, 3),did))
)";
if($conn->query($sql)==FALSE)
	//echo "FAILED TO CREATE TABLE doctor";

//creating table pharmacy
$sql="create table pharmacy
(
pid int auto_increment primary key,
pname varchar(20) unique,
street varchar(20),
city varchar(20),
pincode int(6),
password varchar(25) GENERATED ALWAYS AS (CONCAT('P',substring(pname, 1, 3),pid))
)";
if($conn->query($sql)==FALSE)
	//echo "FAILED TO CREATE TABLE pharmacy";

//creating table pharmaceutical company
$sql="create table pharma_company
(
phname varchar(20) primary key,
contact int(12)
)";
if($conn->query($sql)==FALSE)
	//echo "FAILED TO CREATE TABLE pharma_company";

$sql="create table contract
(
contract_id int auto_increment primary key,
phname varchar(20),
pname varchar(20),
start_date date,
end_date date,
sname varchar(20),
foreign key (phname) references pharma_company(phname),
foreign key (pname) references pharmacy(pname)
)";

if($conn->query($sql)==FALSE)
	//echo "FAILED TO CREATE TABLE contract";

//creating table patient
$sql="create table patient
(
patient_id int auto_increment primary key,
fname varchar(20),
lname varchar(20),
street varchar(20),
city varchar(20),
pincode int(12),
dob date,
contact int(12),
physician varchar(20)
)";

if($conn->query($sql)==FALSE)
	//echo "FAILED TO CREATE TABLE patient";

//creating table prescription
$sql="create table prescription
(
pres_no int auto_increment primary key,
pdate date,
did int,
patient_id int,
symptom varchar(30),
foreign key (did) references doctor(did),
foreign key (patient_id) references patient(patient_id)
)";

if($conn->query($sql)==FALSE)
	//echo "FAILED TO CREATE TABLE prescription";

//creating table drugs
$sql="create table drugs
(
phname varchar(20),
tradename varchar(20),
formula varchar(30),
mrp int(3),
foreign key (phname) references pharma_company(phname),
primary key (phname,tradename)
)";
if($conn->query($sql)==FALSE)
	//echo "FAILED TO CREATE TABLE drugs";

//creating table drugs_prescribed
$sql="create table drugs_prescribed
(
pres_no int,
phname varchar(20),
tradename varchar(20),
quantity int(2),
primary key (pres_no,phname,tradename),
foreign key (phname,tradename) references drugs(phname,tradename),
foreign key (pres_no) references prescription(pres_no)
)";
if($conn->query($sql)==FALSE)
	//echo "FAILED TO CREATE TABLE drugs_prescribed";

//creating table drug_procurement
$sql="create table drug_procurement
(
pid int,
phname varchar(20),
tradename varchar(20),
pdate date,
quantity int(4),
SP int(4),
primary key (pid,phname,tradename,pdate)
)";
if($conn->query($sql)==FALSE)
	//echo "FAILED TO CREATE TABLE drug_procurement";
?>
