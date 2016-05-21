<?php
session_start();
?>
<html>
<head>
	<meta charset="utf-8">
	<title>CASTLE</title>
	<style type="text/css">
  body.back {background-attachment: fixed; 
  background-image: url("castle.jpg"); 
  background-repeat: no-repeat; 
  background-position: center center;
  background-color: black;
}
</style>
</head>
<script>
	var peopled = new Image()
	peopled.src = "http://localhost/hw/wd1.png";
	var peopleu = new Image()
	peopleu.src = "http://localhost/hw/wu1.png";
	var peopler = new Image()
	peopler.src = "http://localhost/hw/wr1.png";
	var peoplel = new Image()
	peoplel.src = "http://localhost/hw/wl1.png";
	var img = new Image();
	img.src="http://localhost/hw/save_house.png";
	var box = new Image();
	box.src="http://localhost/hw/box.jpg";
</script>
<?php
$host="140.116.245.148";
$user="f74026470";
$upwd="hank0127";
$db="f74026470";
$link=mysql_connect($host,$user,$upwd) or die ("Unable to connect!");
mysql_select_db($db, $link) or die ("Unable to select database!");
$id=$_SESSION['user'];

$sql = "SELECT * FROM `map_size` WHERE name = 'save_house' ";
$result=mysql_query($sql,$link) or die ("Error in query: $query. " . mysql_error());
while ($rows=mysql_fetch_array($result)){
	$mx = $rows[1];
	$my = $rows[2];
		}
$sql = "SELECT * FROM `ID` WHERE user = '$id' ";
$result=mysql_query($sql,$link) or die ("Error in query: $query. " . mysql_error());
while ($rows=mysql_fetch_array($result)){
	$nowx=$rows[4];
	$nowy=$rows[5];
}
?>

<script>
var mx = <?php echo $mx;?>;
var my = <?php echo $my;?>;

var map=[];
for (i=0;i<=my;i++){
	map[i]=[];	
}
for (i=0;i<=my;i++){
	for(j=0;j<=mx;j++)
	map[i][j]=0;	
}


</script>
<?php 
$sql = "SELECT * FROM `savehouse` WHERE user = '$id' ";
$result=mysql_query($sql,$link) or die ("Error in query: $query. " . mysql_error());
print '<script>';
while ($rows=mysql_fetch_array($result)){
	print 'map['.$rows[3].']['.$rows[2].']='.$rows[1].';	
	';			
	}
print "</script>";
?>



