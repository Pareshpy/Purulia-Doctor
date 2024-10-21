<?php
include('./common/connection.php');

// Check if a session is not already started and start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

// Sample data - this would normally come from a database
$bookingId = 12345;
$customerName = $_SESSION['user_name'];
$bookingDate = "2024-07-12";

// Check if doctor_id and clinic_id are set in the GET request
if (!isset($_GET['doctor_id']) || !isset($_GET['clinic_id'])) {
    die("Error: Missing required parameters.");
}

$doctor_id = intval($_GET['doctor_id']); // Sanitize input
$clinic_id = intval($_GET['clinic_id']); // Sanitize input

// Prepare the SQL statement to fetch doctor and clinic details
$sql = "SELECT d.full_name AS doctor_name, d.fees, d.address, c.clinic_name, c.clinic_address
        FROM doctors d 
        JOIN clinics c ON d.address = c.clinic_address 
        WHERE d.id = ? AND c.id = ?";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ii", $doctor_id, $clinic_id);
    $stmt->execute();
    $stmt->bind_result($doctor_name, $fees, $doctor_address, $clinic_name, $clinic_address);
    $stmt->fetch();
    $stmt->close();
} else {
    die("Failed to prepare SQL statement.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto my-10 p-5 bg-white shadow-md rounded-lg">
        <div class="flex justify-between items-center pb-6 mb-6 border-b border-gray-200">
            <div>
                <h1 class="text-4xl font-bold">Invoice</h1>
                <p>Invoice #: <?php echo $bookingId; ?></p>
                <p>Created: <?php echo date("F d, Y"); ?></p>
                <p>Due: <?php echo $bookingDate; ?></p>
            </div>
            <div class="text-right">
                <h2 class="text-2xl font-semibold"><?php echo htmlspecialchars($customerName); ?></h2>
                <p>john@example.com</p>
            </div>
        </div>
        <div class="mb-8">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="font-semibold"><?php echo htmlspecialchars($clinic_name); ?></p>
                    <p><?php echo htmlspecialchars($clinic_address); ?></p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="font-semibold">Payment Method</p>
                </div>
                <div class="text-right">
                    <p>Check #</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p>Check</p>
                </div>
                <div class="text-right">
                    <p>1000</p>
                </div>
            </div>
        </div>
        <table class="w-full mb-8">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 text-left">Service</th>
                    <th class="py-2 px-4 text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-200">
                    <td class="py-2 px-4"><?php echo htmlspecialchars($doctor_name); ?></td>
                    <td class="py-2 px-4 text-right">$<?php echo number_format($fees, 2); ?></td>
                </tr>
                <tr class="font-semibold">
                    <td class="py-2 px-4 text-right" colspan="2">Total: $<?php echo number_format($fees, 2); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
