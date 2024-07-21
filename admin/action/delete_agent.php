<?php
require_once __DIR__.'/../db_.php';

if (isset($_GET['ridz'])) {
    $id_agent = $_GET['ridz'];

    // Prepare the SQL statement to update the logical_delete column
    $stmt = $con->prepare("UPDATE agent SET logical_delete = 1 WHERE id_agent = ?");
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }

    $stmt->bind_param("i", $id_agent);

    // Execute the statement
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            header("Location: http://localhost:8080/admin/index.php?message=Agent marked as deleted successfully");
            exit();
        } else {
            echo "<script>alert('No rows updated. The agent might not exist or is already marked as deleted.');</script>";
        }
    } else {
        echo "<script>alert('Error updating agent: " . $stmt->error . "');</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
} else {
    echo "No agent ID specified.";
}