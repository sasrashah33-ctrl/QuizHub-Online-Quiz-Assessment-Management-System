<?php

session_start(); 

$host   = "localhost";
$dbuser = "root";   
$dbpass = "";      
$dbname = "quizhub_db";

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
