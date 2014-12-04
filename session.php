<?php
include('db.php');
session_start();
$check=$_SESSION['UserName'];
$session=mysql_query("SELECT UserName FROM `login_master` WHERE username='$check' ");
$row=mysql_fetch_array($session);
$login_session=$row['UserName'];
if(!isset($login_session))
{
header("Location:log.php");
}
?>