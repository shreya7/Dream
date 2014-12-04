<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$Name=$_POST['txtName'];
$Address=$_POST['txtAddress'];
$City=$_POST['cmbCity'];
$Mobile=$_POST['txtMobile'];
$Email=$_POST['txtEmail'];
$Gender=$_POST['sex'];
//$Birthdate=$_POST['txtBirthDate'];
//$UserName=$_POST['txtUserName2'];
//$Password=$_POST['txtPassword2'];
	// Establish Connection with MYSQL
	$con = mysql_connect ("localhost","root",'');
	// Select Database
	mysql_select_db("pcar", $con);


$q=mysql_query("select * from Customer_Reg where Mobile='".$Mobile."' or Email='".$Email."' ") or die(mysql_error());
  $n=mysql_fetch_row($q);
  if($n>0)
  {
   //echo "$er='The username name '.$Name.' or mail '.$Email.' is already present in our database'";
   echo '<script type="text/javascript">alert("Mobile or Email already exists in database.Please give proper details");window.location=\'register.php\';</script>';
  }

else
{
	// Specify the query to Insert Record
	$sql = "insert into Customer_Reg (CustomerName,Address,City,Mobile,Email,Gender)values('".$Name."','".$Address."','".$City."','".$Mobile."','".$Email."','".$Gender."')";
	// execute query
	mysql_query ($sql,$con);
	

	echo '<script type="text/javascript">alert("Thank you For Buy the car from DOW.");window.location=\'final.php\';</script>';
}	// Close The Connection
	mysql_close ($con);
?>
</body>
</html>
