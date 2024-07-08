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