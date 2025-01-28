<?php
include('common/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // print_r($_POST);
    $email = trim($email = $_POST['data']['email']);
    // print_r($email);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!empty($email)) {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $query_run = mysqli_query($conn, $query);
        if ($query_run->num_rows > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Email available']);
        }
    } 
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
