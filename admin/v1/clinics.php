<?php
include_once('../includes/config.php');
require '../vendor/autoload.php';
$redis = new Predis\Client();

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
	$redis_key = "clinics";
	// echo $redis->ping();
	if (!$redis->get($redis_key)) {
		$sql = "SELECT * FROM `clinics`";


		$result = $conn->query($sql);

		while ($row = mysqli_fetch_array($result)) {
			$id = $row['id'];
			$owner_name = $row['owner_name'];
			$owner_email = $row['owner_email'];
			$owner_phone = $row['owner_phone'];
			$clinic_name = $row['clinic_name'];
			$clinic_phone = $row['clinic_phone'];
			$clinic_email = $row['clinic_email'];
			$clinic_address = $row['clinic_address'];
			// $clinic_name = $row['category'];


			$list[] = array(
				'id' => $id,
				'owner_name' => $owner_name,
				'owner_email' => $owner_email,
				'owner_phone' => $owner_phone,
				'clinic_name' => $clinic_name,
				'clinic_phone' => $clinic_phone,
				'clinic_email' => $clinic_email,
				'clinic_address' => $clinic_address
			);
		}

		// $response['doctors'] = $list;
		$json_data = json_encode($list);
		echo $json_data;
		$redis->set("clinics", $json_data);
		$conn->close();
	} else {
		// echo "Data from redis";
		echo $redis->get("clinics");
	}
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
