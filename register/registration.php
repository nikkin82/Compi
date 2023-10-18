<?php
include"../db.php";

if(isset($_GET['error'])){@$error=$_GET['error'];}


function errors($errorquery,$txt){
global $error;
if(@$error==$errorquery){
	$text= "<span class='error'>".$txt."</span>";
	echo $text;
	}else{$text= " ";}
}

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>registration</title>
<link rel="stylesheet" href="style.css?<?php echo time(); ?>">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
	<link rel="stylesheet" href="../fonts.css">	
</head>

<body>
<h1 class="head"> ახალი მომხმარებლის დარეგისტრირება </h1>
<div id="main-wrapper">



<form action="redirect.php" method="post" id="reg-form">
<mark>მომხმარებლის სახელი: </mark><input type="text" name="username" placeholder="მომხმარებლის სახელი*"><?php 
errors("empty_user","შეავსეთ ველი");
errors("user_exists","ასეთი მომხმარებელი უკვე არსებობს");
errors("user_regex","სახელი არასწორად არის შეყვანილი");
errors("user_digit_check","არ შეიძლება მხოლოდ ციფრების გამოყენება");
?><hr>
<br>
<mark>ელ.ფოსტა: </mark><input type="text" name="mail" placeholder="ელფოსტა*" title="ელფოსტა">
<?php 
errors("empty_mail","შეავსეთ ველი");
errors("mail_regex","მეილი არასწორად არის შეყვანილი");
errors("mail_exists","ასეთი მეილი უკვე არსებობს");
?><hr>
<br>
<mark>პაროლი: </mark><input type="password" name="password" placeholder="პაროლი მინიმუმ 6 სიმბოლო*" 
							class="pass"title="პაროლი უნდა შეიცავდეს მინიმუმ 1 დიდ ასოს და ერთ ციფრს">
	
	<span id="eye"class="material-symbols-outlined">visibility</span>
<?php 
errors("empty_pass","შეავსეთ ველი"); 
errors("pass_length","პაროლი უნდა შეეგებოდეს მინიმუმ 6 სიმბოლოსგან"); 
errors("pass_regex","გამოიყენეთ მხოლოდ ციფრები და სიმბოლოები"); 
errors("pass_exists","ასეთი პაროლი უკვე არსებობს"); 
errors("pass_case_error","პაროლი უნდა შეიცავდეს მინიმუმ ერთ დიდ ასოს და ერთ ციფრს"); 
?>
<hr>

<br>
<mark>გაიმეორეთ პაროლი: </mark><input type="password" name="password2" placeholder="გაიმეორეთ პაროლი*"> 
<?php  errors("pass_match_error","პაროლები არ ემთხვევა"); 
 ?><hr>
 <br>
<input type="checkbox" name="checkbox" class="checkbox" ><strong class="checkspan">მე ვეთანხმები საიტის მოხმარების პირობებს</strong>
<strong class="str" style="font-size:11px;"><?php errors("empty_check","თქვენ არ დაეთანხმეთ საიტის პირობებს");  ?></strong>
<br>
<input type="submit" value="პროფილის შექმნა" name="submit">

</form>
<a href="../index.php">უკან გასვლა </a>
</div>
<script>
	var eye=document.querySelector(".material-symbols-outlined");
	var pass=document.querySelector(".pass");
	eye.onclick=()=>{
		
		pass.type="text";
		eye.innerHTML="visibility_off";
		
	}
var mark=document.getElementsByTagName("mark");
console.log(mark.length);
mark[3].style.cssText="margin-left:7%;";
mark[2].style.cssText="margin-left:20%;";
mark[0].style.cssText="margin-left:4.4%;";
mark[1].style.cssText="margin-left:18%;";
var span=document.getElementsByClassName("error");
span.style.cssText="color:red;";
//console.log(span.length);
</script>
</body>
</html>