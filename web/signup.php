<?php
header('location:profile.php');
$link=mysql_connect('localhost','root','');
if(! $link)
	die('Error '.mysql_error());
mysql_select_db("pcar",$link);
$UserName=$_POST['UserName'];
$Password=$_POST['Password'];
$sql="insert into login_master (UserName,Password) values('{$UserName}','{$Password}')";
mysql_query($sql,$link);
echo "Successfully inserted";
mysql_close($link);
?>