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

                    $connexe = new mysqli("localhost", "root", "", "gestion_courrier");

                    $sql = "INSERT INTO agent VALUES ('','$login',' $password','$num_agent','$nom_agent','$tel_agent','$mail_agent','non valide')";

                    // $sql = "INSERT INTO agent VALUES ('','$num_agent', '$nom_agent', '$tel_agent', '$mail_agent', '$login', '$password', '$num_service','non valide')";

                    $res = $connexe->query($sql);

                    $_SESSION['login'] = $login;
                    
                    header("Location: connexion.php");

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link type="text/css" rel="stylesheet" href="css/inscrire.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSCRIPTIION</title>
</head>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" ENCTYPE="multipart/form-data">

    <body>
        <div class="tete">
            <h1>BIENVENUE SUR LA PLATEFORME COURRIER NUMERIQUE</h1>
            <h3>S'inscrivez-vous tout en remplissant ces champs</h3>
            <p><?php echo ('<p style = "color : red; font-size: 20px";>' .  $password_confirm_error . '</p>'); ?></p>
            <p><?php echo ('<p style = "color : #ffff; margin-left: 21%; font-size: 20px; width: 60%; background: red; padding-top: 5px; padding-bottom:5px; text-align: center";>' .  $messzge_error . '</p>'); ?></p>
            <p><?php echo ('<p style = "color : red; font-size: 20px";>' .  $carater_error . '</p>'); ?></p>
        </div>

        <div class="inputs">

            <div class="input1">
                <div>
                    <input type="text" name="num_agent" placeholder="Votre numero d'agent svp" id="num_agent" required>
                </div>
                <div>
                    <input type="text" name="nom_agent" placeholder="Votre nom d'agent svp" id="nom_agent" required>
                </div>
                <div>
                    <input type="number" name="tel_agent" placeholder="Votre numero de telephone" id="tel_agent" required>
                </div>
                <div>
                    <input type="email" name="mail_agent" placeholder="Votre mail" id="mail_agent" required>
                </div>
            </div>

            <div class="input2">
                <div>
                    <input type="text" name="login" placeholder="Votre login" id="login" required>
                </div>
                <div>
                    <input type="password" name="password" placeholder="Votre mot de passe" id="Password" required>
                </div>
                <div>
                    <input type="password" name="password_confirm" placeholder="Confirmer le mot de passe" id="password_confirm" required>
                </div>

                <!--
                    <div class="child2">
                        <input type="checkbox" name="" onclick="Afficher()" id="">
                    </div>
                    ---->
                <div>
                    <input type="text" name="num_service" placeholder="Votre numero de service" id="num_service">
                </div>
            </div>

        </div>

        <div class="envoyer">
            <input class="submit" type="submit" name="envoyer" id="envoyer" value="Envoyer">
        </div>

        <script>
            function Afficher() {
                var input = document.getElementById("Password");
                if (input.type === "password") {
                    input.type = "texe";
                } else {
                    input.type = "password"
                }
            }
        </script>

    </body>
</form>


</html>