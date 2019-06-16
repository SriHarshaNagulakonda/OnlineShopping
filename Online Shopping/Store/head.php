<!DOCTYPE html>
<html>
<head>
	<title>Shopping</title>
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
</body>
</html>


<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="imgscroll.css">
<style>
.mySlides {display:none;}
</style>
<body>
<div class="w3-content w3-display-container">
  <img class="mySlides" src="images/1.jpg" style="width:100%" width="1700" height="550">
  <img class="mySlides" src="images/2.jpg" style="width:100%" width="1700" height="550">
  <img class="mySlides" src="images/3.jpg" style="width:100%" width="1700" height="550">
  <img class="mySlides" src="images/4.jpg" style="width:100%" width="1700" height="550">
  <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>

</body>
</html>
