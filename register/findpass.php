<?php
if(isset($_POST["mail"]) && !empty($_POST["mail"])){
	$mail = $_POST["mail"];
	}
	if($mail){
		require_once("connect.php");
		$select = mysqli_query($db,"SELECT * FROM users WHERE mail='$mail' ");
		$num = mysqli_num_rows($select);
		if($num>0){$show=mysqli_fetch_array($select);
		$to="To:".$mail;
		$subject="your password recovery";
		$message="your password is".$show["password"];
		$headers= 'From: mail.mydomain.com';
		
		mail($to, $subject, $message, $headers);
		
		echo $show["password"];
		echo "your mail was sent";
		header("Refresh:15, url=index.php");
		}else{echo "such mail wasnt found";}
		}

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>