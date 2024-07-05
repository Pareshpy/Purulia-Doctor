<?php
include_once('../includes/config.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
$response = array();
$list = array();
// $get_id = $_GET['id'];
// if ($get_id) {
// 	$id = $get_id;
// 	$sql = "SELECT * from `users` where `id` = $id";
// 	$data = $conn->query($sql);
// 	if ($data->num_rows > 0) {
// 		$result = mysqli_fetch_array($data);

// 		$id 		=	$result['id'];
// 		$username	=	$result['username'];
// 		$fname 		= 	$result['firstname'];
// 		$lname 		=	$result['lastname'];
// 		$phone 		=	$result['phone'];

// 		$list[] = array('id' => $id, 'username' => $username, 'firstname' => $fname, 'lastname' => $lname, 'phone' => $phone);
// 		$response['users'] = $list;
// 		$json_data2 = json_encode($response);
// 		echo $json_data2;
// 		$conn->close();
// 	} else {
// 		echo "User not found!";
// 	}
// } else {

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $get_id = null;
    $get_update_id = null;

    $sql = "SELECT * FROM `doctors` ORDER BY `id` DESC LIMIT 5";


    $result = $conn->query($sql);

    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $full_name = $row['full_name'];
        $short_name = $row['short_name'];
        $reg_no = $row['reg_no'];
        $cat = $row['category'];

        $list[] = array(
            'id' => $id,
            'full_name' => $full_name,
            'short_name' => $short_name,
            'reg_no' => $reg_no,
            'category' => $cat
        );
    }

    // $response['doctors'] = $list;
    $json_data = json_encode($list);
    echo $json_data;
    $conn->close();
    // $fp = fopen('list.json', 'w');
    // fwrite($fp, json_encode($response));
    // fclose($fp);

    // }
} else {
    $mError = json_encode(["status" => "Method not allowed!"]);
    // header("http/1.1 403");
    http_response_code(405);

    echo $mError;
}
