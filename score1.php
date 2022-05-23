<?php
$sql= new mysqli("127.0.0.1",'root','','snake');
if(isset($_POST['variable'])){
     $s=$_POST["variable"];
	$upt=$sql->query("update users set u_score=$s where u_id=(select u_id from users order by u_id desc limit 1);");
}
?>