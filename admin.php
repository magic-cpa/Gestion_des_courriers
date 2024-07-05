<?php  
  session_start();  
  if(isset($_SESSION["user"]))  
  {  
        header("location:admin/home.php");  
   }  
 
 ?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>PAGE DES ADMINISTRATEUR</title>
  
      <link rel="stylesheet" href="admin/css/style.css">

</head>

<body>
  <div id="clouds">
	<div class="cloud x1"></div>
	<!-- Time for multiple clouds to dance around -->
	<div class="cloud x2"></div>
	<div class="cloud x3"></div>
	<div class="cloud x4"></div>
	<div class="cloud x5"></div>
</div>

 <div class="container">


      <div id="login">

        <form method="post">

          <fieldset class="clearfix">

            <p><span class="fontawesome-user"></span><input type="text"  name="user" value="Username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
            <p><span class="fontawesome-lock"></span><input type="password" name="pass"  value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
            <p><input type="submit" name="sub"  value="Login"></p>

          </fieldset>

        </form>

      </div> <!-- end login -->

    </div>
    <!-- <div class="bottom">  <h3><a href="../index.php">SUN RISE HOMEPAGE</a></h3></div> -->
</body>
</html>

<?php
//    include('db.php');
  //afficher les requette
ini_set('display_errors', 1);
//afficher les requette
ini_set('display_errors', 1);

// connection
$server = "localhost";
$login = "root";
$pass = "";
$dbname = "gestion_courrier";
$db = mysqli_connect($server, $login, $pass, $dbname)
    or die('DATA pas connecter');

// connection


if (isset($_POST['sub'])) {
  if (isset($_POST['user']) && isset($_POST['pass'])) {
      session_start();
      // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
      // pour éliminer toute attaque de type injection SQL et XSS
      $login = mysqli_real_escape_string($db, htmlspecialchars($_POST['user']));
      $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['pass']));

      if ($login !== "" && $password !== "") {

          //la requette pour selectioner la une colonne de la table en etabl une relation entre les valeur
          $requete = "SELECT count(*) FROM user WHERE  user_name = '" . $login . "' and password_user = '" . $password . "' ";

          //execution de la requette
          $exec_requete = mysqli_query($db, $requete);
          $reponse      = mysqli_fetch_array($exec_requete);
          $count = $reponse['count(*)'];
          if ($count != 0) // nom d'utilisateur et mot de passe correctes
          {
              $_SESSION['login'] = $user;
              header('Location: page_admin.php');
          } else {
              echo 'utilisateur ou mot de passe incorrect';
          }
      } else {
          echo 'utilisateur ou mot de passe vide';
      }
  }
}

mysqli_close($db); // fermer la connexion


?>
