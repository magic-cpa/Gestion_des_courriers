<?php 
if (session_status() == PHP_SESSION_NONE){
  session_start();
}
  
  
if (!isset($_SESSION['user'])) {
  header('location: http://localhost:8080/');
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard - agent</title>
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="/js/select.dataTables.min.css">
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="background: #0f2453;">
        <a class="navbar-brand brand-logo" href="/dashboard/"><img src="./partials/images/logo-gestion-courrier.png"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="background: #0f2453;">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <!-- Search bar -->
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <form method="GET" action="index.php">
              <div class="input-group">
                <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                    <span class="input-group-text" id="search">
                        <i class="icon-search"></i>
                    </span>
                </div>
                <input type="text" name="search" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
              </div>
            </form>
        </li>
      </ul>
        <ul class="navbar-nav navbar-nav-right" style="gap:1.5rem">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="./partials/images/default_profile_image.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Parametre
              </a>
              <form id="logoutForm" action="/action/logout.php" method="POST" style="display: inline;">
                <button type="submit" class="dropdown-item">
                  <i class="ti-power-off text-primary"></i>
                  Se deconecter
                </button>
              </form>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
        </div>
      </div>
      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <?php 
          require_once __DIR__.'/../admin/db_.php';
          $id_agent = $_SESSION['user']['id_agent'];

          // Define the number of results per page
          $results_per_page = 2;

          function securisation($con, $data) {
            return mysqli_real_escape_string($con, trim($data));
          }
          
          // Check if a search query is set
          $search_query = isset($_GET['search']) ? securisation($con,$_GET['search']) : '';
          
          // Base SQL query for counting the results
          $count_sql = "SELECT COUNT(c.id_courrier) AS total 
                        FROM courrier c
                        JOIN courrier_agent ca ON c.id_courrier = ca.id_cour
                        WHERE ca.id_ag = '$id_agent' AND c.logical_delete = 0";
          
          // Append search filter to the count query if a search query is set
          if ($search_query) {
              $count_sql .= " AND (c.titre_cour LIKE '%$search_query%' OR c.file_cour LIKE '%$search_query%')";
          }
          
          $result = mysqli_query($con, $count_sql);
          $row = mysqli_fetch_assoc($result);
          $total_results = $row['total'];
          
          // Determine the total number of pages available
          $total_pages = ceil($total_results / $results_per_page);
          
          // Determine which page number visitor is currently on
          $page = isset($_GET['page']) ? $_GET['page'] : 1;
          
          // Determine the SQL LIMIT starting number for the results on the displaying page
          $this_page_first_result = ($page - 1) * $results_per_page;
          
          // Base SQL query for retrieving the results
          $sql = "SELECT 
                      c.id_courrier, 
                      c.file_cour, 
                      c.titre_cour, 
                      c.created_at, 
                      c.updated_at, 
                      ca.id_cour_ag, 
                      ca.id_cour, 
                      ca.id_ag, 
                      ca.id_admin, 
                      ca.created_at AS ca_created_at, 
                      ca.updated_at AS ca_updated_at
                  FROM 
                      courrier c
                  JOIN 
                      courrier_agent ca ON c.id_courrier = ca.id_cour
                  WHERE 
                      ca.id_ag = '$id_agent' AND 
                      c.logical_delete = 0";
          
          // Append search filter to the result query if a search query is set
          if ($search_query) {
              $sql .= " AND (c.titre_cour LIKE '%$search_query%' OR c.file_cour LIKE '%$search_query%')";
          }
          
          // Append LIMIT and OFFSET for pagination
          $sql .= " LIMIT $this_page_first_result, $results_per_page";
          
          $result = mysqli_query($con, $sql);
          
          if (mysqli_num_rows($result) > 0) {
              // Process the results
              echo '<div class="container mx-auto mt-4">';
              echo '<h3 class="text-lg font-semibold mb-2">List des Courriers</h3>';
              while ($row = mysqli_fetch_assoc($result)) {
                  echo '<div class="bg-white shadow-md rounded-lg p-4 mb-4">';
                  echo '<div class="side_mail"><p class="p-2 text-white" style="background: grey;width:20%;border-radius: 0.2rem;"><span class="font-bold">ID Courrier:</span> ' . $row['id_courrier'] . '</p> <p><a href="/courriers/' . $row['file_cour'] . '" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700" download>Télécharger le courrier</a></p></div>';
                  echo '<p><span class="font-bold">Titre Courrier:</span> ' . $row['titre_cour'] . '</p>';
                  echo '<p><span class="font-bold">Fichier Courrier:</span> ' . $row['file_cour'] . '</p>';
                  echo '<p><span class="font-bold">Identifion Agent:</span> ' . $row['id_ag'] . '</p>';
                  echo '<p><span class="font-bold">Date d\'envoi du Courrier:</span> ' . $row['ca_created_at'] . '</p>';
                  echo '</div>';
              }
              echo '</div>';
          
              // Display the pagination links
              echo '<div class="container mx-auto mt-4">';
              echo '<nav class="flex justify-center">';
              echo '<ul class="pagination flex" style="justify-content:center">';
          
              // Display the previous page link
              if ($page > 1) {
                  echo '<li class="page-item"><a class="page-link" href="index.php?page=' . ($page - 1) . '">&laquo; Précédent</a></li>';
              }
          
              // Display links to all the pages
              for ($i = 1; $i <= $total_pages; $i++) {
                  if ($i == $page) {
                      echo '<li class="page-item active"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
                  } else {
                      echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
                  }
              }
          
              // Display the next page link
              if ($page < $total_pages) {
                  echo '<li class="page-item"><a class="page-link" href="index.php?page=' . ($page + 1) . '">Suivant &raquo;</a></li>';
              }
          
              echo '</ul>';
              echo '</nav>';
              echo '</div>';
          } else {
              echo '<div class="container mx-auto mt-4">';
              echo '<div class="bg-red-100 text-red-700 p-4 rounded-lg">';
              echo '<p>Aucun courrier trouvé pour cet agent.</p>';
              echo '</div>';
              echo '</div>';
          }
          
          mysqli_close($con);
          ?>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  
                </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span> 
          </div>
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>