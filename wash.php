<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Dream On Wheel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({ minDate: 0 });
  });
  </script>
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
          <td height="25" bgcolor="#93A537"><span class="style4">&nbsp;Select Your Date</span></td>
        </tr>
        <tr>
          <td><form id="form1" name="form1" method="post" action="next.php">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
       <center>        <tr><td height="32"><label ><br>Select Your date  :</label> &nbsp;&nbsp;&nbsp;&nbsp;
  
  <input type="text" name="pick" id="datepicker" required/> <br><br></td></tr>
        <tr>
          <td><label >Your Name  :</label>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="name"  placeholder="Your Name" required/><br><br></td>
 </tr>
        <tr>
          <td><label >Your Address  :</label>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<textarea rows="3" cols="20" name="add"  placeholder="Your Address" required/></textarea><br><br></td>
 </tr> 
         
        <tr>
          <td height="34"><label>Contact Number</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="con"  pattern="[789][0-9]{9}" placeholder="Your contact number" required/><br><br></td>
        </tr>

         <tr>
          <td><label >Your Email  :</label>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="email"  placeholder="Your Email" required/><br><br></td>
 </tr>

         <!--<div class="wrapper">
   <button class="button">Button</button>-->
<tr><td height="34"><p id="wrapper"><input type="submit" name="submit" value="Click To Confirm"></p></label>
<br>
</td>

</tr>
<tr>
          <td height="25" bgcolor="#93A537"><span class="style4">&nbsp;</span></td>
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






</head>
<body >
 <form action="next.php" method="post">
<p>Date: <input type="text" name="pick" id="datepicker"></p><br>
Name    :<input type="text" name="name">
<br>
Address :<textarea name="add" rows="5" cols="30"></textarea>
Contact :<input type="text" name="con">
Email :<input type="email" name="email">
 <input type="submit" value="Done">
 </form>
 
</body>
</html>