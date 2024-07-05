<?php

//afficher les requette
ini_set('display_errors', 1);

// connection
$server = "localhost";
$login = "root";
$pass = "";
$dbname = "gestion_courrier";
$db = mysqli_connect($server, $login, $pass, $dbname)
    or die('DATA pas connecter');


$resultat = "";
$messzge_error = NULL;
$password_confirm_error = NULL;
$carater_error = NULL;
$num_usager_error = NULL;
$nom_usager_error = NULL;
$tel_usager_error = NULL;
$mail_usager_error = NULL;
$adresse_usager_error = NULL;
$num_courrier_error = null;
$objet_courrier_error = null;
$date_courrier_error = null;
$ref_courrier_error = null;
$num_type_courrier_error = null;
$date_act_error = null;
$reach_error = null;
$document_error = NULL;
$isSucces = true;

//fonction de securisation
function securisation($var)
{
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = trim($var);
    $var = htmlspecialchars($var);
    return $var;
}

function is_name($nbr)
{
    if (strlen($nbr) >= 3) {
        return true;
    } else {
        return false;
    }
}
function is_word($nbr)
{
    if (preg_match("/^[a-zA-Z]+$/", $nbr)) {
        return true;
    } else {
        return false;
    }
}

function tele($nbr)
{
    if (strlen($nbr) >= 6) {
        return true;
    } else {
        return false;
    }
}

function is_number($nbr)
{
    if (preg_match("/^[0-9]+$/", $nbr)) {
        return true;
    } else {
        return false;
    }
}

function is_pass($nbr)
{
    if (preg_match("/^[0-9A-Za-Z@#.!,£%*]+$/", $nbr)) {
        return true;
    } else {
        return false;
    }
}

// ICI POUR PAGE DE CONNEXION 
// la verification de la connection

if (isset($_POST['connecter'])) {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        session_start();
        // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
        // pour éliminer toute attaque de type injection SQL et XSS
        $login = mysqli_real_escape_string($db, htmlspecialchars($_POST['login']));
        $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['password']));

        if ($login !== "" && $password !== "") {

            //la requette pour selectioner la une colonne de la table en etabl une relation entre les valeur
            $requete = "SELECT count(*) FROM agent where
              login_agents = '" . $login . "' and password_agents = '" . $password . "' ";

            //execution de la requette
            $exec_requete = mysqli_query($db, $requete);
            $reponse      = mysqli_fetch_array($exec_requete);
            $count = $reponse['count(*)'];
            if ($count != 0) // nom d'utilisateur et mot de passe correctes
            {
                
                    $_SESSION['login'] = $login;
                    header('Location: admin/nouveau_courrier.php');
                
            } else {
                header('Location: connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
            }
        } else {
            header('Location: connexion.php?erreur=2'); // utilisateur ou mot de passe vide
        }
    }
}

mysqli_close($db); // fermer la connexion

