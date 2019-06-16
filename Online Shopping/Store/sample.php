<?php
$connection=mysql_connect("localhost","root","");
mysql_select_db("store",$connection);
$query="select * from images";
$res=mysql_query($query,$connection);
$row=mysql_fetch_array($res);
$x=$row[1];
?>
<img src="<?php echo $row['img'];?>" height=100 width=100>