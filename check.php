<?php
session_start();
?>
<html>
<head>
<title>BOOK</title>
</head>

<body>

<?php

$host="140.116.245.148";
$user="f74026470";
$upwd="hank0127";
$db="f74026470";
$a=$_GET['user'];
$b=$_GET['password'];
$_SESSION['user']=$a;
if($a==""||$b==""){
	header("Location:http://localhost/hw/wrong.html" );
}

$link=mysql_connect($host,$user,$upwd) or die ("Unable to connect!");
mysql_select_db($db, $link) or die ("Unable to select database!");

$query="SELECT * FROM `ID` WHERE user = '$a' AND password = '$b'";

$result=mysql_query($query,$link) or die ("Error in query: $query. " . mysql_error());;

if(mysql_fetch_array($result,MYSQL_ASSOC)==NULL)
{
	header("Location:http://localhost/hw/wrong.html" );
}
else
{
	$del = "DELETE FROM `now`";
	mysql_query($del,$link);
	$sql = "INSERT INTO `now`(user) VALUES ('$a')";
	if (mysql_query($sql,$link)) {
		header("Location:http://localhost/hw/main.php"); 
	} else {
		echo "Error: " . $query . "<br>" . mysql_error();
	} 
}

?>

</body>
