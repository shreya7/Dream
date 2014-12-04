<html>
<body background-image="">
</body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pcar";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO sell_master (brand,model,month,dat,year,city,img,price,name,address,email,comm_no,altnum)
VALUES ('$_POST[brand]','$_POST[model]','$_POST[month]','$_POST[dat]','$_POST[year]',
	'$_POST[city]','$_POST[upload]','$_POST[price]','$_POST[name]','$_POST[address]','$_POST[email]','$_POST[con]','$_POST[altnum]')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
   header("location:sho.php");
    echo "<a href=sell.php>Click here</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>