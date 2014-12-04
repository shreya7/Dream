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

$con=mysql_connect("localhost","root","") 
or die('Could not connect: ' . mysql_error());
 
 
mysql_select_db("pcar", $con);
    $sql = mysql_query ( "SELECT * FROM sell_master  ORDER BY ID DESC LIMIT 1" ) or die(mysql_error());
    

// Loop through each records 
while($row = mysql_fetch_array($sql))
{



$Model=$row['model'];
$Name=$row['name'];
$Image1=$row['img'];
$Address=$row['address'];
$Email=$row['email'];
$Contact=$row['comm_no'];
?>

			
              <table width="100%" height="344" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td colspan="4" bgcolor="#93A537">&nbsp;<strong><font color="#fff">Car You Want To Sell</font></strong></td>
                </tr>
                <tr>
                  <td colspan="4" bgcolor="#93A537"><span class="style23">
                    <?php 
			  // Retrieve Number of records returned
$records = mysql_num_rows($sql);

			  ?>
                  </span></td>
                  </tr>
                

                
                <tr>
                  <td valign="middle"><div align="center"><img src="images/<?php echo $Image1;?>" alt="" width="300" height="260" border="3" /></div></td>
                  <td colspan="1" valign="top"><table width="100%" height="251" border="0" cellpadding="0" cellspacing="0">
                 
                   
                    <tr>
                      <td><span class="style9 style10">Brand Name:</span></td>
                      <td><span class="style9 style10"><?php echo $Model ;?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style9 style10">Name:</span></td>
                      <td><span class="style9 style10"><?php echo $Name ;?></span></td>
                    </tr>
                     <tr>
                      <td><span class="style9 style10">Address:</span></td>
                      <td><span class="style9 style10"><?php echo $Address ;?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style9 style10">Email:</span></td>
                      <td><span class="style9 style10"><?php echo $Email ;?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style9 style10">Contact Number :</span></td>
                      <td><span class="style9 style10"><?php echo $Contact ;?></span></td>
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
             echo "<a href='chk.html'>Click To Return</a>";
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

<script type="text/javascript">
<!--
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
//-->
</script>
</body>
</html>
