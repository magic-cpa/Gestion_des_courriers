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

// POUR LA PAGE D'INSCRIPTIION
if (isset($_POST['envoyer'])) {

    if (isset($_POST['num_agent']) && isset($_POST['nom_agent']) && isset($_POST['tel_agent']) && isset($_POST['mail_agent'])  && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['num_service'])) {

        /*recuperation des donnee*/
        $num_agent = securisation($_POST['num_agent']);
        $nom_agent = securisation($_POST['nom_agent']);
        $tel_agent = securisation($_POST['tel_agent']);
        $mail_agent = securisation($_POST['mail_agent']);
        $login = securisation($_POST['login']);
        $password = securisation($_POST['password']);
        $password_confirm = securisation($_POST['password_confirm']);
        $num_service = securisation($_POST['num_service']);

        //les champs "nom" et "prenom" comporte au moins trois caractere lettre
        if ($num_agent && $nom_agent && $tel_agent && $login && $mail_agent && $password && $password_confirm && $num_service) {

            if (strlen($password) <= 6) {
                // verification la conformité des mot de passe
                if ($password_confirm == $password) {

                    $connexe = new mysqli("localhost", "root", "1234", "gestion_courrier");

                    $sql = "INSERT INTO agent VALUES ('','$login',' $password','$num_agent','$nom_agent','$tel_agent','$mail_agent','non valide')";

                    // $sql = "INSERT INTO agent VALUES ('','$num_agent', '$nom_agent', '$tel_agent', '$mail_agent', '$login', '$password', '$num_service','non valide')";

                    $res = $connexe->query($sql);

                    $_SESSION['login'] = $login;
                    
                    header("Location: http://localhost:8080/");

                    if (!$connexe->query($sql)) {
                        printf("Message d'erreur: %s\n", $connexe->error);
                    }

                    mysqli_close($connexe);
                } else {
                    $password_confirm_error = "mot de passe non conforme réesayer";
                    $isSucces = false;
                }
            } else {
                $carater_error = "mot de passe doit comporter au plus 6 caractere";
                $isSucces = false;
            }
        } else {
            $messzge_error = "Aucun champs ne doit pas etre non remplir";
            $isSucces = false;
        }
    }
}