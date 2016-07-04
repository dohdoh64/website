<?php
$connectservername = "dbs.eq.edu.au";
$connectusername = "mwest139";
$connectpassword = "zl7uqmj8iqOZ";
$connectdbname = "dbmwest1391";


$conn = new mysqli($connectservername, $connectusername, $connectpassword, $connectdbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>