<?php 


include"script.php";
include"../db.php";
if(isset($_GET["id"])){$id=$_GET["id"];}
session_start();
if(isset($_GET["search"])){$search=$_GET["search"];}
if(isset($_SESSION['user'])){$user=$_SESSION['user'];}
$user_id= session_id();
addProduct();
updateORDERS();
$query=mysqli_query($con,"select * from profile where username='{$_SESSION['user']}'");
$count=mysqli_num_rows($query);
?>
<!doctype html>
<html>
<script src='//fw-cdn.com/10868618/3640122.js' chat='true'></script>	
<head>
<meta charset="utf-8">
	<meta  name="viewport" content="width=device-width, initial-scale=1.0">
<title>COMPi</title>
	
	<link rel="stylesheet" href="../style.css?<?php echo time(); ?>">
	<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<link rel="stylesheet" href="../fonts.css">	
	<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>	
	<!--<div class="plugins"></div>-->
	<div id="container">
	<div class="grid banner">
		<div class="nav">
			<div class="saxli">
		<a href="home.php" class="home"><img src="../img/saxli.png" alt=""></a></div>
			<div id="icons">		
			<!--<span class="material-symbols-outlined">contact_page</span>--></a>
			<a href="index.php?button=orders" class="kalata"><span id="amount"class="material-symbols-outlined">
production_quantity_limits
</span><span class="amount"><?=countproduct("orders");?></span></a>
			<a href="index.php?button=basket" class="kalata"><span id="amount"class="material-symbols-outlined">
shopping_cart
</span><span class="amount"><?=$count;?></span></a>
			<a href="javascript:void()" class="contact"></a>
		
			<a href="javascript:void()" class="search">
			<span class="material-symbols-outlined">search</span>
		</a>
		</div>
		</div>
		<form action="" class="zieba hide">
		<input type="text" class="text" name="search" placeholder="პროდუქტის ძიება..."><input type="submit" value=""class="submit">
		</form>
		
		<div class="login2">
		<button class="scroll2 "><span class="material-symbols-outlined">
account_circle
</span> &nbsp;<?php echo @$user; ?></button>
		<div class="form">
			<br>
		<a href="index.php">პროფილის ნახვა</a> 
			<br>
			<a href="exit.php?user=<?=$_SESSION["user"];?>&user_id=<?=$_SESSION["user_id"];?>">გასვლა</a>		    
		</div>
		</div>
		
		
		<div class="box1">
		<div class="images img1" data-type="1"></div>
		<div class="images img2"></div>
		<div class="images img3"></div>
		<div class="images img4"></div>		
		<div class="images img5"></div>
		<div class="images img6"></div>
		<div class="images img7"></div>
		<div class="images img8"></div>
		<div class="images img9"></div>
		<div class="images img10"></div>
		<div class="images img11"></div>
		<div class="images img12"></div>
		</div>
		
		</div>
		<div class="grid sidebar">
			<h1><img src="../img/icons/0.png" alt="">კატეგორიები</h1>
		<ul class="list">
			<?php 		
			sidebar();
			?>					
			</ul>
		
		</div>
		<div class="grid content">
			<div class="stats">
				<div>სექცია<span class="material-symbols-outlined">double_arrow</span>
					<?php 
				category();
				?>
			</div>
				<div class="bars">
				<?php if(!@$id){
					numbers();
                }else{echo "";} ?>
				</div>
			</div>				 
			<?php 
				if(!@$section && !@$id){
					defaultdata();
						 }else{
					if($section && !@$id){
						if(is_array($combined)){
				foreach($combined as $index=>$value){
				switch($section){					
					case $index: databysections($index); break;
					//default: defaultdata(); break;
				}
				}}
					}else{
						if(@$id && !$section){
						content("../img");
					}
					}
				}?>		 
			<div class="pages">
				<ul>
				
				</ul>
			</div>
		</div>		
	</div>
	
	<?php 
	include"../footer.php";
	include"java.php";	
	?>	
<script src="//cdn.conveythis.com/javascript/conveythis-initializer.js"></script>
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(e) {
		ConveyThis_Initializer.init({
			api_key: "pub_63ea1d87bd0319a1020fd9d88c52d880"
		});
	});
</script>
</body>
</html>