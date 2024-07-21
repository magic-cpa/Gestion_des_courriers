<?php  
if (session_status() == PHP_SESSION_NONE){
    session_start();
  }
if(isset($_SESSION['admin']))
{
  $admin = $_SESSION['admin']; 
}else{
    header("location: http://localhost:8080/admin/login.php");
}


?> 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrateur	</title>
    <!-- Bootstrap Styles-->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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

        <!-- nav -->
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="/admin/index.php"><img src=".././dashboard/partials/images/logo-gestion-courrier.png"/></a>
                </div>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href=""><i class="fa fa-user fa-fw"></i> Profil</a>
                        </li>
                        <li><a href=""><i class="fa fa-gear fa-fw"></i> Parametre</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Se deconecter</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!-- nav -->

        <!--/NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <!-- <li>
                        <a href="roombook.php"><i class="fa fa-bar-chart-o"></i> Valider Courrier</a>
                    </li>
                    <li>
                        <a  href="profit.php"><i class="fa fa-qrcode"></i> Profit</a>
                    </li> -->
                    <li>
                        <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Deconnexion</a>
                    </li>
				</ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->

        <!-- contenu -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Status <small>Courrier en instance </small>
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
				<?php
						include_once __DIR__.'/db_.php';
                        // $sql = "SELECT * FROM _courrier WHERE statut = 1 ORDER BY ref_courrier ASC";
                        $rsql = "SELECT COUNT(*) as courrier_count FROM `courrier` WHERE logical_delete = 0";
                        $result = mysqli_query($con, $rsql);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $courrier_count = $row['courrier_count'];
                        } else {
                            $courrier_count = 0; 
                        }
				?>
    <!-- Modal -->
    <div id="courrierModal" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Envoyer Courrier</p>
                    <div class="modal-close cursor-pointer z-50" onclick="closeModal('courrierModal')">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53a.75.75 0 00-1.06-1.06L9 7.94 4.53 3.47a.75.75 0 10-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 001.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47z"/>
                        </svg>
                    </div>
                </div>
                <!--Body-->
                <form action="/admin/action/send_courrier.php" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="titre_cour" class="block text-gray-600 text-sm font-medium mb-2">Titre Courrier</label>
                        <input type="text" id="titre_cour" name="titre_cour" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div class="mb-4">
                    <label for="agent_recepteur" class="block text-gray-600 text-sm font-medium mb-2">agent recepteur du Courrier</label>
                    <select id="agent_recepteur" name="agent_recepteur" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                    <?php
                        $sql = "SELECT * FROM agent WHERE logical_delete = 0";
					    $result = mysqli_query($con,$sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['id_agent'] . '">' . $row['nom_agent']. ' ' . $row['prenom_agent'] . '</option>';
                        }
                        } else {
                            echo '<option value="">No agents available</option>';
                        }
                    ?>
                </select>
                    </div>
                    <div class="mb-4">
                        <label for="file_cour" class="block text-gray-600 text-sm font-medium mb-2">Fichier Courrier</label>
                        <input type="file" id="file_cour" name="file_cour" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                    </div>
                    <button type="submit" name="send" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">Envoyer</button>
                </form>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button class="modal-close px-4 bg-gray-500 p-3 rounded-lg text-white hover:bg-gray-400" onclick="closeModal('courrierModal')">Fermer</button>
                </div>
            </div>
        </div>
    </div>

		<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <h3 class="p-2">Gérer les agents & courriers</h3>
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <div class="cont-btn-add" style="margin: 0.3rem;">
                            <button class="btn btn-default" type="button" onclick="openModal('courrierModal')">
								Envoyer Courrier  
							</button>
                        </div>
                            <div class="panel-group" id="accordion" style="display: flex; flex-direction: column; gap: 1rem;">
                            <div class="panel panel-primary mt-2">             
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
											<button class="btn btn-default" type="button">
                                            List des Courriers  <span class="badge"><?php echo $courrier_count ; ?></span>
											</button>
											</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                        <div class="panel-body">
                                        <!-- Add Search Bar -->
                                        <div class="input-group mb-3" style="display: flex;align-items: center;">
                                            <h5>recherche des courriers: </h5>
                                            <input type="text" class="form-control" id="searchInput" placeholder="Rechercher des courriers...">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="icon-search"></i></span>
                                            </div>
                                        </div>
                                           <div class="panel panel-default">
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID courrier</th>
                                            <th>ID agent</th>
                                            <th>Nom agent recepteur</th>
                                            <th>prenom agent recepteur</th>
                                            <th>Titre Courrier</th>
                                            <th>Fichier</th>
											<th>iD Expediteur</th>
                                            <th>Nom Expediteur</th>
                                            <th>Date evoie</th>								
                                        </tr>
                                    </thead>
                                    <tbody id="courrierTableBody">
                                        
								<?php
								$rsql = "SELECT c.id_courrier, c.file_cour, c.titre_cour, a.id_agent,
                            a.nom_agent, a.prenom_agent,ca.id_admin,ad.name AS admin_name, ca.created_at AS date_envoi
                            FROM
                                courrier_agent ca
                            JOIN
                                courrier c ON ca.id_cour = c.id_courrier
                            JOIN
                                agent a ON ca.id_ag = a.id_agent
                            JOIN
                                admin ad ON ca.id_admin = ad.id
                            WHERE
                                c.logical_delete = 0 AND a.logical_delete = 0
                            ORDER BY ca.created_at DESC LIMIT 7;";
									$result = mysqli_query($con, $rsql);

                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>{$row['id_courrier']}</td>";
                                            echo "<td>{$row['id_agent']}</td>";
                                            echo "<td>{$row['nom_agent']}</td>";
                                            echo "<td>{$row['prenom_agent']}</td>";
                                            echo "<td>{$row['titre_cour']}</td>";
                                            echo "<td><a href='/Gestion_des_courriers/courriers/{$row['file_cour']}' target='_blank'>{$row['file_cour']}</a></td>";
                                            echo "<td>{$row['id_admin']}</td>";
                                            echo "<td>{$row['admin_name']}</td>";
                                            echo "<td>{$row['date_envoi']}</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>Aucun courrier trouvé.</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
								
                            </div>
                        </div>
                    </div>
                      <!-- End  Basic Table  --> 
                                        </div>
                                    </div>
                                </div>
								<?php
								$rsql = "SELECT COUNT(*) as notification_count FROM `notification`";
                                $result = mysqli_query($con, $rsql);
								if ($result) {
                                    $row = mysqli_fetch_assoc($result);
                                    $r = $row['notification_count'];
                                } else {
                                    $r= 0; 
                                }
								?>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">
											<button class="btn btn-primary" type="button">
												 List des Notifications  <span class="badge"><?php echo $r ; ?></span>
											</button>
											</a>
                                        </h4>
                                    </div>
                                <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
                                  <div class="panel-body">
								<?php
								$msql = "SELECT 
                                n.id_not, n.id_cour, n.contenu_not, n.category, n.created_at, n.close_not,
                                a.id_agent, a.nom_agent, a.prenom_agent, a.email_agent
                                    FROM 
                                        notification n
                                    JOIN 
                                        agent a ON n.id_agent = a.id_agent
                                    WHERE 
                                        a.logical_delete = 0
                                    ORDER BY 
                                        n.created_at DESC
                                    LIMIT 7";

									$mre = mysqli_query($con,$msql);
									
                                    if (mysqli_num_rows($mre) > 0) {
                                        echo '<table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ID Notification</th>
                                                        <th>ID Courrier</th>
                                                        <th>Contenu Notification</th>
                                                        <th>Catégorie</th>
                                                        <th>Fermé</th>
                                                        <th>ID Agent</th>
                                                        <th>Nom Agent</th>
                                                        <th>Prénom Agent</th>
                                                        <th>Email Agent</th>
                                                        <th>Date Création</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                    
                                        while ($row = mysqli_fetch_assoc($mre)) {
                                            echo '<tr>
                                                    <td>' . $row['id_not'] . '</td>
                                                    <td>' . $row['id_cour'] . '</td>
                                                    <td>' . $row['contenu_not'] . '</td>
                                                    <td>' . $row['category'] . '</td>
                                                    <td>' . ($row['close_not'] ? 'Oui' : 'Non') . '</td>
                                                    <td>' . $row['id_agent'] . '</td>
                                                    <td>' . $row['nom_agent'] . '</td>
                                                    <td>' . $row['prenom_agent'] . '</td>
                                                    <td>' . $row['email_agent'] . '</td>
                                                    <td>' . $row['created_at'] . '</td>
                                                  </tr>';
                                        }
                                    
                                        echo '</tbody></table>';
                                    } else {
                                        echo '<p>Aucune notification trouvée.</p>';
                                    }
										?>
										</div>
                                    </div>
                                </div>
                            <?php
								$fsql = "SELECT * FROM `agent` WHERE logical_delete = 0";
								$fre = mysqli_query($con,$fsql);
								$f =0;
								while($row=mysqli_fetch_array($fre) )
								{
										$f = $f + 1;
								}
							?>
                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
											<button class="btn btn-primary" type="button">
												 List des agents  <span class="badge"><?php echo $f ; ?></span>
											</button>
											</a>
                                        </h4>
                                    </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="panel-body">
                                    <div class="m-2 flex justify-end">
                                        <button class="btn btn-primary" type="button" onclick="openModal('agentModal')">
											<span class="badge">ajouter nouveau agent</span>
										 </button>
                                    </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom</th>
                                            <th>prenom</th>
                                            <th>Numero tel</th>
											<th>email</th>
                                            <th>Permission status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
									<?php
									$csql = "SELECT * FROM `agent` WHERE logical_delete = 0 ORDER BY agent.created_at DESC LIMIT 5;";
									$cre = mysqli_query($con,$csql);
									if (mysqli_num_rows($cre) > 0) {
                                        while ($crow = mysqli_fetch_array($cre)) {
                                            echo "<tr>
                                                <td>{$crow['id_agent']}</td>
                                                <td>{$crow['nom_agent']}</td>
                                                <td>{$crow['prenom_agent']}</td>
                                                <td>{$crow['tel_agent']}</td>
                                                <td>{$crow['email_agent']}</td>
                                                <td></td> <!-- Replace this with the appropriate value -->
                                                <td><a href='#' class='btn btn-primary' onclick='return confirmDelete({$crow['id_agent']})'>Supprimer</a></td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center'>Aucun agent trouvé.</td></tr>";
                                    }
									?>
                                        
                                    </tbody>
                                </table>
								<!-- <a href="messages.php" class="btn btn-primary"> Action</a> -->
                            </div>
                        </div>
                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- New Agent Modal -->
        <div id="agentModal" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Ajouter Nouveau Agent</p>
                    <div class="modal-close cursor-pointer z-50" onclick="closeModal('agentModal')">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53a.75.75 0 00-1.06-1.06L9 7.94 4.53 3.47a.75.75 0 10-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 001.06 1.06L9 10.06l4.47 4.47a.75.75 0 001.06-1.06L10.06 9l4.47-4.47z"/>
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <form action="/admin/action/add_agent.php" method="post">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-600 text-sm font-medium mb-2">Nom</label>
                        <input type="text" id="name" name="name" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="prenom" class="block text-gray-600 text-sm font-medium mb-2">Prénom</label>
                        <input type="text" id="prenom" name="prenom" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="numero_tel" class="block text-gray-600 text-sm font-medium mb-2">Numéro de Téléphone</label>
                        <input type="tel" id="numero_tel" name="numero_tel" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-600 text-sm font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-600 text-sm font-medium mb-2">Mot de Passe</label>
                        <input type="password" id="password" name="password" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="Entrez votre mot de passe" required>
                    </div>
                    <div class="mb-4">
                        <label for="password_confirm" class="block text-gray-600 text-sm font-medium mb-2">Mot de Passe</label>
                        <input type="password" name="password_confirm" id="password_confirm" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="Confirmer le mot de passe" required>
                    </div>
                    <button type="submit" name="add" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md 
                    hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">Ajouter</button>
                </form>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button class="modal-close px-4 bg-gray-500 p-3 rounded-lg text-white hover:bg-gray-400" onclick="closeModal('agentModal')">Fermer</button>
                </div>
            </div>
        </div>
    </div>

				<!-- DEOMO-->
				<div class='panel-body'>
                            <button class='btn btn-primary btn' data-toggle='modal' data-target='#myModal'>
                              Update 
                            </button>
                            <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                            <h4 class='modal-title' id='myModalLabel'>Change the User name and Password</h4>
                                        </div>
										<form method='post>
                                        <div class='modal-body'>
                                            <div class='form-group'>
                                            <label>Change User name</label>
                                            <input name='usname' value='<?php echo $fname; ?>' class='form-control' placeholder='Enter User name'>
											</div>
										</div>
										<div class='modal-body'>
                                            <div class='form-group'>
                                            <label>Change Password</label>
                                            <input name='pasd' value='<?php echo $ps; ?>' class='form-control' placeholder='Enter Password'>
											</div>
                                        </div>
										
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
											
                                           <input type='submit' name='up' value='Update' class='btn btn-primary'>
										  </form>
										   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>

    </div>

    <!-- JS Scripts-->
    <script defer>

        function confirmDelete(id) {
            var confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet agent ?");
            if (confirmation) {
                window.location.href = '/admin/action/delete_agent.php?ridz=' + id;
            }
        return false;
        }                                

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('opacity-100');
            modal.classList.remove('opacity-0');
            modal.classList.remove('pointer-events-none');
            modal.style.display = 'flex';
            document.body.classList.add('modal-active');
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('opacity-0');
            modal.classList.remove('opacity-100');
            modal.classList.add('pointer-events-none');
            modal.style.display = 'none';
            document.body.classList.remove('modal-active');
        }
    </script>
    <script src="assets/js/search.js"></script>
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