<?php
// connectionfile.php: Corrected Database Configuration

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "webdata";

// Create connection (using mysqli for simple connections)
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection and stop script if it fails
if (!$conn) {
    // Log error and stop script execution
    error_log("Database Connection Failed: " . mysqli_connect_error());
    die("Connection failed: " . mysqli_connect_error());
}

// NOTE: We do NOT echo "Connected successfully" and do NOT close the connection here.
// The connection is closed by PHP automatically at the end of the script, 
// or by the calling script manually if necessary.
?>