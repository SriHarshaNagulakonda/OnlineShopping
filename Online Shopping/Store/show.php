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
</table></form>
<?php
$x=$_POST['rows'];
$y=$_POST['typ'];
$USER=$_POST['user'];
for($i=0;$i<$x;$i++)
{
$ABCD=$y*10+$i.$_POST['user'];
if(isset($_POST[$ABCD]))
{
	header("location: cart.php?message=$ABCD");
}
	if (isset($_POST[$y*10+$i])){
		$a=$y*10+$i;
		break;
	}
}


$img="images/".$a.".jpg";
$imga="images/".$a."a.jpg";
$imgb="images/".$a."b.jpg";
$imgc="images/".$a."c.jpg";
echo "<table cellspacing=20><tr>";
echo "<td><img src='$img' height=400 width=300></td><td><img src='$imga' height=400 width=300></td><td><img src='$imgb' height=400 width=300></td><td><img src='$imgc' height=400 width=300></td></tr></table>";
$connection=mysql_connect("localhost","root","");
mysql_select_db("store",$connection);
$query="select * from products where id=$a";
$res=mysql_query($query,$connection);
$row=mysql_fetch_array($res);
echo "<table cellspacing=10 margin-left:20px; border=0><tr>";
echo "<td><b>BRAND :</b></td><td><font color=blue>".$row[3]."</font></td></tr></table>";
echo $row[4];
echo "<table cellspacing=10><tr>";
$x=$row[5]-$row[5]*$row[6]*(0.01);
$xyz=$_POST['user'];
echo "<td> Rs.".$x."</td><td>  <strike><font size=4>".$row[5]."</strike></font></td><td><font color=green>".$row[6]."%</font></td>";
echo "</tr><tr><form action='cart.php?message=$ABCD' method='post'><input type='hidden' name='id' value='$a'><input type='hidden' name='name' value='$USER'><input type='submit' src='images/cart.png' width=40 height=40 name='$a' value='Add to Cart'></form></tr></table>";
?>