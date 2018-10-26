<?php

  session_start();
  if(!isset($_SESSION['nick'])){
    header('Location: signin.php');
    exit;
  }

  if($_SESSION['role'] != "ADMIN"){
    header('Location: 403.php');
    exit;
  }

  require_once("config/parameters.php");
  require_once("config/connection.php");

  $query = $mysql->prepare("SELECT * FROM users WHERE id = :id");
  $query->execute([':id' => $_GET['id']]);
  $result = $query->fetchAll();

  foreach ($result as $row){
    $nick = $row['nick'];
    $full_name = $row['full_name'];
    $role = $row['role'];
    $id_zone = $row['id_zone'];
  }

  include 'dictionary/langHandler.php';
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
              <h2 class="page-content__header-heading">Usuarios</h2>
            </div>
          </div>

          <div class="container-fh__content">
            <div class="row">
              <div class="col-lg-12">
                <form class="main-container fl-form" method="POST" action="users_edit_sql.php">
                  <input type="hidden" name="id" value="<?=$_GET['id']?>">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <div class="fl-wrap fl-wrap-input">
                        <label for="nick" class="fl-label">Usuario</label>
                        <input type="text" class="form-control fl-input" id="nick" name="nick" placeholder="example" data-placeholder="example" required="required" value="<?=$nick?>">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <div class="fl-wrap fl-wrap-input">
                        <label for="password" class="fl-label">Contraseña</label>
                        <input type="password" class="form-control fl-input" id="password" name="password" placeholder="*****" data-placeholder="*****" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <div class="fl-wrap fl-wrap-input">
                        <label for="full_name" class="fl-label">Nombre</label>
                        <input type="text" class="form-control fl-input" id="full_name" name="full_name" placeholder="Pepito Perez" required="required" value="<?=$full_name?>">
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <div class="fl-wrap fl-wrap-select"><label for="role" class="fl-label">Permiso</label>
                        <select id="role" name="role" class="form-control select2-hidden-accessible fl-select" tabindex="-1" aria-hidden="true">
                          <option selected="selected" value="<?=$role?>"><?=$role?> (ACTUAL)</option>
                          <option value="USER">USER</option>
                          <option value="ADMIN">ADMIN</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <div class="fl-wrap fl-wrap-select"><label for="id_zone" class="fl-label">Zona</label>
                        <select id="id_zone" name="id_zone" class="form-control select2-hidden-accessible fl-select" tabindex="-1" aria-hidden="true">
                          <?php
                            $query = $mysql->prepare("SELECT * FROM zones WHERE id = :id");
                            $query->execute([':id' => $id_zone]);
                            $result = $query->fetchAll();

                            foreach ($result as $row):
                          ?>
                            <option value="<?=$row['id']?>"><?=$row['title']?> (ACTUAL)</option>
                          <?php endforeach; ?>

                          <?php
                            $query = $mysql->prepare("SELECT * FROM zones ORDER BY id ASC");
                            $query->execute();
                            $result = $query->fetchAll();

                            foreach ($result as $row):
                          ?>
                            <option value="<?=$row['id']?>"><?=$row['title']?></option>
                          <?php endforeach; ?>

                        </select>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-info btn-block">Editar!</button>
                </form>
              </div>
            </div>
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
