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
    
    try {
        $connexion = new PDO("mysql:host = $server;dbname=gestion_courrier;charset=utf8", $login, $pass);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // requette de selection de la table usager
        $req = "SELECT * FROM _usager";
        
        $requestusager = $connexion->query($req);

        // requette sur la selection de la table service
        $req = "SELECT * FROM destinataire";
        $requestservice = $connexion->query($req);

        // requette 
        $requette = "SELECT * FROM _usager";
        $nom_usage = $connexion->query($requette);

        if ($requestusager && $requestservice && $nom_usage)
          //le formulaire
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RESERVATION SUNRISE HOTEL</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a  href="../index.php"><i class="fa fa-home"></i> Menu Principal</a>
                    </li>
                    
					</ul>

            </div>

        </nav>
       
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                        NOUVEAU COURRIER <small></small>
                        </h1>
                    </div>
                </div> 
                 
                                 
            <div class="row">
                
                <!-- identification personel -->
                <div class="col-md-5 col-sm-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             INFORMATION PERSONNELLE
                        </div>
                        <div class="panel-body">

                        <!-- les deux formulaires -->
						<form name="form" method="post">
                            
                        <!--  Pour afficher le nom d'usager--->
                        <div id="input" class="form-group">
                        <label for="">Nom des Usager</label>
                        <select class="form-control" name="usager">
                       <?php
                          while ($tab = $nom_usage->fetch()) {
                               echo '<option value="' . $tab[2] . '"> ' . $tab[2] . '</option>';
                          }
                       ?>
                       </select>
                       </div>
                        <!--  //Pour afficher le nom d'usager--->

                            <div class="form-group">
                                            <label>Titre</label>
                                            <select name="title" class="form-control" required >
												<option value selected ></option>
                                                <option value="Dr.">Dr.</option>
                                                <option value="Miss.">Miss.</option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
												<option value="Prof.">Prof.</option>
												<option value="Rev .">Structure</option>
												<option value="Rev . Fr">Société</option>
                                            </select>
                              </div>
							  <div class="form-group">
                                            <label>Nom</label>
                                            <input name="nom" class="form-control" required>
                                            
                               </div>
							   <div class="form-group">
                                            <label>Prénoms</label>
                                            <input name="prenom" class="form-control" required>
                                            
                               </div>
							   <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" type="email" class="form-control" required>
                                            
                               </div>
							   <div class="form-group">
                                            <label>Type de carte*</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="carte"  value="Sri Lankan" checked="">NIP
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="carte"  value="Non Sri Lankan ">CIN
                                            </label>
                         
                                </div>
								<?php

								// $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

								?>
								<!-- <div class="form-group"> -->
                                            <!-- <label>Passport Country*</label>
                                            <select name="country" class="form-control" required>
												<option value selected ></option> -->
                                                <?php
												// foreach($countries as $key => $value):
												// echo '<option value="'.$value.'">'.$value.'</option>'; //close your tags!!
												// endforeach;
												?>
                                            <!-- </select> -->
								<!-- </div> - -->
								<div class="form-group">
                                            <label>Numero de la carte*</label>
                                            <input name="num_carte" type ="text" class="form-control" required>
                                            
                               </div>
                               <div class="form-group">
                                            <label>Numero de telephone*</label>
                                            <input name="phone" type ="text" class="form-control" required>
                                            
                               </div>
							   
                        </div>
                        <!-- //les deux formulaires -->
                        
                    </div>
                </div>
                <!-- //identification personel -->

            <!-- information sur le courrier -->
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             INFORMATION SUR LE COURRIER
                        </div>
                        <div class="panel-body">
								<div class="form-group">
                                            <label>Type de courrier *</label>
                                            <select name="type_courrier"  class="form-control" required>
												<option value selected ></option>
                                                <option value="Entrant">Entrant</option>
                                                <option value="Sortant Room">Sortant</option>
												
                                            </select>
                              </div>
                              <!-- supprimer -->
                              <!-- expe -->
                              <div class="form-group">
                                            <label>Expediteur</label>
                                            <input name="espe" class="form-control" required>
                                          <!-- //expe -->  
                         <!--  Pour afficher le destinataire--->
                         <div id="input" class="form-group">
                                <label for="">Destinataire</label>
                            <select class="form-control" name="destinataire">
                                <?php
                                while ($tab = $requestservice->fetch()) {
                                echo '<option value="' . $tab[2] . '"> ' . $tab[2] . '</option>';
                                }
                                ?>
                            </select>
                            </div>

                            <!-- reference -->
                            <div class="form-group">
                                            <label>Reference</label>
                                            <input name="refe" type ="text" class="form-control" required>
                               </div>
                            <!-- //reference -->

                            <!-- objet -->
                            <div class="form-group">
                            <label for="">Objet</label>
                            <div class="form-group">
                            <textarea class="form-group" name="objet_courrier" id="" cols="30" rows="2"></textarea>
                            </div>
                            </div>
                            <!-- //objet -->

                             <!-- Desc -->
                             <div class="form-group">
                            <label for="">Description</label>
                            <div class="form-group">
                            <textarea class="form-group" name="desc" id="" cols="30" rows="2"></textarea>
                            </div>
                            </div>
                            <!-- //Desc -->
                           
                           <!-- document pdf -->
                           <div class="form-group">
                            <label for="monfichier">ENVOIE DE FICHIER</label>
                           <div class="form-group">
                           <input type="file" name="fichier">
                           </div>
                           </div>

                           <!-- document pdf -->

                            <!-- //supprimer -->
                       
                       
                       </div>
                        
                    </div>
                </div>
				
				
                <div class="col-md-12 col-sm-12">
                    <div class="well">
                        <h4>VERIFICATION D'HUMAIN</h4>
                        <p>code de verfication <?php $Random_code=rand(); echo$Random_code; ?> </p><br />
						<p>Ecrire le code de verification<br /></p>
							<input  type="text" name="code1" title="random code" />
							<input type="hidden" name="code" value="<?php echo $Random_code; ?>" />
						<input type="submit" name="submit" class="btn btn-primary">
						<?php
							if(isset($_POST['submit']))
							{
							$code1=$_POST['code1'];
							$code=$_POST['code']; 
							if($code1!="$code")
							{
							$msg="Invalide code"; 
							}
							else
							{
							
									$con=mysqli_connect("localhost","root","","gestion_courrier");
									$check="SELECT * FROM _courrier WHERE ref_courrier = '$_POST[refe]'";
									$rs = mysqli_query($con,$check);
									$data = mysqli_fetch_array($rs, MYSQLI_NUM);
									if($data[0] > 1) {
										echo "<script type='text/javascript'> alert('Courrier existe déja')</script>";
										
									}

									else
									{
                                        $new ="Non Conforme";
                                        $date = date('d-m-y');
                                        $dateheure = date('d-m-y h:i:s');
                                       
										$newUser ="INSERT INTO _courrier VALUES ('','$_POST[objet_courrier]','$date','$_POST[refe]','$_POST[type_courrier]','$dateheure','','$_POST[espe]','$_POST[destinataire]','$_POST[desc]','$_POST[usager]','$_POST[title]','$_POST[nom]','$_POST[prenom]','$_POST[email]','$_POST[carte]','$_POST[num_carte]','$_POST[phone]','$_POST[objet_courrier]','$_POST[fichier]','1')";
										if (mysqli_query($con,$newUser))
										{
											echo "<script type='text/javascript'> alert('Votre courrier est bien envoyé...')</script>";
											
										}
										else
										{
											echo "<script type='text/javascript'> alert('Erreur de la base de donnée')</script>";
											
										}
									}

							$msg="Code incorrect";
							}
							}
							?>
						</form>
							
                    </div>
                </div>
            </div>
           <!-- information sur le courrier -->
                
                </div>
                    
            
				
					</div>
			 <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
   
</body>
</html>

<?php

} catch (PDOException $e) {
  echo 'Echec' . $e->getMessage();
}
?>