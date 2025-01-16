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
}


