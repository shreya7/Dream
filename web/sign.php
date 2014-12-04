<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Login Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!----- Scroll top --------->
<script type="text/javascript" src="web/js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="web/js/move-top.js"></script>
<script type="text/javascript" src="web/js/easing.js"></script>
<!-----End  Scroll top --------->
<link href="css/style1.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'>

</head>
<body>
<div class="wrap">

        <div class="header">  	
		 <div class="header_image">
		   <img src="web/images/header_img2.jpg" alt="" />
		   				<div class="header_desc">
				 			 			<a href="index.php"></a>		
		 				</div>			
		 </div>
		</div>
<!-- strat-contact-form -->	
<div class="contact-form">
<!-- start-form -->
	<form class="contact_form" action="signup.php" method="post" name="contact_form">
		<h1>Register Yourself with DOW</h1>
	    <ul>
	        <li>
	            <input type="email" class="textbox1" name="UserName" placeholder="info@w3layouts.com" required />
	            <span class="form_hint">Enter a valid email</span>
	             <p><img src="images/contact.png" alt=""></p>
	        </li>
	        <li>
	            <input type="password" name="Password" class="textbox2" placeholder="password">
	            <p><img src="images/lock.png" alt=""></p>
	        </li>
         </ul>
       	 	<input type="submit" name="Sign In" value="Sign In"/>
			<div class="clear"></div>	
			
		<div class="clear"></div>	
	</form>
	</center>
<!-- end-form -->

<!-- end-account -->
<div class="clear"></div>	
</div>
<!-- end-contact-form -->


</body>
</html>