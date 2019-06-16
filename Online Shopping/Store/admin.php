<?php
$connection=mysql_connect("localhost","root","");
mysql_select_db("store",$connection);
$image=$_POST['image'];
$type=$_POST['type'];
$id=$_POST['id'];
$brand=$_POST['brand'];
$descc=$_POST['descc'];
$ocost=$_POST['ocost'];
$discount=$_POST['discount'];
$quantity=$_POST['quantity'];
$query="insert into products (image, type, id, brand,descc,ocost,discount,quantity) values ('$image', '$type', $id, '$brand','$descc',$ocost,$discount,'$quantity')";
$result=mysql_query($query,$connection);
if($result)
  echo "one row inserted";
else
  echo mysql_error();
?>
