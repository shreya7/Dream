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

$sql = "INSERT INTO contact (Name,Email,Fax,Subject)
VALUES ('$_POST[userName]','$_POST[userEmail]','$_POST[userPhone]','$_POST[userMsg]')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
   header("location:index.html");
    echo "<a href=contact.html>Click here</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>