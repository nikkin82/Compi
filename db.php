<?php 
$host="localhost";  
$name="niko82";  
$pass="paroli";
$table="comp";
@$con=mysqli_connect($host,$name,$pass,$table) or die(error_report());
mysqli_query($con,"SET NAMES 'utf8' ");


?>