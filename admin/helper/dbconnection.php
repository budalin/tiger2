<?php
function dbconnection(){
	$con=mysql_connect("localhost","root","");
	if(!$con){
			die('Could not connect:'.mysql_error());
			
		}
		
		mysql_select_db("tiger_db",$con);//'Selection of DB'
		return $con;
}
?>