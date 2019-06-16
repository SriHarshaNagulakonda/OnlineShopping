<?php
$connect=mysql_connect("localhost","root","");
mysql_select_db('store',$connect);
if($connect)
echo "connected";
else
echo "not connected";
if(isset($_POST['submit']))
{
$username=$_POST['username'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
$email=$_POST['email'];
echo $username;
$query="insert into registration(username,password,email) values('$username','$password','$email')";
$result=mysql_query($query,$connect);
if($result)
echo " inserted";
else
echo " not inserted";
}
else{
$username=$_POST['user'];
$password=$_POST['pass'];
$k=0;
$query="select username,password from registration";
$res=mysql_query($query,$connect);
$num_rows=mysql_num_rows($res);
for($i=0;$i<$num_rows;$i++)
{
	$row=mysql_fetch_array($res);
	echo $row[0];
	if($username==$row[0]&&$password==$row[1])
	{
		$k=1;
		header("location: head.php?message='$username'");
		break;
	}
}
	if($k==0)
		echo "<h1>incorrect password</h1>";
	else
		echo "<h1>successfull</h1>";
}
mysql_close($connect);
?>	