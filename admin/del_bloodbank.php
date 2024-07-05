<?php
session_start();
include('./includes/config.php');

$c_id = $_GET['id'];
$stmt = "DELETE FROM `bloodbanks` WHERE `id` = '$c_id'";
$run_stmt = $conn->query($stmt);

header("location: ./bloodbanks.php");