<?php 
if (isset($_POST['sub'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $approval = "Not Allowed";
    
    // Connect to the database
    $con = mysqli_connect("localhost", "root", "1234", "gestion_courrier");

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO `contact`(`fullname`, `phoneno`, `email`, `cdate`, `approval`) VALUES ('$name', '$phone', '$email', now(), '$approval')";

    if (mysqli_query($con, $sql)) {
        header("Location: http://localhost:8080/");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
        
