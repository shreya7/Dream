<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Dreams On Wheel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style4 {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  font-family: Verdana, Arial, Helvetica, sans-serif;
  }
.style6 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: small; }
.style9 {
  font-family: Verdana, Arial, Helvetica, sans-serif;
  font-weight: bold;
}
.style10 {font-size: small}
.style11 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: small; }

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
$con = mysql_connect("localhost","root");
// Select Database
mysql_select_db("pcar", $con);
// Specify the query to execute
$sql = "SELECT * FROM  wash_date order by id desc limit 1";
// Execute query
$result = mysql_query($sql,$con);
$records = mysql_num_rows($result);



// Loop through each records 
while($row = mysql_fetch_array($result))
{



$washdate=$row['WashDate'];
$Name=$row['name'];
$Address=$row['address'];

$Contact=$row['phone'];
$Email=$row['email'];

?>

      
              <table width="100%" height="344" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td colspan="2" bgcolor="#93A537"><span class="style4">&nbsp;Date and Details Given By You -</span></td>
                </tr>
                <!--<tr>
                  <td colspan="4" bgcolor="#93A537"><span class="style23">-->
                    <?php 
        // Retrieve Number of records returned
$records = mysql_num_rows($result);

        ?>
                  <!--</span></td>
                  </tr>
                      <tr>
          <td height="25" bgcolor="#93A537"><span class="style4">&nbsp; </span></td>
        </tr>-->

                
                
                      <td><span class="style9 style10">Your Name:</span></td>
                      <td><span class="style9 style10"><?php echo $Name ;?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style9 style10">Car Wash Date:</span></td>
                      <td><span class="style9 style10"><?php echo $washdate ;?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style9 style10">Address:</span></td>
                      <td><span class="style9 style10"><?php echo $Address ;?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style9 style10">Contact Details:</span></td>
                      <td><span class="style9 style10"><?php echo $Contact ;?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style9 style10">Email Address:</span></td>
                      <td><span class="style9 style10"><?php echo $Email ;?></span></td>
                    </tr>
                   
                  </table></td>
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
<meta http-equiv="refresh" content="3; url=chk.html">
</body>
</html>
