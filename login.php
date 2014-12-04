<?php
session_start();
$message="";
if(count($_POST)>0) {
$conn = mysql_connect("localhost","root","");
mysql_select_db("pcar",$conn);
$result = mysql_query("SELECT * FROM login_master WHERE UserName='" . $_POST["UserName"] . "' and Password = '". $_POST["Password"]."'");
$row  = mysql_fetch_array($result);
if(is_array($row)) {
//$_SESSION["UserId"] = $row[UserId];
$_SESSION["UserName"] = $row[UserName];
$_SESSION["Password"] = $row[Password];
} else {
$message = "Invalid Username or Password!";
header("Location:sign.php");
}
}
if(isset($_SESSION["UserName"])) {
header("Location:service.html");
}
?>


