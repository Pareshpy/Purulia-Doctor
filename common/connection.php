<?php
include './vendor/autoload.php';

$servername = "152.67.7.221:3306";
$username = "pdproject2";
$password = "PDProject@1234$";
$database = "pdproject2";

// Establish a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
