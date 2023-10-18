<?php 

include"db.php";

$geo=array(false,"კომპიუტერები ","მაინერები და აქსესუარები","ნოუთბუკები ","პროცესორები ","ქულერები ","დედაპლატები ","კეისები ","კვების ბლოკები","ოპერატიული მეხსიერებები","CD&DVD დისკის ჩამწერები","ვიდეო ბარათები","კაბელები ","ხისტი დისკები","კარტრიჯები ","დისკები ","საწმენდები ","კომუტატორები ","ქსელური მოწყობილობები","მეხსიერებები", "ყურსასმენები ","აქსესუარები ","ჯოისტიკები ","კლავიატურები","მიკროფონები ","მონიტორები","მაუსები ","მაუს პადები","პრინტერები ","პროექტორები ","სკანერები ","პროგრამები ","ხმის პლატები","დინამიკები ","ტაბლეტები ","ბატარეები ","უწყვეტი კვების წყაროები UPS","კამერა ","ხელსაწყოები ","გეიმინგ სავარძლები");
	
$sections=[false,"pc","mines","notebook","cpu","cooler","mb","case","psu","ram","cd","gpu","cable","hdd","cart","disk","cleaners","comut","jack","usb","headphones","accessories","joystick","keyboard","mic","monitor","mouse","mpad","print","proj","scan","softs","soundcard","speakers","tablet","battery","ups","cam","tools","chairs"];
if(isset($_GET["section"])){$section=$_GET["section"];}
if(isset($_GET["action"])){$action=$_GET["action"];}
if(isset($_GET["error"])){$error = $_GET["error"];}

$combined=array_combine($sections,$geo);

function error_report($error_string,$text){
	global $error;
	if($error==$error_string){
	echo "<span class='error-report'>".$text."!</span>";
			}
}


function error_report2($error_string,$text){
	global $error;
	if($error==$error_string){
	echo "<span class='error-report'>".$text."!</span>";
			}
}

function passrestore(){ ?>
	<div class="plugins">
	<form action="checkemail.php" method="post"class="restore">
		<h1>პაროლის აღდგენა</h1>
		<span class="close">x</span>
		<input type="text" name="email"class="email" placeholder="ჩაწერეთ თქვენი მეილი...">
		<input type="submit" class="send" value="">
		</form>	
	</div>
	<?php }





function addProduct(){
	include"db.php";
	if(isset($_GET["action"])){
		$action=$_GET["action"];		
	}
	if(isset($_GET["product_id"])){
		$product_id=$_GET["product_id"];		
	}
	if($action=="add" && $product_id){
		$insert=mysqli_query($con,"insert into profile(username,product_id) as ('$user','$product_id')");
		return $insert;
		mysqli_close($insert);		
	}
}



function category(){
	global $section,$combined;		
	if($section){
		if(is_array($combined)){
foreach($combined as $index=>$value){
	switch($section){
		case $index: echo $value;break;		
		}
	}
}
}else{echo "მთავარი";}
		}



function countsections($arg){
	$count=mysqli_query($con,"SELECT count(*) FROM data where section='{$arg}' ");
	return $count;
}




											// DATA


function data($fetch){
	include"db.php";	
?>	
	<div class="data">
	<div class="div1">
		<a href="index.php?id=<?php echo $fetch["id"];?>&section=<?=$fetch['section'];?>">
	<img src="img/<?php echo $fetch["photo"]; ?>" alt="register"></div>
	<div class="div2">
	<h1 class="title"><?php echo strtoupper($fetch["title"]);?></h1></a>
		<h6 class="price"><?php echo $fetch["price"];?> GEL</h6>
<h5 class="section"><span class="material-symbols-outlined">
add_shopping_cart
</span><a href="register/registration.php" >დარეგისტრირდით</a></h5></div></div>
<?php
}


function counts(){
	include"db.php";
	global $search,$section;
	if(@$search){
	$select=mysqli_query($con,"select * from data where title LIKE '%$search%' order by id desc" );
	$count=mysqli_num_rows($select);
		return $count;
		}elseif(!$search && $section){
		$select=mysqli_query($con,"SELECT * FROM data where section='{$section}' order by id desc");
		$count=mysqli_num_rows($select);
		return $count;
	}
	else{
	$select=mysqli_query($con,"SELECT * FROM data  order by id desc");
	$count=mysqli_num_rows($select);
	return $count;
	}
	
	
}
function numbers(){
	global $search,$section;
						if(!@$search){
					echo "მონაცემების რაოდენობა: ".counts();
								}elseif(!@$search && $section){
					echo "მონაცემების რაოდენობა: ".counts();
								}
					else{echo "ნაპოვნია ".counts()." მონაცემი";
						}
					}



