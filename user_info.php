<?php
$sql= new mysqli("127.0.0.1",'root','','snake');

$res=$sql->query("select u_name, u_date from users where u_id=(select u_id from users order by u_id desc limit 1); ");
while($row=$res->fetch_row()){
echo "&nbsp name : ".$row[0]."<br>&nbsp date : ".$row[1]."<br>";
}
?>