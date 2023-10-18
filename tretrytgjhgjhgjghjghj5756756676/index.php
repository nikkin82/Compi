<?php 
include"php.php"; 
include"../script.php"; 
include("../db.php");
if(isset($_GET["id"])){$id=$_GET["id"];}
//if(isset($_GET["id"])){$id=$_GET["id"];}
session_start();
removeOrder();

if(isset($_GET["button"])){@$button=$_GET["button"];
					 }
if($_SESSION["id"] && $_SESSION["user_id"]){
$select=mysqli_query($con,"select * from users where id='{$_SESSION["id"]}' and user_id='{$_SESSION["user_id"]}'");
$fetch=mysqli_fetch_array($select);}
$_SESSION["user"]=$fetch["user"];
$_SESSION["user_d"]=$fetch["user_id"];
$user=$fetch["user"];
$user_id=$fetch["user_id"];
//echo $fetch["user_id"];
deleteUser(); 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<meta  name="viewport" content="width=device-width, initial-scale=1.0">
<title>Untitled Document</title>
	
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<link rel="stylesheet" href="../fonts.css">	
<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">	
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="style.css?<?php echo time(); ?>">
</head>

<body>
	<div class="container">
	<div class="sidebar">
		<div class="photo">			
<span id="user"class="material-symbols-outlined">
	shield_person</span>
<h1>გამარჯობა <br><mark class="mark"><?=$user;?></mark><br>აქ შეგიძლია იხილო შენი შეკვეთები</h1></div>
	<ul class="category">			
			<li><span class="material-symbols-outlined">captive_portal</span>
				<a href="home.php?action=login">საიტზე გადასვლა</a></li>			
			<li><span class="material-symbols-outlined">perm_contact_calendar</span><a href="?button=info">ინფორმაცია</a></li>
		<li><span class="material-symbols-outlined">shopping_cart</span><a href="index.php?button=basket">კალათა </a> 
		<div class="amount">
			<?=countProduct("profile");?></div></li>
		<li><span class="material-symbols-outlined">production_quantity_limits</span>
			<a href="?button=orders">ჩემი შეკვეთები</a><div class="amount"><?=countProduct("orders");?></div></li>			
		<li>
			<span class="material-symbols-outlined">settings_power</span>
			<a href="exit.php?user=<?=$_SESSION["user"];?>&user_id=<?=$_SESSION["user_id"];?>">გასვლა</a></li>		
		</ul>
		</div>
		<div class="content">		
				<?php 				
				switch(@$button){
						case "basket":cart(); break;
					case "info": info(); break;
						case"orders":orders(); break;}
				if(@$id){adminContent("../img");}
				?>	
		</div>
		</div></div>
	<?php include"../footer.php"; ?>
	</div>
<script src="//cdn.conveythis.com/javascript/conveythis-initializer.js"></script>
<script type="text/javascript">
	/*document.addEventListener("DOMContentLoaded", function(e) {
		ConveyThis_Initializer.init({
			api_key: "pub_63ea1d87bd0319a1020fd9d88c52d880"
		});
	});*/
</script>
</body>
</html>