<script>	
var now=[];
	 now[0]= <?php echo $nowx; ?>;
	 now[1]= <?php echo $nowy; ?>;
	var save_x = 33*now[0]+200;
	var save_y = 35*now[1]+102;
	function draw(people){

		var c = document.getElementById("myCanvas");	//取得myCanvas畫布
		var pen = c.getContext("2d");	//提起畫筆

		var oXHR=new XMLHttpRequest();  //IE5相容性問題未解決
		para= "x="+now[0]+"&y="+now[1];   // encodeURIComponent(para); URL編碼
		oXHR.open("POST","now.php",true);
		oXHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//	oXHR.setRequestHeader("Content-length", para.length);
		//	oXHR.setRequestHeader("Connection", "close");

		oXHR.send(para);
		
		var save_x = 33*now[0]+200;
		var save_y = 35*now[1]+102;
		pen.drawImage(img, 0, 0);	//將圖片放在畫布上
		for(i=0;i<6;i++){
			for(j=0;j<7;j++){
				if(map[j][i]!=0)
					pen.drawImage(box,33*i+200,35*j+102);
			}			
		}
		pen.drawImage(people, save_x, save_y);	//將圖片放在畫布上 //200.102 //33.35		
						
	}
	function key(e){
		var itemXHR=new XMLHttpRequest();  //IE5相容性問題未解決
		itemXHR.open("POST","item.php",true);
		itemXHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//	oXHR.setRequestHeader("Content-length", para.length);
		//	oXHR.setRequestHeader("Connection", "close");

		var x = e.keyCode;
		switch(x){
			case 83 :
				if(now[1]<my){
					now[1]++;
					switch (map[now[1]][now[0]]){
					case 1:
						now[1]--;
						break;
					case 2:
						if(map[now[1]+1][now[0]]==1||(now[1]+1)>my)now[1]--;
						else {
							var yn = now[1]+1;
							para= "xo="+now[0]+"&yo="+now[1]+"&xn="+now[0]+"&yn="+yn+"&name=savehouse";   // encodeURIComponent(para); URL編碼
							itemXHR.send(para);
							map[now[1]][now[0]]=0;
							map[now[1]+1][now[0]]=2;
							draw(peopled);
							}						
						break;
					 default:
						draw(peopled);
						break;					
					}
					}
				break;
				
			case 115 :
				if(now[1]<my){
					now[1]++;
					switch (map[now[1]][now[0]]){
					case 1:
						now[1]--;
						break;
					case 2:
						if(map[now[1]+1][now[0]]==1||(now[1]+1)>my)now[1]--;
						else {
							var yn = now[1]+1;
							para= "xo="+now[0]+"&yo="+now[1]+"&xn="+now[0]+"&yn="+yn+"&name=savehouse";   // encodeURIComponent(para); URL編碼
							itemXHR.send(para);
							map[now[1]][now[0]]=0;
							map[now[1]+1][now[0]]=2;
							draw(peopled);
							}						
						break;
					 default:
						draw(peopled);
						break;					
					}
					}
				break;
			case 100 :
				if(now[0]<mx){
					now[0]++;
					switch(map[now[1]][now[0]]){
						case 1:
						now[0]--;
						break;
						case 2:
						if(map[now[1]][now[0]+1]==1||now[0]+1>mx)now[0]--;
						else{
							var xn = now[0]+1;
							para= "xo="+now[0]+"&yo="+now[1]+"&xn="+xn+"&yn="+now[1]+"&name=savehouse";   // encodeURIComponent(para); URL編碼
							itemXHR.send(para);
							map[now[1]][now[0]]=0;
							map[now[1]][now[0]+1]=2;
							draw(peopler);
						}
						break;
					default:
						draw(peopler);
						break;}
						}
				break;
				
			case 68 :
				if(now[0]<mx){
					now[0]++;
					switch(map[now[1]][now[0]]){
						case 1:
						now[0]--;
						break;
						case 2:
						if(map[now[1]][now[0]+1]==1||now[0]+1>mx)now[0]--;
						else{
							var xn = now[0]+1;
							para= "xo="+now[0]+"&yo="+now[1]+"&xn="+xn+"&yn="+now[1]+"&name=savehouse";   // encodeURIComponent(para); URL編碼
							itemXHR.send(para);
							map[now[1]][now[0]]=0;
							map[now[1]][now[0]+1]=2;
							draw(peopler);
						}
						break;
					default:
						draw(peopler);
						break;}
						}
				break;
			case 87 :
				if(now[1]>0){
					now[1]--;
					switch (map[now[1]][now[0]]){
					case 1:
						now[1]++;
						break;
					case 2:
						if((now[1]-1)<0||map[now[1]-1][now[0]]==1)now[1]++;
						else {
							var yn = now[1]-1;
							para= "xo="+now[0]+"&yo="+now[1]+"&xn="+now[0]+"&yn="+yn+"&name=savehouse";   // encodeURIComponent(para); URL編碼
							itemXHR.send(para);
							map[now[1]][now[0]]=0;
							map[now[1]-1][now[0]]=2;
							draw(peopleu);
							}						
						break;
					 default:
						draw(peopleu);
						break;					
					}
					}
					break;
			case 119 :
				if(now[1]>0){
					now[1]--;
					switch (map[now[1]][now[0]]){
					case 1:
						now[1]++;
						break;
					case 2:
						if((now[1]-1)<0||map[now[1]-1][now[0]]==1)now[1]++;
						else {
							var yn = now[1]-1;
							para= "xo="+now[0]+"&yo="+now[1]+"&xn="+now[0]+"&yn="+yn+"&name=savehouse";   // encodeURIComponent(para); URL編碼
							itemXHR.send(para);
							map[now[1]][now[0]]=0;
							map[now[1]-1][now[0]]=2;
							draw(peopleu);
							}						
						break;
					 default:
						draw(peopleu);
						break;					
					}
					}
				break;
			case 97 :
				if(now[0]>0){
					now[0]--;
					switch(map[now[1]][now[0]]){
						case 1:
						now[0]++;
						break;
						case 2:
						if(now[0]-1<0||map[now[1]][now[0]-1]==1)now[0]++;
						else{
							var xn = now[0]-1;
							para= "xo="+now[0]+"&yo="+now[1]+"&xn="+xn+"&yn="+now[1]+"&name=savehouse";   // encodeURIComponent(para); URL編碼
							itemXHR.send(para);
							map[now[1]][now[0]]=0;
							map[now[1]][now[0]-1]=2;
							draw(peoplel);
						}
						break;
					default:
						draw(peoplel);
						break;}
						}
				break;
			case 65 :
				if(now[0]>0){
					now[0]--;
					switch(map[now[1]][now[0]]){
						case 1:
						now[0]++;
						break;
						case 2:
						if(map[now[0]-1<0||now[1]][now[0]-1]==1)now[0]++;
						else{
							var xn = now[0]-1;
							para= "xo="+now[0]+"&yo="+now[1]+"&xn="+xn+"&yn="+now[1]+"&name=savehouse";   // encodeURIComponent(para); URL編碼
							itemXHR.send(para);
							map[now[1]][now[0]]=0;
							map[now[1]][now[0]-1]=2;
							draw(peoplel);
						}
						break;
					default:
						draw(peoplel);
						break;}
						}
				break;
		}
	}
</script>

<body onload="draw(peopled);" onkeypress="key(event);" >

<canvas id="myCanvas" width="1000" height="1000">
Your browser does not support the canvas element.
</canvas>
<div name="main" align=center>

</div>
<div id="re1"></div>
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

</div>
</body>
</html>
