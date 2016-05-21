<?php
session_start();
$id=$_SESSION['user'];
$host="140.116.245.148";
$user="f74026470";
$upwd="hank0127";
$db="f74026470";
$link=mysql_connect($host,$user,$upwd) or die ("Unable to connect!");
mysql_select_db($db, $link) or die ("Unable to select database!");
$nowx=$_POST['xn'];	
$nowy=$_POST['yn'];
$oldx=$_POST['xo'];	
$oldy=$_POST['yo'];
$name=$_POST['name'];

$link=mysql_connect($host,$user,$upwd) or die ("Unable to connect!");

$sql = "UPDATE `$name` SET  `x` =  '$nowx', `y` = '$nowy' WHERE `user` = '$id' AND `x` = '$oldx' AND `y` = '$oldy' ";
$result=mysql_query($sql,$link) or die ("Error in query: $query. " . mysql_error());




?>