function defaultdata(){	
	include"db.php";
	global $search;
	if(@$search){
	$select=mysqli_query($con,"select * from data where title LIKE '%$search%'  order by id desc");
	$count=mysqli_num_rows($select);	
	}else{
	$select=mysqli_query($con,"SELECT * FROM data  order by id desc");
	$count=mysqli_num_rows($select);}	
	$fetch=mysqli_fetch_array($select);
	?>
	<div class="frame"><?php
	if($count>0){
		do{
			data($fetch);
		}while($fetch=mysqli_fetch_array($select));}else{echo "<span class='error'>მსგავსი მონაცემი არ მოიძებნა</span>";}
	?>
	</div>
<?php
}




function databysections($item){
	include"db.php";
	global $combined,$section;
	$select=mysqli_query($con,"SELECT * FROM data where section='{$item}'  order by id desc");
	$fetch=mysqli_fetch_array($select);
	$num=mysqli_num_rows($select);
	$error="განყოფილება ცარიელია";	
	?>
	<div class="frame"><?php
	if($num==0){echo "<span class='error'>$error</span>";}else{
	do{
		data($fetch);
	}while($fetch=mysqli_fetch_array($select));}
	?></div><?php
}

function countsect($arg){
	include"db.php";
	global $combined,$section;
	$query=mysqli_query($con,"select * from data where section='{$arg}' order by id desc");
	$num=mysqli_num_rows($query);
	return $num;
}


								
											// SIDEBAR



function sidebar($link,$img){
	include"db.php";
	global $sections,$geo,$section;
	$query=mysqli_query($con,"select * from data where section='{$section}'  order by id desc");
	$num=mysqli_num_rows($query);	
	for($x=1; $x<count($geo); $x++){
				echo "<li data-key='{$geo[$x]}'><img src='$img/icons/".$x.".png' class='icon'><a href=\"$link?section={$sections[$x]}\"> $geo[$x]</a>
				<span class='dissapear'>".countsect($sections[$x])."</span></li>";		
}
}



									// SHOPPING CART



function cart(){
	include"db.php";
	global $user;
	if(isset($_GET["action"])){$action=$_GET["action"];}
	if(@$action==="delete"){
		$delete=mysqli_query($con,"delete from profile where product_id='{$_GET['id']}'");
		return $delete;
		mysqli_close($delete);
		header("Location: index.php?button=basket");
	}else{echo " ";}
	$selectuser=mysqli_query($con,"select * from profile where username='{$user}'");
	$fecthuser=mysqli_fetch_array($selectuser);
	$num=mysqli_num_rows($selectuser);?>
	<div class="frame"><?php	
	if($num>0){	
	do{
	$selectDATA=mysqli_query($con,"select * from data where id='{$fecthuser["product_id"]}'");
	$fetchdata=mysqli_fetch_array($selectDATA);		
		?>
<div class="data">
	<div class="div1">
		<a href="index.php?id=<?=$fetchdata["id"];?>">
	<img src="../img/<?=$fetchdata["photo"];?>" alt=""></div>
	<div class="div2">
	<h1 class="title"><?=$fetchdata["title"];?></h1></a>
		<h6 class="price"><?=$fetchdata["price"];?> GEL</h6>
<h5 class="section"><span class="material-symbols-outlined">
remove_shopping_cart
</span><a href="?button=basket&action=delete&id=<?=$fetchdata["id"];?>">ამოღება</a></h5>
			</div>
		</div>
<?php 
	}while($fecthuser=mysqli_fetch_array($selectuser));	
	}	else{echo "კალათა ცარიელია";}
	?></div><?php
}


function info(){
	include"../db.php";
	global $user;
	$query=mysqli_query($con,"select * from users where user='{$user}'  ");
	$print=mysqli_fetch_array($query);
	
	echo "<div class='info'>მომხმარებლის სახელი:<mark> {$print['user']}</mark><br> მეილი: <mark>{$print["mail"]}</mark><br> პაროლი:<mark>".$print["password"]."</mark></div>";
	?>
<li class="removeuser"><span class="material-symbols-outlined">
person_cancel
</span>
<a href="?button=remove_user&user=<?=$user;?>">პროფილის წაშლა</a></li>
<?php
}

function countProduct($db){
	include"../db.php";
	global $user;
	$query=mysqli_query($con,"select * from $db where username='{$user}'");
$count=mysqli_num_rows($query);
	return $count;
}

