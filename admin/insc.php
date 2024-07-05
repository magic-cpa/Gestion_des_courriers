
<?php
                  $id = $_GET['ridz'];  
                  include ('db_.php');
					
									$requette = "UPDATE agent SET statut = 'valide' WHERE id_agent = '$id'";
									
									 //preparer les requette
									 $prepa = $con->prepare($requette);

									 //executin de la requette
									 $prepa->execute();
					 
									 //verifier si la requette marque
									//  if ($prepa->rowCount() > 0) {
									 header("Location: home.php");
									//  } else echo 'echec base';
								
							
						?>