<?php

  session_start();
  if(!isset($_SESSION['nick'])){
    header('Location: signin.php');
    exit;
  }

  require_once("config/parameters.php");
  require_once("config/connection.php");

  $query = $mysql->prepare("SELECT * FROM report_reading WHERE id_user=:id_user ORDER BY id DESC");
  $query->execute([
      ':id_user' => $_POST['id']
  ]);
  $result = $query->fetchAll();
  foreach ($result as $row) {
    $ultimaFecha = date_create($row['date']);
    break;
  }

  if (date_format($ultimaFecha, 'd-m-Y') != date('d-m-Y')) {
    $query = $mysql->prepare("INSERT INTO report_reading (id_user) VALUES (:id_user)");
    $query->execute([
        ':id_user' => $_POST['id']
    ]);

    echo "Reporte creado";
  } else {
    echo "Ya tienes un reporte del dia de hoy";
  }