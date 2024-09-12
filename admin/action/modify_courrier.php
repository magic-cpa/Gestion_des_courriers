<?php 
require_once __DIR__ .'/../db_.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $idCourrier = $_POST['id_courrier'];
    $titreCour = $_POST['titre_cour'];
    $agentRecepteur = $_POST['agent_recepteur'];
    $fileCourrier = $_FILES['file_cour'];


    if (isset($_FILES['file_cour']) && $_FILES['file_cour']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file_cour']['tmp_name'];
        $fileName = $_FILES['file_cour']['name'];
        $fileSize = $_FILES['file_cour']['size'];
        $fileType = $_FILES['file_cour']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Define allowed file extensions and size limit
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        $maxFileSize = 5 * 1024 * 1024; // 5 MB

        if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
            $uploadFileDir ='C:/xampp/htdocs/Gestion_des_courriers/courriers/';
            $dest_path = $uploadFileDir . $fileName;
            
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // File upload successful
                $fileCour = $fileName;
            } else {
                // Error moving the uploaded file
                echo "Error moving the uploaded file.";
                exit;
            }
        } else {
            // Invalid file extension or size
            echo "Invalid file extension or file size too large.";
            exit;
        }
    } else {
        // If no new file is uploaded, use the existing file name from the database
        $sql = "SELECT file_cour FROM courrier WHERE id_courrier = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $idCourrier);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $fileCour);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    // Update the database record
    $sql = "UPDATE courrier SET titre_cour = ?, file_cour = ?, updated_at = NOW() WHERE id_courrier = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'ssi', $titreCour, $fileCour, $idCourrier);
    
    if (mysqli_stmt_execute($stmt)) {
        // Successfully updated
        header('location: http://localhost:8080/admin/index.php');
    } else {
        // Update failed
        echo "Error updating courrier: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}


?>