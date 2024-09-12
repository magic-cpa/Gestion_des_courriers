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


        <!-- nav -->
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" >
        				<a class="navbar-brand brand-logo" href="/admin/index.php"><img src="/images/algerie_telecome_logo.svg" alt="" class="" style="height:45px"/></a>
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

        <!-- - modify courrier modal - -->
        <div id="modifyCourrierModal" class="w-full h-full top-0 left-0 flex items-center justify-center">
            <div class="modal-content py-4 text-left px-6 mt-2" style="min-width: 55%;">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Modifier courrier</p>
                    
                </div>

                <?php
                    include_once __DIR__.'/db_.php';
                    // Fetch agent data from the database
                    $sql = "SELECT * FROM agent WHERE logical_delete = 0";
                    $result = mysqli_query($con, $sql);

                    // Fetch the selected agent ID, if available
                    // For example, from a GET parameter or previous query
                    $selectedAgentId = isset($_GET['agent']) ? $_GET['agent'] : '';
                    $selectedCourrierId = isset($_GET['courrier']) ? $_GET['courrier'] : ''; 
                ?>

            <form action="/admin/action/modify_courrier.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_courrier" id="modal_id_courrier" value="<?php echo $selectedCourrierId; ?>">
                <?php
                    if ($selectedCourrierId) {
                        $sql = "SELECT * FROM courrier WHERE id_courrier = '$selectedCourrierId'";
                        $result = mysqli_query($con, $sql);
                        
                        // Fetch the courrier details
                        if ($row = mysqli_fetch_assoc($result)) {
                            $titreCour = htmlspecialchars($row['titre_cour']);
                            $fileCour = htmlspecialchars($row['file_cour']); // If you need to display the current file name
                        } else {
                            // Handle case where the courrier is not found
                            $titreCour = '';
                            $fileCour = '';
                        }
                    } else {
                        // Handle case where no courrier ID is selected
                        $titreCour = '';
                        $fileCour = '';
                    }
                ?>
                <div class="mb-4">
                    <label for="titre_cour" class="block text-sm font-medium text-gray-700">Titre Courrier</label>
                    <input type="text" name="titre_cour" id="modal_titre_cour" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" value="<?php echo $titreCour; ?>" required>
                </div>

                <div class="mb-4">
                    <label for="file_cour" class="block text-gray-600 text-sm font-medium mb-2">Fichier Courrier</label>
                    <input type="file" id="file_cour" name="file_cour" class="w-full border rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                    <p id="file_cour_placeholder" class="text-sm text-gray-500">
                        <?php echo $fileCour; // Display the current file name ?>
                    </p>
                </div>

                <label>Agent récepteur sélectionné</label>
                <div id="default_recepteur">
                    <?php
                    // Display the full name of the selected agent
                    if ($selectedAgentId) {
                        $sql = "SELECT * FROM agent WHERE id_agent = '$selectedAgentId'";
                        $selectedResult = mysqli_query($con, $sql);
                        if ($selectedRow = mysqli_fetch_assoc($selectedResult)) {
                            $fullName = trim($selectedRow['nom_agent']) . ' ' . trim($selectedRow['prenom_agent']);
                            echo htmlspecialchars($fullName);
                        }
                    }
                    ?>
                </div>

                <label for="agent_recepteur" class="block text-gray-600 text-sm font-medium mb-2">Agent récepteur</label>
                <select id="agent_recepteur" name="agent_recepteur" class="w-full border p-2 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                    <?php
                    // Fetch all agents for the dropdown
                    $sql = "SELECT * FROM agent";
                    $result = mysqli_query($con, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $fullName = trim($row['nom_agent']) . ' ' . trim($row['prenom_agent']);
                            $selected = ($row['id_agent'] == $selectedAgentId) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($row['id_agent']) . '" ' . $selected . '>' . htmlspecialchars($fullName) . '</option>';
                        }
                    } else {
                        echo '<option value="">No agents available</option>';
                    }
                    ?>
                </select>

                <button type="submit" name="add" class="w-full mt-2 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">Modifier Courrier</button>
            </form>
                <!--Footer-->
                <!-- <div class="flex justify-end pt-2">
                    <button class="modal-close px-4 bg-gray-500 p-3 rounded-lg text-white hover:bg-gray-400" onclick="closeModal('agentModal')">Fermer</button>
                </div> -->
            </div>