function removeOrder(){
	include("../db.php");
	global $user,$user_id;
	if(isset($_GET["action"]) and isset($_GET["product_id"])){$action=$_GET["action"];
$prID=$_GET["product_id"];
	}	
	if(@$action=="unlink" and $prID){
		$remove=mysqli_query($con,"delete from orders where id='$prID'");
		return $remove;
		mysqli_close($remove);
	}
}

function deleteUser(){
	include"../db.php";
	global $user,$button,$user_id;
	if(isset($_GET["user"])){$username=$_GET["user"];}
	echo @$username;
	if(@$button==="remove_user" and @$username==$user){
	mysqli_query($con,"delete from users where user='$username' and user_id='$user_id'");
		mysqli_query($con,"delete from orders where username='$username'");
		mysqli_query($con,"delete from profile where username='$username'");
		header("Location: ../index.php");
	}
}


function orders(){
	include"../db.php";
	global $user;
	$query=mysqli_query($con,"select * from orders where username='{$user}' order by id desc");
	$select=mysqli_query($con,"select sum(totalprice) as total from orders  where username='{$user}'");
	$sum=mysqli_fetch_array($select);
	$amount= $sum["total"];
	$print=mysqli_fetch_array($query);
	$count=mysqli_num_rows($query);
?>
<h1 class="orders">თქვენი შეკვეთები</h1>
<?php  if($count>0){?>
<table class="table"cellspacing="0" border="0" cellpadding="0"> 
	<td class="td1">პროდუქტის სახელი</td><td class="td1">რაოდენობა</td><td class="td1">შეკვეთის თარიღი</td><td class="td1">ფასი</td><td class="td1"></td><tr>	
<?php 
		do{?>
	<td class="td"><?=$print["product_name"];?></td>	
	<td class="td"><?=$print["amount"];?></td><td class="td"><?=$print["date"];?>
	</td><td class="td"><?=$print["totalprice"];?> GEL</td><td class="td">
	<a href="index.php?button=orders&product_id=<?=$print["id"];?>&action=unlink">შეკვეთის გაუქმება
		<span class="material-symbols-outlined">block</span>
	</a></td><tr></tr><tr>
	<?php }while($print=mysqli_fetch_array($query));?>
	<tr></tr>
<td class="td" colspan="3">ჯამური ფასი</td><td class="td1"  colspan="2"><?=$amount;?> GEL</td>
	<?php }else{echo "<span class='error'>თქვენ შეკვეთები არ გაქვთ</span>";}?>
</table>
<?php }
	
	
									// PAGES 
	
	
	function BUY(){
	global $id,$query,$print;	 
	$sum=$print['price']*@$number;
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
		</div>
		</div>";
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
	location.assign("home.php?id=<?=$print['id'];?>&action=buy&lastprice="+arg+"&amount="+num.value+"");
}
</script>
<?php

}

function updateORDERS(){
	include"../db.php";
	global $user,$print,$id;
	if(isset($_GET["action"])){$action=$_GET["action"];}
	if(isset($_GET["amount"])){$amount=$_GET["amount"];}
	if(isset($_GET["lastprice"])){$lastprice=$_GET["lastprice"];}
	if(isset($_GET['number'])){$number=$_GET['number'];}
	$checkprofi=mysqli_query($con,"select * from profile where product_id='{$id}' and username='{$user}'");
	$printprofi=mysqli_fetch_array($checkprofi);
	$checkuser=mysqli_query($con,"select * from users where user='{$user}'");
	$printuser=mysqli_fetch_array($checkuser);
	$checkproduct=mysqli_query($con,"select * from data where id='{$id}'");
	$printproduct=mysqli_fetch_array($checkproduct);	
	if(@$action=="buy" && $id){
		$insert=mysqli_query($con,"insert into orders(product_id,product_name,username,mail,totalprice,amount) values('$id','{$printproduct['title']}','$user','{$printuser['mail']}','$lastprice','$amount') ");
		return $insert;
		mysqli_close($insert);
	}
	if(@$action=="cancel"&& $id){
		$delete=mysqli_query($con,"delete from orders where product_id='$id'");
		return $delete;
		mysqli_close($delete);
	}
}


function content($src){	
	include"db.php";
	if(isset($_GET["id"])){$id=$_GET["id"];}	
	$query=mysqli_query($con,"select * from data where id='{$id}'");
	$print=mysqli_fetch_array($query);	
		echo "<div id='block'><h1>{$print['title']}</h1><img src='{$src}/{$print['photo']}'><div class='teqsti'>{$print['text']}</div>
		<span class='fasi'>ფასი: <mark>{$print['price']}GEL</mark></span></div><a href='register/registration.php' class='add-product'>გაიარეთ რეგისტრაცია</a>";	
		echo "";
}




?>