<?php
$link=mysql_connect('localhost','root','');
if(! $link)
	die('Error '.mysql_error());
mysql_select_db("pcar",$link);
$pick=$_POST['pick'];
$name=$_POST['name'];
$add=$_POST['add'];
$phone=$_POST['con'];
$email=$_POST['email'];
$sql="insert into wash_date (WashDate,name,address,phone,email) values('{$pick}','{$name}','{$add}','{$phone}','{$email}')";
mysql_query($sql,$link);
header("location:send.php");
		          
 /*echo ' <div class="header-bottom">
		          <div class="menu"> 
	          <script type="text/javascript">alert("Thank You for choosing date ! Our service guy will be at your doorstep ");
		          window.location="index.html";</script></div></div>';
 */

mysql_close($link);
?>