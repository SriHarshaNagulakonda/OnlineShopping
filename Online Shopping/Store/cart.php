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
$user=substr($user,2);
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
echo "
<form action='#' method='post'>
<select name='quantity'>";
for($i=1;$i<=20;$i++)
	echo "<option value=$i>$i</option>";
echo "</select>
<input type='submit' name='submit' value='Add' />
</form>
";
$s=1;
$user=$_GET['message'];
if (isset($user)) {    
	$id=substr($user, 0,2);
	//$id=$_POST['id'];
	$user=substr($user, 2);
	//$user=$_POST['name'];
}
if(isset($_POST['quantity'])){
	$s=$_POST['quantity']; 
$connection=mysql_connect("localhost","root","");
mysql_select_db("store",$connection);
$query="select quantity from products where id=$id";
$res=mysql_query($query,$connection);
$row=mysql_fetch_array($res);
if($row[0]<$s)
	echo "Out of Stock";
else{
	$query="insert into cart values('$user','$id','$s')";
	$res=mysql_query($query);
	if($res)
		echo "inserted";
	else{
		$query="select quantity from cart where pid='$id' && username='$user'";
		$res=mysql_query($query,$connection);
		$roww=mysql_fetch_array($res);
		$quan=$roww[0];		
		$query="update cart set quantity=quantity+$s where pid='$id' && username='$user' && (quantity+$s)<=$row[0]";
		$res=mysql_query($query,$connection);
		if(($quan+$s)<=$row[0])
			echo "updated";
		else
			echo "OUT of STOCK";
	}
}}
?>