<?php 
session_start();
//echo $_SESSION["user"];
//echo $_SESSION["user_id"];
unset($_SESSION["user_id"]);
unset($_SESSION["user"]);
session_destroy();
header("Location: ../index.php");
//header("Refresh: 3,url=../index.php");


?>