<?php
include 'connection.php';

class PD
{
    public function getDoctors()
    {
        global $conn;
        $query = "SELECT * FROM doctors";
        $query_run = mysqli_query($conn, $query);
        $check_doctor = mysqli_num_rows($query_run);

        $doctors = [];
        if ($check_doctor > 0) {
            while ($row = mysqli_fetch_object($query_run)) {
                $doctors[] = $row;
            }
        }

        return json_encode($doctors);
    }

    public function getEmails()
    {
        global $conn;
        $query = "SELECT * FROM users";
        $query_run = mysqli_query($conn, $query);

        if (!$query_run) {
            die("Database query failed: " . mysqli_error($conn));
        }

        $emails = [];
        while ($row = mysqli_fetch_assoc($query_run)) {
            $emails[] = $row;
        }

        return json_encode($emails);
    }
    function checkEmail($data)
    {
        global $conn;
        $email = $data->email;
        $query = "SELECT * FROM users WHERE email = '$email'";
        $query_run = mysqli_query($conn, $query);
        if ($query_run->num_rows > 0) {
            json_encode(['status' => 'error', 'message' => 'Email already exists']);
        } else {
            json_encode(['status' => 'success', 'message' => 'Email available']);
        }

    }
}


