<?php
require_once __DIR__.'/../db_.php';

if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $prenom = mysqli_real_escape_string($con, $_POST['prenom']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $numero_tel = mysqli_real_escape_string($con, $_POST['numero_tel']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $password_confirm = mysqli_real_escape_string($con, $_POST['password_confirm']);
    $logical_delete_default = 0;

    // Check if passwords match
    if ($password !== $password_confirm) {
        echo '<script>alert("Les mots de passe ne correspondent pas."); window.location.href="http://localhost:8080/admin/home.php";</script>';
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into agent table
    $sql = "INSERT INTO agent (nom_agent, prenom_agent, email_agent, tel_agent, password, logical_delete, created_at, updated_at) 
            VALUES ('$name', '$prenom', '$email', '$numero_tel', '$hashed_password', $logical_delete_default, NOW(), NOW())";

    if (mysqli_query($con, $sql)) {
        echo '<script>alert("Agent ajouté avec succès!"); window.location.href="http://localhost:8080/admin/home.php";</script>';
    } else {
        echo '<script>alert("Erreur lors de l\'ajout de l\'agent."); window.location.href="http://localhost:8080/admin/home.php";</script>';
    }

    mysqli_close($con);
} else {
    header("Location: http://localhost:8080/admin/home.php");
    exit();
}

?>