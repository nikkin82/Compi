<?php 

function upd(){
	include"../db.php";		
	global $action,$user,$id,$print;
	if(@$action=="delete"){		
		mysqli_query($con,"delete from profile where product_id='$id'");
		?>
<script>
location.assign("index.php?button=basket");
</script>
<?php
		}
	if(isset($_GET["amount"])){$amount=$_GET["amount"];}
	if(isset($_GET["lastprice"])){$lastprice=$_GET["lastprice"];}
	if(isset($_GET['number'])){$number=$_GET['number'];}	
	$checkuser=mysqli_query($con,"select * from users where user='{$user}'");
	$printuser=mysqli_fetch_array($checkuser);	
	$checkproduct=mysqli_query($con,"select * from data where id='{$id}'");
	$printproduct=mysqli_fetch_array($checkproduct);
	if(@$action=="buy"){		
		mysqli_query($con,"insert into orders(product_id,product_name,username,mail,totalprice,amount) values('$id','{$printproduct['title']}','$user','{$printuser['mail']}','$lastprice','$amount') ");		 
		?>
<script>
location.assign("index.php?button=orders");
</script>
<?php
	}	
}



function adminContent($src){
	include"../db.php";		
	global $action,$user,$id;
	if(isset($_GET["id"])){$id=$_GET["id"];}	
	$query=mysqli_query($con,"select * from data where id='{$id}'");
	$print=mysqli_fetch_array($query);	
		echo "<div id='block'><h1>{$print['title']}</h1>
			<img src='{$src}/{$print['photo']}'>
			<div class='teqsti'>{$print['text']}</div>
			<span class='fasi'>ფასი: <mark id='price'>{$print['price']}</mark> GEL</span>
			</div>";	
		echo "<div id='buy'>
			<a href='{$_SERVER["PHP_SELF"]}?id={$id}&action=delete&product_id={$print['id']}' class='unlink'>
			<span class=\"material-symbols-outlined\">
			remove_shopping_cart
			</span>ამოღება</a>
		<button  class='yidva'>
		<span class=\"material-symbols-outlined\">shopping_cart</span>შეძენა</button>
		<div class='numberdiv'><span id='number'>რაოდენობა</span><input type=\"number\" 
		value='1'step=\"1\" name='number'class='number'>
		<input type='hidden' name='time'value=''>
		<span id='number'>საბოლოო ფასი <strong class='lastprice' name='z'>{$print['price']}</strong> GEL</span>
		</div></div>";
	?>
	<script>
	var d=document;
    var num=d.querySelector(".number");
	var div=d.querySelector("#buy");
	var price=d.querySelector("#price");
	var lastprice=d.querySelector(".lastprice");
	var purchase=d.querySelector(".yidva");
	var finalprice=price.innerHTML*num.value;		
	num.oninput=function(){	
		console.log(num);
	var sum=price.innerHTML*num.value;
	lastprice.innerHTML=sum;		
			purchase.onclick=function(){
				RELOAD(sum);	
			}
	}			
	purchase.onclick=function(){		
		RELOAD(finalprice);	
	
		}	
	function RELOAD(arg){		
	location.assign("index.php?id=<?=$print['id'];?>&action=buy&lastprice="+arg+"&amount="+num.value+"");
}
</script>
<?php	

	upd();

}
?>