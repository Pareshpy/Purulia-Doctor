<?php
// Assuming you have established a database connection
include './common/connection.php';

// Get the search query from the URL parameter (assuming it's passed as 'search')
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
    
    // SQL query to search for doctors, categories, or clinics
    $query = "SELECT * FROM doctors 
              WHERE full_name LIKE '%$search_query%' 
              OR category LIKE '%$search_query%' 
              OR address LIKE '%$search_query%'";

    $query_run = mysqli_query($conn, $query);

    // Check if there are any results
    if (mysqli_num_rows($query_run) > 0) {
        // Loop through the results and display them
        while ($row = mysqli_fetch_assoc($query_run)) {
            // Display each result as per your requirement
            echo '<div>';
            echo '<h4>' . $row['full_name'] . '</h4>';
            echo '<p>' . $row['category'] . '</p>';
            echo '<p>' . $row['address'] . '</p>';
            echo '</div>';
        }
    } else {
        echo "<p>No results found.</p>";
    }
} else {
    echo "<p>No search query provided.</p>";
}

// Close the connection
mysqli_close($conn);
?>
