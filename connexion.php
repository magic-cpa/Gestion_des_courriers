<!DOCTYPE html>

<html>

<head>
    <link type="text/css" rel="stylesheet" href="css/gestioncss.css" />
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>

<form action="traitement.php" method="post">

    <header>
        <div class="header">
            <h2><b id="red">GESTION DES COURRIERS</b></h2>
        </div>
    </header>

    <body>
        <div class="fidele">
         
            <div>
                <!-- <i class="fas fa-user"></i> -->
                <label for="">Login</label>
                <input type="text" name="login" placeholder="Entrer votre login" id="login">
            </div>
            <div>
                <label for="">Mot de passe</label>
                <input type="password" name="password" placeholder="Entrer votre mot de passe" id="password">
            </div>
            <div>
                <button type="submit" name="connecter" id="submit">Connecter</button>
            </div>

            <?php
            if (isset($_GET['erreur'])) {
                $err = $_GET['erreur'];
                if ($err == 1) {
                    echo "<p style='color:#fff;  width: 100%; background: red;text-align: center'>Login ou le mot de passe ne correspond à aucun compte</p>";
                } elseif ($err == 2) {
                    echo "<p style='color:#fff;  width: 100%; background: red; padding-top: 5px; padding-bottom:5px; text-align: center'>Remplissez les champs s'il vous plaît</p>";
                }
            }
            ?>
        </div>

        <div class="flex">
            <div id="flex1">
                <a id="pass" href="#">Mot de passe oublier</a>
            </div>
            <div id="flex2">
                <a href="inscrire.php"> <i class="fas fa-arrow-down-to-bracket"></i>Inscrivez-vous</a>
            </div>
        </div>

    </body>

</form>

</html>