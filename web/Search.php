<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Dreams On Wheel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style6 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: small; }
.style9 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style10 {font-size: small}
.style11 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: small; }
-->
</style>
</head>
<body>
<div class="main">
  <?php
  include "Headermenu.php"
  ?>
  <div class="content">
    <div class="innercontent">
     
      <div class="rightpannel">
      <div>
      <br/>
         <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>
			
              </td>
            </tr>
            <tr>
              <td>
              <?php
$a=$_GET['CityName'];
$b=$_GET['BrandName'];
$c=$_GET['ModelName'];
$d=$_GET['CatId'];
// Establish Connection with Database
$con = mysql_connect("localhost","root");
// Select Database
mysql_select_db("pcar", $con);
// Specify the query to execute
$sql = "SELECT category_master.CategoryName, property_master.PropertyId, property_master.CityName, property_master.BrandName,property_master.ModelName, property_master.PropertyName, property_master.PropertyImage, property_master.PropertyDesc, property_master.PropertyAge, property_master.PropertyCost, property_master.Status, property_master.CustomerId
FROM  category_master, property_master
WHERE category_master.CategoryId=property_master.CategoryId AND property_master.CityName='".$a."' AND property_master.BrandName='".$b."' AND property_master.ModelName='".$c."' AND property_master.CategoryId='".$d."'";
// Execute query
$result = mysql_query($sql,$con);
$records = mysql_num_rows($result);
echo $records." Property Found";


// Loop through each records 
while($row = mysql_fetch_array($result))
{



$CityName=$row['CityName'];
$Model=$row['ModelName'];
$BrandName=$row['BrandName'];

$Age=$row['PropertyAge'];
$Cost=$row['PropertyCost'];
$Status=$row['Status'];
$Description=$row['PropertyDesc'];
$Image1=$row['PropertyImage'];
$CID=$row['CustomerId'];

?>

			
              <table width="100%" height="344" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td colspan="4" bgcolor="#93A537">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="4" bgcolor="#93A537"><span class="style23">
                    <?php 
			  // Retrieve Number of records returned
$records = mysql_num_rows($result);

			  ?>
                  </span></td>
                  </tr>
                

                
                <tr>
                  <td valign="middle"><div align="center"><img src="images/<?php echo $Image1;?>" alt="" width="200" height="200" border="3" /></div></td>
                  <td colspan="1" valign="top"><table width="100%" height="251" border="0" cellpadding="0" cellspacing="0">
                 
                   
                    <tr>
                      <td><span class="style9 style10">Brand Name:</span></td>
                      <td><span class="style9 style10"><?php echo $BrandName ;?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style9 style10">Model:</span></td>
                      <td><span class="style9 style10"><?php echo $Model ;?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style9 style10">Cost:</span></td>
                      <td><span class="style9 style10"><?php echo $Cost ;?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style9 style10">Total Years:</span></td>
                      <td><span class="style9 style10"><?php echo $Age ;?></span></td>
                    </tr>
                   
                  </table></td>
                  </tr>
                <tr>
                  <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><span class="style11">Owner Details:</span></td>

                      <td><a href="register.php?CustId=<?php echo $CID;?>" class="style11">View</a></td>
                      
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="4" bgcolor="#93A537">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="4" bgcolor="#FFFFFF"><hr/></td>
                  </tr>

                <tr>
                  <td colspan="4">  </td>
                  </tr>
              </table>
              <?php
}

mysql_close($con);
?>
              </td>
            </tr>
          </table>
     
      </div>
        
      </div>
    </div>
  </div>
  <div>
    <footer>
   <?php
   include "footer.php"
   ?>
 </footer>
  </div>
</div>
</body>
</html>
