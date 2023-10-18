<?php
session_start();
$db="users";
$page;
include"../db.php";
//if($_REQUEST[])

	
if( isset( $_POST["user"] ) and !empty( $_POST["user"]) ){ 
	
	$user = strip_tags(stripcslashes( $_POST["user"] )); 
}

if( empty( $_POST["user"] ) ){
header("Location: ../index.php?error=empty_user");
	exit();
}
	
if( isset( $_POST[ "pass" ] ) and !empty( $_POST["pass"] ) ){ $pass = strip_tags( $_POST["pass"] ); }

if( empty( $_POST[ "pass" ] ) ){
	
header("Location: ../index.php?error=empty_pass");
	
	exit();
}


$select_user = mysqli_query( $con,"SELECT user FROM $db WHERE user='$user' " );

$check_user = mysqli_num_rows( $select_user );
$check_id=mysqli_query($con,"select user_id from $db where user='$user'");
$print=mysqli_fetch_array( $check_id );
$check_id = mysqli_num_rows( $check_id );
$select_pass = mysqli_query( $con,"SELECT password FROM $db WHERE password='".sha1( $pass )."'" );
$check_pass = mysqli_num_rows( $select_pass );
if( $check_user == false ){ 
header("Location: ../index.php?error=user_error");
	exit();
}
if( $check_pass==false )
{ 
header("Location: ../index.php?error=pass_error");
	exit();

}
if( $check_user == TRUE and $check_pass == TRUE and $check_id==TRUE){ 
$select_id = mysqli_query( $con,"SELECT * FROM $db WHERE user='$user' and user_id='{$print["user_id"]}'" );
$show = mysqli_fetch_array( $select_id );
	$_SESSION["id"]=$show["id"];
	$_SESSION["user_id"]=$show["user_id"];
header( "Location: ../tretrytgjhgjhgjghjghj5756756676/index.php" );

}

?>