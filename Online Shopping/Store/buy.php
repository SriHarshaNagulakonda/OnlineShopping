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
$user=$_POST['user'];
echo "<b> NAME :</b>".$user;
?>
<table cellspacing="10">
	<tr>
		<th>S.No</th>
		<th>TYPE</th>
		<th>BRAND</th>
		<th>NAME</th>
		<th>PRICE</th>
		<th>QUANTITY</th>
		<th>SUB TOTAL</th>
	</tr>
<?php
$user=$_POST['user'];
$connect=mysql_connect("localhost","root","");
mysql_select_db('store',$connect);
$query="select * from products where id in (select pid from cart where username='$user')";
$res=mysql_query($query,$connect);
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
$sum=0;
$type=array("MEN T-SHIRTS","MEN SHIRTS","TROUSERS","MOBILES","MEN SHOES","WOMEN T-SHIRTS","WOMEN SWEAT-SHIRTS","MOBILE COVERS","WOMEN SHOES");
for($i=0;$i<$num;$i++){
	$x=$arr[$i][5]-$arr[$i][5]*$arr[$i][6]*(0.01);
	echo "<tr><td>".($i+1)."</td><td>".$arr[$i][3]."</td><td>".$arr[$i][3]."</td><td>".$arr[$i][4]."</td><td>".$x."</td><td>".$arr[$i][8]."</td><td>".($arr[$i][5]-$arr[$i][5]*$arr[$i][6]*(0.01))*$arr[$i][8]."</td></tr>";
$sum+=$x*$arr[$i][8];
}
echo "<tr></tr><tr><td></td><td></td><td></td><td></td><td></td><td><b>TOTAL:</b></td><td>".$sum."</td></tr><tr><td colspan=7 ALIGN=CENTER><form action='pay.php?message=$user' method='post'><input type='hidden' name='user' value='$user'><input type='submit' name='pay' value='BUY'></TD></TR>";
?>