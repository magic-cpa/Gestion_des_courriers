<?php
// Include your database connection
require_once __DIR__ .'/../db_.php';

// Check if the 'courrier' parameter is set in the URL
if (isset($_GET['courrier'])) {
    $idCourrier = $_GET['courrier'];

    // Prepare the SQL query to update the 'archiver' field
    $sql = "UPDATE courrier SET archiver = 1 WHERE id_courrier = ?";
    
    if ($stmt = mysqli_prepare($con, $sql)) {
        // Bind the 'id_courrier' parameter to the statement
        mysqli_stmt_bind_param($stmt, 'i', $idCourrier);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to the index or success page after updating
            header('Location: /admin/index.php');
            exit();
        } else {
            echo "Error updating the archive status: " . mysqli_error($con);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }
}

// Close the database connection
mysqli_close($con);