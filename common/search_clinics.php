<?php
include 'functions.php';

$pd = new PD;
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

// Fetch clinics from the database
$clinics = $pd->getClinic();
$clinics = json_decode($clinics, true);

if (!empty($searchQuery)) {
    // Filter clinics dynamically based on name, address, or owner
    $clinics = array_filter($clinics, function ($clinic) use ($searchQuery) {
        return stripos($clinic['clinic_name'], $searchQuery) !== false ||
               stripos($clinic['clinic_address'], $searchQuery) !== false ||
               stripos($clinic['owner_name'], $searchQuery) !== false;
    });
}

// Return JSON response
echo json_encode(array_values($clinics));
?>
