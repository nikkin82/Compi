<?php

include("connect.php");

if(isset($_GET["id"])){$id = $_GET["id"];}
if(isset($_GET["error"])){$error = $_GET["error"];}

function error_report($error_string,$text){
	global $error;
	if($error==$error_string){
	echo "<br><span style='color:red;margin-left:7%;font-size:12px;'>".$text."</span>";
			}
	
}
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>login</title>
<link rel="stylesheet" href="style.css?<?php echo time(); ?>" >
</head>

<body>
<div id="login-wrapper">
<h1 class="login-h1">სისტემაში შესვლა</h1>
<form method="post" action="login.php" id="login-form">
<img src="pics/Men-in-blue.png" class="user-image" alt="">
<input type="text" name="user" class="user" placeholder="მომხმარებლის სახელი*" value="">

	<?php error_report("empty_user","შეავსეთ ველი"); error_report("user_error","სახელი არასწორია"); ?>
  
<br>
<img src="pics/189-1894696_password-icon-login-png.png" class="pass-image" alt="">
<input type="password" name="pass" class="pass" placeholder="" >


<?php error_report("empty_pass","შეავსეთ ველი"); error_report("pass_error","პაროლი არასწორია");
?>	
<br>
<input type="checkbox" class="check-box" name="check-box">
<span class="check-span">დაიმახსოვრე პაროლი</span>
<a href="?id=password_recovery" class="passrecovery">დაგავიწყდა პაროლი?</a>
<br>
<input type="submit" class="login-submit" value="შესვლა"><a href="registration.php" class="login-a">რეგისტრაცია</a>
</form>
<br>

</div>

<?php if(isset($id) && @$id=="password_recovery"){
	echo "<div id=\"forma\"><form action=\"findpass.php\" method='post' >
	<h1>პაროლის აღდგენა</h1>
	<input type=\"text\" name=\"mail\" placeholder=\"შეიყვანეთ თქვენი მეილი\">	
	<input type=\"submit\" value=\"გაგზავნა\"><span onClick=\"Hide()\" class='close' >X</span>
	</form></div>";
}else{
	echo " ";} ?>
    <script>

function Hide(){
	var x=document.getElementsByClassName("close");
	var form=document.getElementById("forma");
	
	form.style.display="none";
	
	}
</script>
</body>
</html>