<?php
// Establish Connection with MYSQL
$con = mysql_connect ("localhost","root");
// Select Database
mysql_select_db("pcar", $con);
if($_POST['CityName'])
{
$id=$_POST['CityName'];
$sql=mysql_query("select * from brand_master where CityName='$id' ");
echo '<option selected="selected">--Select City--</option>';
while($row=mysql_fetch_array($sql))
{
echo '<option value="'.$row['BrandName'].'">'.$row['BrandName'].'</option>';
}
}

?>