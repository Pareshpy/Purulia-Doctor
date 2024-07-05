<?php
include_once('../includes/config.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

$response = array();
$list = array();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (file_get_contents("php://input")) {
        $rJD = json_decode(file_get_contents("php://input"));
        $get_id = $rJD->id;

        $id = $get_id;
        $sql = "SELECT * FROM `doctor_clinic` WHERE `clinic_id` = '$get_id'";
        $data = $conn->query($sql);
        if ($data->num_rows > 0) {
            $result = $data->fetch_object();

            $id         =   $result->id;
            $doc_id     =   $result->doc_id;
            $clinic_id  =   $result->clinic_id;
            $status     =   $result->status;

            $clinic = "SELECT * FROM `clinics` WHERE `id` = '$clinic_id'";
            $run_clinic = $conn->query($clinic);
            $data_clinic = $run_clinic->fetch_array();

            $c_id = $data_clinic['id'];
            $owner_name = $data_clinic['owner_name'];
            $owner_email = $data_clinic['owner_email'];
            $owner_phone = $data_clinic['owner_phone'];
            $clinic_name = $data_clinic['clinic_name'];
            $clinic_phone = $data_clinic['clinic_phone'];
            $clinic_email = $data_clinic['clinic_email'];
            $clinic_address = $data_clinic['clinic_address'];

            $clinic_data[] = array(
                'id' => $c_id,
                'owner_name' => $owner_name,
                'owner_email' => $owner_email,
                'owner_phone' => $owner_phone,
                'clinic_name' => $clinic_name,
                'clinic_phone' => $clinic_phone,
                'clinic_email' => $clinic_email,
                'clinic_address' => $clinic_address
            );
            // echo $doc_id;
            $docs = explode(',', $doc_id);
            $docs = array_filter($docs);
            $count_docs = count($docs);
            // echo $docs;
            for ($i = 0; $i < $count_docs; $i++) {
                $new = "SELECT * FROM `doctors` WHERE `id` = '$docs[$i]'";
                $run_new = $conn->query($new);
                $res_new = $run_new->fetch_array();
                $response[] = array(
                    'id' => $res_new['id'],
                    'full_name' => $res_new['full_name'],
                    'short_name' => $res_new['short_name'],
                    'reg_no' => $res_new['reg_no']

                );
            }

            // $list['docs'] = $response;

            // $response['users'] = $list;
            $new_list['clinic'] = $clinic_data;
            $new_list2['docs'] = $response;
            $new_a = array_merge($new_list, $new_list2, ["status" => "success"]);

            $json_data3 = json_encode($new_a);
            echo $json_data3;
            // $json_data2 = json_encode($list);
            // echo $json_data2;
            $conn->close();
        } else {
            $cError = json_encode(["status" => "Clinic not found!"]);
            // header("http/1.1 404");
            http_response_code(404);
            echo $cError;
        }
    } else {


        $get_id = null;
        $get_update_id = null;

        $sql = "SELECT * FROM `doctors`";


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

    }
} else {
    $mError = json_encode(["status" => "Method not allowed!"]);
    // header("http/1.1 403");
    http_response_code(405);

    echo $mError;
}
