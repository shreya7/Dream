<?php
$link=mysql_connect('localhost','root','');
if(! $link)
	die('Error '.mysql_error());
mysql_select_db("pcar",$link);
$pick=$_POST['pick'];

$sql="insert into wash_date (WashDate) values('{$pick}')";
mysql_query($sql,$link);
echo ' <div class="header-bottom">
		          <div class="menu">
					    <ul>
							<li><a href="index.html">Home</a></li></ul></div>';
 echo ' <div class="header-bottom">
		          <div class="menu"> 
		          <script type="text/javascript">alert("Thank You for choosing date ! Our service guy will be at your doorstep ");
		          window.location="index.html\";</script></div></div>';
 
mysql_close($link);
?>