<?php
//afficher les requette
ini_set('display_errors', 1);

// connection
$server = "localhost";
$login = "root";
$pass = "1234";
$dbname = "gestion_courrier";
$db = mysqli_connect($server, $login, $pass, $dbname)
    or die('DATA pas connecter');


$resultat = "";
$messzge_error = NULL;
$password_confirm_error = NULL;
$carater_error = NULL;

//fonction de securisation
function securisation($var)
{
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = trim($var);
    $var = htmlspecialchars($var);
    return $var;
}

// POUR LA PAGE D'INSCRIPTION
if (isset($_POST['envoyer'])) {

    if (isset($_POST['nom_agent']) && isset($_POST['prenom_agent']) && isset($_POST['tel_agent']) && isset($_POST['email_agent']) && isset($_POST['password']) && isset($_POST['password_confirm'])) {

        /*recuperation des donnee*/
        $nom_agent = securisation($_POST['nom_agent']);
        $prenom_agent = securisation($_POST['prenom_agent']);
        $tel_agent = securisation($_POST['tel_agent']);
        $email_agent = securisation($_POST['email_agent']);
        $password = securisation($_POST['password']);
        $password_confirm = securisation($_POST['password_confirm']);


        //les champs "nom" et "prenom" comportent au moins trois caractere lettre
        if (strlen($password) < 6) {
            $caracter_error = "Le mot de passe doit comporter au moins 6 caractères";
            $isSuccess = false;
        } elseif ($password !== $password_confirm) {
            $password_confirm_error = "Les mots de passe ne correspondent pas";
            $isSuccess = false;
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Database connection
            $conn = new mysqli("localhost", "root", "1234", "gestion_courrier");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare the SQL statement to insert data
            $stmt = $conn->prepare("INSERT INTO agent (nom_agent, prenom_agent, email_agent, tel_agent, password, logical_delete) VALUES (?, ?, ?, ?, ?, 0)");

            // Bind parameters and execute the statement
            $stmt->bind_param("sssss", $nom_agent, $prenom_agent, $email_agent, $tel_agent, $hashed_password);
            if ($stmt->execute()) {
                $agent_id = $stmt->insert_id;

                // Prepare the notification content
                $contenu_not = "Un nouveau compte agent a été créer sous nom: '$nom_agent $prenom_agent";
                $category = "Inscription";

                // Insert the notification into the notification table
                $stmt_not = $conn->prepare("INSERT INTO notification (id_agent, contenu_not, category, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
                $stmt_not->bind_param("iss", $agent_id, $contenu_not, $category);
                if ($stmt_not->execute()) {
                    // Notification inserted successfully
                } else {
                    printf("Erreur d'insertion de la notification: %s\n", $stmt_not->error);
                }

                // Close the notification statement
                $stmt_not->close();

                // Redirect to success page
                header("Location: http://localhost:8080/");
                exit(); 
            } else {
                printf("Erreur d'insertion: %s\n", $stmt->error);
                $isSuccess = false;
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        }
    } else {
        $message_error = "Tous les champs doivent être remplis";
        $isSuccess = false;
    }
}