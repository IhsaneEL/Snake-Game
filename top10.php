
<?php
$sql= new mysqli("127.0.0.1",'root','','snake');

$res=$sql->query("SELECT u_name,u_score from users order by u_score desc limit 10;");

while($row=$res->fetch_assoc())
	
	{echo  " &nbsp{$row["u_name"]}:&nbsp&nbsp&nbsp&nbsp&nbsp<b>{$row["u_score"]}</b><br>";}

?>