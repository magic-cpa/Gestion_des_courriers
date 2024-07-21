<?php
require_once __DIR__.'/../db_.php';

if (isset($_POST['send'])) {
    // Escape user inputs to prevent SQL injection
    $titre_cour = mysqli_real_escape_string($con, $_POST['titre_cour']);
    $agent_recepteur = mysqli_real_escape_string($con, $_POST['agent_recepteur']);
    $file_cour = $_FILES['file_cour']['name'];
    $file_cour_tmp = $_FILES['file_cour']['tmp_name'];
    $file_cour_dir = "C:/xampp/htdocs/Gestion_des_courriers/courriers/" . $file_cour;
    // Check the file extension
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
    $file_extension = strtolower(pathinfo($file_cour, PATHINFO_EXTENSION));

    if (in_array($file_extension, $allowed_extensions)) {
        // Move the uploaded file to the desired directory
        if (move_uploaded_file($file_cour_tmp, $file_cour_dir)) {
            // Insert into courrier table
            $sql_courrier = "INSERT INTO courrier (file_cour, titre_cour, created_at, updated_at) VALUES ('$file_cour', '$titre_cour', NOW(), NOW())";
            
            if (mysqli_query($con, $sql_courrier)) {
                // Get the last inserted ID
                $id_courrier = mysqli_insert_id($con);

                // Get the admin ID from session (assuming admin is logged in and ID is stored in session)
                // Replace '1' with actual admin ID from the session
                $id_admin = 1;

                // Insert into courrier_agent table
                $sql_courrier_agent = "INSERT INTO courrier_agent (id_cour, id_ag, id_admin, created_at, updated_at) VALUES ('$id_courrier', '$agent_recepteur', '$id_admin', NOW(), NOW())";

                if (mysqli_query($con, $sql_courrier_agent)) {
                    // Insert into notification table
                    $contenu_not = mysqli_real_escape_string($con, "Un nouveau courrier '$titre_cour' intitulé vous a été envoyé.");
                    $category = mysqli_real_escape_string($con, "Courrier");
                    
                    // Insert into notification table
                    $sql_notification = "INSERT INTO notification (id_cour, id_agent, contenu_not, category, created_at, updated_at) VALUES ('$id_courrier', '$agent_recepteur', '$contenu_not', '$category', NOW(), NOW())";
                    if (mysqli_query($con, $sql_notification)) {
                        echo '<script>alert("Courrier sent successfully!"); window.location.href="http://localhost:8080/admin/index.php";</script>';
                    } else {
                        echo '<script>alert("Error: Could not insert notification data."); window.location.href="http://localhost:8080/admin/index.php";</script>';
                    }
                } else {
                    echo '<script>alert("Error: Could not send courrier agent data."); window.location.href="http://localhost:8080/admin/index.php";</script>';
                }
            } else {
                echo '<script>alert("Error: Could not insert courrier data."); window.location.href="http://localhost:8080/admin/index.php";</script>';
            }
        } else {
            echo '<script>alert("Error: Could not upload file."); window.location.href="http://localhost:8080/admin/index.php";</script>';
        }
    } else {
        echo '<script>alert("Error: Invalid file type. Only jpg, png, and pdf files are allowed."); window.location.href="http://localhost:8080/admin/index.php";</script>';
    }

    // Close the database connection
    mysqli_close($con);
} else {
    header("Location: http://localhost:8080/admin/index.php");
    exit();
}
?>