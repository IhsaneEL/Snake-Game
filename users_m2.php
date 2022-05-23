<?php
$sql= new mysqli("127.0.0.1",'root','','snake');

if(isset($_POST["p1_u_n"]))$u1_m2=$_POST["p1_u_n"]; ;
if(isset($_POST["p2_u_n"]))$u2_m2=$_POST["p2_u_n"]; ;

$d=date("y-m-d");
if(isset($_POST["u1_score"]))$u_s1=$_POST["u1_score"];
if(isset($_POST["u2_score"]))$u_s2=$_POST["u2_score"];
if($sql){
if(isset($u1_m2))
{
	$add1=$sql->query("insert into users values('','$u1_m2',$u_s1,'$d');");
	$add2=$sql->query("insert into users values('','$u2_m2',$u_s2,'$d');");
}
}

?>