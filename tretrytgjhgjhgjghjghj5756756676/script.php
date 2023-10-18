<?php 

include"../db.php";

$geo=array("","კომპიუტერები ","მაინერები და აქსესუარები","ნოუთბუკები ","პროცესორები ","ქულერები ","დედაპლატები ","კეისები ","კვების ბლოკები","ოპერატიული მეხსიერებები","CD&DVD დისკის ჩამწერები","ვიდეო ბარათები","კაბელები ","ხისტი დისკები","კარტრიჯები ","დისკები ","საწმენდები ","კომუტატორები ","ქსელური მოწყობილობები","მეხსიერებები", "ყურსასმენები ","აქსესუარები ","ჯოისტიკები ","კლავიატურები","მიკროფონები ","მონიტორები","მაუსები ","მაუს პადები","პრინტერები ","პროექტორები ","სკანერები ","პროგრამები ","ხმის პლატები","დინამიკები ","ტაბლეტები ","ბატარეები ","უწყვეტი კვების წყაროები UPS","კამერა ","ხელსაწყოები ","გეიმინგ სავარძლები");


$sections=["","pc","mines","notebook","cpu","cooler","mb","case","psu","ram","cd","gpu","cable","hdd","cart","disk","cleaners","comut","jack","usb","headphones","accessories","joystick","keyboard","mic","monitor","mouse","mpad","print","proj","scan","softs","soundcard","speakers","tablet","battery","ups","cam","tools","chairs"];
if(isset($_GET["section"])){$section=$_GET["section"];}

$combined=array_combine($sections,$geo);
//print_r($combined);
//echo $section;


if(isset($_GET["error"])){$error = $_GET["error"];}

function error_report($error_string,$text){
	global $error;
	if($error==$error_string){
	echo $text;
			}
	
}

function addProduct(){
	include"../db.php";
	if(isset($_SESSION['user'])){$user=$_SESSION['user'];}	
	if(isset($_GET["action"])){
		$action=$_GET["action"];
		
	}
	if(isset($_GET["product_id"])){
		$product_id=$_GET["product_id"];		
	}
	if(@$action=="add" && $product_id){
		$insert=mysqli_query($con,"insert into profile(username,product_id) values ('$user','$product_id')");
		return $insert;
		 mysqli_close($insert);
	}
	if(@$action=="delete" && $product_id){
		$delete=mysqli_query($con,"DELETE FROM profile WHERE product_id='$product_id'");
		return $delete;
		 mysqli_close($delete);
	}
}

function category(){
	global $section,$combined;		
	if($section){
foreach($combined as $index=>$value){
	switch($section){
		case $index: echo $value;break;		
	}
}
}else{echo "მთავარი";}
		}

function countsections($arg){
	$count=mysqli_query($con,"SELECT * FROM data where section='{$arg}'  order by id desc");
	$num=mysqli_num_rows($count);
	return $num;
}


function counts(){
	include"../db.php";
	global $search,$section;
	if(@$search){
	$select=mysqli_query($con,"select * from data where title LIKE '%$search%' order by id desc");
	$count=mysqli_num_rows($select);
		return $count;
		}elseif(!$search && $section){
		$select=mysqli_query($con,"SELECT * FROM data where section='{$section}' order by id desc");
		$count=mysqli_num_rows($select);
		return $count;
	}
	else{
	$select=mysqli_query($con,"SELECT * FROM data order by id desc");
	$count=mysqli_num_rows($select);
	return $count;
	}
	
	
}
function numbers(){global $section,$search,$count;
						if(!@$search){
					echo"მონაცემების რაოდენობა: ".					
					 counts();
								}elseif(!@$search && $section){
					echo"მონაცემების რაოდენობა: ".					
					 counts();
								}
					else{echo"ნაპოვნია ".					
					 counts()." მონაცემი";
						}
					}



