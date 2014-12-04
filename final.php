<?php require_once('PMS.php'); ?>
<?php
echo " Thank you ";


$a=$_GET['CityName'];
$b=$_GET['BrandName'];
$c=$_GET['ModelName'];
$d=$_GET['CatId'];
// Select Database
mysql_select_db("pcar", $con);
// Specify the query to execute
$sql = "DELETE category_master.CategoryName, property_master.PropertyId, property_master.CityName, property_master.BrandName,property_master.ModelName, property_master.PropertyName, property_master.PropertyImage, property_master.PropertyDesc, property_master.PropertyAge, property_master.PropertyCost, property_master.Status, property_master.CustomerId
FROM  category_master, property_master
WHERE category_master.CategoryId=property_master.CategoryId AND property_master.CityName='".$a."' AND property_master.BrandName='".$b."' AND property_master.ModelName='".$c."' AND property_master.CategoryId='".$d."'";
// Execute query
$result = mysql_query($sql,$con);
$records = mysql_num_rows($result);
echo $records." Property Deleted";

//header( "refresh:5;url=index.html" );
?>