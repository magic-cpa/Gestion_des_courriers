<?php
// Start the session
session_start();

// Destroy the session
session_unset();  // Unset all session variables
session_destroy();  // Destroy the session

// Redirect to the login page (or any other page)
header("Location: http://localhost:8080/connexion.php");
exit();
?>