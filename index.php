<?php 
include"script.php";
include"db.php";
if(isset($_GET["id"])){$id=$_GET["id"];}
if(isset($_GET["search"])){$search=$_GET["search"];}
?>
<!doctype html>
<html>
	<script
src='//fw-cdn.com/10868618/3640122.js'
chat='true'>
</script>	
<head>
<meta charset="utf-8">
	<meta  name="viewport" content="width=device-width, initial-scale=1.0">
<title>COMPI</title>
	<?php include"header.php"; 
	
	?>
	<link rel="stylesheet" href="style.css?<?php echo time(); ?>">
	<link rel="stylesheet" href="fonts.css">	
</head>
<body>	
	
	<?php if(@$action=="restore"){
	passrestore();
}   ?>
	
	<div id="container">
	<div class="grid banner">
		<div class="nav">
			<div class="saxli">
		<a href="index.php" class="home"><img src="img/saxli.png" alt=""></a>
			</div>
			<div id="icons">
		<a href="javascript:void()" class="contact"></a>
		<a href="javascript:void()" class="search"><span class="material-symbols-outlined">search</span></a>
			</div>
		</div>
		<form action="" class="zieba hide">
		<input type="text" class="text" name="search" 
			   placeholder="პროდუქტის ძიება...">
			<input type="submit" value=""class="submit">
		</form>		
		<div class="errors">
		<?php error_report("empty_user","შეავსეთ ველი"); 
			error_report("user_error","არასწორი მომხმარებელი"); 
			?>
		</div>
			<div class="errors2">
				<?php error_report2("empty_pass","შეავსეთ ველი"); 
				error_report2("pass_error","პაროლი არასწორია");
				?>
		</div>  
		<div class="login">
		<button class="scroll ">
			<span class="material-symbols-outlined">account_circle</span> 
			&nbsp;&nbsp;პროფილში შესვლა</button>
		<div class="form"> 
		<form action="register/login.php" method="post">
		<input type="text" name="user"class="user" value=""placeholder="მომხმარებელი">
		<br>
			<input type="password" name="pass"class="pass"
				   placeholder="password">			
			<br>
			<input type="submit" class="enter" value="შესვლა">
		</form><a href="?action=restore">პაროლის აღდგენა</a> |
			<a href="register/registration.php">რეგისტრაცია</a>		    
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
			<h1><img src="img/icons/0.png" alt="">კატეგორიები</h1>
		<ul class="list">
			<?php 		
			sidebar("index.php","img");
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
				<?php  
					if(!@$id){
					numbers();
					}else{
						echo "";
					}
					?>				
				</div>
			</div>
				
			<?php 
					
				if(!@$section && !@$id){
					defaultdata();
					}else{
					if($section && !@$id){
				foreach($combined as $index=>$value){
				switch($section){					
					case $index: databysections($index); break;
					//default: defaultdata(); break;
				}
				}
					}else{
						if(@$id){
						content("img");
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
	include"footer.php";
	
	include"java.php";?>
	<!-- ConveyThis: https://www.conveythis.com/   -->
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