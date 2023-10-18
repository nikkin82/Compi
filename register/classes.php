<?php


class login{
	public $user; 
	public $pass;
}
function data_pass($post,$var){
	
	if( isset( $_POST[ $post ] ) && !empty( $_POST[ $post ] ) ){	
	$var = strip_tags(stripcslashes( trim( $_POST[ $post ] ) ) );
	}
	
	}
function error_report($page){	
	header("Location:".$page."");
}

	function($x=[]){
		$select=mysql_query("SELECT * FROM users");
		$get=mysql_fetch_array($select);
		$y=array_push($x,$get['user']);
		}

		
?>
