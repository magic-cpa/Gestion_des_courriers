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
<html>
<head>
    <link type="text/css" rel="stylesheet" href="css/gestioncss.css" />
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
	<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link rel="stylesheet" href="css/jquery-ui.css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>

<form action="/action/traitement.php" method="POST">
   <!-- <header>
         <div class="header">
            <h2><b id="red">GESTION DES COURRIERS</b></h2>
        </div> 
    </header>-->
    <?php
    {/** Error display **/}
    if (isset($_GET['erreur'])) {
        $err = $_GET['erreur'];
            if ($err == 1) {
                echo "<p style='color:#fff;margin-left:0rem;  width: 100%; background: red;text-align: center; padding:1rem; margin:0.5rem'>Login ou le mot de passe ne correspond à aucun compte</p>";
            } elseif ($err == 2) {
                echo "<p style='color:#fff;  width: 100%; background: red;  padding:1rem; 
                margin:0.5rem; margin-left:0rem;  text-align: center'>Remplissez les champs s'il vous plaît</p>";
            }
    }
    ?>
    <body>
        <div class="fidele">
         
            <div>
                <!-- <i class="fas fa-user"></i> -->
                <label for="">Nom agent</label>
                <input type="text" name="login" placeholder="Entrer votre login" id="login">
            </div>
            <div>
                <label for="">Mot de passe</label>
                <input type="password" name="password" placeholder="Entrer votre mot de passe" id="password">
            </div>
            <div>
                <button type="submit" name="connecter" id="submit">Connecter</button>
            </div>
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