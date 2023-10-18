<?php
include"connect.php";
session_start();
 define("br","<br>");
if(isset($_GET["id"])){$id=$_GET["id"];}

if(isset($_POST["sender"])){@$sender=$_POST["sender"];}

if(isset($_POST["receiver"])){@$receiver=$_POST["receiver"];}
if(isset($_POST["message"])){@$message=$_POST["message"];}

$select=mysqli_query($db,"SELECT user FROM users WHERE id='$id'");
$output=mysqli_fetch_array($select);

$user1=mysqli_query($db,"select sender from comments where sender!='{$output['user']}'");
$user2=mysqli_query($db,"select sender from comments where sender='{$output['user']}'");
$user3=mysqli_query($db,"select receiver from comments where receiver!='{$output['user']}'");
$user4=mysqli_query($db,"select receiver from comments where receiver='{$output['user']}'");



$out1=mysqli_fetch_array($user1);
$out2=mysqli_fetch_array($user2);
$out3=mysqli_fetch_array($user3);
$out4=mysqli_fetch_array($user4);
$arr=[$out1,$out2,$out3,$out4];
$sentmsg=mysqli_query($db,"select message from comments where sender='{$out2['sender']}' and receiver!='{$out4['receiver']}'");
$recmsg=mysqli_query($db,"select message from comments where sender='{$out1['sender']}' and receiver!='{$out3['receiver']}'");
$sent=mysqli_fetch_array($sentmsg);
$received=mysqli_fetch_array($recmsg);
var_dump($arr).br;

/*$select=mysql_query("SELECT user FROM users WHERE user='$receiver'");
$output=mysql_fetch_array($select);*/
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>profile</title>
</head>

<body>
<div id="message-wall">
<span class="user"><?php echo "Hello ".$output['user']; 
?>
</span>



<div class="message">
<?php  
    
   
    foreach($arr[0] as $mas){echo $mas.br;}
   /* do{echo 'receiver '.$out1['sender'].br; }while($out1=mysqli_fetch_array($user1));
    do{echo 'sender '.$out2['sender'].br;}while($out2=mysqli_fetch_array($user2));
     do{echo 'receiver2 '.$out3['receiver'].br;}while($out2=mysqli_fetch_array($user3));
     do{echo 'sender2 '.$out4['receiver'].br;}while($out2=mysqli_fetch_array($user4));
     do{echo 'sent message '.$sent['message'].br;}while($sent=mysqli_fetch_array($sentmsg));
    do{echo 'received message '.$received['message'].br;}while($received=mysqli_fetch_array($recmsg));*/
    ?>
</div>
</div>
<form method="post" action="">
<input type="text" name="receiver"> receiver
<input type="hidden" name="sender" value="<?=$output['user']; ?>">
<br>
<textarea name="message"  cols="30" rows="10"></textarea>
<br>
    
<input type="submit" value="send">
</form>

<?php //session_destroy(); 

if(@$receiver and @$sender and @$message){
	$insert=mysqli_query($db,"INSERT INTO comments(receiver,sender,message)
	VALUES('$receiver','$sender','$message')");
	if($insert==true){echo "message sent";}
	 }else{echo "error";}
?>
<a href="index.php">exit</a>
</body>
</html>