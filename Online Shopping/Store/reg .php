<?php
$connect=mysql_connect("localhost","root","");
if($connect)
echo "connected";
else
echo "not connected";
$username=$_POST['username'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
$email=$_POST['email'];
mysql_select_db('store',$connect);
$query="insert into registration(username,password,email) values('$username','$password','$email')";
$result=mysql_query($query,$connect);
if($result)
echo " inserted";
else
echo " not inserted";
mysql_close($connect);
?>