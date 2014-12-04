<?php

$link=mysql_connect('localhost','root','');
if(! $link)
	die('Error '.mysql_error());
mysql_select_db("pcar",$link);
$UserName=$_POST['UserName'];
$Password=$_POST['Password'];
$sql="insert into login_master (UserName,Password) values('{$UserName}','{$Password}')";
mysql_query($sql,$link);
//echo "<script type='text/javascript'>alert('You Have Been Successfully Registered and Logged In !') window.location='service.html'</script>";
//header('location:service.html');
echo '<script type="text/javascript">'; 
echo 'alert("You Have Been Successfully Registered and Logged In !");'; 
echo 'window.location.href = "service.html";';
echo '</script>';
mysql_close($link);
?>