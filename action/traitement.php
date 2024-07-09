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
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        // Sanitize and escape input
        $login = mysqli_real_escape_string($db, htmlspecialchars($_POST['login']));
        $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['password']));

        // Trim input
        $login = trim($login);
        $password = trim($password);

        // Validate input
        if ($login !== "" && $password !== "") {
            // Query to check login credentials
            $requete = "SELECT * FROM agent WHERE login_agents = '$login' AND password_agents = '$password'";
            $exec_requete = mysqli_query($db, $requete);

            if (!$exec_requete) {
                die('Query failed: ' . mysqli_error($db));
            }

            $reponse = mysqli_fetch_assoc($exec_requete);

            if ($reponse) { 
                // Store user information in session
                $_SESSION['user'] = $reponse;
                header('Location: http://localhost:8080/dashboard/');
                exit();
            } else {
                header('Location: http://localhost:8080/connexion.php?erreur=1'); // Incorrect username or password
                exit();
            }
        } else {
            header('Location: http://localhost:8080/connexion.php?erreur=2'); // Empty username or password
            exit();
        }
    } else {
        header('Location: http://localhost:8080/connexion.php?erreur=2'); // Empty username or password
        exit();
    }
}

// Close the database connection
mysqli_close($db);

?>
