<?php

// Display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$server = "localhost";
$login = "root";
$pass = "1234";
$dbname = "gestion_courrier";
$db = mysqli_connect($server, $login, $pass, $dbname);

if (!$db) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Start the session
session_start();

// Check if the form was submitted
if (isset($_POST['connecter'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        // Sanitize and escape input
        $email = mysqli_real_escape_string($db, htmlspecialchars($_POST['email']));
        $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['password']));

        // Trim input
        $email = trim($email);
        $password = trim($password);

        // Validate input
        if ($email !== "" && $password !== "") {
            // Query to check login credentials
            $requete = "SELECT * FROM agent WHERE email_agent = '$email'";
            $exec_requete = mysqli_query($db, $requete);

            if (!$exec_requete) {
                die('Query failed: ' . mysqli_error($db));
            }

            $reponse = mysqli_fetch_assoc($exec_requete);

            if ($reponse && password_verify($password, $reponse['password'])) {
                // Password verification successful
                // Store user information in session
                $_SESSION['user'] = $reponse;
                header('Location: http://localhost:8080/dashboard/');
                exit();
            } else {
                // Incorrect email or password
                header('Location: http://localhost:8080/connexion.php?erreur=1');
                exit();
            }
        } else {
            // Empty email or password
            header('Location: http://localhost:8080/connexion.php?erreur=2');
            exit();
        }
    } else {
        header('Location: http://localhost:8080/connexion.php?erreur=2'); // Empty email or password
        exit();
    }
}

// Close the database connection
mysqli_close($db);

?>
