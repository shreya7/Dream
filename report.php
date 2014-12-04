<html><body bgcolor="lavender"></body></html>
<?php
// Connect to the database
$dbLink = new mysqli('127.0.0.1', 'root', '', 'pcar');
if(mysqli_connect_errno()) {
    die("MySQL connection failed: ". mysqli_connect_error());
}
 
// Query for a list of all existing files
$sql = 'SELECT * FROM property_master ORDER BY PropertyId DESC LIMIT 5';
$result = $dbLink->query($sql);
 
// Check if it was successfull
if($result) {
    // Make sure there are some files in there
    if($result->num_rows == 0) {
        echo '<p>There are no files in the database</p>';
    }
    else {
        // Print the top of a table
        echo "<b><u>Report Of All the car which is being bought !</u></b> <br><br>";
        echo '<table width="100%">
                <tr><td><b>City Name</b></td>
                <td><b>Brand Name</b></td>
                <td><b>Model Name</b></td>
                <td><b>Property Cost</b></td>
                    <td><b>Property Status</b></td>
                    
                    
                </tr>';
 
        // Print each file
        while($row = $result->fetch_assoc()) {
            echo "
                <tr>

                    <td>{$row['CityName']}</td>
                    <td>{$row['BrandName']}</td>
                    <td>{$row['ModelName']}</td>
                    <td>{$row['PropertyCost']}</td>
                    <td>{$row['Status']}</td>
                  
                                    </tr>";
        }
 
        // Close table
        echo '</table>';
    }
 
    // Free the result
    $result->free();
}
else
{
    echo 'Error! SQL query failed:';
    echo "<pre>{$dbLink->error}</pre>";
}
 
// Close the mysql connection
$dbLink->close();
?>