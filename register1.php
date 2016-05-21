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
$c=$_GET['email'];
if($a==""||$b==""||$c==""){
	header("Location:http://localhost/hw/register.html" );
}

$link=mysql_connect($host,$user,$upwd) or die ("Unable to connect!");
mysql_select_db($db, $link) or die ("Unable to select database!");
$sql="SELECT * FROM `ID` WHERE user = '$a'";
$result=mysql_query($sql,$link) or die ("Error in query: $query. " . mysql_error());;



if(mysql_fetch_array($result,MYSQL_ASSOC)!=NULL)
{
	header("Location:http://localhost/hw/wrong1.html" );
}
else
{
	$query="INSERT INTO `ID`(user,password,email,map,x,y) VALUES ('$a','$b','$c','save_house','0','6')";
	$initial="SELECT * FROM `savehouse` WHERE user = 'gm'";
	$copy=mysql_query($initial, $link);
	while ($copy1=mysql_fetch_row($copy)){
		$copy2="INSERT INTO `savehouse`(user,item,x,y) VALUES ('$a','$copy1[1]','$copy1[2]','$copy1[3]')";
		mysql_query($copy2, $link);
	}

	if (mysql_query($query,$link)) {
		header("Location:http://localhost/hw/login.html");
	} else {
		echo "Error: " . $query . "<br>" . mysql_error();
	}
}

?>

</body>
