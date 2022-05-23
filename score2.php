<?php
$sql= new mysqli("127.0.0.1",'root','','snake');



if(isset($_POST['variable2']))
{   $s2=$_POST['variable2'];
   
	$scr2=$sql->query("update users set u_score=$s2 where u_id=(select u_id from users group by u_id desc limit 1)-1;");
}
if(isset($_POST['variable1']))
{   $s1=$_POST['variable1'];
var_dump($s2);
	$scr1=$sql->query("update users set u_score=$s1 where u_id=(select u_id from users group by u_id desc limit 1);");
}

?>