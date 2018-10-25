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

  $options = [
    'cost' => 12,
  ];

  $hash = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);

  $query = $mysql->prepare("UPDATE users SET nick=:nick, full_name=:full_name, password=:hash, role=:role, id_zone=:id_zone WHERE id=:id");
  
  $query->execute([
    ':nick' => $_POST['nick'],
    ':full_name' => $_POST['full_name'],
    ':id_zone' => $_POST['id_zone'],
    ':hash' => $hash,
    ':id' => $_POST['id']
  ]);

  if($query) header('location: users.php');