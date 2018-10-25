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

  $query = $mysql->prepare("UPDATE storage SET description=:description, priority=:priority WHERE id=:id");
  
  $query->execute([
    ':description' => $_POST['description'],
    ':priority' => $_POST['priority'],
    ':id' => $_POST['id']
  ]);

  if($query) header('location: storage.php');