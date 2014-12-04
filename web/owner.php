<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Dreams On Wheel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/style1.css" rel="stylesheet" type="text/css" />
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

// Establish Connection with Database
$con = mysql_connect("localhost","root",'');
// Select Database
mysql_select_db("pcar", $con);
// Specify the query to execute
$sql = "SELECT * FROM  customer_reg ORDER BY CustomerId DESC LIMIT 1";
// Execute query
$result = mysql_query($sql,$con);
//$records = mysql_num_rows($result);
//echo $records." Property Found";

if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}
// Loop through each records 
while($row = mysql_fetch_array($result))
{



$CustomerName=$row['txtName'];
$Address=$row['txtAddress'];
$City=$row['cmbCity'];

$Mobile=$row['txtMobile'];
$Email=$row['txtEmail'];
$Gender=$row['sex'];


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
                  <td valign="middle"><div align="center"><img src="image/<?php echo $Image1;?>" alt="" width="200" height="200" border="3" /></div></td>
                  <td colspan="1" valign="top"><table width="100%" height="251" border="0" cellpadding="0" cellspacing="0">
                 
                   
                    <tr>
                      <td><span class="style9 style10">Customer Name:</span></td>
                      <td><span class="style9 style10"><?php echo $CustomerName ;?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style9 style10">Address:</span></td>
                      <td><span class="style9 style10"><?php echo $Address ;?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style9 style10">City:</span></td>
                      <td><span class="style9 style10"><?php echo $City ;?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style9 style10">Contact Number:</span></td>
                      <td><span class="style9 style10"><?php echo $Mobile ;?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style9 style10">Mail Id :</span></td>
                      <td><span class="style9 style10"><?php echo $Email ;?></span></td>
                    </tr>
                     <tr>
                      <td><span class="style9 style10">Gender:</span></td>
                      <td><span class="style9 style10"><?php echo $Gender ;?></span></td>
                    </tr>
                  </table></td>
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
