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

  $query = $mysql->prepare("UPDATE category SET name=:name WHERE id=:id");

  $query->execute([
    ':name' => $_POST['name'],
    ':id' => $_POST['id']
  ]);

  if($query) header('location: category.php');
