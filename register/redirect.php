<?php 
session_start();
//include"classes.php";
require"classes.php";
include("censored.php");
//FILTER_SANITIZE_STRIPPED
//FILTER_SANITIZE_URL
//$ereg=ereg($var);
// & $matches simboloebis masiivi
include"../db.php";

if( isset( $_POST[ "submit" ] ) ){
	if( isset( $_POST[ "username" ] ) && !empty( $_POST[ "username" ] ) ){	
	$username = strip_tags(stripcslashes( trim( $_POST[ "username" ] ) ) );
		$_SESSION["username"]=$username;
		$user_id=session_id();
	}				
	if( isset( $_POST["mail"] ) && !empty( $_POST["mail"] ) && preg_match( "/@/",$_POST["mail"] ) ){
	@$mail = strip_tags( stripcslashes( $_POST["mail"] ) );
	}	
	if( isset( $_POST[ "password" ] ) && !empty( $_POST["password"] ) ){
	$password = htmlspecialchars( stripcslashes( strip_tags( $_POST["password"] ) ) );
	}	
	if( isset( $_POST[ "password2" ]) && !empty( $_POST[ "password2" ] ) ){	
	$password2 = htmlspecialchars( strip_tags( stripcslashes( $_POST["password2"] ) ) );		
	}		
	
	
	@$select_user = mysqli_query( $con,"SELECT user FROM users WHERE user='$username'" );
	@$select_pass = mysqli_query( $con,"SELECT password FROM users WHERE password='".sha1( $password )."'" ); 
	@$select_mail = mysqli_query( $con,"SELECT mail FROM users WHERE mail='$mail'" );
	@$check_user = mysqli_num_rows( @$select_user );
	@$check_pass = mysqli_num_rows( @$select_pass );
	@$check_mail = mysqli_num_rows( @$select_mail );		
		
		
	
	//USERNAME VERIFICATION
	
	if( empty( $_POST[ "username" ] )){
		header("Location: registration.php?error=empty_user" );
		exit();
	}		
	$user_check = preg_match_all( '/[\W]/',$_POST[ "username" ]);
	if( $user_check == true ){	
		header("Location: registration.php?error=user_regex");	
		exit();		
	}			
	if( $check_user == true ){
		header("Location: registration.php?error=user_exists" );
		exit();
	}					
	if( empty( $_POST["mail"] ) ){
		header("Location: registration.php?error=empty_mail" );
		exit();
	}
		
	
	//MAIL VERIFICATION
	
	
	if( $check_mail == true ){
		header("Location: registration.php?error=mail_exists" );
		exit();
	}		
	$validate_mail = filter_var( $_POST[ "mail" ],FILTER_VALIDATE_EMAIL,FILTER_SANITIZE_EMAIL);	
	if( $validate_mail == false ){
		header("Location: registration.php?error=mail_regex" );
		exit();
	}	
		
		
	
	//PASSWORD VERIFICATION
	
	if( empty( $_POST[ "password" ] )){
		header("Location: registration.php?error=empty_pass" );
		exit();
	}		
		
	if( strlen( $password )<6 ){
		header("Location: registration.php?error=pass_length" );
		exit();
	}			
	$pass_check = preg_match_all('/[\W]/',$_POST[ "password" ]);
	if( $pass_check == true ){
		header("Location: registration.php?error=pass_regex" );
		exit();
	}					
	$check_pass_case = preg_match_all( '/[A-Z0-9]/',$_POST[ "password" ] );
	if( $check_pass_case == false ){
	header("Location: registration.php?error=pass_case_error" );
	exit();
	}	
	if( $password !== @$password2 ){
	header("Location: registration.php?error=pass_match_error" );
	exit();
	}	
	if( $check_pass == true ){	
		header("Location: registration.php?error=pass_exists" );
		exit();
	}
	
		
	
	//CHECKBOX VERIFICATION	
	
	
	if(isset($_POST["checkbox"]) && !empty($_POST["checkbox"])){
	@$check=$_POST["checkbox"];
	}		
	if(empty($_POST["checkbox"])){
		header("Location: registration.php?error=empty_check" );
		exit();
	}		
		
	
	
if($username && $user_id && @$mail && $password  && $password==$password2 && $check && $check_user == false && 	$check_pass == false && 
	$check_mail == false &&  $check_pass_case == true && $pass_check == false && $user_check == false && $validate_mail == true ){		
		$insert = mysqli_query( $con,"INSERT INTO users(user,user_id,mail,password) 
		VALUES('$username','$user_id','$mail','".sha1($password)."')");
		if($insert == true){ echo "მონაცემი წარმატებით დაემატა";
		//$_SESSION[ "username" ] = $username;
		$_SESSION[ "password" ] = $password;		
		header( "Refresh:1, url=../index.php" );
		}else{echo "data didn't add";}
		}
	}

?>
