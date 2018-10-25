<?php

  session_start();
  if(!isset($_SESSION['nick'])){
    header('Location: signin.php');
    exit;
  }

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title>Gestion Tropicali</title>
  <link rel="shortcut icon" href="img/favicon.png">

<link rel="stylesheet" href="vendor/datatables/datatables.min.css">
  
    <link rel="stylesheet" href="fonts/open-sans/style.min.css"> <!-- common font  styles  -->
<link rel="stylesheet" href="fonts/universe-admin/style.css"> <!-- universeadmin icon font styles -->
<link rel="stylesheet" href="fonts/mdi/css/materialdesignicons.min.css"> <!-- meterialdesignicons -->
<link rel="stylesheet" href="fonts/iconfont/style.css"> <!-- DEPRECATED iconmonstr -->
<link rel="stylesheet" href="vendor/flatpickr/flatpickr.min.css"> <!-- original flatpickr plugin (datepicker) styles -->
<link rel="stylesheet" href="vendor/simplebar/simplebar.css"> <!-- original simplebar plugin (scrollbar) styles  -->
<link rel="stylesheet" href="vendor/tagify/tagify.css"> <!-- styles for tags -->
<link rel="stylesheet" href="vendor/tippyjs/tippy.css"> <!-- original tippy plugin (tooltip) styles -->
<link rel="stylesheet" href="vendor/select2/css/select2.min.css"> <!-- original select2 plugin styles -->
<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css"> <!-- original bootstrap styles -->
<link rel="stylesheet" href="css/style.min.css" id="stylesheet"> <!-- universeadmin styles -->

  

  <script src="js/ie.assign.fix.min.js"></script>
</head>
<body class="js-loading "> <!-- add for rounded corners: form-controls-rounded -->



  <div class="page-preloader js-page-preloader">
    <div class="page-preloader__logo">
      <img src="img/logo-black-lg.png" alt="" class="page-preloader__logo-image">
    </div>
    <div class="page-preloader__desc">Pro Edition</div>
    <div class="page-preloader__loader">
      <div class="page-preloader__loader-heading">System Loading</div>
      <div class="page-preloader__loader-desc">Widgets update</div>
      <div class="progress progress-rounded page-preloader__loader-progress">
        <div id="page-loader-progress-bar" class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
    </div>
    <div class="page-preloader__copyright">Daniel7Byte, 2018</div>
  </div>



  <div class="navbar navbar-light navbar-expand-lg">
    <?php include("navbar.php"); ?>
  </div>




  <div class="page-wrap">
    
    <div class="sidebar">
      <?php include("menu.php"); ?>
    </div>



    <div class="page-content">
      
      <div class="container-fluid container-fh l-2column">

        <div class="m-content">

          <div class="page-content__header">
            <div>
              <h2 class="page-content__header-heading">Noticias</h2>
            </div>
          </div>
          <div class="m-datatable">
            <table id="datatable" class="table table-striped">
              <thead>
              <tr>
                <th>Fecha</th>
                <th>Titulo</th>
                <th>Descripción</th>
                <th>Tipo</th>
              </tr>
              </thead>
              <tbody>
                <?php

                  require_once("config/parameters.php");
                  require_once("config/connection.php");

                  $query = $mysql->prepare("SELECT * FROM news ORDER BY id DESC");
                  $query->execute();
                  $result = $query->fetchAll();

                  foreach ($result as $row):
                ?>
                <tr>
                  <td><?=date_format(date_create($row['date']), 'd-m-Y')?></td>
                  <td><?=$row['title']?></td>
                  <td><?=$row['description']?></td>
                  <td><?=$row['type']?></td>
                </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
          </div>

        </div>
      </div>

    </div>
  </div>



  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/popper/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="vendor/select2/js/select2.full.min.js"></script>
  <script src="vendor/simplebar/simplebar.js"></script>
  <script src="vendor/text-avatar/jquery.textavatar.js"></script>
  <script src="vendor/tippyjs/tippy.all.min.js"></script>
  <script src="vendor/flatpickr/flatpickr.min.js"></script>
  <script src="vendor/wnumb/wNumb.js"></script>
  <script src="js/main.js"></script>


  <script src="vendor/datatables/datatables.min.js"></script>
  <script src="js/preview/datatables.min.js"></script>


  <div class="sidebar-mobile-overlay"></div>

  <script src="js/preview/settings-panel.min.js"></script>

  <script src="js/preview/slide-nav.min.js"></script>



</body>
</html>
