

<script>
	var d=document;
	var BUTTON=d.querySelector(".scroll");	
	var errors=d.querySelector(".errors");
	var errors2=d.querySelector(".errors2");
	var login=d.querySelector(".login");	
	var icons=d.querySelectorAll(".iconify");
	var banner=d.querySelector(".banner");
	var pages=d.querySelector(".pages");
	var image=d.querySelectorAll(".images")
	var pagesul=d.querySelector(".pages ul");
	var page=d.querySelectorAll(".pages ul li");
	var li=d.querySelectorAll(".list li");
	var a=d.querySelectorAll(".list li a");
	var span=d.querySelectorAll(".sidebar ul li span");
	var icon=d.querySelectorAll(".icon");
	var sections=<?php echo json_encode($sections); ?>;
	var geo=<?php echo json_encode($geo); ?>;
	var data=d.querySelectorAll(".data");
	var box1=d.querySelector(".box1");
	var zoom=d.querySelector(".search");
	var zieba=d.querySelector(".zieba");
	var len=data.length;
	var contact=document.querySelector(".contact");
	var frame=d.querySelector(".frame");
	var key=16;	
	var counter=0;
	var nav=d.querySelector(".nav");
	var close=d.querySelector(".close");
	var plugins=d.querySelector(".plugins");
	
	sections.forEach((elem,index)=>{		
			console.log(elem[index]);		
	});
	
	
	if(location.href.includes("restore")){
	close.onclick=function(){
		plugins.style.display="none";
	}
	}
	
	if(location.href.includes("user_error") || location.href.includes("empty_user") ){
		setTimeout(ERRORS,1000);
	}
	
	if(location.href.includes("pass_error") || location.href.includes("empty_pass") ){
		setTimeout(ERRORS2,1000);
	}
				   
				   
	function ERRORS(){
		errors.style.opacity="0";
		errors.style.transition="0.9s";
	}
	
	
	function ERRORS2(){
		errors2.style.opacity="0";
		errors2.style.transition="0.9s";
	}
	
	
	
	BUTTON.addEventListener("click",()=>{
		Scale();		
	});
	
	
	
	function Scale(){
		login.classList.toggle("high");
	}
	
	if(location.href.includes("error")){
		Scale();
	}
	
		 
	
	if(screen.width===3840){key=28;}
	if(screen.width===1920){key=20;}
	if(screen.width===1024){key=12;}
	image[1].setAttribute("data-set","1");
	
	li.forEach((elem,index)=>{
			if(location.href.includes(sections[index+1])){			
			elem.classList.add("dark");
				a[index].style.color="white";
				icon[index].style.filter="invert(100%)";
				span[index].classList.remove("dissapear");
				if(span[index].innerHTML.length>1){
					span[index].style.paddingTop="5%";
					span[index].style.paddingBottom="5%";
					span[index].style.fontSize="11px";
				}
			}			
	});
			
	
	
	
	contact.onclick=()=>{
		frame.innerHTML="<p class='cont'>3700, რუსთავი <br> TEL: 599 23 09 17 <br> მის: მეგობრობის N12 / 21 <br> E-mail: compi@gmail.com</p><iframe class='iframe' src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2985.740801749891!2d44.98224227582975!3d41.55320908569364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4044014a3b6b0a4b%3A0x9c6dd2dcbdc45bb2!2s12%20Megobroba%20Ave%2C%20Rustavi%203700!5e0!3m2!1sen!2sge!4v1694946441249!5m2!1sen!2sge\' width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>";
		pages.classList.add("hide");
	}
	
	
	
	zoom.addEventListener("click",scrol);
	
	
	
	function scrol(){
		counter++;
		if(counter%2===1){
			zoom.innerHTML="x";
		zieba.classList.replace("hide","show");
		}else{
			hide();
		}
	}
	
	
	function hide(){
		if(zieba.classList.contains("show")){
			zieba.classList.replace("show","hide");
			zoom.innerHTML="<span class=\"material-symbols-outlined\">search</span>";
		}		
	}
	
		
	
	var x=0;
	var y=-2750;
	
	
	function anime(){
		var inter=setInterval(function(){
			move(box1);	
			if(y===0){clearInterval(inter);}
		},1200);
	}
	
	anime();
	
	
	
	function move(elem){			
		if(x>y ){
			x-=275;
		elem.style.marginLeft = x +"px";
		elem.style.transition="0.8s";}		
		else{if(x===y || x<y)			
			y+=275;			 
			 //console.log(y);
		elem.style.marginLeft = y +"px";
		elem.style.transition="0.8s";
		}
	}
	
	
	
	for(var i=key;i<len;i++){
	data[i].style.display="none";
	}	
	
	
							//   SIDEBAR  MENU HOVER
	
	
		li.forEach((elem,index)=>{
			if(location.href.includes(sections[index+1])){			
			elem.classList.add("dark");
				a[index].style.color="white";
				icon[index].style.filter="invert(100%)";
				}			
	});
	
	
	
	if(data.length<key){
		pages.classList.add("hide");
	}
	
	page.forEach((elem,index)=>{
				elem.onclick=()=>{
		elem.classList.replace("white","grey");	
				}
	});
	
	
	
	// DANOMRVA
	
	var totalpages=len/key;
			var b=Math.ceil(totalpages);
			var r=b-1;	
			if(len>key){				
				for(var t=1;t<=b;t++){
					pagesul.innerHTML+="<li class='white'>" + t + "</li>";
					}
				}
	
	var pageli=d.querySelectorAll(".pages ul li");
	var pagesli=d.querySelectorAll(".pages ul li");
	var leng=pageli.length;	
			var lng=pageli.length;
	if(len>=key){
			pageli[0].classList.replace("white","grey");			
				}				
				
	pageli.forEach((elem,index)=>{					
				var start=0+key*index;
				var show=start+key;
				var end=len-start;
				var hideend=len-end;
				var range=hideend+key;
				elem.onclick=()=>{							
						for(var f=0;f<=start;f++){
						data[f].style.display="none";}
						for(var d=start;d<=range;d++){
							data[d].style.display="";}
						for(var g=range;g<len;g++){
							data[g].style.display="none";}									
							}		
							});
	
	
	function paging(){
				pagesli.forEach((item,index)=>{
				item.addEventListener("click",()=>{					
				pagesli[index].classList.replace("white","grey");							
				for(var i=0;i<index;i++){
					pagesli[i].classList.replace("grey","white");					
					}
				for(var x=index+1;x<leng;x++){
					pagesli[x].classList.replace("grey","white");	
					}
					scrollBy(0,-10000);
					});									
				});
				}
	
	paging();
	
	
	li.forEach((elem,index)=>{
		elem.onmouseover=()=>{
			span[index].classList.replace("dissapear","show");
			//console.log(elem);
		}
		elem.onmouseout=()=>{
			span[index].classList.replace("show","dissapear");
			//console.log(elem);
		}		
	}
);
	
	
	
	</script>
