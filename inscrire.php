<?php
if (session_status() == PHP_SESSION_NONE){
    session_start();
}

if(isset($_SESSION)){
    if(isset($_SESSION['user'])){
        header('location: http://localhost:8080/dashboard/');
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
        <form action="/action/inscription.php" method="POST" ENCTYPE="multipart/form-data">
            <div class="form_inscr">
                <div class="col-md-6 mb-3">
                    <label for="nom_agent">Nom</label>
                    <input type="text" name="nom_agent" id="nom_agent" class="form-control" placeholder="Entrez votre nom" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="prenom_agent">Prénom</label>
                    <input type="text" name="prenom_agent" id="prenom_agent" class="form-control" placeholder="Entrez votre prénom" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email_agent">Email</label>
                    <input type="email" name="email_agent" id="email_agent" class="form-control" placeholder="Entrez votre email" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tel_agent">Téléphone</label>
                    <input type="tel" name="tel_agent" id="tel_agent" class="form-control" placeholder="Entrez votre numéro de téléphone" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Entrez votre mot de passe" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password_confirm">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Confirmer le mot de passe" required>
                </div>
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