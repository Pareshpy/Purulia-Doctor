<?php
include 'connection.php';

class Emails
{
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
}
?>
