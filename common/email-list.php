<?php
include 'emails.php';

$emailList = new Emails();
$emailsJson = $emailList->getEmails();
$emails = json_decode($emailsJson, true); // Decode JSON as an associative array

if ($emails === null) {
    echo "Failed to decode JSON.";
} else {
    echo "<div>";
    foreach ($emails as $email) {
        echo "<p>ID: " . htmlspecialchars($email['id']) . "</p>";
        echo "<p>Name: " . htmlspecialchars($email['first_name']) . "</p>";
        echo "<p>Email: " . htmlspecialchars($email['email']) . "</p>";
        echo "<p>Phone: " . htmlspecialchars($email['phone']) . "</p>";
        echo "<hr>";
    }
    echo "</div>";
}
?>
