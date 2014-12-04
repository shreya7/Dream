<html>

<body>
	<h3> Car you want to sold is - <br></h3>
<?php

$con=mysql_connect("localhost","root","") 
or die('Could not connect: ' . mysql_error());
 
 
mysql_select_db("pcar", $con);
    $sql = mysql_query ( "SELECT * FROM sell_master  ORDER BY ID DESC LIMIT 1" ) or die(mysql_error());
    
    while($row = mysql_fetch_array($sql))
    {

    echo '<td> <img border="2"  width="400" src="images/' . $row['img'] . '"></td>';
    echo "<br>";
  echo '<td><b>Your car :'. $row['model'].'</b></td>';
   echo "<br>";
  echo '<td><b>Your Name :'.$row['name'].'</b></td>';
 
 // echo "<br>";
  //echo '<td><b>Your Contact Number :'.$row['contact'] .'</b></td>';
 
  

}
    ?>
    <a href="index.html">Home</a>