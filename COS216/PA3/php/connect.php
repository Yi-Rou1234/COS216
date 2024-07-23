<?php
// Connect to database
$servername = "wheatley.cs.up.ac.za";
$username = "u22561154";
$password = "6SGC6BFVL4LPHW2ELWRMQMQMNOY6GADV";
$dbname = "u22561154_";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>