<?php
$sql= new mysqli("127.0.0.1",'root','','snake');
$res=$sql->query("select u_name, u_date from users where u_id=(select u_id from users order by u_id desc limit 1)-1; ");
while($row=$res->fetch_row()){
echo "&nbsp; Player 1:  ".$row[0]."&nbsp;&nbsp;date : ".$row[1]."<br>";
}
$res2=$sql->query("select u_name, u_date from users where u_id=(select u_id from users order by u_id desc limit 1); ");
while($row2=$res2->fetch_row()){
echo "&nbsp; Player 2: ".$row2[0]."&nbsp;&nbsp;date : ".$row2[1]."<br>";
}
?>