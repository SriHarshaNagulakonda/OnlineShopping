<link rel="stylesheet" href="imgscroll.css">
  <link rel="stylesheet" type="text/css" href="head.css">
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
$user=$_GET['message'];
//$user=substr($user,2);
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
</table></form>

<?php
$user=$_GET['message'];
$connect=mysql_connect("localhost","root","");
mysql_select_db('store',$connect);
$query="select * from products where id in (select pid from cart where username='$user')";
$res=mysql_query($query,$connect);
$num=mysql_num_rows($res);
if($num==0)
	echo "Cart is Empty";
else{
	$num=mysql_num_rows($res);
$arr=array(array());
$k=0;
for($i=0;$i<$num;$i++)
{
	$row=mysql_fetch_array($res);
	for($j=0;$j<8;$j++)
		$arr[$i][$j]=$row[$j];
}

$query="select quantity from cart where username='$user'";
$res=mysql_query($query,$connect);
$nuum=mysql_num_rows($res);
	
for($i=0;$i<$nuum;$i++)
{
	$roww=mysql_fetch_array($res);
	$arr[$i][8]=$roww[0];
}

echo "<form action='buy.php?message=$user' method='post'><input type='hidden' value='$user' name='user'><input type='hidden' value='$num' name='rows'><table border=0 cellpadding=5 cellspacing=30>";
for($j=0;$j<$num/3;$j++){
	echo "<tr>";
for($i=0;$i<3&&$j*3+$i<$num;$i++)
	echo "<td><img src=images/".$arr[$j*3+$i][0]." width=300 height=400></td>";
echo "</tr><tr>";
for($i=0;$i<3&&$j*3+$i<$num;$i++){
	$id=$arr[$j*3+$i][2].$user;
	echo "<td><b>".$arr[$j*3+$i][4]."</b></td>";
}
echo "</tr><tr>";
for($i=0;$i<3&&$j*3+$i<$num;$i++)
	echo "<td> BRAND :<font color=blue>".$arr[$i][3]."</font></td>";
echo "</tr><tr>";
for($i=0;$i<3&&$j*3+$i<$num;$i++){
	$id=$arr[$j*3+$i][2];
	$x=$arr[$j*3+$i][5]-$arr[$j*3+$i][5]*$arr[$j*3+$i][6]*(0.01);
	echo "<td> Rs. ".$x." X ".$arr[$i][8]." = Rs.".$arr[$i][8]*$x;//."  <strike><font size=4>".$arr[$j*3+$i][5]."</strike></font><font color=green>".$arr[$j*3+$i][6]."%</font></td>";
}
echo "</tr>";
}
echo "<tr><td></td><td align='center'><input type='submit' name='buy' value='BUY'></table></form>";
//".$arr[$j*3+$i][2]."
mysql_close();
}
?>