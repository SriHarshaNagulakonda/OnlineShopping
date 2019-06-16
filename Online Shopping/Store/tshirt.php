<!--<?php include('copy.php');?>-->
  <link rel="stylesheet" type="text/css" href="head.css">
<link rel="stylesheet" href="imgscroll.css">
</head>
<body>
<form action="tshirt.php" method="post">
<table border=0 cellspacing="10" cellpadding="5" class="menu">
	<tr width=300>
		<td>HOME</td>
		<td><div class="dropdown">
  <button class="dropbtn">MEN</button>
  <div class="dropdown-content">
    <input class="button" type="submit" name="1" value="T-SHIRTS">
    <input class="button" type="submit" name="2" value="SHIRTS">
    <input class="button" type="submit" name="3" value="TROUSERS">
    <input class="button" type="submit" name="5" value="SHOES">
  </div>
</div></td>
		  <td><div class="dropdown">
  <button class="dropbtn">WOMEN</button>
  <div class="dropdown-content">
    <input class="button" type="submit" name="6" value="T-SHIRTS">
    <input class="button" type="submit" name="7" value="SWEAT SHIRTS">
    <input class="button" type="submit" name="9" value="SHOES">
  </div>
</div></td>
<td><div class="dropdown">
  <button class="dropbtn">ELECTRONICS</button>
  <div class="dropdown-content">
    <input class="button" type="submit" name="8" value="MOBILES COVERS">
  </div>
</div></td>		</form>
		
<?php
$user=$_POST['user'];
if (isset($user)) {    
  echo "
<td align=right width=900><div class='dropdown'>
  <button class='dropbtn'>$user</button>
  <div class='dropdown-content'>
    <a href='cart_disp.php?message=$user'>CART</a>
    <a href='history.php?message=$user'>HISTORY</a>
  </div>
</div></td>
    <input type='hidden' value=$user name='user'>";
}


?>
	</tr>
</table><!--</form>
<form action="#" method="post">
<select name='sort'>
	<option value=1>Relavance</option>
	<option value=2>price   low -- high</option>
	<option value=3>price   high -- low</option>
</select>
<input type="submit" name="submit" value="Sort By" />
</form>-->
<?php
$s=1;/*
if(isset($_POST['submit']))
	$s=$_POST['sort']; 
$y=1;*/
for($i=1;$i<=10;$i++){
	if(isset($_POST[$i]))
	{
		$y=$i;
		break;
	}
}
$user=$_POST['user'];
$connection=mysql_connect("localhost","root","");
mysql_select_db("store",$connection);
if($s==1)
	$query="select * from products where type=".$y;
else if($s==2){
	$query="select * from products where type=".$y." order by ocost-ocost*discount*0.01";
}
else if($s==3)
	$query="select * from products where type=".$y." order by ocost-ocost*discount*0.01 desc";
$res=mysql_query($query,$connection);
$num=mysql_num_rows($res);
$arr=array(array());
$k=0;
for($i=0;$i<$num;$i++)
{
	$row=mysql_fetch_array($res);
	for($j=0;$j<8;$j++)
		$arr[$i][$j]=$row[$j];
}
$typ=$y;
echo "<form action='show.php' method='post'><input type='hidden' value='$typ' name='typ'><input type='hidden' value='$user' name='user'><input type='hidden' value='$num' name='rows'><table cellpadding=5 cellspacing=30>";
for($j=0;$j<$num/3;$j++){
	echo "<tr>";
for($i=0;$i<3&&$j*3+$i<$num;$i++)
	echo "<td><img src=images/".$arr[$j*3+$i][0]." width=300 height=400></td>";
echo "</tr><tr>";
for($i=0;$i<3&&$j*3+$i<$num;$i++){
	$id=$arr[$j*3+$i][2].$user;
	echo "<td><b>".$arr[$j*3+$i][4]."</b><span style=float:right;><input type='submit' src='images/cart.png' width=40 height=40 name='$id' value='Add to Cart'></span></td>";
}
echo "</tr><tr>";
for($i=0;$i<3&&$j*3+$i<$num;$i++){
	$id=$arr[$j*3+$i][2];
	$x=$arr[$j*3+$i][5]-$arr[$j*3+$i][5]*$arr[$j*3+$i][6]*(0.01);
	echo "<td> Rs. ".$x."  <strike><font size=4>".$arr[$j*3+$i][5]."</strike></font><font color=green>".$arr[$j*3+$i][6]."%</font><span style=float:right;><input type='submit' value='show' name='$id'></span></td>";
}
echo "</tr>";
}
echo "</table></form>";
mysql_close();
?>