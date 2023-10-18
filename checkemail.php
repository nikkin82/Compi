<?php 

if(isset($_POST['email']) && !empty($_POST['email'])){	
	$email=$_POST['email'];
}else{
	echo "mail is empty";
	header("Refresh: 3, url=index.php?action=restore");
}
if(@$email){
	include"db.php";
	$check=mysqli_query($con,"select mail from users where mail='{$email}'");
	$num=mysqli_num_rows($check);
	if($num>0){
		
		header("Location: index.php");
			  }else{
		echo "such email doesn't exist";
		header("Refresh: 3, url=index.php?action=restore");
	}
}
?>