<?php

  session_start();
  if(!isset($_SESSION['nick'])){
    header('Location: signin.php');
    exit;
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
  <title>Dashboard Documents</title>
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



  <?php include 'page-preloader.php'; ?>



  <div class="navbar navbar-light navbar-expand-lg">
    <?php include("navbar.php"); ?>
  </div>




  <div class="page-wrap">

    <div class="sidebar">
      <?php include("menu.php"); ?>
    </div>



    <div class="page-content">

      <div class="container-fluid container-fh">

        <div class="m-content">

          <div class="page-content__header">
            <div>
              <h2 class="page-content__header-heading"><?=DOCUMENTS?></h2>
            </div>
          </div>
          <div class="m-datatable">
            <table id="datatable" class="table table-striped">
              <thead>
              <tr>
                <?php if($_SESSION['role'] == "ADMIN" OR $_SESSION['role'] == "EDITOR"): ?>
                  <th>ID</th>
                <?php endif; ?>

                <th><?=Date?></th>
                <th><?=Description?></th>
                <th><?=Priority?></th>

                <?php if($_SESSION['role'] == "ADMIN" OR $_SESSION['role'] == "EDITOR"): ?>
                  <th><?=USERS?></th>
                  <th><?=CATEGORY?></th>
                <?php endif; ?>

                <th><?=Actions?></th>
              </tr>
              </thead>
              <tbody>
                <?php

                  require_once("config/parameters.php");
                  require_once("config/connection.php");

                  $users_nick = $_SESSION['nick'];

                  if($_SESSION['role'] == "ADMIN" OR $_SESSION['role'] == "EDITOR"){
                    $query = $mysql->prepare("SELECT * FROM storage ORDER BY id DESC");
                    $query->execute();
                  }else{
                    $query = $mysql->prepare("SELECT * FROM (SELECT * FROM storage WHERE type = 'Public' OR users_nick LIKE :users_nick ORDER BY id DESC) AS t WHERE t.file_check = 'Y'");
                    $query->execute([':users_nick' => "%$users_nick%"]);
                  }

                  $result = $query->fetchAll();

                  foreach ($result as $row):
                ?>
                <tr>
                  <?php if($_SESSION['role'] == "ADMIN" OR $_SESSION['role'] == "EDITOR"): ?>
                    <td><?=$row['id']?></td>
                  <?php endif; ?>

                  <td><?=date_format(date_create($row['date']), 'd-m-Y')?></td>
                  <td><a href="storage/<?=$row['file']?>"><?=$row['description']?></a></td>
                  <td><?=$row['priority']?></td>

                  <?php if($_SESSION['role'] == "ADMIN" OR $_SESSION['role'] == "EDITOR"): ?>
                    <td>
                      <?php
                      if($row['type'] == "Public"){
                        echo "<b>PUBLIC</b>";
                      }elseif($row['type'] == "Private"){
                        echo $row['users_nick'];
                      }
                      ?>
                    </td>
                    <td>
                      <?php
                        require_once("config/parameters.php");
                        require_once("config/connection.php");

                        $query = $mysql->prepare("SELECT * FROM category WHERE id = :id");
                        $query->execute([':id' => $row['category']]);
                        $result = $query->fetchAll();

                        foreach ($result as $rowCat):
                          echo $rowCat['name'];
                        endforeach;
                      ?>
                    </td>
                  <?php endif; ?>
                  <td>
                    <a class="btn btn-outline-success icon-center mr-3" href="storage/<?=$row['file']?>"><span class="btn-icon ua-icon-download"></span></a>
                    <?php if($_SESSION['role'] == "ADMIN"): ?>
                      <a class="btn <?=(($row['file_check'] == 'N') ? 'btn-outline-danger' : 'btn-outline-success')?> icon-center mr-3" href="#" id="val_check_<?=$row['id']?>" onclick="val_check(<?=$row['id']?>);"><span class="btn-icon ua-icon-check"></span></a>
                    <?php endif; ?>
                    <?php if($_SESSION['role'] == "ADMIN" OR $_SESSION['role'] == "EDITOR"): ?>
                    <div class="dropdown card-widget-d__dropdown">
                      <button class="btn btn-outline-info dropdown-toggle card-widget-d__control" type="button" data-toggle="dropdown">
                        <?=Edit?>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="storage_edit.php?id=<?=$row['id']?>"><?=Edit?></a>
                        <a class="dropdown-item" href="storage_delete_sql.php?id=<?=$row['id']?>"><?=Delete?></a>
                      </div>
                    </div>
                    <?php endif; ?>
                  </td>

                  <td><a class="btn btn-outline-success icon-center mr-3" href="storage/<?=$row['file']?>"><span class="btn-icon ua-icon-download"></span></td>
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
