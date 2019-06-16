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
echo $user;
$connection=mysql_connect("localhost","root","");
mysql_select_db("store",$connection);
$query="select type,brand,descc,(select pid from history where username='$user' and pid=id) from products where id in (select pid from history where username='$user')";
$result=mysql_query($query,$connection);
$num=mysql_num_rows($result);
?>
<table cellspacing="10">
	<tr>
		<th>S.NO</th>
		<th>TYPE</th>
		<th>BRAND</th>
		<th>NAME</th>
		<th>QUANTITY</th>
	</tr>
<?php
$type=array("MEN T-SHIRTS","MEN SHIRTS","TROUSERS","MOBILES","MEN SHOES","WOMEN T-SHIRTS","WOMEN SWEAT-SHIRTS","MOBILE COVERS","WOMEN SHOES");
for($i=0;$i<$num;$i++){
	$row=mysql_fetch_array($result);
	echo "<tr><td>".($i+1)."</td><td>".$type[$row[0]]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td></tr>";
}
?>