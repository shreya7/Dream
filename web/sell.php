<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Real Estate</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.asterisk_input:before {
content:"*"; 
color: #e32;
position: absolute; 
margin: 0px 0px 0px 0px; 
font-size: xx-large; 
padding: 0 3px 0 0; }

.mandatory {
    color: #000;
}
.mandatory:after {
   /* Empty content, but required for pseudo element to display */
   content: "*";

   /* Size of star within sprite */
    vertical-align: top;
    margin-right: -4px;
    font-size: 20 px;
    color: #d35400;
}
</style>
<style type="text/css">
<!--
.style3 {
  color: #FFFFFF;
  font-weight: bold;
  font-family: Verdana, Arial, Helvetica, sans-serif;
  font-size: 15;
}
.style4 {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  font-family: Verdana, Arial, Helvetica, sans-serif;
  }
.style6 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: small; }
.style8 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: small; font-weight: bold; }
.style9 {
  font-family: Verdana, Arial, Helvetica, sans-serif;
  font-weight: bold;
}
.style10 {font-size: small}
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
      <?php
    include "left.php"
    ?>
      <div class="rightpannel">
      <div>
      <br/>

   <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" bgcolor="#93A537"><span class="style4">&nbsp;Sell Your Car</span></td>
        </tr><p id="right"><label class="mandatory"></label> &nbsp;Required Field</p>
        <tr>
          <td><form id="form1" name="form1" method="post" action="sells.php">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
       
        <tr><td height="32"><label class="mandatory">Car Details  :</label> &nbsp;&nbsp;&nbsp;&nbsp;
  
  <input type="text" name="brand" placeholder="Car Brand" required/> &nbsp;&nbsp;<input type="text" name="model" Placeholder="Model" required/><br><br></td>
        </tr><br><br>
        <tr>
          <td><label class="mandatory">Car  Year  :</label>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <input type="text" name="dat" pattern="[1-31]{2}" placeholder="Date Of Issue">&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="month" pattern="[1-12]{2}" placeholder="Month">&nbsp;&nbsp;<input type="text" name="year" pattern="[1980-2014]{4}" placeholder="year purchase" required/><br><br></td>
 </tr>
        <tr>
          <td height="32">  

<label class="mandatory"> Car City :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="city" placeholder="Name of City" required><br><br></td>
        </tr>
        <tr>
          <td height="34"><label class="mandatory">Your Car :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="file" name="upload" placeholder="Car Image" required>
<br><br></td>
        </tr>

<tr>
          <td height="34"><label class="mandatory"> Expected Price:</label><label>(<img src="images/rs.png">)</label>&nbsp;
<input type="text" name="price" placeholder="Your Price" required>
<br><br></td>
        </tr>
        <tr>
          <td height="34"><label class="mandatory">Name : </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" placeholder="Your Name" required>
<br><br></td>
        </tr>
        <tr>
          <td height="34"><label class ="mandatory">Email :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="email" name="email" placeholder="Email id" required>
<br><br></td>
        </tr>
        <tr>
          <td height="34"><label class="mandatory">Mobile Number :</label>&nbsp;
<input type="text" name="phone"  pattern="[789][0-9]{9}" placeholder="Your Contact Number" required>
<br><br></td>
        </tr>
        <tr>
          <td height="34"><label>Alternate Number</label>
<input type="text" name="altnum" placeholder="Other contact"><br><br></td>
        </tr>

         <!--<div class="wrapper">
   <button class="button">Button</button>-->
<tr><td height="34"><p id="wrapper"><input type="submit" name="submit" value="Sell your car"></p></label>
</td>

</tr>

    
      </table></form>
      <br/>
      <br/>
      <br/>
      <br/>
      <br/>
      <br/>
      <br/>
      <br/>
      <br/>
      <br/>
      <br/>
      <br/>
      <br/>
      <br/>
      <br/>
      </div>
        
      </div>
    </div>
  </div>
  <div>
   <?php
   include "footer.php"
   ?>
  </div>
</div>
</body>
</html>
