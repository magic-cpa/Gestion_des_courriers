<?php 
session_start();
require_once __DIR__.'/../db_.php'; // Replace with your database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Escape user inputs to prevent SQL injection
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Query to check login credentials (adjust table and column names as per your database structure)
    $sql = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            // Verify hashed password
            if (password_verify($password, $row['password'])) {
                // Password correct, set session and redirect
                $_SESSION['admin'] = $result;
                header("location: http://localhost:8080/admin/index.php");
                exit;
            } else {
                // Password incorrect
                header('location: http://localhost:8080/admin/login.php?error=Your Login Name or Password is invalid'); 
                exit; 
            }
        } else {
            // No user found with the provided email
            header('location: http://localhost:8080/admin/login.php?error=Your Login Name or Password is invalid'); 
            exit; 
        }
    } else {
        // Query failed
        die('Query failed: ' . mysqli_error($con));
    }

    // Close connection
    mysqli_close($con);
}