function data($fetch){
	include"../db.php";
	global $sections,$geo,$section,$search,$id;
	if(isset($_SESSION['user'])){$user=$_SESSION['user'];}
	
		$check=mysqli_query($con,"select product_id from profile where product_id='{$fetch['id']}' and username='{$user}'");
	$count=mysqli_num_rows($check);
	if($count==0){
		$class="add_shopping_cart";
		$action="add";
		$text="კალათაში დამატება";
	}else{
		$class="check_circle";
		$text="კალათაშია";
		$action="delete";
	}
	
?>	
	<div class="data">
	<div class="div1">
		<a href="home.php?id=<?php echo $fetch["id"];?>">
	<img src="../img/<?php echo $fetch["photo"]; ?>" alt=""></div>
	<div class="div2">
	<h1 class="title"><?php echo strtoupper($fetch["title"]);?></h1></a>
		<h6 class="price"><?php echo $fetch["price"];?> GEL</h6>
<h5 class="section"><span class="material-symbols-outlined">
<?=$class;?>
</span>
	<a href="?<?php 
	if($section){echo "section=$section";}
	?>&action=<?=$action;?>&product_id=<?=$fetch["id"];?>"class="buy"><?=$text;?></a>
		</h5>
		</div>
</div>
<?php
}



function defaultdata(){
	
	include"../db.php";
	global $search;
	if(@$search){
	$select=mysqli_query($con,"select * from data where title LIKE '%$search%' order by id desc");
	$count=mysqli_num_rows($select);}else{
	$select=mysqli_query($con,"SELECT * FROM data");
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
	include"../db.php";
	global $sections,$geo,$section;
	$select=mysqli_query($con,"SELECT * FROM data where section='{$item}' order by id desc");
	$fetch=mysqli_fetch_array($select);
	$num=mysqli_num_rows($select);
	$error="განყოფილება ცარიელია";
	?>
	<div class="frame"><?php
	if($num==false){echo "<span class='error'>$error</span>";}else{
	do{
		data($fetch);
	}while($fetch=mysqli_fetch_array($select));}
	?></div><?php
}

function countsect($arg){
	include"../db.php";
	global $sections,$geo,$section;
	$query=mysqli_query($con,"select * from data where section='{$arg}' order by id desc");
	$num=mysqli_num_rows($query);
	return $num;
}

function sidebar(){
	include"../db.php";
	global $sections,$geo,$section;
	$query=mysqli_query($con,"select * from data where section='{$section}' order by id desc");
	$num=mysqli_num_rows($query);	
	for($x=1; $x<count($geo); $x++){
				echo "<li><img src='../img/icons/".$x.".png' class='icon'><a href=\"?section={$sections[$x]}\"> $geo[$x]</a>
				<span class='dissapear'>".countsect($sections[$x])."</span></li>";		
}
}


function purchase(){
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



function countProduct($db){
	include"../db.php";
	global $user;
	$query=mysqli_query($con,"select * from $db where username='{$user}'");
$count=mysqli_num_rows($query);
	return $count;
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

function content(){
	include"../db.php";
	if(isset($_GET["id"])){$id=$_GET["id"];}
	if(isset($_GET["lastprice"])){$lastprice=$_GET["lastprice"];}
	if(isset($_GET['number'])){$number=$_GET['number'];}	
	global $user,$check,$count;
	$check=mysqli_query($con,"select product_id from profile where product_id='{$id}' and username='{$user}'");
	$count=mysqli_num_rows($check);
	global $id,$query,$print;
	$query=mysqli_query($con,"select * from data where id='{$id}'");
	$print=mysqli_fetch_array($query);	
	$checkuser=mysqli_query($con,"select username,product_id from orders where username='{$user}' and product_id='$id'");
	$num=mysqli_num_rows($checkuser);
		echo "<div id='block'><h1>{$print['title']}</h1><img src='../img/{$print['photo']}'><div class='teqsti'>{$print['text']}</div>
		<span class='fasi'>ფასი: <mark id='price'>{$print['price']}</mark> GEL</span>";
	if($count==0 and $num==0){?>
		<a href="home.php?id=<?=$id;?>&action=add&product_id=<?=$print['id'];?>" class="add-product"><span class="material-symbols-outlined">
add_shopping_cart
</span>კალათაში დამატება</a>
		
	<?php }else{
	if(!@$lastprice){
	purchase();
	}else{ 
		echo "		
		<a href='home.php?id={$print['id']}&action=cancel' class='cancel'><span class=\"material-symbols-outlined\">
remove_shopping_cart
</span>შეკვეთის გაუქმება</a>";
	}
	"</div>";	
	}
}


?>