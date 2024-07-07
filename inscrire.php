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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSCRIPTIION</title>
</head>

<body>
    <div class="container mt-5">
        <div class="tete text-center mb-4">
            <h3 style="color:#000">S'inscrivez-vous tout en remplissant ces champs</h3>
            <?php if (!empty($password_confirm_error)) { echo "<p class='alert alert-danger'>$password_confirm_error</p>"; } ?>
            <?php if (!empty($messzge_error)) { echo "<p class='alert alert-danger'>$messzge_error</p>"; } ?>
            <?php if (!empty($carater_error)) { echo "<p class='alert alert-danger'>$carater_error</p>"; } ?>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" ENCTYPE="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" name="num_agent" class="form-control" placeholder="Votre numero d'agent svp" id="num_agent" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" name="nom_agent" class="form-control" placeholder="Votre nom d'agent svp" id="nom_agent" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="number" name="tel_agent" class="form-control" placeholder="Votre numero de telephone" id="tel_agent" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="email" name="mail_agent" class="form-control" placeholder="Votre mail" id="mail_agent" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" name="login" class="form-control" placeholder="Votre login" id="login" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Votre mot de passe" id="Password" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="password" name="password_confirm" class="form-control" placeholder="Confirmer le mot de passe" id="password_confirm" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" name="num_service" class="form-control" placeholder="Votre numero de service" id="num_service">
                </div>
                <div class="col-12 text-center">
                    <button type="submit" name="envoyer" class="btn btn-primary btn-lg">Envoyer</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function Afficher() {
            var input = document.getElementById("Password");
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>