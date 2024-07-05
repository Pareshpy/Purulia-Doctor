<?php
// error_reporting(0);

// Database section


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

// End

// Configuration section

$config['base_url'] = 'http://localhost/PD-Project/Purulia-Doctor/admin';
$config['header'] = './template/header.php';
$config['footer'] = './template/footer.php';

define('base_url', $config['base_url']);
define('header', $config['header']);
define('footer', $config['footer']);


// End