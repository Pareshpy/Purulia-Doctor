<?php
session_start();
include('./includes/config.php');

$d_id = $_GET['id'];
$c_id = $_GET['c'];
$stmt = "SELECT * FROM `doctor_clinic` WHERE `clinic_id` = '$c_id'";
$run_stmt = $conn->query($stmt);
// if()
$data_stmt = $run_stmt->fetch_object();
$docs = explode(',', $data_stmt->doc_id);
$docs = array_filter($docs);

if (($key = array_search($d_id, $docs)) !== false) {
    unset($docs[$key]);
    // print_r($docs);
    $new_docs = implode(',', $docs);
    $new = "UPDATE `doctor_clinic` SET `doc_id` = '$new_docs'";
    $run_new = $conn->query($new);
    if ($run_new) {
        header("location: ./assign_doctors.php?id=" . $c_id);
    }
}
