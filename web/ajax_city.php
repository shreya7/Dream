<?php
// Establish Connection with MYSQL
$con = mysql_connect ("localhost","root");
// Select Database
mysql_select_db("pcar", $con);
if($_POST['BrandName'])
{
$id=$_POST['BrandName'];
$sql=mysql_query("select * from model_master where BrandName='$id' ");
echo '<option selected="selected">--Select Brand--</option>';
while($row=mysql_fetch_array($sql))
{
echo '<option value="'.$row['ModelName'].'">'.$row['ModelName'].'</option>';
}
}

?>