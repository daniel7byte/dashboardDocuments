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

  $query = $mysql->prepare("SELECT * FROM storage WHERE id = :id");
  $query->execute([':id' => $_GET['id']]);
  $result = $query->fetchAll();

  foreach ($result as $row){
    $description = $row['description'];
    $priority = $row['priority'];
    $type = $row['type'];
    $users_nick = $row['users_nick'];
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

<link rel="stylesheet" href="vendor/sumo-select/sumoselect.min.css">

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

      <div class="container-fluid container-fh l-2column">

        <div class="m-content">

          <div class="page-content__header">
            <div>
              <h2 class="page-content__header-heading"><?=DOCUMENTS?></h2>
            </div>
          </div>

          <div class="container-fh__content">
            <div class="row">
              <div class="col-lg-12">
                <form class="main-container fl-form" method="POST" action="storage_edit_sql.php">
                  <input type="hidden" name="id" value="<?=$_GET['id']?>">
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <div class="fl-wrap fl-wrap-input">
                        <label for="description" class="fl-label"><?=Description?></label>
                        <input type="text" class="form-control fl-input" id="description" name="description" placeholder="example" data-placeholder="example" required="required" value="<?=$description?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="type" class="fl-label"><?=Privacy?></label>
                    <select class="form-control" id="type" name="type" onchange="validePrivate();">
                      <?php

                        if ($type  == "Private") {
                          $typeName = tPRIVATE;
                        }elseif($type  == "Public"){
                          $typeName = tPUBLIC;
                        }

                      ?>
                      <option value="<?=$type?>" selected><?=$typeName?> (<?=NOW?>)</option>
                      <option value="Private"><?=tPRIVATE?></option>
                      <option value="Public"><?=tPUBLIC?></option>
                    </select>
                  </div>
                  <div class="form-row" id="tagsUsers">
                    <div class="form-group col-md-12">
                      <div class="fl-wrap fl-wrap-select"><label for="users_nick" class="fl-label"><?=USERS?></label>
                        <select id="selectbox-ex4" multiple="multiple" name="users_nick[]" class="selectbox">
                          <?php

                            require_once("config/parameters.php");
                            require_once("config/connection.php");

                            $query = $mysql->prepare("SELECT * FROM users ORDER BY id DESC");
                            $query->execute();
                            $result = $query->fetchAll();

                            foreach ($result as $row):
                              echo "<option value='".$row['nick']."'>".$row['nick']."</option>";
                            endforeach;
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <div class="fl-wrap fl-wrap-select"><label for="priority" class="fl-label"><?=Priority?></label>
                        <select id="priority" name="priority" class="form-control select2-hidden-accessible fl-select" tabindex="-1" aria-hidden="true">
                          <?php

                            if ($priority == "Critical") {
                              $priorityName = Critical;
                            }elseif($priority == "High"){
                              $priorityName = High;
                            }elseif($priority == "Medium"){
                              $priorityName = Medium;
                            }elseif($priority == "Low"){
                              $priorityName = Lowl;
                            }

                          ?>
                          <option value="<?=$priority?>" selected><?=$priorityName?> (<?=NOW?>)</option>
                          <option value="Critical"><?=Critical?></option>
                          <option value="High"><?=High?></option>
                          <option value="Medium"><?=Medium?></option>
                          <option value="Low"><?=Low?></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-info btn-block"><?=Edit?></button>
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

  <script src="vendor/sumo-select/jquery.sumoselect.min.js"></script>
  <script src="js/preview/select.min.js"></script>
  <script>
    $(function() {
      <?php
        $arrayTags = explode(',', $users_nick);
        foreach ($arrayTags as $user):
          echo "$('select#selectbox-ex4')[0].sumo.selectItem('".$user."');";
        endforeach;
      ?>
    });
  </script>
  <script>
  function validePrivate(){
    if ($('#type').val() == 'Public') {
      $('#tagsUsers').hide();
    } else {
      $('#tagsUsers').show();
    }
  }
  validePrivate();
  </script>

  <div class="sidebar-mobile-overlay"></div>

  <script src="js/preview/settings-panel.min.js"></script>

  <script src="js/preview/slide-nav.min.js"></script>



</body>
</html>
