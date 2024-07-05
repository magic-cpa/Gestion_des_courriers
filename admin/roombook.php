<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
?> 

<?php
		if(!isset($_GET["rid"]))
		{
				
			 header("location:index.php");
		}
		else {
				$curdate=date("Y/m/d");
				include ('db_.php');
				$id = $_GET['rid'];
				
				
				$sql ="Select * from _courrier where id_courrier = '$id'";
				$re = mysqli_query($con,$sql);
				while($row=mysqli_fetch_array($re))
				{
					$title = $row['ref_courrier'];
					$fname = $row['expe'];
					$lname = $row['desti'];
					$email = $row['objet_courrier'];
					$nat = $row['desc'];
					$country = $row['nom'];
					$Phone = $row['prenom'];
					$troom = $row['email'];
					$nroom = $row['type_carte'];
					$bed = $row['num_carte'];
					$non = $row['tel'];
					$meal = $row['adress_fichier'];
					$sta = $row['statut'];
					$days = $row['date_time_act'];
					$days_one = $row['date_courrier'];
					
				
				
				}
					
					
				
		
	}
		
		
		
			?> 

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrateur	</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"> <?php echo $_SESSION["user"]; ?> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="usersetting.php"><i class="fa fa-user fa-fw"></i> Profil</a>
                        </li>
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Parametre</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Deconnexion</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

				<li>
                        <a class="active-menu" href="home.php"><i class="fa fa-dashboard"></i> Status</a>
                    </li>
                    <li>
                        <a href="roombook.php"><i class="fa fa-bar-chart-o"></i> Valider Courrier</a>
                    </li>
                    <li>
                        <a  href="profit.php"><i class="fa fa-qrcode"></i> Profit</a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Deconnexion</a>
                    </li>
                    
					</ul>
                    
					</ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
		
		
		

        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Validation Courrier<small>	<?php echo  $curdate; ?> </small>
                        </h1>
                    </div>
					
					
					<div class="col-md-8 col-sm-8">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                           Confirmation du Courrier
                        </div>
                        <div class="panel-body">
							
							<div class="table-responsive">
                                <table class="table">
                                    <tr>
                                            <th>DESCRIPTION</th>
                                            <th>INFORMATION</th>
                                            
                                        </tr>
                                        <tr>
                                            <th>Reference</th>
                                            <th><?php echo $title; ?> </th>
                                            
                                        </tr>
										<tr>
                                            <th>Expedicteur</th>
                                            <th><?php echo $fname; ?> </th>
                                            
                                        </tr>
										<tr>
                                            <th>Destinataire </th>
                                            <th><?php echo $lname; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Objet </th>
                                            <th><?php echo $email;  ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Description</th>
                                            <th><?php echo $nat; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Nom du deposant </th>
                                            <th><?php echo $country; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Prenom </th>
                                            <th><?php echo $Phone; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Email </th>
                                            <th><?php echo $troom; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Type de Carte </th>
                                            <th><?php echo $nroom; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>N° de carte </th>
                                            <th><?php echo $bed; ?></th>
                                            
                                        </tr>
										
										<tr>
                                            <th>Telephone</th>
                                            <th><?php echo $non; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Statut</th>
                                            <th><?php echo $sta; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Date deposant</th>
                                            <th><?php echo $days; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Date courrier</th>
                                            <th><?php echo $days_one; ?></th>
                                            
                                        </tr>
                                    
                                </table>
                            </div>
                        
					
							
                        </div>
                        <div class="panel-footer">
                            <form method="post">
										<div class="form-group">
														<label>Selectionner la confirmation</label>
														<select name="conf"class="form-control">
															<option value selected>	</option>
															<option value="0">Valide</option>
														</select>
										 </div>
							<input type="submit" name="co" value="Validé" class="btn btn-success">
							
							</form>
                        </div>
                    </div>
					</div>
					
					
					<div class="col-md-4 col-sm-4">
                    
					</div>
                </div>
                <!-- /. ROW  -->
				
                </div>
                <!-- /. ROW  -->
				
				
				
				
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
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>

<?php
                    include ('db_.php');
						if(isset($_POST['co']))
						{	
							$st = $_POST['conf'];
											
							if($st== '0')
							{
									$requette = "UPDATE _courrier SET statut = '0' WHERE id_courrier = '$id'";
									
									 //preparer les requette
									 $prepa = $con->prepare($requette);

									 //executin de la requette
									 $prepa->execute();
					 
									 //verifier si la requette marque
									 if ($prepa->rowCount() > 0) {
										 header("Location: home.php");
									 } else echo 'echec base';
								 }  else echo 'connexion echoué';
								} 
						
					
									
									
							
						?>