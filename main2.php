<html>
<head>
	<meta charset="utf-8">
	<title>BOOK</title>
</head>
<div>
<img src="save_house.png" align=center>
</div>
<!--
<div class="forsearch" style="font-size:20px; color:#FFB3FF; font-family: 'Courgette', cursive;">
<form action="http://localhost/metasearch.php" method=get name="search">
<h1> <font color="Black">Welcome to Bookmark website</font></h1>
	Search: <input type="text" name="keyword">
	<input type=submit value="go">
</form>
<form action="http://localhost/savebook.php" method=get name="thing">
modify your account:
<a href="http://localhost/modify.php/">
<input type="button" value="modify"></a><br>
<h1> <font color="Black">Add new bookmark</font></h1>
	Name: <input type="text" name="name"><br><br>
	Website: <input type="text" name="link" style="width:300px;height:40px;font-size: 20px;"><br><br>
	<input type=submit value="OK">
</form>
<h1> <font color="Black">Bookmark</font></h1>
</div>-->
<?php
$host="140.116.245.148";
$user="f74026470";
$upwd="hank0127";
$db="f74026470";
$link=mysql_connect($host,$user,$upwd) or die ("Unable to connect!");
mysql_select_db($db, $link) or die ("Unable to select database!");
$sql = "SELECT * FROM `now`";
$result=mysql_query($sql,$link) or die ("Error in query: $query. " . mysql_error());;
while ($rows=mysql_fetch_array($result)){
	$a = $rows[0];
}
$sql = "SELECT * FROM `book` WHERE ID = '$a'";
$result=mysql_query($sql, $link);

function del($aa, $bb, $cc)  
{  
	$host="140.116.245.148";
	$user="f74026470";
	$upwd="hank0127";
	$db="f74026470";
	$conn=mysql_connect($host,$user,$upwd) or die ("Unable to connect!");
	mysql_select_db($db, $conn) or die ("Unable to select database!");
	$del = "DELETE FROM `book` WHERE ID = '$aa' AND name = '$bb' AND link = '$cc'";
	mysql_query($del,$conn);
	header("Location:http://localhost/main.php" );
} 

function mod($aa, $bb, $cc)  
{   
	$host="140.116.245.148";
	$user="f74026470";
	$upwd="hank0127";
	$db="f74026470";
	$conn=mysql_connect($host,$user,$upwd) or die ("Unable to connect!");
	mysql_select_db($db, $conn) or die ("Unable to select database!");
	$del = "DELETE FROM `now1`";
	mysql_query($del,$conn);
	$mod = "Insert into `now1`(ID,name,link) VALUES ('$aa', '$bb', '$cc')";
	mysql_query($mod,$conn);
	header("Location:http://localhost/modify2.php" );
}     

while ($row=mysql_fetch_row($result))  
{   
	if (isset($_GET['hello'])) {
		$aa = $_GET['aa'];
		$bb = $_GET['bb'];
		$cc = $_GET['cc'];
		del($aa, $bb, $cc);
		break;
	}
	if (isset($_GET['bye'])) {
		$aa = $_GET['aa'];
		$bb = $_GET['bb'];
		$cc = $_GET['cc'];
		mod($aa, $bb, $cc);
		break;
	}
	print "<div>";
	print "<a href='main.php?bye=true&aa=".$row[0]."&bb=".$row[1]."&cc=".$row[2]."'><img src=\"1.jpg\" style=\"width:20px;height:20px;font-size: 20px;\"></a>";
	print "<a href='main.php?hello=true&aa=".$row[0]."&bb=".$row[1]."&cc=".$row[2]."'><img src=\"2.jpg\" style=\"width:20px;height:20px;font-size: 20px;\" ></a>";
	print "<a href=".$row[2]." target=_blank >".$row[1]."</a><br>";
	print "</div>";
}  
?>
</div>
</body>
</html>
