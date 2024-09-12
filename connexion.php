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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
			function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //for-mobile-apps -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
	<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
	<link rel="stylesheet" href="css/jquery-ui.css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
	<!--fonts-->
	<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <style>
        /* CSS styles to fix the navbar at the top */
        .w3_navigation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        .container {
            padding-top: 15px;
        }
        /* Add padding to the body to avoid content going under the navbar */
        body {
            padding-top: 100px; /* Adjust based on your navbar height */
        }
        .navbar-brand {
            display: inline-block;
        }
    </style>
</head>
<body>
        
    <div class="w3_navigation">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="navbar-header navbar-left">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" >
        				<a class="navbar-brand brand-logo" href="/"><img src="images/algerie_telecome_logo.svg" alt="" class="" style="height:45px"/></a>
				</div>
                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                    <nav class="menu menu--iris">
                        <ul class="nav navbar-nav menu__list">
                            <li class="menu__item menu__item--current"><a href="/" class="menu__link">Acceuil</a></li>
                            <li class="menu__item"><a href="#contact" class="menu__link scroll">Contact </a></li>
                            <li class="menu__item"><a href="connexion.php" class="">Mon compte </a></li>
                        </ul>
                    </nav>
                </div>
            </nav>
        </div>
    </div>

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
                echo "<p style='color:#fff;margin-left:0rem;border-radius:3px;  width: 100%; background: red;text-align: center; padding:1rem; margin:0.5rem'>email ou mot de passe ne correspond à aucun compte</p>";
            } elseif ($err == 2) {
                echo "<p style='color:#fff;  width: 100%; background: red;  padding:1rem; 
                margin:0.5rem; margin-left:0rem;  text-align: center'>Remplissez les champs s'il vous plaît</p>";
            }
        }
        ?>
        <div class="fidele">
            <div>
                <label for="login">Email</label>
                <input type="email" name="email" placeholder="Entrer votre email" id="email" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" placeholder="Entrer votre mot de passe" id="password" required>
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

    </form>
    
</body>
</html>