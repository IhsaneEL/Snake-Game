<?php

$sql= new mysqli("127.0.0.1",'root','','snake');
if(isset($_POST["s_p_n"]))$u_m1=$_POST["s_p_n"]; ;
$d=date("y-m-d");
if(isset($_POST["u_score"]))$u_s=$_POST["u_score"];

if($sql){
if(isset($u_m1))
{   $req="insert into users values('','$u_m1',$u_s,'$d');";
	$add=$sql->query($req);
}

}
 ?>

